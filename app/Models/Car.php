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
        'dlc',
        'mod',
    ];

    public function getImage($folder = 'cars')
    {
        // The car has no image
        if ($this->image == null) {
            return asset("storage/assets/$folder/default_car.png");
        }

        // The car is not modded content (so is default Assetto Corsa content)
        if ($this->mod == false) {
            // The car is not part of a DLC
            if ($this->dlc == null) {
                return asset("storage/assets/$folder/Default/$this->image");
            }
    
            // The car is part of a DLC
            if ($this->dlc != null) {
                return asset("storage/assets/$folder/$this->dlc/$this->image");
            }
        }

        // The car is modded content
        if ($this->mod == true) {
            return asset("storage/assets/$folder/$this->image");
        }
    }
}
