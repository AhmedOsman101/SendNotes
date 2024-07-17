<?php

use App\Models\Note;
use Livewire\Volt\Component;

new class extends Component {
    public Note $note;
    public int $heartsCount;

    public function mount(Note $note) {
        $this->note = $note;
        $this->heartsCount = $note->hearts_count;
    }

    public function like() {
        $this->note->increment('hearts_count');
        $this->heartsCount = $this->note->hearts_count;
    }
}

?>

<div>
    <x-button xs wire:click='like' rose icon="heart" spinner>
        <span x-text="{{$heartsCount}}"></span>
    </x-button>
</div>
