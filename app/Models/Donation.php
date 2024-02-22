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

    public function dryFood()
    {
        return $this->hasOne(DryFood::class);
    }

    public function coockedMeal()
    {
        return $this->hasOne(CoockedMeal::class);
    }
}
