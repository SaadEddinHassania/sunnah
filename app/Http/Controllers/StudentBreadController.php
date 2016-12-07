<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentBreadController extends Controller
{
    public function getStudentByRegion($region_id)
    {
        return Student::join('users', 'students.user_id', 'users.id')
            ->where('region_id', '=', $region_id)
            ->pluck('students.user_id', 'users.name');
    }
}
