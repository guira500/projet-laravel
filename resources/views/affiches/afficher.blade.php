<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400..800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style1.css') }}">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="{{ route('login') }}" class="nav-logo">
                <img src="{{ asset('images/Screenshot_20240624-233455-removebg-preview.png') }}" alt="">
            </a>

            <ul class="nav-list">

                <li class="nav-item">
                    <a href="{{ route('afficher') }}" class="nav-link">Emploi du temps</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" id="presence" style="background: #27BBFE; border-radius: 5px; color: white; text-align: center;">Se connecter  <i class="fa-solid fa-user"></i></a>
                </li>

            </ul>
        </nav>
    </header>

    <br>
    <p class="p" style="text-align: start;">Le programme de la semaine</p>
    <hr>

    
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

    @foreach($emploisPublies as $niveau => $seancesPubliees)
    @if($seancesPubliees->isNotEmpty())
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th colspan="5" class="text-center bg-info text-white">
                            Emploi du temps publié de {{ $niveau }} (Semaine du {{ now()->startOfWeek()->format('d/m/Y') }} au {{ now()->endOfWeek()->format('d/m/Y') }})
                        </th>
                    </tr>
                    <tr>
                        <th class="bg-info text-white">Jours</th>
                        @foreach($horaires as $horaire)
                            <th class="bg-info text-white">{{ $horaire }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($jours as $jour)
                        <tr>
                            <td class="bg-info text-white font-weight-bold">
                                {{ $jour }} <br>
                                <small>{{ now()->startOfWeek()->addDays(array_search($jour, $jours))->format('d/m/Y') }}</small>
                            </td>
                            @foreach(array_keys($horaires) as $heure)
                                @php
                                    $seance = $seancesPubliees->where('date', now()->startOfWeek()->addDays(array_search($jour, $jours))->toDateString())
                                                             ->where('heure_debut', $heure)
                                                             ->first();
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
    @endif
@endforeach



    <div class="login" id="login">
    <form action="{{ route('login.action')}}" method="post" class="login-form">
        @csrf
        <h2 class="login-title">Connexion</h2>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <span class="text-red-600">{{ $error }}</span><br>
                @endforeach
            </div>
        @endif

        <div class="login-group">
            <div>
                <label for="matricule" class="login-label">Matricule</label>
                <input type="text" name="matricule" value="{{ old('matricule') }}" 
                       placeholder="Entrez le numéro matricule" class="login-input" id="matricule">
                @error('matricule')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="login-label">Mot de passe</label>
                <input type="password" name="password" placeholder="Mot de passe" class="login-input" id="pwd">
                @error('password')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="login-button">Se connecter</button>
        </div>
    </form>
    <i class="fa-solid fa-xmark login-close" id="login-close"></i>
</div>



    <script type="text/javascript" src="{{ asset('script.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
</body>
</html>