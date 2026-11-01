<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class StudentController extends Controller {
    public function index() { $students = Student::withCount('registrations')->orderBy('student_number')->paginate(10); return view('students.index', compact('students')); }
    public function create() { return view('students.form', ['student'=>new Student(), 'heading'=>'Add student']); }
    public function store(Request $request) {
        $data = $request->validate(['student_number'=>'required|string|max:30|unique:students,student_number','first_name'=>'required|string|max:100','last_name'=>'required|string|max:100','email'=>'required|email|max:255|unique:students,email','course_of_study'=>'nullable|string|max:150']);
        Student::create($data); return redirect()->route('students.index')->with('success','Student added successfully.');
    }
    public function show(Student $student) { $student->load('registrations.course'); return view('students.show', compact('student')); }
    public function edit(Student $student) { return view('students.form', ['student'=>$student, 'heading'=>'Edit student']); }
    public function update(Request $request, Student $student) {
        $data = $request->validate(['student_number'=>['required','string','max:30',Rule::unique('students')->ignore($student->id)],'first_name'=>'required|string|max:100','last_name'=>'required|string|max:100','email'=>['required','email','max:255',Rule::unique('students')->ignore($student->id)],'course_of_study'=>'nullable|string|max:150']);
        $student->update($data); return redirect()->route('students.index')->with('success','Student updated successfully.');
    }
    public function destroy(Student $student) { $student->delete(); return redirect()->route('students.index')->with('success','Student deleted successfully.'); }
}
