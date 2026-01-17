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
    <div x-show="successMessage" x-transition class="text-green-600 z-50 mb-8 text-sm">
        <span x-text="successMessage"></span>
    </div>

    {{-- Kategorie Filter --}}
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

    {{-- Items Grid --}}
    <x-partials.items-grid
        :items="$items"
        :showCategoryFilter="true"
        selectedCategory="all"
        :onItemClick="'selectedItem = item'"
        :plusButtonAction="'openRoomListModal({itemId})'"
    />

    @include('livewire.modals.selected-item')
    @include('livewire.modals.open-room-list')
</section>
