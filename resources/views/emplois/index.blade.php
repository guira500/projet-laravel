@extends('layouts.user')

@section('title', 'emploi du temps')

@section('contents')
<br><br>
    <p class="p" style="text-align: start;">Programme de la semaine</p>
    <hr>

<div class="container mt-5">
    @php
        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $horaires = [
            '08:00:00' => '8h00-10h00',
            '10:30:00' => '10h00-12h00',
            '14:00:00' => '14h-16h',
            '16:00:00' => '16h-18h'
        ];
    @endphp

    @foreach($emplois as $niveauId => $emploiDuTemps)
        @php
            // Trouver le niveau par son ID
            $niveau = \App\Models\Niveau::find($niveauId);
        @endphp
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
                                    // Récupérer la séance pour ce professeur et ce jour
                                    $seance = $emploiDuTemps->where('date', now()->startOfWeek()->addDays(array_search($jour, $jours))->toDateString())->where('heure_debut', $heure)->first();
                                @endphp
                                <td>
                                    @if($seance)
                                        <strong>{{ $seance->module->nom }}</strong> <br>
                                        {{ $seance->professeur->prenom }} {{ $seance->professeur->nom }} <br>
                                        <small>SALLE : {{ $seance->salle->nom }}</small>
                                        <br>
                                        @if($seance->validation_professeur === 'en attente')
                                            <form action="{{ route('home/emplois/valider', ['id' => $seance->id]) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Valider</button>
                                            </form>
                                            <form action="{{ route('home/emplois/refuser', ['id' => $seance->id]) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Refuser</button>
                                            </form>
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

            <!-- Formulaire de soumission à l'administrateur -->
            @if($emploiDuTemps->every(fn($seance) => $seance->validation_professeur !== 'en attente') && !$emploiDuTemps->first()->soumis)
                <form action="{{ route('home/emplois/soumettre', ['niveau' => $niveau->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">Soumettre à l'Administrateur</button>
                </form>
            @elseif($emploiDuTemps->first()->soumis)
                <span class="badge bg-info">Emploi du temps soumis</span>
            @endif
        </div>
    @endforeach
</div>


@endsection