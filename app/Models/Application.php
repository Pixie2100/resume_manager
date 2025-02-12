<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'link', 'status', 'resume_id'];

    // Relationship to Resume
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}