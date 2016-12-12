<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    
    public $timestamps = false;

    public static function getName($id)
    {
        return Student::join('users', 'students.user_id', 'users.id')
            ->where('users.id', '=', $id)
            ->select('users.name')
            ->first()
            ->name;
    }

    public function getByRegion($region_id)
    {
        return $this->join('users', 'students.user_id', 'users.id')
            ->where('region_id', '=', $region_id)
            ->pluck('users.name', 'students.user_id');
    }

    public static function getStudentsByCourse($course_id)
    {
        $dd = Student::join('users', 'students.user_id', 'users.id')
            ->join('course_students', 'users.id', 'course_students.student_id')
            ->where('course_students.course_id', '=', $course_id)
            ->select('users.name', 'students.user_id', 'course_students.status', 'course_students.grade')
            ->get();
        error_log('data= ' . json_encode($dd));
        return $dd;
    }
}
