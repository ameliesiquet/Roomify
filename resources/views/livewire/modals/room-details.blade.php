{{-- ROOM DETAILS SIDE MODAL --}}
@if($showRoomDetailsModal && $selectedRoomForDetails)
    <div class="fixed inset-0 z-50 flex">
        <div class="fixed inset-0 bg-black/50" wire:click="closeRoomDetailsModal"></div>

        <section
            class="w-full max-w-md bg-[#f7f7f5] h-full shadow-xl p-6 flex flex-col ml-auto relative z-10"
            role="dialog"
            aria-modal="true"
        >
            <header class="relative flex items-center justify-center py-3 mb-6 border-b border-light-sand shadow-2xs">
                <button
                    class="absolute left-0 text-gray-500 hover:text-black cursor-pointer"
                    wire:click="closeRoomDetailsModal"
                    aria-label="Close details"
                >
                    <x-svg.arrow-left/>
                </button>
                <h2 class="text-sm tracking-wide uppercase text-turquoise">
                    {{ $selectedRoomForDetails->name }} Details
                </h2>
            </header>

            <div class="flex-1 overflow-y-auto space-y-6">
                <livewire:partials.rooms.detail-title :room="$selectedRoomForDetails"/>


                {{-- Budget --}}
                <section>
                    <x-texts.modal-section-header
                        title="Budget"
                        wire:click="openBudgetEditModal">
                    </x-texts.modal-section-header>


                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        {{-- Progress Circle --}}
                        <div class="flex items-center gap-6 mb-4">
                            <div class="relative w-24 h-24">
                                @php
                                    $percentage = $selectedRoomForDetails->budget > 0
                                        ? round(($selectedRoomForDetails->spent / $selectedRoomForDetails->budget) * 100)
                                        : 0;
                                @endphp
                                <svg class="w-24 h-24 transform -rotate-90">
                                    {{-- Background circle --}}
                                    <circle cx="48" cy="48" r="40" stroke="#e5e7eb" stroke-width="8" fill="none"/>
                                    {{-- Progress circle --}}
                                    <circle
                                        cx="48"
                                        cy="48"
                                        r="40"
                                        stroke="#4ade80"
                                        stroke-width="8"
                                        fill="none"
                                        stroke-dasharray="{{ 2 * 3.14159 * 40 }}"
                                        stroke-dashoffset="{{ 2 * 3.14159 * 40 * (1 - $percentage / 100) }}"
                                        stroke-linecap="round"
                                    />
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-xl font-semibold text-gray-800">{{ $percentage }}%</span>
                                </div>
                            </div>

                            <div class="flex-1 space-y-2">
                                <div class="flex items-baseline gap-2">
                                    <span class="text-sm text-gray-600">Remaining budget:</span>
                                    <span class="text-2xl font-light text-[#4ade80]">
                                    {{ number_format($selectedRoomForDetails->budget - $selectedRoomForDetails->spent, 0) }}€
                                </span>
                                </div>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-sm text-gray-600">You've spend so far:</span>
                                    <span class="text-xl font-light text-gray-800">
                                    {{ number_format($selectedRoomForDetails->spent, 0) }}€
                                </span>
                                </div>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-sm text-gray-600">You can spend up to</span>
                                    <span class="text-xl font-light text-gray-800">
                                    {{ number_format($selectedRoomForDetails->budget, 0) }}€
                                </span>
                                </div>
                            </div>
                        </div>

                        {{-- Arrow Button --}}
                        <button
                            class="ml-auto flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </section>

                {{-- Moodboard --}}
                <livewire:partials.rooms.detail-moodboard :room="$selectedRoomForDetails"/>


                {{-- To-do  --}}
                <livewire:partials.rooms.detail-todo :room="$selectedRoomForDetails"/>

                {{-- Notes Section --}}
                <livewire:partials.rooms.detail-notes :room="$selectedRoomForDetails"/>

                {{-- Delete Button --}}
                <section
                    class="pt-6 border-t border-gray-200"
                    x-data
                >
                    <x-buttons.red-button
                        @click="$dispatch('open-delete-room-modal')"
                    >
                        Delete Room
                    </x-buttons.red-button>
                </section>

            </div>

            {{-- Delete Modal --}}
            <aside
                x-data="{ open: false }"
                x-on:open-delete-room-modal.window="open = true"
                x-on:close-delete-room-modal.window="open = false"
                x-show="open"
                x-cloak
                class="fixed inset-0 flex items-center justify-center bg-black/40 z-50"
            >
                <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        Delete room?
                    </h2>

                    <p class="mt-2 text-sm text-gray-600">
                        Are you sure you want to delete
                        <span class="font-semibold text-turquoise">
                        “{{ $selectedRoomForDetails?->name }}”
                </span>?
                        All items, todos and notes in this room will be permanently removed. 🤯
                    </p>

                    <div class="mt-6 flex justify-start gap-3">
                        <x-buttons.white-button
                            type="button"
                            @click="$dispatch('close-delete-room-modal')"
                        >
                            Cancel
                        </x-buttons.white-button>

                        <x-buttons.red-button
                            wire:click="deleteRoom"
                            @click="$dispatch('close-delete-room-modal')"
                        >
                            Delete Room
                        </x-buttons.red-button>
                    </div>
                </div>
            </aside>
        </section>
    </div>
@endif
