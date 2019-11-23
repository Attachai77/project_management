<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    protected $guarded = [];


    public function permissions()
    {
        // return $this->hasMany('App\Permission', 'permission_group_id', 'id');
        return $this->hasMany('App\Permission');
    }
}
