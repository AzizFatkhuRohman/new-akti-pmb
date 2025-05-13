<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function student(){
        return $this->hasOne(Student::class);
    }
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
}
