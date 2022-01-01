<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \Torann\GeoIP\Facades\GeoIP;
use App\Models\Provider;
use App\Models\Game;
use App\Models\Submission;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'avatar_provider_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'email',
        'avatar_provider_id',
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
        'points',
        'ip',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'avatar',
        'current_game',
        'rank',
        'region',
    ];

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn(): string
    {
        return 'User.' . $this->id;
    }

    /**
     * The games that belong to the User
     *
     * @return BelongsToMany
     */
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'submissions')->as('submission')->using(Submission::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function avatarProvider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function getAvatarAttribute()
    {
        $avatar = $this->avatarProvider()->first();

        if ($avatar) {
            return $avatar->avatar;
        }

        return null;
    }

    public function getCurrentGameAttribute()
    {
        $game = $this->games()->get()->where('status', 'started')->where('status', 'waiting')->first();

        if ($game) {
            return $game->id;
        }

        return null;
    }

    public function getRankAttribute()
    {
        $rank = User::get()->sortByDesc('points')->search($this);

        if ($rank !== false) {
            return $rank + 1;
        }

        return null;
    }

    public function getRegionAttribute()
    {
        $location = GeoIP::getLocation($this->ip);
        return [
            'iso' => strtolower($location->iso_code),
            'name' => $location->country,
        ];
    }
}
