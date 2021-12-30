<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\User;
use App\Models\Game;

class Submission extends Pivot
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'game_id',
        'code',
    ];

    protected $hidden = [
        'user_id',
        'game_id',
    ];

    protected $appends = [
        'placed',
    ];

    protected $casts = [
        'time' => 'datetime',
    ];

    /**
     * Get the user that owns the Submission
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the game that owns the Submission
     *
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function getPlacedAttribute()
    {
        $place = $this->game->submissions->orderByDesc('percentage_tests_passed')->orderByAsc('time')->search($this);

        if ($place !== false) {
            return $place + 1;
        }

        return null;
    }
}
