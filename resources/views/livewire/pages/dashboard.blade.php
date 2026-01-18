<div class="flex flex-col gap-4">
    {{-- Welcome Section --}}
    <section class="welcome">
        <h2 class="hidden">Roomify Message</h2>
        @foreach($messages as $message)
            @if(!empty($message['props']))
                <x-dynamic-component
                    :component="$message['component']"
                    :attributes="$message['props']"
                />
            @endif
        @endforeach
    </section>

    {{-- Inspiration Section --}}
    <section class="inspiration">
        <x-texts.second-title>Inspiration</x-texts.second-title>
        <div>
            <x-ui.inspirationbox :items="$inspirations" />
        </div>
    </section>

    {{-- Budget & Rooms Section --}}
    <div class="flex flex-col lg:flex-row gap-20 mt-10">

        {{-- Budget Section --}}
        <section class="your-budget ">
            <x-texts.second-title>Your budget</x-texts.second-title>

            @if($hasBudget)
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex flex-col gap-6 max-w-fit">
                    <x-ui.budget-widget
                        :spent="$totalSpent"
                        :budget="$totalBudget"
                        variant="detailed"
                        circleSize="md"
                    />
                    <x-svg.arrow-right></x-svg.arrow-right>

                </div>
            @else
                <x-ui.messages.no-budget-message />
            @endif
        </section>

        {{-- Rooms Section --}}
        <section class="your-rooms">
            <x-texts.second-title>Your rooms</x-texts.second-title>

            @if($hasRooms)
                <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-100 flex flex-col">
                    <div class="flex flex-wrap gap-y-4">
                        @foreach($rooms->take(4) as $room)
                            <a
                                href="{{ route('rooms') }}"
                                class="flex items-center justify-between px-4 rounded-lg hover:underline hover:font-semibold cursor-pointer transition-colors group"
                            >
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6  flex items-center justify-center">
                                        @if(str_contains(strtolower($room->name), 'kitchen'))
                                            <x-svg.kitchen class="w-5 h-5 text-turquoise" />
                                        @elseif(str_contains(strtolower($room->name), 'bedroom'))
                                            <x-svg.bed class="w-5 h-5 text-turquoise" />
                                        @elseif(str_contains(strtolower($room->name), 'bathroom'))
                                            <x-svg.bath class="w-5 h-5 text-turquoise" />
                                        @elseif(str_contains(strtolower($room->name), 'living'))
                                            <x-svg.sofa class="w-5 h-5 text-turquoise" />
                                        @else
                                            <x-svg.sofa class="w-5 h-5 text-turquoise" />
                                        @endif
                                    </div>

                                    <div>
                                        <p class="font-base text-sm text-gray-900">{{ $room->name }}</p>
                                    </div>
                                </div>

                            </a>

                        @endforeach
                            <x-svg.arrow-right></x-svg.arrow-right>

                    </div>

                    @if($rooms->count() > 4)
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a
                                href="{{ route('rooms') }}"
                                class="flex items-center justify-center text-sm text-turquoise hover:text-turquoise/80 transition-colors"
                            >
                                View all {{ $rooms->count() }} rooms →
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <x-ui.messages.no-rooms-message />
            @endif
        </section>
    </div>
</div>
