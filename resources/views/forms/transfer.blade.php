<section>
    <form onsubmit="validateAccount(event)" method="post" action="{{ route('transfer.create') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="recipient_account_number" :value="__('Bank Account Number')" />
            <x-text-input id="recipient_account_number" name="recipient_account_number" placeholder="1234" type="text" class="mt-1 block w-full" :value="old('amount')" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('recipient_account_number')" />
            <div id="message" class="mt-1 text-sm tracking-wide font-medium"></div>
        </div>


        <div style="display: none">
            <x-input-label for="amount" :value="__('Amount (£)')" />
            <x-text-input id="amount" disabled name="amount" placeholder="0.00" type="text" class="mt-1 block w-full" :value="old('amount')" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
        </div>

        <div id="lookUpBtn">
            <x-primary-button>{{ __('Lookup') }}</x-primary-button>
        </div>


        <div class="flex items-center gap-4">
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

<br>

<script>
    function validateAccount(event) {

        event.preventDefault();

        const accountCheckForm = event.target.closest('form');
        const formData = new FormData(accountCheckForm);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const loadingSpinner = document.getElementById('loadingSpinner');

        console.log(accountCheckForm, formData);

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
                const messageContainer = document.getElementById('message');
                const message = data.exists ? 'Account Found' : 'That account number does not exist. Please check it and try again';
                const colorClass = data.exists ? 'text-green-600' : 'text-red-600';
                const amount = document.getElementById('amount');
                const lookUpBtn = document.getElementById('lookUpBtn');

                if(data.exists) {
                    amount.removeAttribute('disabled');
                    lookUpBtn.style.display = 'none'
                    displayPinCheck(event);
                } else {
                    amount.setAttribute('disabled', '');
                    lookUpBtn.style.display = 'block'
                }

                amount.parentElement.style.display = data.exists ? 'block' : 'none';
                messageContainer.classList.remove('text-green-600', 'text-red-600');
                messageContainer.innerText = message;
                messageContainer.classList.add(colorClass);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }
</script>

@include('forms.pin-check')
