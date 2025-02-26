@extends('layouts.user')

@section('title', 'emploi du temps')

@section('contents')
<br><br>

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

    @foreach($emplois as $niveau => $emploiDuTemps)
        <div class="container mt-5">
            <h3>Emploi du temps pour le niveau {{ $niveau }}</h3>
            <table class="table table-bordered text-center">
                <thead class="bg-primary text-white">
                    <tr>
                        <th colspan="5" class="text-center">Emploi du temps de {{ $niveau }}</th>
                    </tr>
                    <tr style="background: #23BBFE">
                        <th>Jours</th>
                        @foreach($horaires as $horaire)
                            <th>{{ $horaire }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($jours as $jour)
                        <tr>
                            <td class="font-weight-bold" style="height: 100px;">{{ $jour }}</td>
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
                                    @else
                                        
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>

@endsection