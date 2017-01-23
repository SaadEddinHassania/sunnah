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

    protected $appends = ['rating'];

    public function getRatingAttribute()
    {
        $tested = 3;
        $attended = 2;
        $type = $this->type_id;
        $rating = 0;

        $students = $this->users;
        foreach ($students as $student) {
            $status = CourseUser::whereCourse_id($this->id)->whereUser_id($student->id)->first()->status;
            if ($status == 1) {
                $rating += $type * $tested;
            } elseif ($status == 2) {
                $rating += $type * $attended;
            }
        }
        return $rating;

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

    public static function toDropDown()
    {
        return Course::pluck('name', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function type()
    {
        return $this->belongsTo(CourseType::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id', 'user_id')->with('user');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'user_id')->with('user');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function status()
    {
        return $this->belongsTo(CourseStatus::class);
    }

}