<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Database\Seeder;

class CourseRegistrationSeeder extends Seeder
{
    public function run(): void
    {
       $registrations = [
            ['student_number' => 'STU001', 'course_code' => 'BCS101', 'registration_date' => '2026-10-01'],
            ['student_number' => 'STU001', 'course_code' => 'DBS201', 'registration_date' => '2026-10-02'],
            ['student_number' => 'STU002', 'course_code' => 'BCS101', 'registration_date' => '2026-10-03'],
            ['student_number' => 'STU003', 'course_code' => 'WEB202', 'registration_date' => '2026-10-04'],
            ['student_number' => 'STU004', 'course_code' => 'NET203', 'registration_date' => '2026-10-05'],
        ];

        foreach ($registrations as $row) {
            $student = Student::where('student_number', $row['student_number'])->first();
            $course = Course::where('course_code', $row['course_code'])->first();
            if ($student && $course) {
                CourseRegistration::updateOrCreate(
                    ['student_id' => $student->id, 'course_id' => $course->id],
                    ['registration_date' => $row['registration_date']]
                );
            }
        }
    }
}
