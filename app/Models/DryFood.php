<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryFood extends Model
{
    use HasFactory;

    public function dryFood()
    {
        return $this->belongsToMany(DryFoodType::class, 'dry_food_dry_food_type', 'dry_food_id', 'dry_food_type_id');
    }

}
