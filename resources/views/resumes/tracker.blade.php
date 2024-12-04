@extends('layouts.manager')

@section('content')

<header class="bg-white dark:bg-gray-800 shadow relative">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Job Application Tracker of {{ $resume->name }}
        </h2>
        <a href="javascript:void(0);" 
           onclick="toggleModal()" 
           class="py-2 px-4 bg-blue-500 text-white font-bold rounded-md text-center hover:bg-blue-600 transition duration-200">
            <span class="mr-2">+</span> New Job Application
        </a>
    </div>

    @if(session('success'))
        <div id="success-popup" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-100 text-green-800 p-4 rounded-md shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif
</header>

<!-- Modal for New Job Application -->
<div id="addApplicationModal" class="fixed inset-0 flex items-center justify-center hidden">
    <!-- Background overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity opacity-0" id="modalOverlay"></div>

    <!-- Modal content -->
    <div class="relative bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-1/2 transform scale-95 opacity-0 transition-all duration-300" id="modalContent">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-700 dark:text-gray-300">Add New Job Application</h2>
            <button 
                class="text-gray-500 hover:text-gray-800 dark:hover:text-gray-200" 
                onclick="toggleModal()">
                &times;
            </button>
        </div>
        <form action="{{ route('tracker.store', $resume) }}" method="POST" class="space-y-4 mt-4">
            @csrf
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="company_name" class="block text-gray-700 dark:text-gray-300">Company Name<span class="text-red-500">*</span></label>
                    <input type="text" name="company_name" id="company_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="link" class="block text-gray-700 dark:text-gray-300">Application Link<span class="text-red-500">*</span></label>
                    <input type="url" name="link" id="link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="status" class="block text-gray-700 dark:text-gray-300">Status<span class="text-red-500">*</span></label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="Applied">Applied</option>
                        <option value="Under Review">Under Review</option>
                        <option value="For Interview">For Interview</option>
                        <option value="Interviewed">Interviewed</option>
                        <option value="Offer Extended">Offer Extended</option>
                        <option value="Accepted Offer">Accepted Offer</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Withdrawn">Withdrawn</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Add Application</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmationModal" class="fixed inset-0 flex items-center justify-center hidden">
    <!-- Background overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity opacity-0" id="deleteModalOverlay"></div>

    <!-- Modal content -->
    <div class="relative bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-1/3 transform scale-95 opacity-0 transition-all duration-300" id="deleteModalContent">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-700 dark:text-gray-300">Confirm Deletion</h2>
            <button class="text-gray-500 hover:text-gray-800 dark:hover:text-gray-200" onclick="toggleDeleteModal()">&times;</button>
        </div>
        <p class="mt-4 text-gray-700 dark:text-gray-300">Are you sure you want to delete this job application?</p>
        <div class="flex justify-end gap-4 mt-4">
            <button onclick="toggleDeleteModal()" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600">Cancel</button>
            <form id="deleteForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700">Delete</button>
            </form>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="space-y-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <table class="min-w-full mt-4 table-auto border-collapse border border-gray-200 dark:border-gray-700">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-700">
                    <th class="px-4 py-2 text-left" style="width: 30%;">Company Name</th>
                    <th class="px-4 py-2 text-left" style="width: 35%;">Link</th>
                    <th class="px-4 py-2 text-left" style="width: 25%;">Status</th>
                    <th class="px-4 py-2 text-center" style="width: 10%;"></th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800">
                @foreach($applications as $application)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $application->company_name }}</td>
                        <td class="border border-gray-300 px-4 py-2"><a href="{{ $application->link }}" target="_blank" class="text-blue-500 hover:underline">{{ $application->link }}</a></td>
                        <td class="border border-gray-300 px-4 py-2">
                            <form action="{{ route('tracker.update', $application) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="w-full border-gray-300 rounded-md" required onchange="this.form.submit()">
                                    <option value="Applied" {{ $application->status == 'Applied' ? 'selected' : '' }}>Applied</option>
                                    <option value="Under Review" {{ $application->status == 'Under Review' ? 'selected' : '' }}>Under Review</option>
                                    <option value="For Interview" {{ $application->status == 'For Interview' ? 'selected' : '' }}>For Interview</option>
                                    <option value="Interviewed" {{ $application->status == 'Interviewed' ? 'selected' : '' }}>Interviewed</option>
                                    <option value="Offer Extended" {{ $application->status == 'Offer Extended' ? 'selected' : '' }}>Offer Extended</option>
                                    <option value="Accepted Offer" {{ $application->status == 'Accepted Offer' ? 'selected' : '' }}>Accepted Offer</option>
                                    <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="Withdrawn" {{ $application->status == 'Withdrawn' ? 'selected' : '' }}>Withdrawn</option>
                                </select>
                            </form>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button type="button" class="text-red-500 hover:text-red-700" onclick="confirmDelete(event, '{{ route('tracker.destroy', $application) }}')">
                                <i class="fas fa-trash mr-2"></i> Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmDelete(event, url) {
        event.preventDefault(); // Prevent default form submission
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = url; // Set the form action to the URL passed in

        toggleDeleteModal(); // Show the delete confirmation modal
    }

    function toggleModal() {
        const modal = document.getElementById('addApplicationModal');
        const overlay = document.getElementById('modalOverlay');
        const content = document.getElementById('modalContent');

        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                content.classList.remove('opacity-0', 'scale-95');
            }, 10); // Ensure transition starts after display
        } else {
            overlay.classList.add('opacity-0');
            content.classList.add('opacity-0', 'scale-95');
            content.addEventListener('transitionend', () => modal.classList.add('hidden'), { once: true });
        }
    }

    function toggleDeleteModal() {
        const modal = document.getElementById('deleteConfirmationModal');
        const overlay = document.getElementById('deleteModalOverlay');
        const content = document.getElementById('deleteModalContent');

        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                content.classList.remove('opacity-0', 'scale-95');
            }, 10); // Ensure transition starts after display
        } else {
            overlay.classList.add('opacity-0');
            content.classList.add('opacity-0', 'scale-95');
            content.addEventListener('transitionend', () => modal.classList.add('hidden'), { once: true });
        }
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
