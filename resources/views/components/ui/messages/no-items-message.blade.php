<x-ui.messages.message
    :message="'You haven’t saved any items yet...🪑

        Start exploring and save items you love.

        They’ll show up here. 💫'"
    :time="now()->format('H:i')"
    link-text="Start now"
    :link-href="route('shopping')"
/>
