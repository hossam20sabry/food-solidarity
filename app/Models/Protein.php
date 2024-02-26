<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protein extends Model
{
    use HasFactory;

    public function proteinTypes()
    {
        return $this->belongsToMany(ProteinType::class, 'protein_protein_types', 'protein_id', 'protein_type_id');
    }
    
}
