{{-- TODO: Make this a template? Header Slot + Form Slot? --}}


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Make a Transfer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('forms.transfer')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
