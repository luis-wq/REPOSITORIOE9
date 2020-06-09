@extends('layouts.apppostlogin')

@section('content')
    <div class="row ml-4">
        <div class="col-3">
            <div class="card">
                <div class="card-header">Categorias</div>
                <div class="card-body">
                    <table>
                        <tr>
                            <th></th>
                        </tr>
                        @foreach(App\Section::orderBy('titulo','ASC')->get() as $seccion)
                        @if($seccion->id_section != null)
                        @else
                        <tr><td><a href="{{ route('sections.show',$seccion->id) }}" class="btn btn-outline-primary btn-sm" style="font-weight: 200;font-family: sans-serif;">{{$seccion->titulo}}</a></td></tr>
                        @endif
                            @foreach(App\Section::orderBy('titulo','ASC')->where('id_section',$seccion->id)->get() as $subseccion)
                                <tr><td><a href="{{ route('sections.show',$subseccion->id) }}" class="btn btn-outline-danger btn-sm ml-4" style="font-weight: 200;font-family: sans-serif;">{{$subseccion->titulo}}</a></td></tr>
                            @endforeach
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
        <div class="col-8 ml-0">
            <div class="" style="height: 550px;
    width: 100%;
    overflow-y: auto;">
            <div class="card">
                <div class="card-header">Últimas categorias agregadas</div>
                <div class="card-body">
                    <table>
                        <tr>
                            <th></th>
                        </tr>

                            <tr>
                                <div class="row">
                                @foreach($categorias as $categoria)<td>
                                            <div class="col">
                                                <div class="card" style="width: 14rem;">
                                    <div class="card-header" style="background-color: darkblue;color: white">{{$categoria->titulo}}</div>
                                    <div class="card-body">
                                    <p class="card-text">
                                        {{$categoria->descripcion}}
                                    </p>
                                    <a href="{{ route('sections.show',$categoria->id) }}" class="btn btn-success">Ver más</a>
                                    </div>
                                </div>
                                            </div>
                            </td>
                        @endforeach
                    </div></tr>
                    </table>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Últimos juegos agregados</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <th></th>
                        </tr>
                         <tr>
                        <div class="row">
                        @foreach($juegosNOk as $juego)
                           <td>
                                <div class="col">
                                <div class="card" style="width: 14rem;height: 370px">
                                    <img class="card-img-top" src="storage/{{$juego->urlimage1}}" alt="Card image cap" onerror="this.src='images/default.jpg'" style="height: 120px">
                                    <div class="card-body">
                                    <h5 class="card-title" style="font-family: sans-serif;font-variant: small-caps;height: 40px;white-space: pre-wrap;
     overflow: hidden;
     text-overflow: ellipsis;">{{$juego->titulo}}</h5>
                                    <p class="card-text" style="height: 70px; white-space: pre-wrap; overflow: hidden;text-overflow: ellipsis;">{{$juego->sipnosis}}
                                    </p>
                                    <p class="card-text"><small class="text-muted">Subido: {{$juego->vigencia}}</small></p>
                                    <a href="{{ route('contents.show',$juego->content) }}" class="btn btn-success">Comprar</a>
                                    </div>
                                </div>
                            </div>
                            </td>
                        @endforeach
                    </div></tr>
                    </table>
                </div>
            </div>
                <br>
        </div>
        </div>

    </div>
@endsection
