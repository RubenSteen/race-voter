<?php

namespace App\Models;

use App\Jobs\DiscordGetPrivateChannelID;
use App\Jobs\DiscordSendMessageToChannel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->last_activity = \Carbon\Carbon::now();
        });

        static::created(function ($user) {
            DiscordSendMessageToChannel::dispatch(config('discord.admin_log_channel_id'), [
                'content' => "New user has been created: $user->nickname",
            ])->onQueue('discord_api');

            DiscordGetPrivateChannelID::dispatch($user)->onQueue('discord_api');
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'nickname',
        'avatar',
        'banned',
        'admin',
        'last_activity',
        'token',
        'token_expires_at',
        'refresh_token',
        'discord_private_channel_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'token',
        'token_expires_at',
        'refresh_token',
        'discord_private_channel_id',
    ];

    protected $casts = [
        'token_expires_at' => 'datetime',
        'banned' => 'datetime',
        'admin' => 'datetime',
        'last_activity' => 'datetime',
    ];

    public function getAvatar()
    {
        return $this->avatar != null ? $this->avatar : asset('storage/avatars/default.png');
    }

    public function isBanned()
    {
        return $this->banned != null ? true : false;
    }

    public function isSuperAdmin()
    {
        return $this->super_admin != null ? true : false;
    }

    public function isAdmin()
    {
        return $this->admin != null ? true : false;
    }

    public function setPrivateChannelID($value)
    {
        $this->discord_private_channel_id = $value;

        $this->save();
    }

    // Handles making the user admin and remove admin status
    public function admin()
    {
        $this->admin = $this->isAdmin() ? null : \Carbon\Carbon::now();

        $this->save();
    }

    // Handles banning and unbanning the user
    public function ban()
    {
        $this->banned = $this->isBanned() ? null : \Carbon\Carbon::now();

        $this->save();
    }

    public function update_last_activity()
    {
        $this->last_activity = \Carbon\Carbon::now();

        $this->save();
    }

    public function suggest()
    {
        return $this->hasOne(Suggest::class);
    }
}
