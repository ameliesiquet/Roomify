
<section class="flex flex-col gap-4">
    <div class="flex flex-col items-start gap-3 bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <p class="text-sm text-gray-800">
            No rooms created yet 😴🏠<br>
            Bring your home to life! Add your first room and start designing stress-free.
        </p>

        <button
            wire:click="openAddRoomModal"
            class="px-4 py-2 bg-turquoise text-white text-sm rounded-lg hover:bg-turquoise/90 transition-colors inline-flex items-center gap-2"
        >
            Create my first room
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</section>
