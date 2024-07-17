<x-guest-layout>
    <div class="flex justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $note->title }}
        </h2>
    </div>
    <p class="mb-12 mt-4">{{ $note->content }}</p>
    <div class="mb-2 mt-12 flex items-center justify-end space-x-2">
        <h3 class="mr-2 text-sm">Sent from: <span class="font-semibold">{{ $note->user->name }}</span></h3>
        <livewire:like :note="$note" />
    </div>
</x-guest-layout>
