<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'track_id',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function vote()
    {
        return $this->hasOne(Vote::class);
    }
}
