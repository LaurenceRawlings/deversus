<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Question;
use App\Models\User;
use App\Models\Submission;

class Game extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'code',
    ];

    protected $hidden = [
        'question_id',
        'end',
    ];

    protected $appends = [
        'status',
        'countdown',
    ];

    /**
     * Get the question that owns the Game
     *
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Quesion::class);
    }

    /**
     * The users that belong to the Game
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'submissions')->as('submission')->using(Submission::class);
    }

    /**
     * The submissions that belong to the Game
     *
     * @return HasMany
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function getStatusAttribute()
    {
        if ($this->start && $this->end) {
            return 'finished';
        }

        if ($this->start) {
            return 'started';
        }

        return 'waiting';
    }

    public function getCountdownAttribute()
    {
        if ($this->start && $this->end) {
            return 0;
        }

        if ($this->start) {
            return $this->start->diffInSeconds(now());
        }

        return 0;
    }
}
