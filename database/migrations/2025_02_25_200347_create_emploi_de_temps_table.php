<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emploi_de_temps', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->foreignId('niveau_id')->constrained();
            $table->foreignId('semestre_id')->constrained();
            $table->foreignId('salle_id')->constrained();
            $table->foreignId('module_id')->constrained();
            $table->foreignId('professeur_id')->constrained();
            $table->enum('validation_professeur', ['en attente', 'valide', 'refuse'])->default('en attente');
            $table->boolean('publie')->default(false);
            $table->boolean('envoye')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emploi_de_temps');
    }
};
