@extends('layouts.app')

@section('title', 'creer elements')

@section('contents')
<br><br><br>
<form action="{{ route('admin/elements/store') }}" method="post" style="margin-left: 50px; margin-top: 20px;">
    @csrf
        <div class="row">
            <div class="col-5">
                <h2 class="text-center alert alert alert-warning">Ajout d'un element</h2>
                <div class="mb-3">
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">uece</label>
                    <input type="text" name="uece" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">ue</label>
                    <input type="text" name="ue" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">module</label>
                    <input type="text" name="module" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">coefficient</label>
                    <input type="number" name="coefficient" class="form-control" id="exampleInputPassword1">
                  </div>
                  <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </div>
      </form>
@endsection