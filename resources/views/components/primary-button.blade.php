<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-white text-white hover:text-black rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white dark:focus:text-black active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring focus:ring-teal-500 focus:ring-offset-1 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
