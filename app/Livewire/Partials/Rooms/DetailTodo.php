<?php

namespace App\Livewire\Partials\Rooms;

use Livewire\Component;
use App\Models\Room;

class DetailTodo extends Component
{
    public Room $room;
    public array $todos = [];

    public function mount(Room $room)
    {
        $this->room = $room;

        $todos = $room->todo_list ?? [];
        $this->todos = array_map(function($todo) {
            if (is_string($todo)) {
                return ['text' => $todo, 'completed' => false];
            }
            return $todo;
        }, $todos);
    }

    public function addTodo()
    {
        $this->todos[] = [
            'text' => '',
            'completed' => false,
        ];
    }

    public function removeTodo($index)
    {
        unset($this->todos[$index]);
        $this->todos = array_values($this->todos);
        $this->save();
    }

    public function toggleCompleted($index)
    {
        $this->todos[$index]['completed'] = ! $this->todos[$index]['completed'];
        $this->save();
    }

    public function save()
    {
        $this->room->update([
            'todo_list' => $this->todos,
        ]);
    }

    public function render()
    {
        return view('livewire.partials.rooms.detail-todo');
    }
}

