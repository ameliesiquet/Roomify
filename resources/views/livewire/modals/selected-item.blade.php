<div
    x-show="selectedItem"
    x-cloak
    class="fixed inset-0 bg-black/40 flex items-center justify-center p-4 z-100"
    @click.self="selectedItem = null"
>
    <article class="bg-white p-6 rounded-xl w-full max-w-4xl shadow-xl z-50">

        <button
            class="mb-4 cursor-pointer"
            @click="selectedItem = null"
        >
            <x-svg.arrow-left></x-svg.arrow-left>
        </button>

        <div class="flex flex-col md:flex-row gap-6">

            <div class="flex-shrink-0 md:w-1/2">
                <img
                    :src="selectedItem?.image_url || '/images/placeholder.png'"
                    class="rounded-lg w-full h-auto max-h-[380px] object-contain"
                    alt="Item image"
                >
            </div>

            <div class="flex flex-col md:w-1/2 gap-3 overflow-hidden">

                <h2 class="text-2xl text-turquoise break-words"
                    x-text="selectedItem?.title || 'No title available'">
                </h2>

                <p class="text-gray-600 break-words text-sm"
                   x-text="selectedItem?.description || 'No description available'">
                </p>

                <template x-if="selectedItem?.size">
                    <p class="text-gray-600 text-sm">
                        <span class="font-medium">Size:</span>
                        <span x-text="selectedItem.size"></span>
                    </p>
                </template>


                <p class="text-xl font-light"
                   x-text="selectedItem ? selectedItem.price + ' €' : ''">
                </p>

                <p class="text-sm text-gray-500"
                   x-text="selectedItem ? 'Category: ' + selectedItem.category : ''">
                </p>

                <template x-if="selectedItem?.item_url">
                    <a
                        class="block mt-2 text-turquoise underline text-sm font-medium"
                        :href="selectedItem.item_url"
                        target="_blank"
                    >
                        Where can I buy this item?
                    </a>
                </template>


            </div>
        </div>
    </article>
</div>
