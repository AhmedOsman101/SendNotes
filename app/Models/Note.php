<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model {


    use HasFactory, HasUuids;

    protected $guarded = [];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * The function `publishedNotes` retrieves published notes belonging to a
     * specific user.
     *
     * @param User user The `publishedNotes` function takes a `User` object as a
     * parameter. It filters notes based on the `user_id` and `is_published`
     * columns in the database table. The function retrieves all notes that
     * belong to the specified user and are marked as published.
     *
     * @return Collection The function `publishedNotes` is returning a
     * collection of notes that belong to the specified user and are marked as
     * published.
     */
    public function publishedNotes(User $user): Collection {
        return $this->where('user_id', $user->id)
            ->where('is_published', true)
            ->get();
    }
}
