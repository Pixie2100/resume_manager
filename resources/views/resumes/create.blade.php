@extends('layouts.manager')

@section('content')
    <header class="bg-white dark:bg-gray-800 shadow sticky top-0 z-10">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create a New Resume') }}
            </h2>
        </div>

        @if(session('success'))
            <div id="success-popup" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-100 text-green-800 p-4 rounded-md shadow-lg z-50">
                {{ session('success') }}
            </div>
        @endif
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form action="{{ route('resumes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            @csrf

            <!-- Photo Upload Section -->
        <section class="bg-gray-50 p-4 rounded-md shadow-sm mb-8">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex justify-between items-center">
                <span>Photo</span>
            </h3>
            <div>
                <label for="photo" class="block text-gray-700 dark:text-gray-300">Choose a Photo<span class="text-red-500">*</span></label>
                <input type="file" name="photo" id="photo" accept="image/*"
                       class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md"
                       onchange="previewImage(event)">
            </div>
            <div class="mt-4 text-center">
                <img id="photoPreview" src="#" alt="Preview" class="w-32 h-32 rounded-full mx-auto hidden" />
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
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-300">Email<span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 dark:text-gray-300">Phone<span class="text-red-500">*</span></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
<div class="mb-4">
                        <label for="address" class="block text-gray-700 dark:text-gray-300">Address<span class="text-red-500">*</span></label>
                        <input type="text" name="address" id="addresss" value="{{ old('address') }}" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="objectives" class="block text-gray-700 dark:text-gray-300">Objectives<span class="text-red-500">*</span></label>
                        <textarea name="objectives" id="objectives" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">{{ old('objectives') }}</textarea>
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
            <input type="text" name="nickname" id="nickname" value="{{ old('nickname') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="age" class="block text-gray-700 dark:text-gray-300">Age<span class="text-red-500">*</span></label>
            <input type="number" name="age" id="age" value="{{ old('age') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="sex" class="block text-gray-700 dark:text-gray-300">Sex<span class="text-red-500">*</span></label>
            <select name="sex" id="sex" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('sex') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="birthday" class="block text-gray-700 dark:text-gray-300">Birthday<span class="text-red-500">*</span></label>
            <input type="date" name="birthday" id="birthday" value="{{ old('birthday') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="mb-4">
            <label for="birthplace" class="block text-gray-700 dark:text-gray-300">Birthplace<span class="text-red-500">*</span></label>
            <input type="text" name="birthplace" id="birthplace" value="{{ old('birthplace') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="father_name" class="block text-gray-700 dark:text-gray-300">Father's Name<span class="text-red-500">*</span></label>
            <input type="text" name="father_name" id="father_name" value="{{ old('father_name') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="mother_name" class="block text-gray-700 dark:text-gray-300">Mother's Name<span class="text-red-500">*</span></label>
            <input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="mb-4">
            <label for="civil_status" class="block text-gray-700 dark:text-gray-300">Civil Status<span class="text-red-500">*</span></label>
            <select name="civil_status" id="civil_status" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                <option value="Single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Married" {{ old('civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                <option value="Widowed" {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                <option value="Separated" {{ old('civil_status') == 'Separated' ? 'selected' : '' }}>Separated</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="nationality" class="block text-gray-700 dark:text-gray-300">Nationality<span class="text-red-500">*</span></label>
            <input type="text" name="nationality" id="nationality" value="{{ old('nationality') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
        <div class="mb-4">
            <label for="religion" class="block text-gray-700 dark:text-gray-300">Religion<span class="text-red-500">*</span></label>
            <input type="text" name="religion" id="religion" value="{{ old('religion') }}" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
        </div>
    </div>
</section>

            <!-- Education Section -->
            <section class="bg-gray-50 p-4 rounded-md shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Educational Background</h3>
                    <button type="button" onclick="addEducation()" class="py-2 px-4 bg-blue-500 text-white rounded-md text-center hover:bg-blue-600 transition duration-200">Add Education</button>
                </div>
                <div id="education-section">
                    <div class="education-entry mb-4 flex items-center space-x-4">
                        <button type="button" onclick="removeEntry(this)" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <div class="flex flex-1 space-x-4">
                            <input type="text" name="educations[0][school_name]" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="School Name*">
                            <input type="text" name="educations[0][degree]" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Degree">
                            <input type="number" name="educations[0][year_started]" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Year Started*">
                            <input type="number" name="educations[0][year_ended]" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Year Ended (Empty for Present)">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Employment Section -->
            <section class="bg-gray-50 p-4 rounded-md shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Employment History</h3>
                    <button type="button" onclick="addEmployment()" class="py-2 px-4 bg-blue-500 text-white rounded-md text-center hover:bg-blue-600 transition duration-200">Add Employment</button>
                </div>
                <div id="employment-section">
                    <div class="employment-entry mb-4 flex items-center space-x-4">
                        <button type="button" onclick="removeEntry(this)" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <div class="flex flex-1 space-x-4">
                            <input type="text" name="employments[0][company_name]" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Company Name*">
                            <input type="text" name="employments[0][position]" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Position*">
                            <input type="number" name="employments[0][year_started]" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Year Started*">
                            <input type="number" name="employments[0][year_ended]" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Year Ended (Empty for Present)">
                        </div>
                    </div>
                </div>
            </section>

<!-- Skills Section -->
<section class="bg-gray-50 p-4 rounded-md shadow-sm">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Skills</h3>
        <button type="button" onclick="addSkill()" class="py-2 px-4 bg-blue-500 text-white rounded-md text-center hover:bg-blue-600 transition duration-200">Add Skill</button>
    </div>
    <div id="skills-section">
        <!-- This is the template for the first skill entry -->
        <div class="skill-entry mb-4 flex items-center space-x-4">
            <button type="button" onclick="removeEntry(this)" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                <i class="fas fa-trash-alt"></i>
            </button>
            <div class="w-1/2"> <!-- 50% width applied here -->
                <input type="text" name="skills[0][skill_name]" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Skill*">
            </div>
        </div>
    </div>
</section>

            <!-- References Section -->
            <section class="bg-gray-50 p-4 rounded-md shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">References</h3>
                    <button type="button" onclick="addReference()" class="py-2 px-4 bg-blue-500 text-white rounded-md text-center hover:bg-blue-600 transition duration-200">Add Reference</button>
                </div>
                <div id="references-section">
                    <div class="reference-entry mb-4 flex items-center space-x-4">
                        <button type="button" onclick="removeEntry(this)" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <div class="flex flex-1 space-x-4">
                            <input type="text" name="references[0][name]" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Reference Name*">
                            <input type="email" name="references[0][email]" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Email Address*">
                            <input type="text" name="references[0][phone]" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Phone Number*">
                        </div>
                    </div>
                </div>
            </section>

            <div class="mt-8 text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600">Submit Resume</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    let eduIndex = 1;
    let empIndex = 1;
    let skillIndex = 1;
    let refIndex = 1;

    function addEducation() {
        const eduSection = document.getElementById('education-section');
        eduSection.insertAdjacentHTML('beforeend', `
            <div class="education-entry mb-4">
                <div class="flex justify-between items-center">
                    <button type="button" onclick="removeEntry(this)" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 mr-4">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <div class="flex flex-1 space-x-4">
                        <div class="flex-1">
                            <input type="text" name="educations[${eduIndex}][school_name]" required placeholder="School Name" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                            <input type="text" name="educations[${eduIndex}][degree]" required placeholder="Degree" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                            <input type="number" name="educations[${eduIndex}][year_started]" placeholder="Year Started" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                            <input type="number" name="educations[${eduIndex}][year_ended]" placeholder="Year Ended" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                    </div>
                </div>
            </div>
        `);
        eduIndex++;
    }

    function addEmployment() {
        const empSection = document.getElementById('employment-section');
        empSection.insertAdjacentHTML('beforeend', `
            <div class="employment-entry mb-4">
                <div class="flex justify-between items-center">
                    <button type="button" onclick="removeEntry(this)" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 mr-4">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <div class="flex flex-1 space-x-4">
                        <div class="flex-1">
                            <input type="text" name="employments[${empIndex}][company_name]" required placeholder="Company Name" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                            <input type="text" name="employments[${empIndex}][position]" required placeholder="Position" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                            <input type="number" name="employments[${empIndex}][year_started]" placeholder="Year Started" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                            <input type="number" name="employments[${empIndex}][year_ended]" placeholder="Year Ended" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                    </div>
                </div>
            </div>
        `);
        empIndex++;
    }

    function addSkill() {
    const skillsSection = document.getElementById('skills-section');
    skillsSection.insertAdjacentHTML('beforeend', `
        <div class="skill-entry mb-4 flex items-center space-x-4">
            <button type="button" onclick="removeEntry(this)" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                <i class="fas fa-trash-alt"></i>
            </button>
            <div class="w-1/2"> <!-- 50% width for new skill -->
                <input type="text" name="skills[${skillIndex}][skill_name]" required class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md" placeholder="Skill">
            </div>
        </div>
    `);
    skillIndex++;
}

    function addReference() {
        const refSection = document.getElementById('references-section');
        refSection.insertAdjacentHTML('beforeend', `
            <div class="reference-entry mb-4">
                <div class="flex justify-between items-center">
                    <button type="button" onclick="removeEntry(this)" class="text-red-600 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 mr-4">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <div class="flex flex-1 space-x-4">
                        <div class="flex-1">
                            <input type="text" name="references[${refIndex}][name]" required placeholder="Reference Name*" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                            <input type="email" name="references[${refIndex}][email]" placeholder="Email Address*" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                        <div class="flex-1">
                            <input type="text" name="references[${refIndex}][phone]" placeholder="Phone Number*" class="mt-1 block w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                        </div>
                    </div>
                </div>
            </div>
        `);
        refIndex++;
    }

    function removeEntry(button) {
        const entry = button.closest('div');
        entry.remove();
    }

    function previewImage(event) {
        const reader = new FileReader();
        const file = event.target.files[0];
        const preview = document.getElementById('photoPreview');

        reader.onload = function() {
            preview.src = reader.result;
            preview.classList.remove('hidden'); // Show the preview image
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
