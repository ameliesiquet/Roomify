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
            x-data="{ category: '{{ $item->category }}' }"
            x-show="selectedCategory === 'all' || selectedCategory === category"
            x-transition.opacity
            class="relative overflow-hidden cursor-pointer"
            @click="selectedItem = @json($item)"
        >

            <img src="{{ $item->image_url }}"
                 class="h-40 md:h-50 lg:h-60 w-full object-cover rounded-xl">

            <div class="p-3 flex flex-col gap-1">
                <h3 class="text-sm lg:text-md xl:text-xlline-clamp-2 text-nowrap overflow-hidden">
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

            <div class="absolute top-2 right-2">
                @include('components.svg.plus', [
                    'onclick' => "openRoomListModal({$item->id})"
                ])
            </div>

        </div>
    @endforeach
</div>
