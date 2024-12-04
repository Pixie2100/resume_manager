@extends('layouts.manager')

@section('content')
    <!-- Display errors -->
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <header class="bg-white dark:bg-gray-800 shadow sticky top-0 z-10">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Resume of {{ $resume->name }}
        </h2>
    </div>
        </header>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <form action="{{ route('resumes.update', $resume) }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Photo Field -->
<section class="bg-gray-50 p-4 rounded-md shadow-sm mb-8">
<h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex justify-between items-center"><span>Photo</span></h3>
                <label for="photo" class="block text-gray-700">Choose a Photo<span class="text-red-500">*</span></label>
                <input type="file" id="photo" name="photo" accept="image/*" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" onchange="previewImage(event)">
                
                <!-- Existing Photo Preview -->
                 <div class="mt-4 text-center">
                @if($resume->photo)
                    <img id="photoPreview" src="{{ asset('storage/' . $resume->photo) }}" alt="Photo" class="w-32 h-32 object-cover rounded-full mx-auto">
                @else
                    <img id="photoPreview" src="#" alt="No Photo" class="w-32 h-32 object-cover rounded-full mx-auto hidden">
                @endif
</div>
</section>

<!-- Personal Information Section -->
<section class="bg-gray-50 p-4 rounded-md shadow-sm">
    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex justify-between items-center">
        <span>Basic Information</span>
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-gray-300">Name<span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $resume->name) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 dark:text-gray-300">Email<span class="text-red-500">*</span></label>
            <input type="email" name="email" id="email" value="{{ old('email', $resume->email) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 dark:text-gray-300">Phone<span class="text-red-500">*</span></label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $resume->phone) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
<div class="mb-4>
            <label for="address" class="block text-gray-700 dark:text-gray-300">Address<span class="text-red-500">*</span></label>
            <input type="text" name="address" id="address" value="{{ old('address', $resume->address) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="objectives" class="block text-gray-700 dark:text-gray-300">Objectives<span class="text-red-500">*</span></label>
            <textarea name="objectives" id="objectives" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">{{ old('objectives', $resume->objectives) }}</textarea>
        </div>
    </div>
</section>

