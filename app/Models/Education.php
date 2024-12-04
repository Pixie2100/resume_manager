<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations'; // Explicitly define the correct table name
    
    protected $fillable = [
        'school_name',
        'degree',
        'year_started',
        'year_ended',
        'resume_id'
    ];
}
