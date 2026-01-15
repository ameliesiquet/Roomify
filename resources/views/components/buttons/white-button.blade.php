<button
    {{ $attributes->merge([
        'class' => 'text-xs md:text-sm lg:text-base self-stretch px-2 py-1.5 text-turquoise bg-mywhite rounded-lg cursor-pointer'
    ]) }}
>
    {{ $slot }}
</button>
