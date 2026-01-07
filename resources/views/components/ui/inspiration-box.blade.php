<div x-data="{ selectedItem: null }" class="relative">
    <div class="swiper mySwiper overflow-x-auto">
        <div class="swiper-wrapper flex gap-6">
            @foreach($items as $item)
                <div class="swiper-slide cursor-pointer w-auto flex-shrink-0"
                     @click="selectedItem = {{ $item->toJson() }}">
                    <img src="{{ $item->image_url }}"
                         alt="{{ $item->title ?? 'Item' }}"
                         class="h-60 w-auto object-cover rounded-xl shadow-md">
                </div>
            @endforeach
        </div>

        <!-- Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    @include('livewire.modals.selected-item')
</div>
