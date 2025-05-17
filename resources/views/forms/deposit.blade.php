<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Make a Transfer') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Send secure payments across our platform, enter the recipients bank account number and the amount below.") }}
        </p>
    </header>

    <form method="post" action="{{ route('transfer.create') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="recipient" :value="__('Bank Account Number')" />
            <x-text-input id="recipient" name="recipient" type="text" class="mt-1 block w-full" :value="old('amount')" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('recipient')" />
        </div>

        <div>
            <x-input-label for="amount" :value="__('Amount (£)')" />
            <x-text-input id="amount" name="amount" type="text" class="mt-1 block w-full" :value="old('amount')" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
