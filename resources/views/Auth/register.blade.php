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
    
    <!-- <div class="container">
    <form action="{{route('register.save')}}" method="post" style="margin-left: 50px; margin-top: 20px;">
        @csrf
        <div class="row">
            <div class="col-5">
                <h2 class="text-center alert alert alert-warning">Information Enseignant</h2>
                <div class="mb-3">
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" id="exampleInputPassword1">
                    @error('nom')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Prenom</label>
                    <input type="text" name="prenom" class="form-control" id="exampleInputPassword1">
                    @error('prenom')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Matricule</label>
                    <input type="text" name="matricule" class="form-control" id="exampleInputPassword1">
                    @error('matricule')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="exampleInputPassword1">
                    @error('email')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    @error('password')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirmer le mot de passe</label>
                    <input type="confirm-password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
                    @error('password_confirmation')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </div>
      </form>
    </div> -->

    <br><br>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg p-4" style="width: 50rem;">
            <h2 class="text-center">Creation de compte enseignant</h2>

            <form action="{{ route('register.save') }}" method="post">
                @csrf

                <div class="row">
                    <!-- Nom -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control">
                        @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Prénom -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control">
                        @error('prenom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Matricule -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Matricule</label>
                        <input type="text" name="matricule" class="form-control">
                        @error('matricule')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100">Envoyer</button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('script.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
</body>
</html>