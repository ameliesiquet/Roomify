@props([
    'items',
    'showCategoryFilter' => false,
    'selectedCategory' => 'all',
    'onItemClick' => null,
    'plusButtonAction' => null,
    'showRemoveButton' => false,
    'removeButtonAction' => null,
    'roomId' => null,
])


<div class="
    grid
    grid-cols-2
    sm:grid-cols-3
    lg:grid-cols-4
    gap-x-6 gap-y-6
    sm:gap-x-6 sm:gap-y-8
    md:gap-x-10 md:gap-y-8
    lg:gap-x-8 lg:gap-y-10
    xl:gap-x-14 xl:gap-y-12
">
    @foreach($items as $item)
        <div
            x-data="{ item: @js($item) }"
            @if($showCategoryFilter)
                :class="(selectedCategory === 'all' || selectedCategory === '{{ $item->category }}') ? '' : 'hidden'"
            @endif
            class="relative overflow-hidden cursor-pointer transition-opacity duration-300"
            @if($onItemClick)
                @click="{{ $onItemClick }}"
            @endif
        >
            <img src="{{ $item->image_url }}"
                 alt="{{ $item->title }}"
                 class="h-40 md:h-50 lg:h-60 w-full object-cover rounded-xl">

            <div class="p-3 flex flex-col gap-1">
                <h3 class="text-sm lg:text-md xl:text-xl line-clamp-2 text-nowrap overflow-hidden">
                    {{ $item->title }}
                </h3>

                <div class="flex flex-col sm:flex-row justify-between items-baseline gap-1 sm:gap-2 text-gray-500 mt-1 flex-wrap">
                    <span class="text-s">
                        @if($item->price)
                            {{ number_format($item->price, 2) }}€
                        @endif
                    </span>
                    <span class="text-xs">
                        @if($item->size)
                            {{ $item->size }}
                        @endif
                    </span>
                </div>
            </div>

            <div class="absolute top-2 right-2 flex gap-1">
                {{-- Plus Button --}}
                @if($plusButtonAction)
                    <button
                        @click.stop="{{ str_replace('{itemId}', $item->id, str_replace('{roomId}', $roomId, $plusButtonAction)) }}"
                        class="bg-white/80 hover:bg-white rounded-full p-1.5 shadow-md transition"
                        title="Add to list"
                    >
                        @include('components.svg.plus')
                    </button>
                @endif

                {{-- Remove Button --}}
                @if($showRemoveButton && $removeButtonAction)
                    <button
                        wire:click.stop="{{ str_replace('{itemId}', $item->id, str_replace('{roomId}', $roomId, $removeButtonAction)) }}"
                        class="bg-white/80 hover:bg-white rounded-full p-1.5 shadow-md transition rotate-45"
                        title="Remove item"
                    >
                        <x-svg.plus class="w-4 h-4 transform rotate-45 text-red-500"/>
                    </button>
                @endif

            </div>

        </div>
    @endforeach
</div>
