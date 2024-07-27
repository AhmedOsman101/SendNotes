<?php

namespace App\Console\Commands;

use App\Jobs\SendEmail;
use App\Models\Note;
use Illuminate\Console\Command;
use Throwable;

class SendScheduledNotes extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle() {
        $now = now()->toDateString();

        $notes = Note::where('is_published', true)
            ->where('send_date', $now)
            ->get();

        $notes->each(function ($note) {
            try {
                SendEmail::dispatch($note);
            } catch (Throwable $e) {
                $this->error($e->getMessage());
            }
        });


        $this->info($notes->count() . ' notes sent');
    }
}
