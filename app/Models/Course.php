<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Course extends Model {
    protected $fillable = ['course_code','course_name','description','credit_units','lecturer_id'];
    public function registrations(): HasMany { return $this->hasMany(CourseRegistration::class); }
    public function lecturer() { return $this->belongsTo(User::class, 'lecturer_id'); }
}
