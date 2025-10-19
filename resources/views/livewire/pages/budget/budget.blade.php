<section>
    @foreach($messages as $message)
        <x-dynamic-component
            :component="$message['component']"
            :attributes="$message['props']"
        />
    @endforeach
</section>
