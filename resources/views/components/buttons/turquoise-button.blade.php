<button
    {{ $attributes->merge([
        'class' => 'text-xs md:text-sm lg:text-sm self-stretch px-2 py-1.5 text-white bg-turquoise rounded-lg cursor-pointer'
    ]) }}
>
    {{ $slot }}
</button>
