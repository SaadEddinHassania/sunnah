<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseStatus extends Model
{
    function courses()
    {
        return $this->hasMany(Course::class);
    }
}
