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

    public function foods()
    {
        return $this->hasMany(Canned::class);
    }

    public function cookedMeals()
    {
        return $this->hasMany(CookedMeal::class);
    }

        public function need()
    {
        return $this->hasOne(Need::class);
    }

}
