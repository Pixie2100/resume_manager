<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        // Display a list of all resumes
        $resumes = Resume::with(['educations', 'employments', 'skills', 'references'])->get();
        return view('resumes.index', compact('resumes'));
    }

    public function create()
    {
        // Show a form to create a new resume
        return view('resumes.create');
    }

    public function store(Request $request)
{
    // Validate and store a new resume
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'objectives' => 'required|string',
        'address' => 'nullable|string',
        'nickname' => 'nullable|string|max:255',
        'age' => 'nullable|integer',
        'sex' => 'nullable|string|max:10',
        'birthday' => 'nullable|date',
        'birthplace' => 'nullable|string|max:255',
        'father_name' => 'nullable|string|max:255',
        'mother_name' => 'nullable|string|max:255',
        'civil_status' => 'nullable|string|max:50',
        'nationality' => 'nullable|string|max:255',
        'religion' => 'nullable|string|max:255',
        'educations.*.school_name' => 'required|string|max:255',
        'educations.*.degree' => 'nullable|string|max:255',
        'educations.*.year_started' => 'nullable|string|max:255',
        'educations.*.year_ended' => 'nullable|string|max:255',
        'employments.*.company_name' => 'required|string|max:255',
        'employments.*.position' => 'required|string|max:255',
        'employments.*.year_started' => 'nullable|string|max:255',
        'employments.*.year_ended' => 'nullable|string|max:255',
        'skills.*.skill_name' => 'required|string|max:255',
        'references.*.name' => 'required|string|max:255',
        'references.*.email' => 'required|email|max:255',
        'references.*.phone' => 'required|string|max:20',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate the photo
    ]);

        // Handle the photo upload if exists
        if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');  // Store in 'storage/app/public/photos'
        } else {
        $photoPath = null;  // If no photo uploaded, set it to null
        }

        // Create the resume record
    $resume = Resume::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'objectives' => $validated['objectives'],
        'address' => $validated['address'],
        'nullable' => $validated['address'] ?? null, // Handle null if not provided
        'nickname' => $validated['nickname'] ?? null, // Handle null if not provided
        'age' => $validated['age'] ?? null, // Handle null if not provided
        'sex' => $validated['sex'] ?? null, // Handle null if not provided
        'birthday' => $validated['birthday'] ?? null, // Handle null if not provided
        'birthplace' => $validated['birthplace'] ?? null, // Handle null if not provided
        'father_name' => $validated['father_name'] ?? null, // Handle null if not provided
        'mother_name' => $validated['mother_name'] ?? null, // Handle null if not provided
        'civil_status' => $validated['civil_status'] ?? null, // Handle null if not provided
        'nationality' => $validated['nationality'] ?? null, // Handle null if not provided
        'religion' => $validated['religion'] ?? null, // Handle null if not provided
        'photo' => $photoPath,  // Save the photo path to the database
    ]);

        $resume->educations()->createMany($request->input('educations', []));
        $resume->employments()->createMany($request->input('employments', []));
        $resume->skills()->createMany($request->input('skills', []));
        $resume->references()->createMany($request->input('references', []));

        return redirect()->route('resumes.index')->with('success', 'Resume created successfully.');
    }

    public function show(Resume $resume)
    {
        // Display a single resume
        return view('resumes.show', compact('resume'));
    }

    public function edit(Resume $resume)
    {
        // Show a form to edit an existing resume
        return view('resumes.edit', compact('resume'));
    }

    public function update(Request $request, Resume $resume)
    {
        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'objectives' => 'nullable|string',
            'address' => 'nullable|string',
            'nickname' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'sex' => 'nullable|string|max:10',
            'birthday' => 'nullable|date',
            'birthplace' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'civil_status' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            // Validate education fields
            'educations.*.school_name' => 'required|string|max:255',
            'educations.*.degree' => 'nullable|string|max:255',
            'educations.*.year_started' => 'required|integer',
            'educations.*.year_ended' => 'nullable|integer',
            // Validate employment fields
            'employments.*.company_name' => 'required|string|max:255',
            'employments.*.position' => 'required|string|max:255',
            'employments.*.year_started' => 'required|integer',
            'employments.*.year_ended' => 'nullable|integer',
            // Validate skills fields
            'skills.*' => 'required|string|max:255',
            // Validate reference fields
            'references.*.name' => 'required|string|max:255',
            'references.*.email' => 'required|email|max:255',
            'references.*.phone' => 'required|string|max:15',
        ]);

// Handle the photo upload if exists
if ($request->hasFile('photo')) {
    $photoPath = $request->file('photo')->store('photos', 'public');
} else {
    $photoPath = $resume->photo;  // Keep the existing photo if none uploaded
}

