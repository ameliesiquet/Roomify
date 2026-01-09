<section x-data="{
    selectedItem: null,
    showRoomListModal: false,
    userRooms: @js($rooms),
    selectedRoomItemId: null,
    selectedRoomId: null,
    selectedCategory: 'all',
    successMessage: '',

    openRoomListModal(itemId) {
        this.selectedRoomItemId = itemId;
        this.showRoomListModal = true;
    },
    closeRoomListModal() {
        this.showRoomListModal = false;
    }
}">
    <div x-show="successMessage" x-transition class="  text-green-700  z-50 mb-8 text-sm">
        <span x-text="successMessage"></span>
    </div>

    <div class="flex items-center gap-4 overflow-x-auto mb-8">
        <button
            @click="selectedCategory = 'all'"
            :class="selectedCategory === 'all' ? 'underline font-semibold' : 'text-gray-500'"
            class="flex items-center text-sm gap-2 px-2 py-2"
        >
            <x-dynamic-component
                :component="'svg.' . 'all'"
                class="w-4 h-4 shrink-0"
            />
            All
        </button>

        @foreach ($categories as $category)
            <button
                @click="selectedCategory = '{{ $category }}'"
                :class="selectedCategory === '{{ $category }}' ? 'underline font-semibold' : 'text-gray-500 hover:text-black'"
                class="flex items-center gap-2 px-2 py-2 text-sm rounded-md"
            >
                <x-dynamic-component
                    :component="'svg.' . strtolower($category)"
                    class="w-4 h-4 shrink-0"
                />
                <span class="leading-none">
                    {{ ucfirst($category) }}
                </span>
            </button>
        @endforeach
    </div>

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
                :class="(selectedCategory === 'all' || selectedCategory === '{{ $item->category }}') ? '' : 'hidden'"
                class="relative overflow-hidden cursor-pointer transition-opacity duration-300"
                @click="selectedItem = @js($item)"
            >

                <img src="{{ $item->image_url }}"
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

                <div class="absolute top-2 right-2">
                    @include('components.svg.plus', [
                        'onclick' => "openRoomListModal({$item->id})"
                    ])
                </div>

            </div>
        @endforeach
    </div>

    @include('livewire.modals.selected-item')
    @include('livewire.modals.open-room-list')
</section>
