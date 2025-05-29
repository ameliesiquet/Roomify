<div>
    @if($child)
        @livewire('modals.' . $child, ['model' => $model])
    @endif
</div>
