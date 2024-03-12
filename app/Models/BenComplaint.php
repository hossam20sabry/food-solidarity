<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'answered',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
