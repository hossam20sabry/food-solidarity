<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    public function dist()
    {
        return $this->belongsTo(Dist::class);
    }

    public function donationType()
    {
        return $this->belongsTo(DonationType::class);
    }

    public function dryFoods()
    {
        return $this->hasOne(DryFood::class);
    }

    public function coockedMeals()
    {
        return $this->hasOne(CoockedMeal::class);
    }

    public function need()
    {
        return $this->hasOne(Need::class);
    }
}
