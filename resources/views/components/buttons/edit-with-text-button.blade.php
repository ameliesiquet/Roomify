<button
    {{ $attributes->merge([
        'class' => 'flex items-center gap-1 text-sm text-gray-600 hover:text-black'
    ]) }}
>
    Edit
    <x-svg.edit></x-svg.edit>
</button>
