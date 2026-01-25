<div class="space-y-8">

    @if(!$hasData)
        <section>
            @foreach($messages as $message)
                <x-dynamic-component
                    :component="$message['component']"
                    :attributes="$message['props']"
                />
            @endforeach
        </section>

        @if($editingTotalBudget)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Set Your Total Budget</h3>
                <label class="text-sm text-turquoise uppercase block mb-2">Total Budget (€)</label>
                <input
                    type="number"
                    wire:model="editingTotalBudgetValue"
                    placeholder="2400"
                    step="0.01"
                    autofocus
                    class="text-sm w-full bg-transparent border focus:outline-none p-3 rounded-lg
                        @error('editingTotalBudgetValue') border-red-500 @else border-gray-300 @enderror"
                />
                @error('editingTotalBudgetValue')
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror

                <div class="mt-4 flex gap-2">
                    <x-buttons.turquoise-button wire:click="saveTotalBudgetEdit">
                        Save Budget
                    </x-buttons.turquoise-button>
                    <x-buttons.white-button wire:click="cancelTotalBudgetEdit">
                        Cancel
                    </x-buttons.white-button>
                </div>
            </div>
        @endif
    @else

        <x-texts.modal-section-header
            title="Total Budget"
            wire:click="openTotalBudgetEdit"
        ></x-texts.modal-section-header>

        @if($editingTotalBudget)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-4">
                <label class="text-sm text-turquoise uppercase block mb-2">Total Budget</label>
                <input
                    type="number"
                    wire:model="editingTotalBudgetValue"
                    placeholder="2400"
                    step="0.01"
                    class="text-sm w-full bg-transparent border focus:outline-none p-2 rounded-lg
                        @error('editingTotalBudgetValue') border-red-500 @else border-gray-700 @enderror"
                />
                @error('editingTotalBudgetValue')
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror

                <div class="mt-3 flex gap-2">
                    <x-buttons.turquoise-button wire:click="saveTotalBudgetEdit">
                        Save
                    </x-buttons.turquoise-button>
                    <x-buttons.white-button wire:click="cancelTotalBudgetEdit">
                        Cancel
                    </x-buttons.white-button>
                </div>
            </div>
        @endif

        <section class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-4">Total Distribution</h3>
                    <x-ui.budget-widget
                        :spent="$totalSpent"
                        :budget="$appTotalBudget"
                        variant="detailed"
                        circleSize="md"
                    />
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-4">Room Distribution</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach($rooms as $room)
                            @php
                                $roomPercentage = $appTotalBudget > 0
                                    ? round(($room->budget / $appTotalBudget) * 100)
                                    : 0;
                            @endphp
                            <div class="flex flex-col items-start self-center">
                                <x-ui.budget-circle
                                    :spent="$room->spent"
                                    :budget="$room->budget"
                                    size="sm"
                                    class="mb-2"
                                />
                                <p class="text-xs text-gray-900 font-medium text-center">{{ $room->name }}</p>
                                <p class="text-xs text-gray-500">{{ $roomPercentage }}%</p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </section>

        @if($rooms->count() > 0)
            <x-texts.modal-section-header title="Your Rooms" :editable="false"></x-texts.modal-section-header>

            <section class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center gap-2 overflow-x-auto mb-6 pb-2 border-b border-b-mybeige">
                    @foreach($rooms as $room)
                        <button
                            wire:click="selectRoom({{ $room->id }})"
                            @class([
                                'flex items-center gap-2 px-4 py-2 text-sm rounded-lg whitespace-nowrap transition-colors',
                                'text-turquoise font-semibold' => $selectedRoomId === $room->id,
                                'text-gray-600 hover:text-gray-900' => $selectedRoomId !== $room->id,
                            ])
                        >
                            @if(str_contains(strtolower($room->name), 'kitchen'))
                                <x-svg.kitchen class="w-4 h-4" />
                            @elseif(str_contains(strtolower($room->name), 'bedroom'))
                                <x-svg.bed class="w-4 h-4" />
                            @elseif(str_contains(strtolower($room->name), 'bathroom'))
                                <x-svg.bath class="w-4 h-4" />
                            @elseif(str_contains(strtolower($room->name), 'living'))
                                <x-svg.sofa class="w-4 h-4" />
                            @else
                                <x-svg.sofa class="w-4 h-4" />
                            @endif
                            <span>{{ $room->name }}</span>
                        </button>
                    @endforeach
                </div>

                @if($selectedRoom)
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <x-ui.budget-widget
                                :spent="$selectedRoom->spent"
                                :budget="$selectedRoom->budget"
                                variant="detailed"
                                circleSize="md"
                            />
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-4">Category Distribution</h3>
                            <div class="space-y-4">
                                @foreach($categoryDistribution as $category => $data)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <x-dynamic-component
                                                :component="'svg.' . strtolower($category)"
                                                class="w-4 h-4 text-turquoise"
                                            />
                                            <span class="text-sm text-gray-700">{{ ucfirst($category) }}</span>
                                        </div>
                                        <span class="text-lg font-light text-gray-900">{{ $data['percentage'] }}%</span>
                                    </div>
                                @endforeach

                                @if(count($categoryDistribution) === 0)
                                    <p class="text-sm text-gray-500 text-left py-4">
                                        No items in this room yet
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        @endif

    @endif
</div>
