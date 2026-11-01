<?php
namespace App\Models;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable {
    use HasFactory, Notifiable;
    protected function casts(): array {
        return ['email_verified_at' => 'datetime', 'password' => 'hashed'];
    }
    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isLecturer(): bool { return $this->role === 'lecturer'; }
    public function student() { return $this->hasOne(Student::class, 'email', 'email'); }
    public function taughtCourses() { return $this->hasMany(Course::class, 'lecturer_id'); }
}
