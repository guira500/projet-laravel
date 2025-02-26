@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')
    <div>
        <h1 class="font-bold text-2xl ml-3">Bureau</h1>
    </div>

    <br><br><br>
    <div class="principal">
        <section>
            <div class="info-data">
                <div class="card i">
                    <div class="head">
                        <div>
                            <h2>{{ $salle->count() }}</h2>
                            <p>Salles</p>
                        </div>
                        <i class='fa fa-school icon'></i>
                    </div>
                </div>

                <div class="card u">
                    <div class="head">
                        <div>
                            <h2>{{ $niveau->count() }}</h2>
                            <p>Niveau</p>
                        </div>
                        <i class="fa-solid fa-building-columns icon"></i>
                    </div>
                </div>

                <div class="card i">
                    <div class="head">
                        <div>
                            <h2>{{ $us->count() }}</h2>
                            <p>Professeurs</p>
                        </div>
                        <i class="fa-solid fa-users-between-lines icon "></i>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <br><br><br>

    <div class="table-container">
        <table class="table table-hover table-bordered table-striped" style="width: 80%;">
            <thead>
                <tr>
                    <th colspan="5" class="text-center">Fiche semestrielle</th>
                </tr>
                <tr>
                    <th>Niveau</th>
                    <th>Semestre</th>
                    <th>Nom</th>
                    <th>Coefficient</th>
                    <th>Enseignant</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $niveau => $moduleGroup)
                    <tr>
                        <td colspan="5" class="text-center font-weight-bold">{{ "Niveau " . $niveau }}</td>
                    </tr>

                    @foreach($moduleGroup as $module)
                        @php
                            $semestre = $module->semestre;  // Récupérer le semestre de chaque module
                        @endphp

                        <tr>
                            <td>{{ $semestre->niveau->nom }}</td>
                            <td>{{ $semestre->nom }}</td>
                            <td>{{ $module->nom }}</td>
                            <td>{{ $module->coefficient }}</td>
                            <td>{{ $module->professeur->prenom . ' ' . $module->professeur->nom ?? 'Non assigné' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

@endsection