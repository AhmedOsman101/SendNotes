<?php

use App\Models\Note;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {
    #[Validate('required|string|min:3')]
    public string $title;

    #[Validate('required|string|min:10')]
    public string $content;

    #[Validate('required|email')]
    public string $recipient;

    #[Validate('required|date')]
    public string $send_date;

    public function submit() {

        if ($this->validate()) {
            Note::create([
                'title' => $this->title,
                'user_id' => Auth::id(),
                'content' => $this->content,
                'recipient' => $this->recipient,
                'send_date' => $this->send_date,
            ]);

            to_route('notes.index');
        }
    }
}; ?>

<div>
    <form class="space-y-4" wire:submit='submit'>
        <x-input label="Note Title" placeholder="It's been a great day." wire:model="title" />
        <x-textarea label="Your Note" placeholder="Share all your thoughts with your friend." wire:model="content" />
        <x-input icon="user" label="Recipient" placeholder="yourfriend@email.com" type="email" wire:model="recipient" />
        <x-input icon="calendar" label="Send Date" type="date" wire:model="send_date" />
        <div class="pt-4">
            <x-button primary right-icon="calendar" spinner type="submit">Schedule Note</x-button>
        </div>
        <x-errors />
    </form>
</div>
