<?php

/**
 * Created by PhpStorm.
 * User: abu-alhsn
 * Date: 02/12/16
 * Time: 15:53
 */

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    protected $table = 'courses';

    public function students(){
        return $this->belongsToMany(Student::class,'course_student','student_id','student_id');
    }

    public function rows()
    {
        return $this->join('supervisor', 'supervisor.id', '=', 'courses.supervisor_id')
            ->select('courses.id', 'courses.sn', 'courses.name');
    }

    public static function getName($id)
    {
        $user = User::where('id', '=', Auth::user()->id)->first();
        $course = Course::where('id', '=', $id)
            ->select('name')
            ->first()
            ->name;

        if ($user->can('view', $course)) {
            return $course;
        }
        return 'permission';
    }
}