<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sibling extends Model
{
    protected $guarded=[];
    public function user(){
        return $this->hasOne(User::class);
    }
    public function student(){
        return $this->hasOne(Student::class);
    }
}
