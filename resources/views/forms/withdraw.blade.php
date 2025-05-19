<section>
    <form onsubmit="displayPinCheck(event)" method="post" action="{{ route('withdraw.create') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="amount" :value="__('Amount (£)')" />
            <x-text-input id="amount" name="amount" placeholder="0.00" type="text" class="mt-1 block w-full" :value="old('amount')" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Withdraw') }}</x-primary-button>

            @if (session('status') === 'success')
                <p x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-teal-500"
                >{{ __('Withdrawal successful.') }}</p>
            @endif
        </div>
    </form>
</section>

<br>

<form onsubmit="pinCheck(event)" style="display: none" id="pinCheck" action="{{ route('security.pin') }}" method="POST" class="mt-6 space-y-6">
    @csrf
    <div class="relative">
        <x-input-label for="pin" :value="__('Pin number')" />
        <x-text-input id="pin" minlength="4" maxlength="4" name="pin" placeholder="Pin number" type="text" class="mt-1 block w-full" :value="old('pin')" required autofocus/>
        <small data-section="form-errors" class="hidden text-red-600 text-sm my-1">You have entered an incorrect pin, please try again.</small>
        <x-input-error class="mt-2" :messages="$errors->get('pin')" />
        <div id="loadingSpinner" class="hidden absolute top-[16px] right-2 items-center gap-1.5 text-gray-300">
            <div class="spinner"></div>
            <span class="text-sm tracking-wide text-gray-100">Checking Pin..</span>
        </div>

    </div>
    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Submit') }}</x-primary-button>

        @if (session('status') === 'success')
            <p x-data="{ show: true }"
               x-show="show"
               x-transition
               x-init="setTimeout(() => show = false, 2000)"
               class="text-sm text-teal-500"
            >{{ __('Pin correct') }}</p>
        @endif
    </div>
</form>

<script>
    function displayPinCheck(e) {
        e.preventDefault();
        const pinCheckForm = document.getElementById('pinCheck');
        pinCheckForm.style.display = 'block';
    }

    function pinAttemptSuccessful() {
        const form = document.getElementById('formWrapper').querySelector('form');
        form.submit();
    }

    function pinAttemptFailure(event) {
        const form = event.srcElement;
        console.log(form);
        const input = form.querySelector('#pin');
        input.value = '';
        const errorMessage = form.querySelector('[data-section="form-errors"]');
        errorMessage.style.display = 'block';
        input.classList.add('!border-red-700');
    }

    function pinCheck(event) {
        event.preventDefault();

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const pinCheckForm = event.target.closest('form');
        const formData = new FormData(pinCheckForm);
        const loadingSpinner = document.getElementById('loadingSpinner');

        fetch('/pin-check', {
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
                setTimeout(() => {
                    if(data['success'] === true) {
                        pinAttemptSuccessful();
                    } else {
                        pinAttemptFailure(event);
                    }
                    loadingSpinner.style.display = '';
                }, 1200);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }
</script>


<style>
    .spinner {
        width: 16px;
        height: 16px;
        border: 3px solid #ccc;          /* Light grey background */
        border-top-color: #14b8a6;       /* Blue top border */
        border-radius: 50%;
        animation: spin .8s linear infinite;
        margin: 20px auto;               /* Center horizontally with margin */
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
