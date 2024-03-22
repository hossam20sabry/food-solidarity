<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProteinType extends Model
{
    use HasFactory;

    public function proteins()
    {
        return $this->belongsToMany(Protein::class, 'protein_protein_types', 'protein_type_id', 'protein_id');
    }
}
