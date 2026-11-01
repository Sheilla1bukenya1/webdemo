<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['student_number' => 'STU001', 'first_name' => 'John', 'last_name' => 'Mugisha', 'email' => 'john@gmail.com', 'course_of_study' => 'Business Computing'],
            ['student_number' => 'STU002', 'first_name' => 'Lucy', 'last_name' => 'Namumbya', 'email' => 'lucy@gmail.com', 'course_of_study' => 'Business Computing'],
            ['student_number' => 'STU003', 'first_name' => 'Peter', 'last_name' => 'Mugisha', 'email' => 'peter@gmail.com', 'course_of_study' => 'Information Technology'],
            ['student_number' => 'STU004', 'first_name' => 'Sarah', 'last_name' => 'Achieng', 'email' => 'sarah@gmail.com', 'course_of_study' => 'Business Computing'],
            ['student_number' => 'STU005', 'first_name' => 'David', 'last_name' => 'Okello', 'email' => 'david@gmail.com', 'course_of_study' => 'Information Technology'],
        ];

        foreach ($students as $student) {
            Student::updateOrCreate(['student_number' => $student['student_number']], $student);
        }
    }
}
