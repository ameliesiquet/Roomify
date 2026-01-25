@props([
    'spent' => 0,
    'budget' => 0,
    'variant' => 'compact',
    'circleSize' => 'sm'
])

@php
    $remaining = $budget - $spent;
    $percentage = $budget > 0 ? round(($spent / $budget) * 100) : 0;

    $statusColor = match(true) {
        $percentage >= 90 => 'text-red-500',
        $percentage >= 75 => 'text-orange-500',
        default => 'text-[#25A249]',
    };

    $statusMessage = match(true) {
        $percentage >= 90 => 'You need to pay attention!⚠️',
        $percentage >= 75 => 'Oh! you have to pay attention 😝',
        default => 'No worries, you\'re good 😊',
    };
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center gap-4']) }}>
    <x-ui.budget-circle
        :spent="$spent"
        :budget="$budget"
        :size="$circleSize"
    />

    <div class="flex-1 min-w-0">
        @if($variant === 'compact')
            <p class="flex flex-wrap items-baseline gap-2 mb-1">
                <span class="text-xs text-gray-600">Remaining:</span>
                <span class="text-lg font-light {{ $statusColor }}">
                    {{ number_format($remaining, 0) }}€
                </span>
            </p>
            <p class="text-xs text-gray-500 break-words">
                {{ $statusMessage }}
            </p>
        @else
            <div class="space-y-1 sm:space-y-2">
                <p class="flex flex-wrap items-baseline gap-2">
                    <span class="text-sm text-gray-600">Remaining budget:</span>
                    <span class="text-lg sm:text-xl font-light {{ $statusColor }}">
                        {{ number_format($remaining, 0) }}€
                    </span>
                </p>
                <p class="flex flex-wrap items-baseline gap-2">
                    <span class="text-xs text-gray-600">You've spent so far:</span>
                    <span class="text-sm sm:text-l font-light text-gray-800">
                        {{ number_format($spent, 0) }}€
                    </span>
                </p>
                <p class="flex flex-wrap items-baseline gap-2">
                    <span class="text-xs text-gray-600">You can spend up to:</span>
                    <span class="text-sm sm:text-l font-light text-gray-800">
                        {{ number_format($budget, 0) }}€
                    </span>
                </p>
            </div>
        @endif
    </div>
</div>

