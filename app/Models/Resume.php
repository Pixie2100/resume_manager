<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'objectives',
        'address',
        'photo', 
        'nickname', 
        'age', 
        'sex', 
        'birthday', 
        'birthplace', 
        'father_name', 
        'mother_name', 
        'civil_status', 
        'nationality', 
        'religion',
    ];

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function employments()
    {
        return $this->hasMany(Employment::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}