<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthType extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasMany(User::class);
    }

}
