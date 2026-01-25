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
                    @if($editingBudget)
                        <div>
                            <label class="text-sm text-turquoise uppercase">Budget</label>
                            <input type="number"
                                   wire:model="editingBudgetValue"
                                   placeholder="2000"
                                   step="0.1"
                                   class="text-xs mt-1 w-full bg-transparent border focus:outline-none p-2 rounded-lg
                      @error('editingBudgetValue') border-red-500 @else border-gray-700 @enderror" />
                            @error('editingBudgetValue')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror

                            <div class="mt-2 flex gap-2">
                                <x-buttons.turquoise-button wire:click="saveBudgetEdit">
                                    Save
                                </x-buttons.turquoise-button>
                                <x-buttons.white-button wire:click="cancelBudgetEdit">
                                    Cancel
                                </x-buttons.white-button>
                            </div>
                        </div>
                    @endif

                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <x-ui.budget-widget
                            :spent="$selectedRoomForDetails->spent"
                            :budget="$selectedRoomForDetails->budget"
                            variant="full"
                        circleSize="sm"
                        />
                    </div>
                </section>


                {{-- Moodboard --}}
                <livewire:partials.rooms.detail-moodboard :room="$selectedRoomForDetails"/>


                {{-- To-do  --}}
               {{-- <livewire:partials.rooms.detail-todo :room="$selectedRoomForDetails"/>--}}

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
