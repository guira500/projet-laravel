<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'niveau_id'
    ];

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
}
