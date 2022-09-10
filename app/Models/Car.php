<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'source',
    ];

    public function getImage()
    {
        return $this->image != null ? asset('storage/images/' . $this->image) : asset('storage/images/default_track.png');
    }
}
