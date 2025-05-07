<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-auto inline-flex items-center px-4 py-2 bg-turquoise border border-transparent rounded-md text-xs text-white hover:bg-white focus:outline-none focus:ring-2 focus:ring-turquoise focus:ring-offset-2  transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
