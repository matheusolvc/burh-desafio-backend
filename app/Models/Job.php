<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['title', 'description', 'salary', 'start_time', 'exit_time', 'company_id', 'job_type_id'];

    function company() {
        return $this->belongsTo('App\Company');
    }

    function jobType(){
        return $this->belongsTo('App\JobType');
    }

    function users(){
        return $this->belongsToMany(User::class, 'job_user');
    }
}
