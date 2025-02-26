@extends('layouts.user')

@section('title', 'home')

@section('contents')
<br><br>
    <p class="p" style="text-align: start;">Vous êtes concerné par les classes ci-après à l'ESI</p>
    <hr>
    
    <div class="table-container">
        <table class="table table-hover table-bordered table-striped" style="margin-left: 20px; margin-right: 20px;">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Niveau</th>
                    <th>Semestre</th>
                    <th>Nom du module</th>
                    <th>Coefficient</th>
                </tr>
            </thead>
            <tbody>
            @foreach($modules as $mod)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $mod->semestre->niveau->nom }}</td>
                    <td>{{ $mod->semestre->nom }}</td>
                    <td>{{ $mod->nom }}</td>
                    <td>{{ $mod->coefficient }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection