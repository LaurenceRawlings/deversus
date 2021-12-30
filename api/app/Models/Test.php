<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'stdin',
        'expexted',
        'visible',
    ];

    protected $hidden = [
        'question_id',
        'expexted',
        'visible',
    ];
}
