@extends('layouts.apppostlogin')

@section('content')

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Contenidos aplicables</div>
                <div class="card-body">
                    <a class="btn btn-outline-secondary" href="{{route('home')}}">Volver</a>
                </div>
            </div>
        </div>
               <div class="col-md-9">
            <div class="card">
                <div class="card-header" style="background-color: #005F82; color: white">Contenidos aprobados y propuestos</div>
                <div class="card-body">
                   <table class="table">
        <tr>
            <th>Imagen</th>
            <th>Titulo</th>
            <th>Sección</th>
            <th>Fecha de publicación</th>
            <th>Motivo</th>
            <th>Aprobado</th>
            <th width="200px">Acciones</th>
        </tr>
        @foreach($juegos as $juego)
  <tbody>
        <tr>
            <td scope="row"><img src="../storage/{{$juego->urlimage1}}" onerror="this.src='../images/default.jpg'" style="width: 120px"></td>
            <td>{{$juego->titulo_juego}}</td>
            <td>{{$juego->titulo}}</td>
            <td>{{$juego->vigencia}}</td>
            <td>{{$juego->motivo}}</td>
            <td> @if($juego->isAprobado==0) NO @else SI  @endif</td>
            <td>
                @if($juego->isAprobado==0)
                <a class="btn btn-secondary btn-sm" href="{{ route('aprobar',$juego->id)}}" >Aprobar</a>
                @else
                @if(App\Versione::where('content',$juego->id)->get()->count()>$juego->version)
                            <strong style="color: red;font-size: 11px">(Modificado)</strong><a class="btn btn-secondary btn-sm" href="{{ route('aprobar',$juego->id)}}" >Revisar</a>
                        @else
                        @endif
                @endif
                    <a class="btn btn-success btn-sm" href="{{ route('contents.show',$juego->id) }}">Ver</a>
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
