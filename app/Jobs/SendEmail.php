<?php

namespace App\Jobs;

use App\Mail\SendNotes;
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
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Note $note;

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
        $noteUrl = env('APP_URL') . "/notes/{$this->note->id}";

        // $message = "Hello, you've received a new note. View it here: {$noteUrl}";
        try {
            Mail::to($this->note->recipient)->send(new SendNotes($this->note, $noteUrl));
        } catch (Throwable $e) {
            Log::info('Failed to send email: ' . $e->getMessage());
        }
    }
}
