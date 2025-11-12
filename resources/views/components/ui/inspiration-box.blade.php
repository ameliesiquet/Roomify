<div x-data="{ selectedItem: null }" class="relative">

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($items as $item)
                <div class="swiper-slide cursor-pointer flex justify-center"
                     @click="selectedItem = {{ $item->toJson() }}">
                    <img src="{{ $item->image_url }}"
                         alt="{{ $item->title ?? 'Item' }}"
                         class="h-60 object-cover rounded-xl shadow-md">
                </div>
            @endforeach
        </div>

        <!-- Swiper Controls -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- Custom scrollbar below slider -->
    <div class="relative mt-2 h-1 bg-gray-200 rounded-full overflow-hidden">
        <div id="slider-progress" class="absolute top-0 left-0 h-full bg-gray-900 transition-all duration-300 w-0"></div>
    </div>
    <!-- hizr noch den link mit dem pfeil einfügen dmait ich aifd ie hsoping page gehen kann -->
    @include('livewire.modals.selected-item')

</div>
