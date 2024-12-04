@extends('layouts.public')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="space-y-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
<!-- Name, Email, and Phone Section -->
<div class="flex items-center justify-center mb-12 pt-8">
    <!-- Profile Photo -->
    @if($resume->photo)
        <div class="mr-6">
            <img src="{{ asset('storage/' . $resume->photo) }}" alt="Resume Photo" class="rounded-full w-32 h-32">
        </div>
    @endif

    <!-- Text Section -->
    <div class="text-left">
        <h1 class="text-4xl font-extrabold text-gray-800 tracking-wide mb-2">{{ $resume->name }}</h1>
        <p class="text-lg font-medium text-gray-600 mt-2">
            <span class="text-blue-600">{{ $resume->email }}</span> | 
            <span class="text-blue-600">{{ $resume->phone }}</span>
        </p>
        <p class="text-lg font-medium text-gray-600 mt-2">{{ $resume->address }}</p>
    </div>
</div>

        <!-- Objective Section -->
        <section class="mb-10 p-6 rounded-lg shadow-sm bg-gradient-to-r from-slate-100 via-slate-50 to-white">
            <div class="flex items-center space-x-3 mb-4">
                <i class="fas fa-bullseye text-blue-600 w-6 h-6"></i>
                <h2 class="text-2xl font-semibold text-gray-800">Objective</h2>
            </div>
            <p class="text-base text-gray-700">{{ $resume->objectives }}</p>
        </section>

        <hr class="my-8 border-t border-gray-300" />

        <!-- Personal Information Section -->
        <section class="mb-10 p-6 rounded-lg shadow-sm bg-gradient-to-r from-slate-100 via-slate-50 to-white">
            <div class="flex items-center space-x-3 mb-4">
                <i class="fas fa-user text-blue-600 w-6 h-6"></i>
                <h2 class="text-2xl font-semibold text-gray-800">Personal Information</h2>
            </div>
            <ul class="list-none space-y-3">
                <li class="text-base text-gray-600">
                    <strong class="text-blue-600">Age:</strong> {{ $resume->age ?? 'N/A' }}
                </li>
                <li class="text-base text-gray-600">
                    <strong class="text-blue-600">Sex:</strong> {{ $resume->sex ?? 'N/A' }}
                </li>
                <li class="text-base text-gray-600">
                    <strong class="text-blue-600">Birthday:</strong> {{ $resume->birthday ?? 'N/A' }}
                </li>
                <li class="text-base text-gray-600">
                    <strong class="text-blue-600">Birthplace:</strong> {{ $resume->birthplace ?? 'N/A' }}
                </li>
                <li class="text-base text-gray-600">
                    <strong class="text-blue-600">Father's Name:</strong> {{ $resume->father_name ?? 'N/A' }}
                </li>
                <li class="text-base text-gray-600">
                    <strong class="text-blue-600">Mother's Name:</strong> {{ $resume->mother_name ?? 'N/A' }}
                </li>
                <li class="text-base text-gray-600">
                    <strong class="text-blue-600">Civil Status:</strong> {{ $resume->civil_status ?? 'N/A' }}
                </li>
                <li class="text-base text-gray-600">
                    <strong class="text-blue-600">Nationality:</strong> {{ $resume->nationality ?? 'N/A' }}
                </li>
                <li class="text-base text-gray-600">
                    <strong class="text-blue-600">Religion:</strong> {{ $resume->religion ?? 'N/A' }}
                </li>
            </ul>
        </section>

<!-- Education Section -->
<section class="mb-10 p-6 rounded-lg shadow-sm bg-gradient-to-r from-slate-100 via-slate-50 to-white">
    <div class="flex items-center space-x-3 mb-4">
        <i class="fas fa-graduation-cap text-blue-600 w-6 h-6"></i>
        <h2 class="text-2xl font-semibold text-gray-800">Education</h2>
    </div>
    <ul class="list-none space-y-3">
        @foreach($resume->educations->sortByDesc('year_started') as $education)
            <li class="text-base text-gray-600">
                <strong class="text-blue-600">{{ $education->school_name }}</strong>
                @if($education->degree)
                    <br>{{ $education->degree }}
                @endif
                <br>
                {{ $education->year_started }} - {{ $education->year_ended ?? 'Present' }}
            </li>
        @endforeach
    </ul>
</section>

        <!-- Employment Section -->
        <section class="mb-10 p-6 rounded-lg shadow-sm bg-gradient-to-r from-slate-100 via-slate-50 to-white">
            <div class="flex items-center space-x-3 mb-4">
                <i class="fas fa-briefcase text-blue-600 w-6 h-6"></i>
                <h2 class="text-2xl font-semibold text-gray-800">Employment History</h2>
            </div>
            <ul class="list-none space-y-3">
                @foreach($resume->employments->sortByDesc('year_started') as $employment)
                    <li class="text-base text-gray-600">
                        <strong class="text-blue-600">{{ $employment->company_name }}</strong><br>{{ $employment->position }}<br>
                        {{ $employment->year_started }} - {{ $employment->year_ended ?? 'Present' }}
                    </li>
                @endforeach
            </ul>
        </section>

        <!-- Skills Section -->
        <section class="mb-10 p-6 rounded-lg shadow-sm bg-gradient-to-r from-slate-100 via-slate-50 to-white">
            <div class="flex items-center space-x-3 mb-4">
                <i class="fas fa-cogs text-blue-600 w-6 h-6"></i>
                <h2 class="text-2xl font-semibold text-gray-800">Skills</h2>
            </div>
            <ul class="list-none space-y-3">
                @foreach($resume->skills as $skill)
                    <li class="text-base text-gray-600">{{ $skill->skill_name }}</li>
                @endforeach
            </ul>
        </section>

        <!-- References Section -->
        <section class="mb-10 p-6 rounded-lg shadow-sm bg-gradient-to-r from-slate-100 via-slate-50 to-white">
            <div class="flex items-center space-x-3 mb-4">
                <i class="fas fa-user-friends text-blue-600 w-6 h-6"></i>
                <h2 class="text-2xl font-semibold text-gray-800">References</h2>
            </div>
            <ul class="list-none space-y-3">
                @foreach($resume->references as $reference)
                    <li class="text-base text-gray-600">
                        <strong class="text-blue-600">{{ $reference->name }}</strong><br>{{ $reference->email }} | {{ $reference->phone }}
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
</div>
@endsection