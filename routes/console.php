<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:send-notes')
    ->timezone(env('APP_TIMEZONE'))
    ->dailyAt('18:00');
