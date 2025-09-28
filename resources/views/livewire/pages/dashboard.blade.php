<div class="flex flex-col gap-4">
    @foreach($messages as $message)
        @if(!empty($message['props']['username'])) <!-- optional absichern -->
        <x-dynamic-component
            :component="$message['component']"
            :attributes="$message['props']"
        />
        @endif
    @endforeach
</div>
