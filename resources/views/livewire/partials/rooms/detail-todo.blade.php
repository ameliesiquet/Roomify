<section>
    <x-texts.modal-section-header
        title="To-do list"
        :editable="false"
    />


    <div class="bg-white p-6 rounded-2xl shadow-sm space-y-3">
        @forelse($todos as $index => $todo)
            <div class="flex items-center gap-3">
                <input
                    type="checkbox"
                    wire:click="toggleCompleted({{ $index }})"
                    @checked($todo['completed'])
                    class="rounded border-gray-300"
                >

                <input
                    type="text"
                    wire:model.lazy="todos.{{ $index }}.text"
                    wire:blur="save"
                    class="flex-1 text-sm bg-transparent border-b border-transparent focus:border-gray-300 focus:outline-none
                        {{ $todo['completed'] ? 'line-through text-gray-400' : '' }}"
                    placeholder="New task…"
                >

                <button
                    wire:click="removeTodo({{ $index }})"
                    class="text-gray-400 hover:text-red-500"
                >
                    ✕
                </button>
            </div>
        @empty
            <p class="text-sm text-gray-400 italic">
                No todos yet…
            </p>
        @endforelse

        <button
            wire:click="addTodo"
            class="text-sm text-turquoise hover:underline mt-4"
        >
            + Add task
        </button>
    </div>
</section>
