<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Resume;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // Show the applications for a specific resume
    public function show(Resume $resume)
    {
        $applications = $resume->applications; // Fetch applications related to the resume
        return view('resumes.tracker', compact('resume', 'applications')); // Updated view path
    }

    // Add a new application
    public function store(Request $request, Resume $resume)
    {
        $validated = $request->validate([
            'company_name' => 'required|string',
            'link' => 'required|url',
            'status' => 'required|string',
        ]);

        // Create a new application related to the resume
        $resume->applications()->create($validated);

        return redirect()->route('tracker.show', $resume)->with('success', 'Application added successfully!');
    }

    // Update an existing application
    public function update(Request $request, Application $application)
{
    // Validate the status input
    $validated = $request->validate([
        'status' => 'required|string',
    ]);

    // Update the status of the application
    $application->update($validated);

    // Redirect back to the tracker page with a success message
    return redirect()->route('tracker.show', $application->resume)->with('success', 'Application status updated successfully!');
}


    // Delete an application
    public function destroy(Application $application)
    {
        $application->delete(); // Delete the application

        return redirect()->route('tracker.show', $application->resume)->with('success', 'Application deleted successfully!');
    }
}
