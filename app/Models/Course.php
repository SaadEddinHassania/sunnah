<?php

/**
 * Created by PhpStorm.
 * User: abu-alhsn
 * Date: 02/12/16
 * Time: 15:53
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return Course::where('id', '=', $id)
            ->select('name')
            ->first()
            ->name;
    }
}