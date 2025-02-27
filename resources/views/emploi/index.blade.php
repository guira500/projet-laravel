@extends('layouts.app')

@section('title', 'emploi du temps')

@section('contents')
<br><br><br><br><br>
        <h3><a href="#" class="btn btn-primary float-right" style="margin-right: 80px" data-bs-toggle="modal" data-bs-target="#createModal">Ajouter une activité</a></h3>
        <br>

<div class="container mt-5">
    @php
        $nom_niveaux = ['Licence 1', 'Licence 2', 'Licence 3']; 
        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']; 
        $horaires = [
            '08:00:00' => '8h00-10h00', 
            '10:30:00' => '10h00-12h00', 
            '14:00:00' => '14h-16h', 
            '16:00:00' => '16h-18h'
        ];
    @endphp

    @foreach($niveaux as $niveau)
        @if(isset($emplois[$niveau->nom])) 
            <div class="container mt-5">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th colspan="5" class="text-center">Emploi du temps de {{ $niveau->nom }} du {{ now()->startOfWeek()->format('d/m/Y') }} au {{ now()->endOfWeek()->format('d/m/Y') }}</th>
                        </tr>
                        <tr>
                            <th class="bg-primary text-white">Jours</th>
                            @foreach($horaires as $horaire)
                                <th class="bg-primary text-white">{{ $horaire }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jours as $jour)
                            <tr>
                            <td class="bg-primary text-white font-weight-bold" style="height: 100px;">
                                {{ $jour }} <br>
                                <small>{{ now()->startOfWeek()->addDays(array_search($jour, $jours))->format('d/m/Y') }}</small>
                            </td>
                                @foreach(array_keys($horaires) as $heure)
                                    @php
                                        $seance = $emplois[$niveau->nom]->where('date', now()->startOfWeek()->addDays(array_search($jour, $jours))->toDateString())->where('heure_debut', $heure)->first();
                                    @endphp
                                    <td>
                                        @if($seance)
                                            <strong>{{ $seance->module->nom }}</strong> <br>
                                             {{ $seance->professeur->prenom }} {{ $seance->professeur->nom }} <br>
                                            <small>SALLE : {{ $seance->salle->nom }}</small>
                                            <br>
                                            @if($seance->validation_professeur === 'en attente')
                                                <span class="badge bg-warning">En attente de validation</span>
                                            @elseif($seance->validation_professeur === 'valide')
                                                <span class="badge bg-success">Validé</span>
                                            @elseif($seance->validation_professeur === 'refuse')
                                                <span class="badge bg-danger">Refusé</span>
                                            @endif
                                        @else
                                            
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex">
                <form action="{{ route('admin/emploi/envoyer', ['niveau' => $niveau->id]) }}" method="POST" class="mr-2 d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-success">Envoyer l'emploi du temps aux professeurs</button>
                </form>

                <form action="{{ route('admin/emploi/publier', ['niveau' => $niveau->id]) }}" method="POST" class="mr-2 d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-primary mt-3">Publier l'emploi du temps</button>
                </form>

                {{-- Vérifier si des emplois publiés existent pour ce niveau --}}
                @php
                    $emploisPubliés = DB::table('emploi_de_temps')
                        ->where('niveau_id', $niveau->id)
                        ->where('publié', true)
                        ->count();
                @endphp

                @if($emploisPubliés > 0)
                    <form action="{{ route('admin/emploi/retirer', ['niveau' => $niveau->id]) }}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-danger mt-3">Retirer la publication</button>
                    </form>
                @endif

                </div>
            </div>
        @endif
    @endforeach
</div>


        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #23bbfe">
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #fff">Ajouter une activité</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin/emploi/store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Niveau: </label>
                            <select name="niveau_id" id="niveau_id" class="form-control" required>
                                <option value="">Sélectionnez un niveau</option>
                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}">{{ $niveau->nom }}</option> 
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Semestre: </label>
                            <select name="semestre_id" id="semestre_id" class="form-control" required>
                                <option value="">Sélectionnez un semestre</option>
                                @foreach($semestres as $semestre)
                                    <option value="{{ $semestre->id }}">{{ $semestre->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Module: </label>
                            <select name="module_id" id="module_id" class="form-control" required>
                                <option value="">Sélectionnez un module</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="professeur_id">Professeur :</label>
                            <select name="professeur_id" id="professeur_id" class="form-control" required>
                                <option value="">Sélectionnez un professeur</option>
                                @foreach($professeurs as $prof)
                                    <option value="{{ $prof->id }}">{{ $prof->prenom }} {{ $prof->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="salle_id">Salle :</label>
                            <select name="salle_id" id="salle_id" class="form-control" required>
                                <option value="">Sélectionnez une salle</option>
                                    @foreach($salles as $salle)
                                        <option value="{{ $salle->id }}">{{ $salle->nom }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="date">Date :</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="heure_debut">Heure de début :</label>
                            <input type="time" name="heure_debut" id="heure_debut" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="heure_fin">Heure de fin :</label>
                            <input type="time" name="heure_fin" id="heure_fin" class="form-control" required>
                        </div>
                    </div>


                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>
                        <button type="submit" class="btn btn-outline-primary">
                            <i class='bx bx-save'></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

@endsection