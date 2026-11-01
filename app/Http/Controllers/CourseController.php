<?php
namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class CourseController extends Controller {
    public function index() {
        $query = Course::with('lecturer')->withCount('registrations');
        if (auth()->user()->role === 'lecturer') $query->where('lecturer_id', auth()->id());
        $courses = $query->orderBy('course_code')->paginate(10);
        return view('courses.index', compact('courses'));
    }
    public function create() { $lecturers = User::where('role','lecturer')->orderBy('name')->get(); return view('courses.form', ['course'=>new Course(),'heading'=>'Add course','lecturers'=>$lecturers]); }
    public function store(Request $request) {
        $data=$request->validate(['course_code'=>'required|string|max:30|unique:courses,course_code','course_name'=>'required|string|max:150','description'=>'nullable|string','credit_units'=>'required|integer|min:1|max:30','lecturer_id'=>'nullable|exists:users,id']);
        if (auth()->user()->role==='lecturer') $data['lecturer_id']=auth()->id();
        Course::create($data); return redirect()->route('courses.index')->with('success','Course added successfully.');
    }
    public function show(Course $course) { if(auth()->user()->role==='lecturer' && $course->lecturer_id!==auth()->id()) abort(403); $course->load('lecturer','registrations.student'); return view('courses.show',compact('course')); }
    public function edit(Course $course) { if(auth()->user()->role==='lecturer' && $course->lecturer_id!==auth()->id()) abort(403); $lecturers=User::where('role','lecturer')->orderBy('name')->get(); return view('courses.form', ['course'=>$course,'heading'=>'Edit course','lecturers'=>$lecturers]); }
    public function update(Request $request, Course $course) {
        if(auth()->user()->role==='lecturer' && $course->lecturer_id!==auth()->id()) abort(403);
        $data=$request->validate(['course_code'=>['required','string','max:30',Rule::unique('courses')->ignore($course->id)],'course_name'=>'required|string|max:150','description'=>'nullable|string','credit_units'=>'required|integer|min:1|max:30','lecturer_id'=>'nullable|exists:users,id']);
        if(auth()->user()->role==='lecturer') $data['lecturer_id']=auth()->id();
        $course->update($data); return redirect()->route('courses.index')->with('success','Course updated successfully.');
    }
    public function destroy(Course $course) { if(auth()->user()->role!=='admin') abort(403); $course->delete(); return redirect()->route('courses.index')->with('success','Course deleted successfully.'); }
}
