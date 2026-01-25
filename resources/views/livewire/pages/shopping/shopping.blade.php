<section x-data="{
    selectedItem: null,
    showRoomListModal: false,
    userRooms: @js($rooms),
    selectedRoomItemId: null,
    selectedRoomId: null,
    selectedCategory: 'all',

    openRoomListModal(itemId) {
        this.selectedRoomItemId = itemId;
        this.showRoomListModal = true;
    },
    closeRoomListModal() {
        this.showRoomListModal = false;
    }
}">
    @if (session()->has('message'))
        <div class="text-green-600 z-50 mb-8 text-sm">
            {{ session('message') }}
        </div>

    @endif

    <div class="flex items-center gap-4 overflow-x-auto mb-8">
        <button
                @click="selectedCategory = 'all'"
                :class="selectedCategory === 'all' ? 'underline font-semibold' : 'text-gray-500'"
                class="flex items-center text-sm gap-2 px-2 py-2"
        >
            <x-dynamic-component :component="'svg.all'" class="w-4 h-4 shrink-0" />
            All
        </button>

        @foreach ($categories as $category)
            <button
                    @click="selectedCategory = '{{ $category }}'"
                    :class="selectedCategory === '{{ $category }}' ? 'underline font-semibold' : 'text-gray-500 hover:text-black'"
                    class="flex items-center gap-2 px-2 py-2 text-sm rounded-md"
            >
                <x-dynamic-component :component="'svg.' . strtolower($category)" class="w-4 h-4 shrink-0" />
                <span class="leading-none">{{ ucfirst($category) }}</span>
            </button>
        @endforeach
    </div>

    <x-partials.items-grid
            :items="$items"
            :showCategoryFilter="true"
            selectedCategory="all"
            :onItemClick="'selectedItem = item'"
            :plusButtonAction="'openRoomListModal({itemId})'"
    />

    <button
            wire:click="openAddModal"
            aria-label="Add Item"
            class="
        fixed bottom-6 right-6 z-50
        rounded-full
        bg-black/10
        backdrop-blur-sm
        p-[2px] sm:p-1
        transition-all duration-200
        hover:scale-105
    "
    >
        <x-svg.add-camera-button
                class="
            block
            w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20
            drop-shadow-[0_18px_45px_rgba(0,0,0,0.45)]
        "
        />
    </button>



    @include('livewire.modals.selected-item')
    @include('livewire.modals.open-room-list')
    @include('livewire.modals.add-item-modal')
</section>
