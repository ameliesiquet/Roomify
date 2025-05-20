<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'cursor-pointer w-auto inline-flex items-center px-4 py-2 bg-turquoise border border-transparent rounded-md text-xs text-white hover:bg-[#446063]/80 hover:text-white focus:text-turquoise focus:outline-none focus:ring-2 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
