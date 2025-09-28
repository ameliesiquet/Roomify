<x-ui.messages.message
    :message="'Welcome to Roomify  🏡✨

    Let’s get started — create your first room or browse for inspiration.

    ➡️ Tip: Start with the room you use the most — maybe your bedroom?'"
    link-text="Add your first room"
    :link-href="route('rooms')"
    :time="now()->format('H:i')"
/>
