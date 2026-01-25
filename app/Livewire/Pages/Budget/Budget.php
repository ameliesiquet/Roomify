<?php

namespace App\Livewire\Pages\Budget;

use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Budget extends Component
{
    public $rooms;
    public $selectedRoomId = null;
    public $appTotalBudget = 0;
    public $totalSpent = 0;
    public $totalRoomBudgets = 0;
    public $messages = [];

    public $editingTotalBudget = false;
    public $editingTotalBudgetValue = 0;

    public function mount()
    {
        $this->loadBudgetData();
        $this->messages = $this->getMessages();

        if ($this->rooms->count() > 0) {
            $this->selectedRoomId = $this->rooms->first()->id;
        }
    }

    protected function loadBudgetData()
    {
        $user = Auth::user();
        $this->rooms = $user->rooms()->with('items')->get();

        $this->appTotalBudget = $user->total_budget ?? 0;

        $this->totalRoomBudgets = $this->rooms->sum('budget');
        $this->totalSpent = $this->rooms->sum('spent');
    }

    protected function getMessages()
    {
        $hasRooms = $this->rooms->count() > 0;
        $hasBudget = $this->appTotalBudget > 0;

        $messages = [];

        if (!$hasRooms || !$hasBudget) {
            $messages[] = [
                'component' => 'ui.messages.no-budget-message',
                'props' => [],
            ];
        }

        return $messages;
    }

    public function selectRoom($roomId)
    {
        $this->selectedRoomId = $roomId;
    }

    public function openTotalBudgetEdit()
    {
        $this->editingTotalBudget = true;
        $this->editingTotalBudgetValue = $this->appTotalBudget;
    }

    public function cancelTotalBudgetEdit()
    {
        $this->editingTotalBudget = false;
        $this->editingTotalBudgetValue = 0;
        $this->resetValidation();
    }

    public function saveTotalBudgetEdit()
    {
        $this->validate([
            'editingTotalBudgetValue' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();


        $updated = $user->update(['total_budget' => $this->editingTotalBudgetValue]);


        $this->appTotalBudget = $this->editingTotalBudgetValue;
        $this->editingTotalBudget = false;
        $this->loadBudgetData();

        session()->flash('message', 'Total budget updated successfully!');
        $this->messages = $this->getMessages();
    }

    public function getSelectedRoomProperty()
    {
        return $this->rooms->firstWhere('id', $this->selectedRoomId);
    }

    public function getCategoryDistributionProperty()
    {
        if (!$this->selectedRoom) {
            return [];
        }

        $items = $this->selectedRoom->items;
        $totalItems = $items->count();

        if ($totalItems === 0) {
            return [];
        }

        $categories = $items->groupBy('category')->map(function ($categoryItems) use ($totalItems) {
            return [
                'count' => $categoryItems->count(),
                'percentage' => round(($categoryItems->count() / $totalItems) * 100),
            ];
        });

        return $categories->toArray();
    }

    public function render()
    {
        return view('livewire.pages.budget.budget', [
            'messages' => $this->messages,
            'appTotalBudget' => $this->appTotalBudget,
            'totalSpent' => $this->totalSpent,
            'totalRoomBudgets' => $this->totalRoomBudgets,
            'rooms' => $this->rooms,
            'selectedRoom' => $this->selectedRoom,
            'categoryDistribution' => $this->categoryDistribution,
            'hasData' =>  $this->appTotalBudget > 0,
        ])->layout('layouts.app-sidebar', [
            'title' => 'Your Budget',
        ]);
    }
}
