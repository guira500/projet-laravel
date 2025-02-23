
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
            <a href="#" class="nav-logo">
                <img src="{{ asset('images/Screenshot_20240624-233455-removebg-preview.png') }}" alt="">
            </a>

            <ul class="nav-list">

                <li class="nav-item">
                    <a href="#" class="nav-link">Emploi du temps</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#createModal">Compte enseignant</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" id="presence">Se connecter  <i class="fa-solid fa-user"></i></a>
                </li>

            </ul>
        </nav>
    </header>

    <br><br><br><br>
    <h3 class="alert alert-info">Année académique 2024 - 2025</h3>
    <h5>Fiche semestrielle : Licence 1</h5>
    <hr>
    <div class="principal">
        <section>
            <div class="info-data">
                <div class="card i">
                    <div class="head">
                        <div>
                            <p>Semestre 1</p>
                        </div>
                    </div>
                </div>

                <div class="card u">
                    <div class="head">
                        <div>
                            <p>Semestre 2</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <h5>Fiche semestrielle : Licence 2</h5>
    <hr>
    <div class="principal">
        <section>
            <div class="info-data">
                <div class="card i">
                    <div class="head">
                        <div>
                            <p>Semestre 3</p>
                        </div>
                    </div>
                </div>

                <div class="card u">
                    <div class="head">
                        <div>
                            <p>Semestre 4</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <h5>Fiche semestrielle : Licence 3</h5>
    <hr>
    <div class="principal">
        <section>
            <div class="info-data">
                <div class="card i">
                    <div class="head">
                        <div>
                            <p>Semestre 5</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <br><br>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Entrez votre matricule</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Matricule: </label>
                            <input type="number" name="matricule" class="form-control" aria-label="matricule" placeholder="Votre numero matricule">
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>
                        <button type="submit" class="btn btn-outline-success" name="materiel_submit">
                            <i class='bx bx-save'></i> Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>


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