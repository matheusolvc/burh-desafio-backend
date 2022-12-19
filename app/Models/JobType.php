<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    protected $fillable = ['type_name', 'max_time', 'min_salary'];

    function company() {
        return $this->hasMany('App\Job');
    }
}
