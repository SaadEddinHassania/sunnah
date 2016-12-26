<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    public static function getName($id)
    {
        return Permission::where('id', '=', $id)
            ->select('display_name as name')
            ->first()
            ->name;
    }

    public static function toDropDown()
    {
        return Permission::pluck('display_name as name', 'id');
    }

    public static function getId($funcName, $className)
    {
        error_log($funcName. ' == ' . $className);
        return Permission::where('policy_name', '=', $className)
            ->where('func_name', '=', $funcName)
            ->select('id')
            ->first()
            ->id;
    }
    
    public static function toDropDownDis(){
        return Permission::select('policy_name')->distinct()->get();
    }

    public function permissionsByPolicy($policy_name){
        return Permission::where('policy_name', $policy_name)->get();
    }


}
