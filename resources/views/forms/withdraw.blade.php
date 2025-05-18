<section>
    <form onsubmit="displayPinCheck(event)" method="post" action="{{ route('withdraw.create') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="amount" :value="__('Amount (£)')" />
            <x-text-input id="amount" name="amount" placeholder="0.00" type="text" class="mt-1 block w-full" :value="old('amount')" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

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
    <div>
        <x-input-label for="pin" :value="__('Pin number')" />
        <x-text-input id="pin" name="pin" placeholder="Pin number" type="text" class="mt-1 block w-full" :value="old('pin')" required autofocus/>
        <x-input-error class="mt-2" :messages="$errors->get('pin')" />
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
    function pinCheck(event) {
        event.preventDefault();

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/pin-check', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }
</script>
