<x-app-layout>

    <div class="py-12">
    @if (isset($header) || isset($content))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-1">
            @isset($header)
                <h2 class="text-3xl tracking-wide font-light">
                    {{ $header }}
                </h2>
            @endisset

            @isset($content)
                <div class="tracking-wide">
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
