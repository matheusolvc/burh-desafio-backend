<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'description', 'cnpj'];

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }

    public function plans(){
        return $this->belongsTo('App\Plan');
    }
}
