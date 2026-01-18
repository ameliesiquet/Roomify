@props([
    'spent' => 0,
    'budget' => 0,
    'size' => 'md',
    'showPercentage' => true
])

@php
    $percentage = $budget > 0 ? round(($spent / $budget) * 100) : 0;

    $sizeConfig = [
        'sm' => [
            'container' => 'w-16 h-16',
            'svgSize' => 'w-16 h-16',
            'cx' => 32,
            'cy' => 32,
            'radius' => 28,
            'strokeWidth' => 6,
            'textSize' => 'text-sm',
        ],
        'md' => [
            'container' => 'w-24 h-24',
            'svgSize' => 'w-24 h-24',
            'cx' => 48,
            'cy' => 48,
            'radius' => 40,
            'strokeWidth' => 8,
            'textSize' => 'text-xl',
        ],
        'lg' => [
            'container' => 'w-32 h-32',
            'svgSize' => 'w-32 h-32',
            'cx' => 64,
            'cy' => 64,
            'radius' => 56,
            'strokeWidth' => 10,
            'textSize' => 'text-2xl',
        ],
    ];

    $config = $sizeConfig[$size] ?? $sizeConfig['md'];
    $circumference = 2 * 3.14159 * $config['radius'];

    $strokeColor = match(true) {
        $percentage >= 90 => '#ef4444',
        $percentage >= 75 => '#f59e0b',
        default => '#25A249',
    };
@endphp

<div {{ $attributes->merge(['class' => 'relative shrink-0 ' . $config['container']]) }}>
    <svg class="{{ $config['svgSize'] }} transform -rotate-90">
        <circle
            cx="{{ $config['cx'] }}"
            cy="{{ $config['cy'] }}"
            r="{{ $config['radius'] }}"
            stroke="#e5e7eb"
            stroke-width="{{ $config['strokeWidth'] }}"
            fill="none"
        />
        <circle
            cx="{{ $config['cx'] }}"
            cy="{{ $config['cy'] }}"
            r="{{ $config['radius'] }}"
            stroke="{{ $strokeColor }}"
            stroke-width="{{ $config['strokeWidth'] }}"
            fill="none"
            stroke-dasharray="{{ $circumference }}"
            stroke-dashoffset="{{ $circumference * (1 - $percentage / 100) }}"
            stroke-linecap="round"
        />
    </svg>
    @if($showPercentage)
        <div class="absolute inset-0 flex items-center justify-center">
            <span class="{{ $config['textSize'] }} font-semibold text-gray-800">{{ $percentage }}%</span>
        </div>
    @endif
</div>
