@extends('layouts.app')

@section('title', 'liste des salles')

@section('contents')
<br><br><br><br><br>
        <h3><a href="#" class="btn btn-primary float-right" style="margin-right: 150px" data-bs-toggle="modal" data-bs-target="#createModal">Ajouter salle</a></h3>
        <br><br><br>
        <div class="table-container">
            <table class="table table-hover table-bordered table-striped" style="width: 80%;">
            <thead>
            <tr>
                <th colspan="6" class="text-center">Salles</th>
            </tr>
                <tr>
                    <th>Numéro</th>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Capacité</th>
                    <th>Localisation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if($salle->count() > 0)
            @foreach($salle as $s)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $s->code }}</td>
                    <td>{{ $s->nom }}</td>
                    <td>{{ $s->capacite }}</td>
                    <td>{{ $s->localisation }}</td>
                    <td>

                    <div class="actions">
                        <a href="#" class="bg-info text-white rounded p-1 infoBtn" title="Detail" style="margin-right: 10px;">
                        <i class='fa fa-info-circle'></i>
                        </a>
                        <a href="#" class="bg-warning text-white rounded p-1 updateBtn" title="Modifier" style="margin-right: 10px;">
                            <i class='fa fa-edit'></i>
                        </a>
                        <form action="#" method="post" onsubmit="return confirm('Delete?')" class="d-inline">
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

        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #23bbfe">
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #fff">Salles de cours</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin/salle/store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Code: </label>
                            <input type="text" name="code" class="form-control" aria-label="matricule">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Nom de la salle: </label>
                            <input type="text" name="nom" class="form-control" aria-label="matricule">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Capacité: </label>
                            <input type="text" name="capacite" class="form-control" aria-label="matricule">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Localisation: </label>
                            <select class="form-control" aria-label="Default select example" name="localisation">
                                <option selected>--Selectionner--</option>
                                    <option value="Campus site de Nasso">Campus site de Nasso</option>
                                    <option value="Campus site du secteur 22">Campus site du secteur 22</option>
                                    <option value="Campus site du CFR">Campus site du CFR</option>
                            </select>
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