<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'coefficient',
        'code',
        'semestre_id',
        'professeur_id',
    ];

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function professeur()
    {
        return $this->belongsTo(User::class);
    }
}
