<?php
namespace Database\Seeders;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {
    public function run(): void {
       $admin=User::updateOrCreate(['email'=>'admin@gmail.com'],['name'=>'System Administrator','password'=>Hash::make('Admin@123'),'role'=>'admin']);
        $lecturer=User::updateOrCreate(['email'=>'lecturer@gmail.com'],['name'=>'Course Lecturer','password'=>Hash::make('Lecturer@123'),'role'=>'lecturer']);
        $students=[
            ['student_number'=>'STU001','first_name'=>'John','last_name'=>'Mugisha','email'=>'john@gmail.com','course_of_study'=>'Business Computing'],
            ['student_number'=>'STU002','first_name'=>'Mary','last_name'=>'Nankya','email'=>'mary@gmail.com','course_of_study'=>'Business Computing'],
            ['student_number'=>'STU003','first_name'=>'Peter','last_name'=>'Okello','email'=>'peter@gmail.com','course_of_study'=>'Accounting'],
            ['student_number'=>'STU004','first_name'=>'Sarah','last_name'=>'Atim','email'=>'sarah@gmail.com','course_of_study'=>'Marketing'],
            ['student_number'=>'STU005','first_name'=>'Lucy','last_name'=>'Namumbya','email'=>'lucy@gmail.com','course_of_study'=>'Business Computing'],
        ];
        foreach($students as $data) {
            $student=Student::updateOrCreate(['student_number'=>$data['student_number']],$data);
            User::updateOrCreate(['email'=>$student->email],['name'=>$student->first_name.' '.$student->last_name,'password'=>Hash::make('Student@123'),'role'=>'student']);
        }
        $courses=[
            ['course_code'=>'BCS101','course_name'=>'Introduction to Business Computing','description'=>'Foundations of business computing and information systems.','credit_units'=>3],
            ['course_code'=>'DBS201','course_name'=>'Database Systems','description'=>'Relational databases, SQL and database design.','credit_units'=>4],
            ['course_code'=>'WEB202','course_name'=>'Web Application Development','description'=>'Design and development of web applications.','credit_units'=>4],
            ['course_code'=>'NET203','course_name'=>'Computer Networks','description'=>'Networking concepts, protocols and administration.','credit_units'=>3],
        ];
        foreach($courses as $data) {
            $course=Course::updateOrCreate(['course_code'=>$data['course_code']],$data+['lecturer_id'=>$lecturer->id]);
        }
        $sample=[
            ['student_number'=>'STU001','course_code'=>'BCS101','date'=>'2026-10-01'],
            ['student_number'=>'STU001','course_code'=>'DBS201','date'=>'2026-10-02'],
            ['student_number'=>'STU002','course_code'=>'BCS101','date'=>'2026-10-03'],
            ['student_number'=>'STU003','course_code'=>'WEB202','date'=>'2026-10-04'],
            ['student_number'=>'STU004','course_code'=>'NET203','date'=>'2026-10-05'],
        ];
        foreach($sample as $row) {
            $student=Student::where('student_number',$row['student_number'])->first();
            $course=Course::where('course_code',$row['course_code'])->first();
            CourseRegistration::updateOrCreate(['student_id'=>$student->id,'course_id'=>$course->id],['registration_date'=>$row['date']]);
        }
    }
}
