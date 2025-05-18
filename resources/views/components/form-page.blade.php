<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-1 mb-8">
            <ul class="flex gap-2 text-sm items-center text-gray-200">
                <li><a class="hover:text-white hover:underline transition-all duration-100" href="{{ route('dashboard')}}">Dashboard</a></li>
                <li><svg class="fill-teal-500 w-[9px] top-[.5px] relative" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.--><path d="M273 239c9.4 9.4 9.4 24.6 0 33.9L113 433c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l143-143L79 113c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L273 239z"/></svg></li>
                <li><span class="underline white cursor-default">{{ $header }}</span></li>
            </ul>
        </div>

        @if (isset($header) || isset($content))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-1">
                @isset($header)
                    <h2 class="text-2xl tracking-wide font-light">
                        {{ $header }}
                    </h2>
                @endisset

                @isset($content)
                    <div class="tracking-wider text-sm text-gray-300">
                        {{ $content }}
                    </div>
                @endisset
            </div>
        @endif

        @if($slot->isNotEmpty())
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
