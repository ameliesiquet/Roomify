@props([
    'href',
    'icon',
    'label',
    'expanded' => true,
])

@php
    $isActive = request()->routeIs(basename($href)) || request()->url() === $href;
@endphp

<li class="cursor-pointer lg:border-b lg:border-b-dark-sand" x-data="{ showTooltip: false }" role="listitem">
    <a href="{{ $href }}"
       wire:navigate
       @mouseenter="showTooltip = true"
       @mouseleave="showTooltip = false"
       class="group flex  items-center px-3 py-2 h-10 rounded-lg relative lg:flex-row lg:items-center lg:justify-start"
        {{ $attributes }}
    >
    <span class=" hidden items-center  {{ $isActive ? 'text-myblack font-semibold' : '' }} lg:mr-2 lg:flex flex-col">
        <x-dynamic-component :component="'svg.' . $icon" />
    </span>

        @if($expanded)
            <span class="{{ $isActive ? 'text-myblack font-semibold underline lg:no-underline decoration-1 underline-offset-6' : '' }}">
            {{ $label }}
        </span>
        @endif
    </a>
</li>
