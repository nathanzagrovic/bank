<div id="pinCheck" style="display: none" class="fixed inset-0 bg-black/90 grid items-center h-full w-full">
    <div class="max-w-xl w-full mx-auto border border-stone-800 p-10 relative">
        <div class="absolute top-2 right-2 z-10 color-white hover:text-red-600 cursor-pointer" onclick="document.getElementById('pinCheck').style.display = 'none'">✕</div>
        <span class="block text-xl font-bold">Security Check</span>
        <form onsubmit="pinCheck(event)" action="{{ route('security.pin') }}" method="POST" class="w-full space-y-6">
        @csrf
        <div class="relative">
            <x-input-label for="pin" :value="__('Pin number')" />
            <x-text-input id="pin" minlength="4" maxlength="4" name="pin" placeholder="Pin number" type="text" class="mt-1 block w-full" :value="old('pin')" required autocomplete="off" autofocus/>
            <small data-section="form-errors" class="hidden text-red-600 text-sm my-1">You have entered an incorrect pin, please try again.</small>
            <x-input-error class="mt-2" :messages="$errors->get('pin')" />
            @include('elements.spinner')
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
    </div>
</div>

<script>

    function displayPinCheck(e) {
        e.preventDefault();

        const pinCheckForm = document.getElementById('pinCheck');
        pinCheckForm.style.display = 'grid';
    }

    function pinAttemptSuccessful() {
        const form = document.querySelector('#formWrapper form:not(#accountLookupForm)');
        const hiddenAmount = document.getElementById('amount');
        const rawValue = window.anAmount.getNumber();

        if(hiddenAmount && rawValue) {
            hiddenAmount.value = rawValue;
        }

        form.submit();
    }

    function pinAttemptFailure(event) {
        const form = event.srcElement;
        const errorMessage = form.querySelector('[data-section="form-errors"]');
        const input = form.querySelector('#pin');
        input.value = '';
        errorMessage.style.display = 'block';
        input.classList.add('!border-red-700');
    }

    function pinCheck(event) {
        event.preventDefault();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const pinCheckForm = event.target.closest('form');
        const formData = new FormData(pinCheckForm);
        const loadingSpinner = event.target.querySelector('.loadingSpinner');
        initNumeric();

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
