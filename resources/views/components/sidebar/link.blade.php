@props([
    'href',
    'icon',
    'label',
    'expanded' => true,
])

@php
    $isActive = request()->routeIs(basename($href)) || request()->url() === $href;
@endphp

<li class="rounded-lg cursor-pointer " x-data="{ showTooltip: false }" role="listitem">
    <a href="{{ $href }}"
       wire:navigate
       @mouseenter="showTooltip = true"
       @mouseleave="showTooltip = false"
       class="group flex items-center px-3 py-2 h-10 rounded-lg relative "
        {{ $attributes }}
    >
        <span :class="{{ $isActive ? 'true' : 'false' }} ? 'text-myblack ' : ''">
            <x-dynamic-component :component="'svg.' . $icon" />

        </span>
        @if($expanded)
            <span class="ml-2.5" :class="{{ $isActive ? 'true' : 'false' }} ? 'text-myblack' : ''">
                {{ $label }}
            </span>
        @endif

    </a>
</li>
