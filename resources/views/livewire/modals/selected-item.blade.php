<!-- MODAL -->
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
                <template x-if="selectedItem">
                    <img
                        :src="selectedItem.image_url"
                        class="rounded-lg w-full h-auto max-h-[380px] object-contain"
                    >
                </template>
            </div>

            <div class="flex flex-col md:w-1/2 gap-3 overflow-hidden">

                <h2 class="text-2xl text-turquoise break-words"
                    x-text="selectedItem?.title">
                </h2>

                <p class="text-gray-600 break-words"
                   x-text="selectedItem?.description">
                </p>

                <p class="text-gray-600 text-sm"
                   x-text="'Size: ' + selectedItem?.size">
                </p>

                <p class="text-xl font-light "
                   x-text="selectedItem?.price + ' €'">
                </p>

                <p class="text-sm text-gray-500"
                   x-text="'Category: ' + selectedItem?.category">
                </p>

                <a
                    class="block mt-2 text-turquoise underline text-sm font-medium"
                    :href="selectedItem?.shop_link"
                    target="_blank"
                >
                    Where can I buy it?
                </a>
                <!-- Button für das item einzufügen -->
            </div>
        </div>
    </article>
</div>
