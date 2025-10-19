<div class="flex flex-col gap-4">
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
    <section class="inspiration">
        <x-texts.second-title>Inspiration</x-texts.second-title>
        <div>
            <x-ui.inspirationbox>

            </x-ui.inspirationbox>
        </div>
    </section>

    <div class="flex flex-col lg:flex-row gap-6">
        <section class="your-budget">
            <x-texts.second-title>Your budget</x-texts.second-title>
            <x-ui.messages.no-budget-message></x-ui.messages.no-budget-message>
        </section>
        <section class="your-rooms">
            <x-texts.second-title>Your rooms</x-texts.second-title>
            <x-ui.messages.no-rooms-message></x-ui.messages.no-rooms-message>
        </section>
    </div>

</div>

