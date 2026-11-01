<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Student extends Model {
    protected $fillable = ['student_number','first_name','last_name','email','course_of_study'];
    public function registrations(): HasMany { return $this->hasMany(CourseRegistration::class); }
    public function user() { return $this->hasOne(User::class, 'email', 'email'); }
}
