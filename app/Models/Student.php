<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    
    public $timestamps = false;

    protected $appends = array('المنطقة','الاسم','تاريخ الميلاد','رقم الجوال');

    public function getالاسمAttribute()
    {
        return $this->user->name;
    }

    public function getالمنطقةAttribute()
    {
        return $this->region->name;
    }
    public function getتاريخالميلادAttribute()
    {
        return $this->dob;
    }
    public function getرقمالجوالAttribute()
    {
        return $this->mobile;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

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
            ->join('course_user', 'users.id', 'course_user.user_id')
            ->where('course_user.course_id', '=', $course_id)
            ->select('users.name', 'students.user_id', 'course_user.status', 'course_user.grade')
            ->get();

        return $dd;
    }

}
