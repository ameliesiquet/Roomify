{{-- resources/views/livewire/modals/add-item-modal.blade.php --}}
@if($showAddModal)
    <div class="fixed inset-0 z-50 flex">
        <div class="fixed inset-0 bg-black/50" wire:click="closeAddModal"></div>
        <aside class="w-full max-w-md bg-[#f7f7f5] h-full shadow-xl p-6 flex flex-col ml-auto relative z-10" role="dialog" aria-modal="true">

            <header class="relative flex items-center justify-center py-3 mb-6 border-b border-light-sand shadow-2xs">
                <button class="absolute left-0 text-gray-500 hover:text-black cursor-pointer"
                        wire:click="closeAddModal"
                        aria-label="Close add item">
                    <x-svg.arrow-left />
                </button>
                <h2 class="text-sm tracking-wide uppercase text-turquoise">
                    Add New Item
                </h2>
            </header>

            <form wire:submit.prevent="createItem" class="flex-1 overflow-y-auto space-y-6">

                {{-- Title --}}
                <div>
                    <label class="text-sm text-turquoise uppercase">Title *</label>
                    <input type="text" wire:model="title" placeholder="Item title"
                           class="text-xs mt-1 w-full bg-transparent border focus:outline-none p-2 rounded-lg
                              @error('title') border-red-500 @else border-gray-700 @enderror" />
                    @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label class="text-sm text-turquoise uppercase">Description *</label>
                    <textarea wire:model="description" rows="4" placeholder="Describe your item"
                              class="text-xs mt-1 w-full bg-transparent border focus:outline-none p-2 rounded-lg resize-none
                                 @error('description') border-red-500 @else border-gray-700 @enderror"></textarea>
                    @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Price --}}
                <div>
                    <label class="text-sm text-turquoise uppercase">Price (€) *</label>
                    <input type="number" wire:model="price" step="0.01" min="0" placeholder="0.00"
                           class="text-xs mt-1 w-full bg-transparent border focus:outline-none p-2 rounded-lg
                              @error('price') border-red-500 @else border-gray-700 @enderror" />
                    @error('price') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Category --}}
                <div>
                    <label class="text-sm text-turquoise uppercase">Category *</label>
                    <select wire:model="category"
                            class="text-xs mt-1 w-full bg-transparent border focus:outline-none p-2 rounded-lg
                               @error('category') border-red-500 @else border-gray-700 @enderror">
                        <option value="">Select category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                    @error('category') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Image --}}
                <div x-data="{ fileName: '' }">
                    <label class="text-sm text-turquoise uppercase">Image*</label>
                    <div class="mt-1 relative">
                        <input type="file" id="image-upload" wire:model="image" accept="image/*"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                               @change="fileName = $event.target.files[0]?.name || ''" />
                        <div class="text-xs w-full bg-transparent border border-gray-700 p-2 rounded-lg pointer-events-none
                                @error('image') border-red-500 @enderror">
                            <span class="text-gray-400" x-text="fileName || 'Click to upload image'"></span>
                        </div>
                    </div>
                    @error('image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror

                    @if($image)
                        <div class="mt-3">
                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-32 object-cover rounded-lg border border-gray-300" alt="Preview">
                        </div>
                    @endif
                </div>

                {{-- Item URL --}}
                <div>
                    <label class="text-sm text-turquoise uppercase">Item URL *</label>
                    <input type="url" wire:model="item_url" placeholder="https://example.com/item"
                           class="text-xs mt-1 w-full bg-transparent border focus:outline-none p-2 rounded-lg
                              @error('item_url') border-red-500 @else border-gray-700 @enderror" />
                    @error('item_url') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Optional: Assign to Room ONLY on Rooms page --}}
                @if($assignToRoom ?? false)
                    <div>
                        <label class="text-sm text-turquoise uppercase">Assign to Room</label>
                        <select wire:model="selectedRoomIdForNewItem"
                                class="text-xs mt-1 w-full bg-transparent border focus:outline-none p-2 rounded-lg">
                            <option value="">Select a room (optional)</option>
                            @foreach($userRooms as $room)
                                <option value="{{ $room->id }}">{{ ucfirst($room->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Make Public --}}
                <div>
                    <div class="flex items-center justify-between">
                        <label class="text-sm text-turquoise uppercase">Make this item public</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model.live="is_public" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-turquoise peer-focus:ring-2 peer-focus:ring-turquoise transition-colors
                                    after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-transform
                                    peer-checked:after:translate-x-5"></div>
                        </label>
                    </div>
                    <p class="text-xs text-gray-600 mt-2 mb-4">
                        @if($is_public) Everyone can see this item @else Only you can see this item @endif
                    </p>
                </div>

            </form>

            <footer class="pt-6">
                <x-buttons.turquoise-button type="button" wire:click="createItem">
                    Add Item
                </x-buttons.turquoise-button>
            </footer>
        </aside>
    </div>
@endif
