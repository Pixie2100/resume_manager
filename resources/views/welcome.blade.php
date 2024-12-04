<x-guest-layout>
    <div class="flex items-center justify-center space-x-4 mt-4">
        <!-- Login Button -->
        <x-primary-button class="bg-gray-800 text-white hover:bg-gray-700" onclick="window.location='{{ route('login') }}'">
            {{ __('Log in') }}
        </x-primary-button>

        <!-- Register Button -->
        <x-primary-button class="bg-gray-800 text-white hover:bg-gray-700" onclick="window.location='{{ route('register') }}'">
            {{ __('Register') }}
        </x-primary-button>
    </div>
</x-guest-layout>