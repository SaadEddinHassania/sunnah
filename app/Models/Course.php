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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function supervisor(){
        return $this->belongsTo(Supervisor::class, 'supervisor_id', 'user_id')->with('user');
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id', 'user_id')->with('user');
    }

    public function venue(){
        return $this->belongsTo(Venue::class);
    }

}