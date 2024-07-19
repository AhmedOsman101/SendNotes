<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with()
    {
        return [
            'notesCount' => Auth::user()->notes()->where('send_date', '<', now())->where('is_published', true)->count(),

            'heartsCount' => Auth::user()->notes()->sum('hearts_count'),
        ];
    }
}; ?>

<div>
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-2">
        <div class="rounded-lg bg-white p-6 shadow-lg dark:bg-gray-800">
            <div class="flex items-center">
                <div>
                    <p class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Notes Sent</p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-3xl font-bold leading-9 text-gray-900 dark:text-gray-100">{{ $notesCount }}</p>
            </div>
        </div>
        <div class="rounded-lg bg-white p-6 shadow-lg dark:bg-gray-800">
            <div class="flex items-center">
                <div>
                    <p class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Notes Loved</p>
                </div>
            </div>
            <div class="mt-6">
                <div class="flex items-center text-3xl font-bold leading-9 text-gray-900 dark:text-gray-100 gap-3">
                    <span>{{ $heartsCount }}</span>
                    <x-icon class="h-7 w-7 fill-primary-500 text-primary-500" name="heart" />
                </div>

            </div>
        </div>
    </div>
</div>
