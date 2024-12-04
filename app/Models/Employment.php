<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'position', 'year_started', 'year_ended'];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
