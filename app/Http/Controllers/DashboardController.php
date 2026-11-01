<?php
namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller {
    public function index() {
        $user = Auth::user();
        $studentCount = Student::count();
        $courseCount = Course::count();
        $registrationCount = CourseRegistration::count();
        $myRegistrations = collect();
        if ($user->role === 'student' && $user->student) {
            $myRegistrations = $user->student->registrations()->with('course')->latest()->get();
        }
        $myCourses = $user->role === 'lecturer' ? $user->taughtCourses()->withCount('registrations')->get() : collect();
        return view('dashboard', compact('studentCount','courseCount','registrationCount','myRegistrations','myCourses'));
    }
}
