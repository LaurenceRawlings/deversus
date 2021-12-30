<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Test;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'content',
    ];

    /**
     * Get all of the tests for the Question
     *
     * @return HasMany
     */
    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }
}
