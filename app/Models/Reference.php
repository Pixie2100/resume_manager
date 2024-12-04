<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone'];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
