<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    use HasFactory;

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
