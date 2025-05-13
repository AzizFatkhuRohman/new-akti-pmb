<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded=[];
    public function gradeSchool(){
        return $this->hasOne(GradeSchool::class);
    }
    public function juniorHighSchool(){
        return $this->hasOne(JuniorHighSchool::class);
    }
    public function seniorHighSchool(){
        return $this->hasOne(SeniorHighSchool::class);
    }
    public function achievement(){
        return $this->hasMany(Achievement::class);
    }
    public function raport(){
        return $this->hasOne(Raport::class);
    }
    public function father(){
        return $this->hasOne(Father::class);
    }
    public function mother(){
        return $this->hasOne(Mother::class);
    }
    public function guardian(){
        return $this->hasOne(Guardian::class);
    }
    public function sibling(){
        return $this->hasMany(Sibling::class);
    }
    public function passAdministration(){
        return $this->hasOne(PassAdministration::class);
    }
    public function passExam(){
        return $this->hasOne(PassExam::class);
    }
    public function passEye(){
        return $this->hasOne(PassEye::class);
    }
    public function passInterview(){
        return $this->hasOne(PassInterview::class);
    }
    public function passPsychotest(){
        return $this->hasOne(PassPsychotest::class);
    }
    public function passMedical(){
        return $this->hasOne(PassMedical::class);
    }
    public function entryRoute(){
        return $this->belongsTo(EntryRoute::class);
    }
}
