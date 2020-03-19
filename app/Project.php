<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // protected $fillable = ['*'];
    protected $guarded = [];

    public function project_purposes()
    {
        // return $this->hasMany('App\Permission', 'permission_group_id', 'id');
        return $this->hasMany('App\ProjectPurpose');
    }

    public function project_expecteds()
    {
        return $this->hasMany('App\ProjectExpected');
    }

    public function project_supports()
    {
        return $this->hasMany('App\ProjectSupport');
    }

    public function members()
    {
        return $this->hasMany('App\ProjectMember');
    }

    public function project_files()
    {
        return $this->hasMany('App\ProjectFile');
    }

    public function summary()
    {
        return $this->hasOne('App\ProjectSummary', 'project_id', 'id');
    }

    public function summary_comments()
    {
        return $this->hasMany('App\ProjectSummaryComment');
    }

    public function inProgressCount()
    {
        $projects = Project::all();
    }

}
