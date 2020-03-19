<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function member()
    {
        return $this->hasMany('App\TaskMember');
    }

    public function task_files()
    {
        return $this->hasMany('App\TaskFile');
    }

}
