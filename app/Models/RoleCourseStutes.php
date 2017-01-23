<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleCourseStutes extends Model
{
    protected $table = 'role_course_status';

    function role(){
        return $this->belongsTo(Role::class);
    }

    function status(){
        return $this->belongsTo(CourseStatus::class);
    }
}
