<section>
    <form method="post" action="{{ route('transfer.create') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="recipient_account_number" :value="__('Bank Account Number')" />
            <x-text-input id="recipient_account_number" name="recipient_account_number" placeholder="1234" type="text" class="mt-1 block w-full" :value="old('recipient_account_number')" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('recipient_account_number')" />
        </div>

        <div>
            <x-input-label for="amount" :value="__('Amount (£)')" />
            <x-text-input id="amount" name="amount" placeholder="0.00" type="text" class="mt-1 block w-full" :value="old('amount')" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'success')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-teal-500"
                >{{ __('Transfer successful.') }}</p>
            @endif
        </div>
    </form>
</section>
