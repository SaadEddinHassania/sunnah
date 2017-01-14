<?php
/**
 * Created by PhpStorm.
 * User: abu-alhsn
 * Date: 03/12/16
 * Time: 14:02
 */

function getNameById($field, $id)
{
    $model_name = ucfirst(explode('_', $field)[0]);
    if ($model_name == 'Field' || $model_name == 'Type') {
        $model_name = 'Course' . $model_name;
    }
    $c = '\App\Models\\' . $model_name;
    error_log($c);
    return $c::getName($id);

//    return \App\Models\Course::where('id', 1)->select('name')->first()->name;
}