<!-- Personal Data Section -->
<section class="bg-gray-50 p-4 rounded-md shadow-sm">
    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex justify-between items-center">
        <span>Personal Data</span>
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
        <div class="mb-4">
            <label for="nickname" class="block text-gray-700 dark:text-gray-300">Nickname<span class="text-red-500">*</span></label>
            <input type="text" name="nickname" id="nickname" value="{{ old('nickname', $resume->nickname ?? '') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="age" class="block text-gray-700 dark:text-gray-300">Age<span class="text-red-500">*</span></label>
            <input type="number" name="age" id="age" value="{{ old('age', $resume->age ?? '') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="sex" class="block text-gray-700 dark:text-gray-300">Sex<span class="text-red-500">*</span></label>
            <select name="sex" id="sex" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                <option value="Male" {{ old('sex', $resume->sex ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('sex', $resume->sex ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('sex', $resume->sex ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="birthday" class="block text-gray-700 dark:text-gray-300">Birthday<span class="text-red-500">*</span></label>
            <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $resume->birthday ?? '') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="mb-4">
            <label for="birthplace" class="block text-gray-700 dark:text-gray-300">Birthplace<span class="text-red-500">*</span></label>
            <input type="text" name="birthplace" id="birthplace" value="{{ old('birthplace', $resume->birthplace ?? '') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="father_name" class="block text-gray-700 dark:text-gray-300">Father's Name<span class="text-red-500">*</span></label>
            <input type="text" name="father_name" id="father_name" value="{{ old('father_name', $resume->father_name ?? '') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="mother_name" class="block text-gray-700 dark:text-gray-300">Mother's Name<span class="text-red-500">*</span></label>
            <input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', $resume->mother_name ?? '') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="mb-4">
            <label for="civil_status" class="block text-gray-700 dark:text-gray-300">Civil Status<span class="text-red-500">*</span></label>
            <select name="civil_status" id="civil_status" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                <option value="Single" {{ old('civil_status', $resume->civil_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Married" {{ old('civil_status', $resume->civil_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                <option value="Widowed" {{ old('civil_status', $resume->civil_status ?? '') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                <option value="Separated" {{ old('civil_status', $resume->civil_status ?? '') == 'Separated' ? 'selected' : '' }}>Separated</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="nationality" class="block text-gray-700 dark:text-gray-300">Nationality<span class="text-red-500">*</span></label>
            <input type="text" name="nationality" id="nationality" value="{{ old('nationality', $resume->nationality ?? '') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="religion" class="block text-gray-700 dark:text-gray-300">Religion<span class="text-red-500">*</span></label>
            <input type="text" name="religion" id="religion" value="{{ old('religion', $resume->religion ?? '') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
    </div>
</section>

<!-- Education Section -->
<section class="bg-gray-50 p-4 rounded-md shadow-sm">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Educational Background</h3>
        <button type="button" id="addEducation" class="py-2 px-4 bg-blue-500 text-white rounded-md text-center hover:bg-blue-600 transition duration-200">Add Education</button>
    </div>
    <div id="education-list">
        @foreach($resume->educations as $education)
            <div class="education-entry mb-4 flex items-center space-x-4" id="education-{{ $education->id }}">
                <button type="button" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 remove-education" data-id="{{ $education->id }}">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <div class="flex flex-1 space-x-4">
                    <input type="text" name="education[{{ $education->id }}][school_name]" value="{{ old('education.' . $education->id . '.school_name', $education->school_name) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="School Name*">
                    <input type="text" name="education[{{ $education->id }}][degree]" value="{{ old('education.' . $education->id . '.degree', $education->degree) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Degree">
                    <input type="number" name="education[{{ $education->id }}][year_started]" value="{{ old('education.' . $education->id . '.year_started', $education->year_started) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Start Year*">
                    <input type="number" name="education[{{ $education->id }}][year_ended]" value="{{ old('education.' . $education->id . '.year_ended', $education->year_ended) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="End Year (Empty for Present)">
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Employment Section -->
<section class="bg-gray-50 p-4 rounded-md shadow-sm">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Employment History</h3>
        <button type="button" id="addEmployment" class="py-2 px-4 bg-blue-500 text-white rounded-md text-center hover:bg-blue-600 transition duration-200">Add Employment</button>
    </div>
    <div id="employment-list">
        @foreach($resume->employments as $employment)
            <div class="employment-entry mb-4 flex items-center space-x-4" id="employment-{{ $employment->id }}">
                <button type="button" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 remove-employment" data-id="{{ $employment->id }}">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <div class="flex flex-1 space-x-4">
                    <input type="text" name="employment[{{ $employment->id }}][company_name]" value="{{ old('employment.' . $employment->id . '.company_name', $employment->company_name) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Company Name*">
                    <input type="text" name="employment[{{ $employment->id }}][position]" value="{{ old('employment.' . $employment->id . '.position', $employment->position) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Position*">
                    <input type="number" name="employment[{{ $employment->id }}][year_started]" value="{{ old('employment.' . $employment->id . '.year_started', $employment->year_started) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Start Year*">
                    <input type="number" name="employment[{{ $employment->id }}][year_ended]" value="{{ old('employment.' . $employment->id . '.year_ended', $employment->year_ended) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="End Year (Empty for Present)">
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Skills Section -->
<section class="bg-gray-50 p-4 rounded-md shadow-sm">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Skills</h3>
        <button type="button" id="addSkill" class="py-2 px-4 bg-blue-500 text-white rounded-md text-center hover:bg-blue-600 transition duration-200">Add Skill</button>
    </div>
    <div id="skills-list">
        @foreach($resume->skills as $skill)
            <div class="skill-entry mb-4 flex items-center space-x-4" id="skill-{{ $skill->id }}">
                <button type="button" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 remove-skill" data-id="{{ $skill->id }}">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <div class="w-1/2">
                    <input type="text" name="skills[{{ $skill->id }}]" value="{{ old('skills.' . $skill->id, $skill->skill_name) }}" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Skill">
                </div>
            </div>
        @endforeach
    </div>
</section>

        <!-- References Section -->
        <section class="bg-gray-50 p-4 rounded-md shadow-sm">
        <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">References</h3>
        <button type="button" id="addReference" class="py-2 px-4 bg-blue-500 text-white rounded-md text-center hover:bg-blue-600 transition duration-200">Add Reference</button>
</div>
        <div id="references-list">
            @foreach($resume->references as $reference)
                <div class="reference-item mb-4 flex items-center space-x-4" id="reference-{{ $reference->id }}">
                    <button type="button" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 remove-reference" data-id="{{ $reference->id }}"><i class="fas fa-trash-alt"></i></button>
                    <input type="text" name="references[{{ $reference->id }}][name]" value="{{ old('references.' . $reference->id . '.name', $reference->name) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Name">
                    <input type="email" name="references[{{ $reference->id }}][email]" value="{{ old('references.' . $reference->id . '.email', $reference->email) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Email">
                    <input type="text" name="references[{{ $reference->id }}][phone]" value="{{ old('references.' . $reference->id . '.phone', $reference->phone) }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Phone">
                    
                </div>
            @endforeach
        </div>
        
</section>

<div class="mt-8 text-center">
        <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600">Update Resume</button>
        </div>    

    </form>
</section>
</div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Track the current number of items added for each section
            let educationIndex = $('#education-list .education-item').length;
            let employmentIndex = $('#employment-list .employment-item').length;
            let skillIndex = $('#skills-list .skill-item').length;
            let referenceIndex = $('#references-list .reference-item').length;

            // Add Education
            $('#addEducation').on('click', function () {
                educationIndex++;
                $('#education-list').append(`
                    <div class="education-item mb-4" id="education-${educationIndex}">
                    <div class="flex justify-between items-center">
                        <button type="button" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 mr-4 remove-education" data-id="${educationIndex}"><i class="fas fa-trash-alt"></i></button>
                        <div class="flex flex-1 space-x-4">
                        <div class="flex-1">
                        <input type="text" name="education[${educationIndex}][school_name]" placeholder="School Name" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                        <input type="text" name="education[${educationIndex}][degree]" placeholder="Degree" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                        <input type="number" name="education[${educationIndex}][year_started]" placeholder="Start Year" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                        <input type="number" name="education[${educationIndex}][year_ended]" placeholder="End Year (or leave empty for Present)" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        </div>
                    </div>
                    </div>
                `);
            });

            // Add Employment
            $('#addEmployment').on('click', function () {
                employmentIndex++;
                $('#employment-list').append(`
                    <div class="employment-item mb-4" id="employment-${employmentIndex}">
                    <div class="flex justify-between items-center">
                        <button type="button" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 mr-4 remove-employment" data-id="${employmentIndex}"><i class="fas fa-trash-alt"></i></button>
                        <div class="flex flex-1 space-x-4">
                        <div class="flex-1">
                        <input type="text" name="employment[${employmentIndex}][company_name]" placeholder="Company Name" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                        <input type="text" name="employment[${employmentIndex}][position]" placeholder="Position" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                        <input type="number" name="employment[${employmentIndex}][year_started]" placeholder="Start Year" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                        <input type="number" name="employment[${employmentIndex}][year_ended]" placeholder="End Year (or leave empty for Present)" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        </div>
                    </div>
                    </div>
                `);
            });

// Add Skill
$('#addSkill').on('click', function () {
    skillIndex++;
    $('#skills-list').append(`
        <div class="skill-item mb-4 flex items-center space-x-4" id="skill-${skillIndex}">
            <button type="button" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 remove-skill" data-id="${skillIndex}">
                <i class="fas fa-trash-alt"></i>
            </button>
            <div class="w-1/2">
                <input type="text" name="skills[${skillIndex}]" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Skill">
            </div>
        </div>
    `);
});

            // Add Reference
            $('#addReference').on('click', function () {
                referenceIndex++;
                $('#references-list').append(`
                    <div class="reference-item mb-4" id="reference-${referenceIndex}">
                    <div class="flex justify-between items-center">
                        <button type="button" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 mr-4 remove-reference" data-id="${referenceIndex}"><i class="fas fa-trash-alt"></i></button>
                        <div class="flex flex-1 space-x-4">
                        <div class="flex-1">
                        <input type="text" name="references[${referenceIndex}][name]" placeholder="Name" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                        <input type="email" name="references[${referenceIndex}][email]" placeholder="Email" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                        <input type="text" name="references[${referenceIndex}][phone]" placeholder="Phone" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        </div>
                    </div>
                    </div>
                `);
            });

            // Remove Education
            $(document).on('click', '.remove-education', function () {
                let educationId = $(this).data('id');
                $('#education-' + educationId).remove();
            });

            // Remove Employment
            $(document).on('click', '.remove-employment', function () {
                let employmentId = $(this).data('id');
                $('#employment-' + employmentId).remove();
            });

            // Remove Skill
            $(document).on('click', '.remove-skill', function() {
    var skillId = $(this).data('id');
    $(`#skill-${skillId}`).remove();
});
            // Remove Reference
            $(document).on('click', '.remove-reference', function () {
                let referenceId = $(this).data('id');
                $('#reference-' + referenceId).remove();
            });
        });

        function previewImage(event) {
            const reader = new FileReader();
            const file = event.target.files[0];
            const preview = document.getElementById('photoPreview');

            // Clear the preview if the input is empty or reset
            preview.src = '#';  // Reset the preview source

            // Once the new file is loaded, update the preview
            reader.onload = function() {
                preview.src = reader.result;  // Set the preview to the new image data
                preview.classList.remove('hidden');  // Show the preview image
            }

            if (file) {
                reader.readAsDataURL(file);  // Read the file to display the preview
            }
        }
    </script>
@endsection
