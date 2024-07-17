<?php

use App\Models\Note;
use Livewire\Volt\Component;

new class extends Component {
    public Note $note;
    public int $heartsCount;

    public function mount(Note $note)
    {
        $this->note = $note;
        $this->heartsCount = $note->hearts_count;
    }

    public function like()
    {
        $this->note->increment('hearts_count');
        $this->heartsCount = $this->note->hearts_count;
    }
};

?>

<div>
    <x-button icon="heart" rose spinner wire:click='like' xs>
        <span x-text="$wire.heartsCount"></span>
    </x-button>
</div>
