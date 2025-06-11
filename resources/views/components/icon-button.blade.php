@props([
    'label' => '',
    'type' => 'button',
    'variant' => 'default',
])

@php
    $classes = match($variant) {
        'outline' => 'border border-turquoise text-turquoise bg-transparent',
        default => 'bg-transparent text-gray-600',
    };
@endphp

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => "flex items-end gap-1 lg:gap-2 px-4 py-2 rounded-xl text-xs font-medium $classes"]) }}>
    {{$slot}}
    {{ $label }}
</button>
