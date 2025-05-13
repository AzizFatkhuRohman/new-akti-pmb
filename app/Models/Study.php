<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $guarded=[];
    public function seniorHighSchool(){
        return $this->hasMany(SeniorHighSchool::class);
    }
}
