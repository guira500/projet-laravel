@extends('layouts.app')

@section('title', 'profile settings')

@section('contents')
<br><br><br>
<form action="" method="post" style="margin-left: 50px; margin-top: 20px;">
        <div class="row">
            <div class="col-5">
                <h2 class="text-center alert alert alert-warning">Information Enseignant</h2>
                <div class="mb-3">
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="{{ auth()->user()->nom }}" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Prenom</label>
                    <input type="text" name="prenom" value="{{ auth()->user()->prenom }}" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Matricule</label>
                    <input type="text" name="matricule" value="{{ auth()->user()->matricule }}" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="text" name="email" value="{{ auth()->user()->email }}" class="form-control" id="exampleInputPassword1">
                  </div>
            </div>
        </div>
      </form>
@endsection