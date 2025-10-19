<div class="flex flex-col gap-4">
    @foreach($messages as $message)

        <x-dynamic-component
            :component="$message['component']"
            :attributes="$message['props']"
        />
    @endforeach
</div>
