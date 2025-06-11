<div class="flex flex-col gap-4">
    @foreach ($messages as $message)
        <x-ui.message
                :icon="$message['icon']"
                :message="$message['message']"
                :linkText="$message['linkText']"
                :linkHref="$message['linkHref']"
                :time="$message['time']"
        />
    @endforeach
</div>
