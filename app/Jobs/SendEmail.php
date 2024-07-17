<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Mail;
use Throwable;

class SendEmail implements ShouldQueue {
    use Queueable, Dispatchable;

    public Note $note;

    /**
     * Create a new job instance.
     */
    public function __construct(Note $note) {
        $this->note = $note;
    }

    /**
     * Execute the job.
     */
    public function handle(): void {
        $noteUrl = config('app.url') . '/notes/' . $this->note->id;

        $message = "Hello, you've received a new note. View it here: {$noteUrl}";
        try {
            Mail::raw($message, function ($message) {
                $message->to($this->note->recipient)
                    ->subject('You have a new note from ' . $this->note->user->name);
            });
        } catch (Throwable $e) {
            Log::info('Failed to send email: ' . $e->getMessage());
        }
    }
}
