<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiDeTemps extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'heure_debut',
        'heure_fin',
        'niveau_id',
        'semestre_id',
        'salle_id',
        'module_id',
        'professeur_id',
        'validation_professeur',
        'publie',
        'envoye'
    ];

    public function professeur()
    {
        return $this->belongsTo(User::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function valider()
    {
        if (auth()->user()->id === $this->professeur_id) {
            $this->validation_professeur = 'valide';
            $this->save();
        }
    }

    public function invalider()
    {
        if (auth()->user()->id === $this->professeur_id) {
            $this->validation_professeur = 'refuse';
            $this->save();
        }
    }

}
