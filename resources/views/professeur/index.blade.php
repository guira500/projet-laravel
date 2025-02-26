@extends('layouts.app')

@section('title', 'liste des profs')

@section('contents')
<br><br><br><br><br>
        <h3><a href="{{ route('register') }}" class="btn btn-primary float-right" style="margin-right: 150px">Ajouter element</a></h3>
        <br><br><br>
        <div class="table-container">
            <table class="table table-hover table-bordered table-striped" style="width: 80%;">
            <thead>
            <tr>
                <th colspan="6" class="text-center">Professeurs</th>
            </tr>
                <tr>
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Matricule</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if($user->count() > 0)
            @foreach($user as $us)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <th>{{ $us->nom }}</th>
                    <td>{{ $us->prenom }}</td>
                    <td>{{ $us->matricule }}</td>
                    <td>{{ $us->email }}</td>
                    <td>

                    <div class="actions">
                        <a href="" class="bg-info text-white rounded p-1 infoBtn" title="Detail" style="margin-right: 10px;">
                            <i class='fa fa-info-circle'></i>
                        </a>
                        <a href="" class="bg-warning text-white rounded p-1 updateBtn" title="Modifier" style="margin-right: 10px;">
                            <i class='fa fa-edit'></i>
                        </a>
                        <form action="" method="post" onsubmit="return confirm('Delete?')" class="d-inline">
                            <button type="submit" class="bg-danger text-white rounded p-1" title="Supprimer">
                                <i class='fa fa-trash'></i>
                            </button>
                        </form>
                    </div>
                        
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="6">Aucun élément pour le moment</td>
                </tr>
                @endif
            </tbody>
        </table>
        </div>
@endsection