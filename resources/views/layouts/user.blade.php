<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400..800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title')</title>
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
            <a href="{{ url('home') }}" class="nav-logo">
                <img src="{{ asset('images/Screenshot_20240624-233455-removebg-preview.png') }}" alt="">
            </a>

            <ul class="nav-list">

                <li class="nav-item">
                    <a href="#" class="nav-link" style="color: black;">Bienvenue, {{ Auth::user()->prenom }} {{ Auth::user()->nom }}</a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('home/emplois') }}" class="nav-link">Emploi du temps</a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/logout') }}" class="nav-link" id="presence">Se deconnecter  <i class="fa-solid fa-right-from-bracket"></i></a>
                </li>

            </ul>
        </nav>
    </header>


    <section>
        <div>@yield('contents')</div>
    </section>

    <script type="text/javascript" src="{{ asset('script.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
</body>
</html>