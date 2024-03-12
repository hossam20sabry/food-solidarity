<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'dist_id',
        'answered'
    ];

    public function dist()
    {
        return $this->belongsTo(Dist::class);
    }
}
