@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => '!ring-0 focus:border-teal-500 text-white rounded bg-transparent border border-grey-700']) }}>
