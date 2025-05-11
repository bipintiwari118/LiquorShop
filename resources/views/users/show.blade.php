<x-app-layout>
    <x-slot name="header">
        {{ __('Edit User') }}
    </x-slot>

    <a href="{{ route('users.index') }}"
        class="bg-blue-500 w-[70px] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-left mb-4">
        Back
    </a>

</x-app-layout>
