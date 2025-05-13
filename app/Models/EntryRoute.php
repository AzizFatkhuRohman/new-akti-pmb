<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntryRoute extends Model
{
    protected $guarded=[];
    public function student(){
        return $this->hasOne(Student::class);
    }
}
