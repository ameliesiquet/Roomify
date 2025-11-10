<div
    x-data="{ selectedItem: null }"
    class="relative"
>

    <!-- GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($items as $item)
            <div class="cursor-pointer"
                 @click="selectedItem = {{ $item->toJson() }}">
                <img src="{{ $item->image_url }}" class="w-full h-48 object-cover rounded-lg">
                <h3 class="mt-2 font-semibold">{{ $item->title }}</h3>
            </div>
        @endforeach
    </div>

    <!-- MODAL (importiert aus deiner separaten Datei) -->
    @include('livewire.modals.selected-item')

</div>
