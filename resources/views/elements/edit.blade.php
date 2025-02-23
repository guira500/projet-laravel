@extends('layouts.app')

@section('title', 'editer un element')

@section('contents')
<br><br><br>
<form action="{{ route('admin/elements/update') }}" method="post" style="margin-left: 50px; margin-top: 20px;">
    @csrf 
    @method('PUT')
        <div class="row">
            <div class="col-5">
                <h2 class="text-center alert alert alert-warning">Editer un element</h2>
                <div class="mb-3">
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">uece</label>
                    <input type="text" name="uece" class="form-control" value="$elements->uece }}" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">ue</label>
                    <input type="text" name="ue" value="{{ $elements->ue }}" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Module</label>
                    <input type="text" name="module" value="{{ $elements->module }}" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">coefficient</label>
                    <input type="text" name="email" value="{{ $elements->coefficient }}" class="form-control" id="exampleInputPassword1">
                  </div>
                  <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </div>
      </form>
@endsection