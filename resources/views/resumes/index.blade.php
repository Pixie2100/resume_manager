@extends('layouts.manager')

@section('content')
<header class="bg-white dark:bg-gray-800 shadow sticky top-0 z-10">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
        <a href="{{ route('resumes.create') }}" class="py-2 px-4 bg-blue-500 text-white font-bold rounded-md text-center hover:bg-blue-600 transition duration-200">
            <span class="mr-2">+</span> New Resume
        </a>
    </div>

    @if(session('success'))
        <div id="success-popup" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-100 text-green-800 p-4 rounded-md shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif
</header>

<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
    <!-- Resumes List -->
    <ul class="space-y-4">
        @foreach($resumes as $resume)
            <li class="flex items-center bg-gray-50 p-4 rounded-md shadow-sm hover:bg-gray-100">
                @if($resume->photo)
                    <img src="{{ asset('storage/' . $resume->photo) }}" alt="Resume Photo" class="rounded-full w-16 h-16 mr-4">
                @endif
                <span class="text-lg font-semibold text-gray-700 flex-1">{{ $resume->name }}</span>
                <div class="flex space-x-4">
                    <!-- Public Button -->
                    <a href="{{ url('resumes/' . $resume->id) }}" class="flex items-center text-blue-500 hover:text-blue-700">
                        <i class="fas fa-globe mr-2"></i> Public
                    </a>
                    
                    <!-- Tracker Button -->
                    <a href="{{ route('tracker.show', $resume) }}" class="flex items-center text-indigo-500 hover:text-indigo-700">
                        <i class="fas fa-list mr-2"></i> Tracker
                    </a>

                    <!-- Separator -->
                    <span class="mx-2 text-gray-500">|</span>

                    <!-- Action Buttons -->
                    <a href="{{ route('resumes.show', $resume) }}" class="flex items-center text-emerald-500 hover:text-emerald-700">
                        <i class="fas fa-eye mr-2"></i> Preview
                    </a>
                    <a href="{{ route('resumes.edit', $resume) }}" class="flex items-center text-amber-500 hover:text-amber-700">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    <button onclick="openDeleteModal('{{ $resume->id }}', '{{ $resume->name }}')" class="flex items-center text-red-500 hover:text-red-700">
                        <i class="fas fa-trash mr-2"></i> Delete
                    </button>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 flex items-center justify-center hidden z-20">
    <!-- Background overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity opacity-0" id="deleteModalOverlay"></div>

    <!-- Modal content -->
    <div class="relative bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-1/3 transform scale-95 opacity-0 transition-all duration-300" id="deleteModalContent">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Confirm Deletion</h2>
            <button class="text-gray-500 hover:text-gray-800 dark:hover:text-gray-200" onclick="closeDeleteModal()">
                &times;
            </button>
        </div>
        <p class="text-gray-600 mt-2">Are you sure you want to delete <span id="resume-name" class="font-bold"></span>?</p>
        <div class="mt-4 flex justify-end space-x-4">
            <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</button>
            <form id="delete-form" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
function openDeleteModal(resumeId, resumeName) {
    // Set the resume name and form action dynamically
    document.getElementById('resume-name').textContent = resumeName;
    document.getElementById('delete-form').action = '/resumes/' + resumeId;

    // Show the modal and apply the animation
    const modal = document.getElementById('delete-modal');
    const overlay = document.getElementById('deleteModalOverlay');
    const content = document.getElementById('deleteModalContent');

    modal.classList.remove('hidden');  // Make the modal visible
    setTimeout(() => {
        overlay.classList.remove('opacity-0');
        content.classList.remove('opacity-0', 'scale-95');
    }, 10); // Ensure transition starts after display
}

function closeDeleteModal() {
    const modal = document.getElementById('delete-modal');
    const overlay = document.getElementById('deleteModalOverlay');
    const content = document.getElementById('deleteModalContent');

    // Apply closing animation
    overlay.classList.add('opacity-0');
    content.classList.add('opacity-0', 'scale-95');
    content.addEventListener('transitionend', () => {
        modal.classList.add('hidden');
    }, { once: true });
}

        document.addEventListener('DOMContentLoaded', function() {
            var successPopup = document.getElementById('success-popup');
            if (successPopup) {
                setTimeout(function() {
                    successPopup.style.display = 'none';
                }, 5000);
            }
        });
    </script>
@endsection
