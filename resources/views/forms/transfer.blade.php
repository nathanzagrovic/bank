<section>
    @include('forms.account-lookup')
    <form id="transactionForm" style="display: none" method="post" onsubmit="displayPinCheck(event)" action="{{ route('transfer.create') }}" class="mt-6 space-y-6">
        @csrf
        <x-input-label for="amount" :value="__('Amount (£)')" />
        <x-text-input id="amount" name="amount" placeholder="0.00" type="text" class="mt-1 block w-full | type-currency" :value="old('amount')" required autofocus/>
        <div class="relative" style="display:none;">
            <x-input-label for="recipient_account_number" :value="__('Bank Account Number')" />
            <x-text-input id="recipient_account_number" name="recipient_account_number" placeholder="1234" type="text" class="mt-1 block w-full " :value="old('recipient_account_number')" required autofocus/>
        </div>
        <x-input-error class="mt-2" :messages="$errors->get('recipient_account_number')" />
        <x-primary-button>
            {{ __('Send') }}
        </x-primary-button>
    </form>
    @include('forms.pin-check')
</section>
