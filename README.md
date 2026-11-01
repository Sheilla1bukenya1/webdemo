# MUBS Student Management System — AWAD Coursework Two

Laravel application for managing students, courses, and course registrations.

## Features
- Student records: create, view, update, and delete (administrator).
- Course records: create, view and update (administrator/lecturer); delete (administrator).
- Course registrations with database-level prevention of duplicate student/course pairs.
- Role-based pages for administrator, lecturer, and student.
- Students can browse available courses and see their own registrations.
- Lecturers can view their assigned courses and the students registered in them.
- Form validation, confirmation prompts, feedback messages, pagination, and responsive styling.

## Setup on Windows
1. Extract this folder into your project directory.
2. Open the project folder in VS Code.
3. Make sure PHP, Composer, Node.js, and MySQL are installed.
4. Copy `.env.example` to `.env` if you do not already have your own `.env`.
5. Create a MySQL database named `awad_coursework_management_system`.
6. In `.env`, set `DB_CONNECTION=mysql`, `DB_HOST=127.0.0.1`, `DB_PORT=3306`, `DB_DATABASE=awad_coursework_management_system`, and your own MySQL username/password.
7. In the terminal run:
   ```bash
   composer install
   php artisan key:generate
   php artisan migrate --seed
   ```
8. Start the site:
   ```bash
   php artisan serve
   ```
9. Open `http://127.0.0.1:8000`.

If you already have important records in the database, back it up first. Do not use `migrate:fresh` on a database containing data you need.

## Seeded login accounts
- Administrator: `admin@gmail.com` / `Admin@123`
- Lecturer: `lecturer@gmail.com` / `Lecturer@123`
- Student: `john@gmail.com` / `Student@123`
- Other seeded student accounts also use password `Student@123` (e.g. `lucy@gmail.com`).

Change these sample passwords before using this system beyond coursework.

## Important notes
- This implementation uses a `role` column and a small role middleware so the project works without requiring an additional role package installation. If your coursework specifically requires Spatie Laravel Permission, install and configure that package separately and migrate the role checks accordingly.
- The student portal links a login to a student record by matching the user's email with the student's email. Make sure those emails match.
- This project was prepared from the uploaded archive, which did not include the controllers, models, routes, and pages from the earlier working version. Review it in your own Laravel/PHP/MySQL environment before submission.
