{{-- ADD ROOM SIDE MODAL --}}

@if($showAddRoomModal)
    <div class="fixed inset-0 z-50 flex">
        <div class="fixed inset-0 bg-black/50"
            wire:click="closeRoomDetailsModal"
        ></div>
        <aside
            class="w-full max-w-md bg-[#f7f7f5] h-full shadow-xl p-6 flex flex-col ml-auto relative z-10"
            role="dialog"
            aria-modal="true"
        >

            {{-- HEADER --}}
            <header class="relative flex items-center justify-center py-3 mb-6 border-b border-light-sand shadow-2xs">
                <button class="absolute left-0 text-gray-500 hover:text-black cursor-pointer"
                        wire:click="closeAddRoomModal"
                        aria-label="Close add room">
                    <x-svg.arrow-left />
                </button>
                <h2 class="text-sm tracking-wide uppercase text-turquoise">
                    Add a room
                </h2>
            </header>

            {{-- FORM --}}
            <form wire:submit.prevent="createRoom" class="flex-1 overflow-y-auto space-y-8">

                {{-- Title --}}
                <div>
                    <label class="text-sm text-turquoise uppercase ">Title *</label>
                    <input type="text"
                           wire:model="name"
                           placeholder="Kitchen"
                           class="text-xs mt-1 w-full bg-transparent border focus:outline-none p-2 rounded-lg
                              @error('name') border-red-500 @else border-gray-700 @enderror" />
                    @error('name')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Budget --}}
                <div>
                    <label class="text-sm text-turquoise uppercase">Budget</label>
                    <input type="number"
                           wire:model="budget"
                           placeholder="2000"
                           step="0.1"
                           class="text-xs mt-1 w-full bg-transparent border focus:outline-none p-2 rounded-lg
                              @error('budget') border-red-500 @else border-gray-700 @enderror" />
                    @error('budget')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Moodboard --}}
                <section>
                    <x-texts.modal-section-header
                        title="Moodboard"
                        :editable="false"
                    />
                    <div class="flex flex-wrap gap-4">
                        @foreach($colors as $index => $color)
                            <div class="flex items-center gap-2">
                                <div class="relative w-6 h-6">
                                    <div
                                        class="w-6 h-6 rounded-full border border-gray-300"
                                        style="background-color: {{ $color }}"
                                    ></div>

                                    <input
                                        type="color"
                                        wire:model.live="colors.{{ $index }}"
                                        class="w-6 h-6 absolute inset-0 opacity-0 cursor-pointer"
                                    />
                                </div>
                                <button
                                    type="button"
                                    wire:click="removeColor({{ $index }})"
                                    class="text-xs text-gray-400 hover:text-red-500"
                                >
                                    ✕
                                </button>
                            </div>
                        @endforeach

                        <button
                            type="button"
                            wire:click="addColor"
                            class="w-5 h-5 flex items-center justify-center
                   rounded-full border border-dashed border-gray-300
                   text-gray-400 hover:border-gray-500 hover:text-gray-600"
                        >
                            +
                        </button>
                    </div>
                </section>


                {{-- To-do list --}}
                <section>
                    <h3 class="text-sm text-gray-500 mb-3">To do</h3>
                    <ul class="space-y-2">
                        @foreach($todo_list as $index => $todo)
                            <li class="flex items-center gap-2">
                                <input type="text"
                                       wire:model="todo_list.{{ $index }}.text"
                                       class="flex-1 bg-transparent border-b border-gray-300 focus:outline-none py-1 text-xs" />
                                <button type="button"
                                        class="text-gray-400 text-xs"
                                        wire:click="removeTodo({{ $index }})"
                                        aria-label="Remove task">
                                    ✕
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    <button type="button"
                            class="text-xs text-gray-500 mt-2"
                            wire:click="addTodo">
                        + Add task
                    </button>
                </section>

            </form>

            {{-- FOOTER --}}
            <footer class="pt-4">
                <x-buttons.turquoise-button
                    type="button"
                    wire:click="createRoom"
                    @click="
                    successMessage = 'Room successfully created';
                    setTimeout(() => successMessage = '', 3000);"
                   >
                    Save changes
                </x-buttons.turquoise-button>
            </footer>
        </aside>
    </div>
@endif
