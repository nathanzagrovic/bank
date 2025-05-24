<section>
    <form id="accountLookupForm" onsubmit="validateAccount(event)" method="post" class="mt-6 space-y-6">
        @csrf
        <div class="relative">
            <x-input-label for="recipient_lookup" :value="__('Bank Account Number')" />
            <x-text-input id="recipient_lookup" name="recipient_lookup" placeholder="1234" type="text" class="mt-1 block w-full " :value="old('recipient_lookup')" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('recipient_lookup')" />
            @include('elements.spinner', ['message' => 'Looking up account'])
        </div>

        <div id="lookUpBtn">
            <x-primary-button>{{ __('Lookup') }}</x-primary-button>
        </div>

        <x-input-error class="mt-2" :messages="$errors->get('amount')" />


        <div class="flex items-center gap-4">
            @if (session('status') === 'success')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-white"
                >{{ __('✅ Transfer successful.') }}</p>
            @endif
        </div>

    </form>
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

<script>
    function validateAccount(event) {

        event.preventDefault();
        const accountCheckForm = event.target.closest('form');
        const formData = new FormData(accountCheckForm);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const loadingSpinner = event.target.querySelector('.loadingSpinner');
        const messageContainer = document.getElementById('message');
        const recipientAccountNumber = document.getElementById('recipient_account_number');

        recipientAccountNumber.style.borderColor = '';
        messageContainer.innerText = '';

        fetch('/account-check', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error');
                }
                loadingSpinner.style.display = 'flex';
                return response.json();
            })
            .then(data => {
                const message = data.exists ? '✅ Account Found' : '❌ That account number does not exist. Please check it and try again';
                setTimeout(function () {
                    messageContainer.innerText = message;
                    loadingSpinner.style.display = 'none';
                    data.exists ? accountExists()  : accountNotFound();
                }, 1200);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    function accountExists() {
        const amount = document.getElementById('amount');
        const lookUpBtn = document.getElementById('lookUpBtn');
        const recipientLookup = document.getElementById('recipient_lookup');
        const recipientAccountNumber  = document.getElementById('recipient_account_number');
        const transactionForm = document.getElementById('transactionForm');

        transactionForm.style.display = 'block';

        if (recipientLookup && recipientAccountNumber) {
            recipientAccountNumber.value = recipientLookup.value;
            recipientLookup.addEventListener('input', () => {
                recipientAccountNumber.value = recipientLookup.value;
            });
        }

        lookUpBtn.style.display = 'none';
        amount.closest('form').style.display = 'block';
        recipientLookup.style.borderColor = '';
        recipientLookup.setAttribute('readonly', 'true');
    }

    function accountNotFound() {
        const amount = document.getElementById('amount');
        const recipientLookup = document.getElementById('recipient_lookup');
        recipientLookup.style.borderColor = 'red';
        amount.closest('form').style.display = 'none';
    }
</script>
