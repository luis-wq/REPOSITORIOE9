@extends('layouts.apppostlogin')

@section('content')

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Acciones</div>
                <div class="card-body">
                    <a class="btn btn-outline-secondary" href="{{route('home')}}">Volver</a>
                </div>
            </div>
        </div>
               <div class="col-md-9">
            <div class="card">
                <div class="card-header" style="background-color: #005F82; color: white">Usuarios subscritos</div>
                <div class="card-body">
                   <table class="table">
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Sección</th>
            <th>Fecha de Subscripción</th>
        </tr>
        @foreach($subscripciones as $subscriptor)
  <tbody>
        <tr>
            <td>{{$subscriptor->name}}</td>
            <td>{{$subscriptor->email}}</td>
            <td>@if($subscriptor->id_section == NULL) Subscrito a todo el sitio @else{{App\Section::where('id',$subscriptor->id_section)->get()->first()->titulo}} @endif</td>
            <td>{{$subscriptor->created_at}}</td>
        </tr>
  </tbody>
        @endforeach

    </table>
                </div>
            </div>
        </div><!--col-content-->
</div><!--row-->
</div><!--container-->
    {!! $subscripciones->links() !!}
@endsection
