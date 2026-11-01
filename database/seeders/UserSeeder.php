<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
      $users = [
            ['name' => 'Administrator', 'email' => 'admin@gmail.com', 'password' => 'Admin@123', 'role' => 'admin'],
            ['name' => 'Lecturer', 'email' => 'lecturer@gmail.com', 'password' => 'Lecturer@123', 'role' => 'lecturer'],
            ['name' => 'John Student', 'email' => 'john@gmail.com', 'password' => 'Student@123', 'role' => 'student'],
            ['name' => 'Lucy Namumbya', 'email' => 'lucy@gmail.com', 'password' => 'Student@123', 'role' => 'student'],
            ['name' => 'Peter Mugisha', 'email' => 'peter@gmail.com', 'password' => 'Student@123', 'role' => 'student'],
            ['name' => 'Sarah Achieng', 'email' => 'sarah@gmail.com', 'password' => 'Student@123', 'role' => 'student'],
            ['name' => 'David Okello', 'email' => 'david@gmail.com', 'password' => 'Student@123', 'role' => 'student'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                ['name' => $user['name'], 'password' => Hash::make($user['password']), 'role' => $user['role']]
            );
        }
    }
}
