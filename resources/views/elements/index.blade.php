@extends('layouts.app')

@section('title', 'liste des modules')

@section('contents')
<br><br><br><br>

    <p class="p" style="text-align: start;">Vous êtes concerné par les classes ci-après à l'ESI</p>
    <a href="{{ route('admin/elements/create') }}" class="btn btn-primary float-right">Ajouter element</a>
    <hr>
    
    <div class="table-container">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Niveau</th>
                    <th>Semestre</th>
                    <th>UE</th>
                    <th>UECE</th>
                    <th>Coefficient</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($elements->count() > 0)
                @foreach($elements as $rs)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{$rs->uece}}</td>
                    <td>{{ $rs->ue }}</td>
                    <td>{{$rs->module}}</td>
                    <td>{{$rs->coefficient}}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin/elements/show', $rs->id) }}" class="bg-info text-white rounded p-1 infoBtn" title="Detail"><i class='fa fa-info-circle'></i></a>
                            <a href="{{ route('admin/elements/edit', $rs->id) }}" class="bg-warning text-white rounded p-1 updateBtn" title="Modifier"><i class='fa fa-edit'></i></a>
                            <form action="{{ route('admin/elements/destroy', $rs->id) }}" class="bg-danger text-white rounded" method="post" onsubmit="return confirm('Delete?')" class="float">
                                @csrf
                                @method('delete')
                                <i class='fa fa-trash'></i>
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