// Update the resume's main fields
$resume->update([
    'name' => $request->input('name'),
    'email' => $request->input('email'),
    'phone' => $request->input('phone'),
    'objectives' => $request->input('objectives'),
    'address' => $request->input('address', null), // Default to null if not provided
    'nickname' => $request->input('nickname', null), // Default to null if not provided
    'age' => $request->input('age', null), // Default to null if not provided
    'sex' => $request->input('sex', null), // Default to null if not provided
    'birthday' => $request->input('birthday', null), // Default to null if not provided
    'birthplace' => $request->input('birthplace', null), // Default to null if not provided
    'father_name' => $request->input('father_name', null), // Default to null if not provided
    'mother_name' => $request->input('mother_name', null), // Default to null if not provided
    'civil_status' => $request->input('civil_status', null), // Default to null if not provided
    'nationality' => $request->input('nationality', null), // Default to null if not provided
    'religion' => $request->input('religion', null), // Default to null if not provided
    'photo' => $photoPath,  // Save the photo path to the database (or keep old photo)
]);

// Update Education (if any)
$educationData = $request->input('education', []);
$existingEducationIds = $resume->educations()->pluck('id')->toArray();

// Loop through the incoming education data
foreach ($educationData as $id => $education) {
    if ($education['school_name']) {
        // Update or create the education entry
        $resume->educations()->updateOrCreate(
            ['id' => $id], // Match by ID to update existing
            [
                'school_name' => $education['school_name'],
                'degree' => $education['degree'] ?? null, // Allow degree to be nullable 
                'year_started' => $education['year_started'],
                'year_ended' => $education['year_ended']
            ]
        );

        // Remove this ID from the list of existing education IDs
        $existingEducationIds = array_diff($existingEducationIds, [$id]);
    }
}

// Delete any educations that were not included in the updated data
foreach ($existingEducationIds as $idToDelete) {
    $resume->educations()->where('id', $idToDelete)->delete();
}

// Update Employment (if any)
$employmentData = $request->input('employment', []);
$existingEmploymentIds = $resume->employments()->pluck('id')->toArray();

// Loop through the incoming employment data
foreach ($employmentData as $id => $employment) {
    if ($employment['company_name']) {
        // Update or create the employment entry
        $resume->employments()->updateOrCreate(
            ['id' => $id], // Match by ID to update existing
            [
                'company_name' => $employment['company_name'],
                'position' => $employment['position'],
                'year_started' => $employment['year_started'],
                'year_ended' => $employment['year_ended']
            ]
        );

        // Remove this ID from the list of existing employment IDs
        $existingEmploymentIds = array_diff($existingEmploymentIds, [$id]);
    }
}

// Delete any employments that were not included in the updated data
foreach ($existingEmploymentIds as $idToDelete) {
    $resume->employments()->where('id', $idToDelete)->delete();
}

// Update Skills (if any)
$skillsData = $request->input('skills', []);
$existingSkills = $resume->skills()->pluck('skill_name')->toArray();

foreach ($skillsData as $id => $skillName) {
    if ($skillName && !in_array($skillName, $existingSkills)) {
        // Add new skill without overwriting
        $resume->skills()->create(['skill_name' => $skillName]);
    }

    // Remove this skill name from the list of existing skills to track what needs to be deleted
    $existingSkills = array_diff($existingSkills, [$skillName]);
}

// Delete any skills that were not included in the updated data
foreach ($existingSkills as $skillToDelete) {
    $resume->skills()->where('skill_name', $skillToDelete)->delete();
}

    // Update References (if any)
$referenceData = $request->input('references', []);
$existingReferenceIds = $resume->references()->pluck('id')->toArray();

// Loop through the incoming reference data
foreach ($referenceData as $id => $reference) {
    if ($reference['name']) {
        // Update or create the reference entry
        $resume->references()->updateOrCreate(
            ['id' => $id], // Match by ID to update existing
            [
                'name' => $reference['name'],
                'email' => $reference['email'],
                'phone' => $reference['phone']
            ]
        );

        // Remove this ID from the list of existing reference IDs
        $existingReferenceIds = array_diff($existingReferenceIds, [$id]);
    }
}

// Delete any references that were not included in the updated data
foreach ($existingReferenceIds as $idToDelete) {
    $resume->references()->where('id', $idToDelete)->delete();
}

return redirect()->route('resumes.show', ['resume' => $resume->id])
                 ->with('success', 'Resume of ' . $resume->name . ' updated successfully.');
}

public function destroy($id)
{
    $resume = Resume::findOrFail($id);
    $resume->delete();  // Deletes the resume
    // You may want to delete related records here as well, e.g., related references, education, etc.
    return redirect()->route('resumes.index')->with('success', 'Resume deleted successfully');
}

public function tracker($resumeId)
{
    $resume = Resume::findOrFail($resumeId);
    $applications = $resume->applications;  // Assuming there's a relationship with the Application model
    
    return view('resumes.tracker', compact('resume', 'applications'));
}

}