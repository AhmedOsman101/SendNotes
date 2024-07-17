<?php

use App\Models\Note;
use Livewire\Volt\Component;

new class extends Component {
    public function with() {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date')->get(),
        ];
    }

    public function delete(string $noteId) {
        $note = Note::findOrFail($noteId);

        $this->authorize('delete', $note);

        $note->delete();

        $this->reset();
    }
};
?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
        <div class="text-center">
            <p class="text-xl font-bold">No notes yet</p>
            <p class="text-sm">Let's create your first note to send.</p>
            <x-button class="mt-6" href="{{ route('notes.create') }}" icon-right="plus" primary wire:navigate>Create
                note</x-button>
        </div>
        @else
        <x-button class="mb-12" href="{{ route('notes.create') }}" icon-right="plus" primary wire:navigate>Create
            note</x-button>
        <div class="mt-12 grid grid-cols-2 gap-4">
            @foreach ($notes as $note)
            <x-card wire:key='{{ $note->id }}'>
                <div class="flex justify-between">
                    <div>
                        <a class="text-xl font-bold hover:text-blue-500 hover:underline" wire:navigate href="{{ route('notes.edit', $note->id) }}">
                            {{ $note->title }}
                        </a>

                        <p class="mt-2 text-xs">{{ Str::limit($note->content, 50) }}</p>
                    </div>

                    <p class="text-xs text-gray-500">
                        {{ $note->send_date }}
                    </p>
                </div>
                <div class="mt-2 flex items-end justify-between space-x-1">
                    <p class="text-xs">Recipient: <span class="font-semibold">{{ $note->recipient }}</span></p>
                    <div>
                        <a class="inline-flex rounded-full border-2 border-gray-900 p-2.5 transition duration-500 hover:bg-primary-500 hover:text-white" href="{{ route('notes.view', $note) }}" wire:navigate>
                            <x-icon class="h-4 w-4" name="eye" />
                        </a>
                        <button class="rounded-full border-2 border-gray-900 p-2.5 transition duration-500 hover:bg-primary-500 hover:text-white" wire:click="delete('{{ $note->id }}')">
                            <x-icon class="h-4 w-4" name="trash" />
                        </button>
                    </div>
                </div>
            </x-card>
            @endforeach
        </div>
        @endif
    </div>
</div>
