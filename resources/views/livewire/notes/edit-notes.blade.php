<?php

use App\Models\Note;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component {
    public string $id;
    public string $title;
    public string $content;
    public string $recipient;
    public string $send_date;
    public bool $is_published;

    public ?Note $note;

    public function mount() {
        $this->note = Note::find($this->id);

        $this->authorize('update', $this->note);

        $this->title = $this->note->title;
        $this->content = $this->note->content;
        $this->recipient = $this->note->recipient;
        $this->send_date = $this->note->send_date;
        $this->is_published = $this->note->is_published;
    }

    public function update() {
        // validate data
        $validated = $this->validate([
            'title' => 'required|string|min:5',
            'content' => 'required|string|min:10',
            'recipient' => 'required|email',
            'send_date' => 'required|date',
            'is_published' => 'boolean',
        ]);

        // update the note
        $this->note->update($validated);

        // dispatches a new event `note-saved`
        $this->dispatch('note-saved');
    }
};
?>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Edit Note') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto max-w-2xl space-y-4 sm:px-6 lg:px-8">
        <form class="space-y-4" wire:submit='update'>
            <x-input label="Note Title" placeholder="It's been a great day." wire:model="title" />
            <x-textarea label="Your Note" placeholder="Share all your thoughts with your friend." wire:model="content" />
            <x-input icon="user" label="Recipient" placeholder="yourfriend@email.com" type="email" wire:model="recipient" />
            <x-input icon="calendar" label="Send Date" type="date" wire:model="send_date" />
            <x-checkbox label="Note Published" wire:model='is_published' />
            <div class="flex justify-between pt-4">
                <x-button secondary spinner="update" type="submit">Save Note</x-button>
                <x-button href="{{ route('notes.index') }}" icon="arrow-left" info>Back to Notes</x-button>
            </div>
            <x-action-message on="note-saved" />
            <x-errors />
        </form>
    </div>
</div>
