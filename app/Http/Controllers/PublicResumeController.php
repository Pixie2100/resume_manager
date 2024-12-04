<?php

namespace App\Http\Controllers;

use App\Models\Resume;

class PublicResumeController extends Controller
{
    public function show(Resume $resume)
    {
        // Pass the resume data to the public view
        return view('public', compact('resume'));
    }
}