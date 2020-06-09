@extends('layouts.apppostlogin')

@section('content')

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Contenidos aplicables</div>
                <div class="card-body">
                    @if(App\Permiso::where('id_user',Auth::user()->id)->get()->first()['subseccion']==1)
                        <a href="{{route('sections.create')}}" class="btn btn-outline-primary">Agregar sub-sección</a>
                    <br><br>
                    @else
                    @endif
                    <a href="{{route('contents.create')}}" class="btn btn-outline-primary">Agregar contenido</a>
                    <br><br>
                    <a class="btn btn-outline-secondary" href="{{route('home')}}">Volver</a>
                </div>
            </div>
        </div>
               <div class="col-md-9">
            <div class="card">
                <div class="card-header" style="background-color: #005F82; color: white">Contenidos</div>
                <div class="card-body">
                   <table class="table">
        <tr>
            <th>Imagen</th>
            <th>Titulo</th>
            <th>Sección</th>
            <th>Fecha de publicación</th>
            <th>Motivo</th>
            <th>Aprobado</th>
            <th width="180px">Acciones</th>
        </tr>
        @foreach($juegos as $juego)
  <tbody>
        <tr>
            <td scope="row"><img src="../storage/{{$juego->urlimage1}}" onerror="this.src='../images/default.jpg'" style="width: 120px"></td>
            <td>{{$juego->titulo_juego}}</td>
            <td>{{$juego->titulo}}</td>
            <td>{{$juego->vigencia}}</td>
            <td>{{App\Versione::where('content',$juego->id)->get()->last()['motivo']}}</td>
            <td> @if($juego->isAprobado==0) NO @else SI @endif</td>
            <td>
                    <a class="btn btn-success" href="{{ route('contents.show',$juego->id) }}" >Ver</a>
                    @if(App\Permiso::where('id_user',Auth::user()->id)->get()->first()['modificacion']==1)
                        <a class="btn btn-primary" href="{{ route('contents.edit',$juego->id) }}" >Editar</a>
                    @else
                    @endif
            </td>
        </tr>
  </tbody>
        @endforeach

    </table>
                </div>
            </div>
        </div><!--col-content-->
</div><!--row-->
</div><!--container-->
    {!! $juegos->links() !!}
@endsection
