<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session('login'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-2xl">
            <div class="shadow-sm sm:rounded-lg grid grid-cols-3 gap-6">
                <div class="col-span-1">
                    <a class="group" href="{{ route('deposit.index')  }}">
                        <div class="p-6 py-12 group-hover:hover:bg-black/20 group-hover:scale-95 transition-all duration-200 border-[#1c1c1c] border flex flex-col gap-3 items-center text-gray-900 dark:text-gray-100">
                            <svg class="w-8 fill-white group-hover:fill-teal-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.--><path d="M272 16c-53 0-96 43-96 96c0 4.4-3.6 8-8 8s-8-3.6-8-8C160 50.1 210.1 0 272 0c56 0 102.4 41.1 110.7 94.8c.7 4.4-2.3 8.5-6.7 9.1s-8.5-2.3-9.1-6.7C359.8 51.2 320 16 272 16zM52 200c-19.9 0-36 16.1-36 36s16.1 36 36 36l12.8 0c8-80.9 76.2-144 159.2-144l157 0c18.9-19.7 45.6-32 75-32l11.2 0c15.8 0 27.3 14.9 23.2 30.2l-9.2 34.7c21.4 16.4 38.6 38.1 49.6 63.2l13.3 0c17.7 0 32 14.3 32 32l0 96c0 17.7-14.3 32-32 32l-32 0c-16.5 22-38.5 39.5-64 50.7l0 29.3c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48l0-16-64 0 0 16c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48l0-48c-38.8-29.2-64-75.7-64-128l-12 0c-28.7 0-52-23.3-52-52s23.3-52 52-52l4 0c4.4 0 8 3.6 8 8s-3.6 8-8 8l-4 0zM248 432l80 0 16 0c4.4 0 8 3.6 8 8s-3.6 8-8 8l-8 0 0 16c0 17.7 14.3 32 32 32l32 0c17.7 0 32-14.3 32-32l0-34.6c0-3.3 2-6.2 5.1-7.4c26-10.3 48.4-28 64.4-50.6c1.5-2.1 3.9-3.4 6.5-3.4l36.1 0c8.8 0 16-7.2 16-16l0-96c0-8.8-7.2-16-16-16l-18.6 0c-3.3 0-6.2-2-7.4-5.1c-10.3-26-28-48.4-50.6-64.4c-2.7-1.9-4-5.4-3.1-8.6l10.6-39.9c1.4-5.1-2.5-10.1-7.7-10.1L456 112c-26.1 0-49.5 11.3-65.6 29.3c-1.5 1.7-3.7 2.7-6 2.7l-.4 0s0 0 0 0l-160 0c-79.5 0-144 64.5-144 144c0 48.5 23.9 91.3 60.6 117.4c2.1 1.5 3.4 3.9 3.4 6.5l0 52.1c0 17.7 14.3 32 32 32l32 0c17.7 0 32-14.3 32-32l0-16-8 0c-4.4 0-8-3.6-8-8s3.6-8 8-8l16 0zM416 272a16 16 0 1 0 0-32 16 16 0 1 0 0 32zm0-48a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                            <span class="text-center tracking-widest text-xs font-medium uppercase">Deposit</span>
                        </div>
                    </a>
                </div>
                <div class="col-span-1">
                    <a class="group" href="{{ route('withdraw.index')  }}">
                        <div class="p-6 py-12 group-hover:hover:bg-black/20 group-hover:scale-95 transition-all duration-200 border-[#1c1c1c] border flex flex-col gap-3 items-center text-gray-900 dark:text-gray-100">
                            <svg class="w-8 fill-white group-hover:fill-teal-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.--><path d="M72 32C32.2 32 0 64.2 0 104L0 408c0 39.8 32.2 72 72 72l368 0c39.8 0 72-32.2 72-72l0-224c0-39.8-32.2-72-72-72L72 112c-4.4 0-8 3.6-8 8s3.6 8 8 8l368 0c30.9 0 56 25.1 56 56l0 224c0 30.9-25.1 56-56 56L72 464c-30.9 0-56-25.1-56-56l0-304c0-30.9 25.1-56 56-56l400 0c4.4 0 8-3.6 8-8s-3.6-8-8-8L72 32zM376 296a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm64 0a40 40 0 1 0 -80 0 40 40 0 1 0 80 0z"/></svg>
                            <span class="text-center tracking-widest text-xs font-medium uppercase">Withdraw</span>
                        </div>
                    </a>
                </div>
                <div class="col-span-1">
                    <a class="group" href="{{ route('transfer.index')  }}">
                        <div class="p-6 py-12 group-hover:hover:bg-black/20 group-hover:scale-95 transition-all duration-200 border-[#1c1c1c] border flex flex-col gap-3 items-center text-gray-900 dark:text-gray-100">
                            <svg class="w-8 fill-white group-hover:fill-teal-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.--><path d="M383.9 50.1l108.9 87.1c2.1 1.6 3.2 4.1 3.2 6.8s-1.2 5.1-3.2 6.8L383.9 237.9c-1.7 1.4-3.9 2.1-6.1 2.1c-5.4 0-9.8-4.4-9.8-9.8l0-86.2 0-86.2c0-5.4 4.4-9.8 9.8-9.8c2.2 0 4.4 .8 6.1 2.1zM352 152l0 78.2c0 14.2 11.5 25.8 25.8 25.8c5.9 0 11.5-2 16.1-5.6l108.9-87.1c5.8-4.7 9.2-11.8 9.2-19.2s-3.4-14.6-9.2-19.2L393.9 37.6C389.3 34 383.6 32 377.8 32C363.5 32 352 43.5 352 57.8l0 78.2L8 136c-4.4 0-8 3.6-8 8s3.6 8 8 8l344 0zM144 281.8l0 86.2 0 86.2c0 5.4-4.4 9.8-9.8 9.8c-2.2 0-4.4-.8-6.1-2.1L19.2 374.8c-2.1-1.6-3.2-4.1-3.2-6.8s1.2-5.1 3.2-6.8l108.9-87.1c1.7-1.4 3.9-2.1 6.1-2.1c5.4 0 9.8 4.4 9.8 9.8zM160 360l0-78.2c0-14.2-11.5-25.8-25.8-25.8c-5.9 0-11.5 2-16.1 5.6L9.2 348.8C3.4 353.4 0 360.5 0 368s3.4 14.6 9.2 19.2l108.9 87.1c4.6 3.7 10.2 5.6 16.1 5.6c14.2 0 25.8-11.5 25.8-25.8l0-78.2 344 0c4.4 0 8-3.6 8-8s-3.6-8-8-8l-344 0z"/></svg>
                            <span class="text-center tracking-widest text-xs font-medium uppercase">Transfer</span>
                        </div>
                    </a>
                </div>
            </div>
            </div>
        </div>

        @if ($transactions)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white mt-8">
            <div class="max-w-2xl bg-black/5 border border-gray-600/10 p-10">
            <h3 class="tracking-wide text-lg text-gray-300 font-medium">Recent Transactions</h3>
            <div class="w-5 h-[1px] mt-1 bg-teal-500 mb-5"></div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-[12px] text-left rtl:text-right text-gray-300">
                    <thead class="bg-gray-700/10 uppercase">
                    <tr class="tracking-widest">
                        <th scope="col" class="px-4 py-3">
                            <span class="font-bold text-white">Type</span>
                        </th>
                        <th scope="col" class="px-4 py-3">
                            <span class="font-bold text-white">Amount</span>
                        </th>
                        <th scope="col" class="px-4 py-3 text-right">
                            <span class="font-bold text-white">Date</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr class="border-b border-gray-600/10 {{ $loop->even ? 'bg-black/10' : 'bg-transparent'  }}">
                            <td class="px-4 py-2 uppercase tracking-wider font-medium text-[12px]">
                                @if($transaction->type === 'transfer')
                                   {{ $transaction->recipient_id == auth()->id() ? 'Received' : 'Sent' }}
                                @else
                                    {{ $transaction->type }}
                                @endif
                            </td>
                            <td class="px-4 py-2 {{ ($transaction->recipient_id == auth()->id()) ? 'text-green-600' : ($transaction->type == 'deposit' ? 'text-green-600' : 'text-red-700')  }}">
                                {{ $transaction->recipient_id == auth()->id() || $transaction->type == 'deposit' ? '+' : '-'  }}
                                {{ $transaction->getAmount() }}
                            </td>
                            <td class="px-4 py-2 text-right">
                                {{ $transaction->created_at->format('d/m/y H:i')  }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        </div>
    </div>
</x-app-layout>
