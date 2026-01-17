<button
    {{ $attributes->merge([
        'class' => 'text-xs md:text-sm lg:text-sm self-stretch px-2 py-1.5 text-white bg-red-700 hover:bg-red-900 transition rounded-lg cursor-pointer'
    ]) }}
>
    {{ $slot }}
</button>
