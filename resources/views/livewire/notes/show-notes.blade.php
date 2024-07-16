<?php

use App\Models\Note;
use Livewire\Volt\Component;

new class extends Component {
    public function with()
    {

        return [
            'notes' => Auth::user()->notes()->orderBy('send_date')->get(),
        ];
    }
};
?>

<div>
    <div class="spacey-2">
        @foreach ($notes as $note)
            <x-card wire:key='{{ $note->id }}'>
                <div class="flex justify-between">
                    <a class="text-xl font-bold hover:text-blue-500 hover:underline" href="#">
                        {{ $note->title }}
                    </a>
                    <div class="text-xs text-gray-500">
                        {{ $note->send_date }}
                    </div>
                </div>
            </x-card>
        @endforeach
    </div>
</div>
