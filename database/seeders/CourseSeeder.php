<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
      $courses = [
            ['course_code' => 'BCS101', 'course_name' => 'Introduction to Business Computing', 'description' => 'Foundations of business computing.', 'credit_units' => 3],
            ['course_code' => 'DBS201', 'course_name' => 'Database Management Systems', 'description' => 'Database design, SQL and data management.', 'credit_units' => 4],
            ['course_code' => 'WEB202', 'course_name' => 'Web Application Development', 'description' => 'Fundamentals of developing web applications.', 'credit_units' => 4],
            ['course_code' => 'NET203', 'course_name' => 'Computer Networks', 'description' => 'Networking concepts and infrastructure.', 'credit_units' => 3],
        ];

        foreach ($courses as $course) {
            Course::updateOrCreate(['course_code' => $course['course_code']], $course);
        }
    }
}
