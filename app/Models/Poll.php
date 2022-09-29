<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'open_at',
        'close_at',
        'race_at',
    ];

    protected $casts = [
        'race_at' => 'datetime',
        'open_at' => 'datetime',
        'close_at' => 'datetime',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function suggestions()
    {
        return $this->hasMany(Suggest::class);
    }
}
