<?php
namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class StudentRegistrationController extends Controller {
    public function index() {
        $user=Auth::user();
        if($user->role==='student') {
            $student=Student::where('email',$user->email)->first();
            if(!$student) abort(403,'Your login email is not linked to a student record. Ask the administrator to make the emails match.');
            $registrations=$student->registrations()->with('course')->latest()->paginate(10);
        } else {
            $registrations=CourseRegistration::with(['student','course'])->latest()->paginate(10);
        }
        return view('registrations.index',compact('registrations'));
    }
    public function availableCourses() {
        $registeredIds=[];
        if(Auth::user()->role==='student') {
            $student=Student::where('email',Auth::user()->email)->first();
            if(!$student) abort(403,'Your login email is not linked to a student record.');
            $registeredIds=$student->registrations()->pluck('course_id')->all();
        }
        $courses=Course::whereNotIn('id',$registeredIds)->orderBy('course_code')->paginate(10);
        return view('registrations.available',compact('courses'));
    }
    public function store(Request $request) {
        $student=Student::where('email',Auth::user()->email)->first();
        if(Auth::user()->role==='student' && !$student) abort(403,'Your login email is not linked to a student record.');
        $data=$request->validate(['course_id'=>'required|exists:courses,id']);
        if(Auth::user()->role!=='student') {
            $data['student_id']=$request->validate(['student_id'=>'required|exists:students,id'])['student_id'];
        } else { $data['student_id']=$student->id; }
        if(CourseRegistration::where('student_id',$data['student_id'])->where('course_id',$data['course_id'])->exists()) {
            return back()->withErrors(['course_id'=>'This student is already registered for that course.']);
        }
        $data['registration_date']=now()->toDateString();
        CourseRegistration::create($data);
        return redirect()->route('registrations.index')->with('success','Course registration saved successfully.');
    }
    public function create() { return view('registrations.create',['students'=>Student::orderBy('student_number')->get(),'courses'=>Course::orderBy('course_code')->get()]); }
    public function destroy(CourseRegistration $registration) {
        if(Auth::user()->role==='student') {
            $student=Student::where('email',Auth::user()->email)->first();
            if(!$student || $registration->student_id!==$student->id) abort(403);
        }
        $registration->delete(); return back()->with('success','Registration removed.');
    }
}
