<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course_Student extends Model
{
    protected $table = 'course_students';
    protected $fillable = ['course_id', 'student_id', 'status', 'grade'];
}
