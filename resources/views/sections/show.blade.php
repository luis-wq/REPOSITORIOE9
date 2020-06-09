@extends('layouts.apppostlogin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Subcategorias</div>
                <div class="card-body">
                    @foreach($subsecciones as $subseccion)
                    <tr><td><a href="{{ route('sections.show',$subseccion->id) }}" class="btn btn-outline-primary btn-sm" style="font-weight: 200;font-family: sans-serif;">{{$subseccion->titulo}}</a></td></tr>
                    @endforeach
                    @if(@Auth::user()->subscripcion==1)
                    @else
                        @if(@App\Suscripcion::where('id_user',Auth::user()->id)->where('id_section',$id_section)->get()->first()->id==NULL)
                            <br><br>
                            <a class="btn btn-outline-primary" href="{{route('subscribirte',$id_section)}}">Subscribirme</a>
                        @else
                            <br><br>
                            <a class="btn btn-outline-success" href="#">Subscrito</a>

                        @endif
                    @endif
                    <br><br>
                    <a class="btn btn-outline-secondary" href="{{route('home')}}">Volver</a>
                </div>
            </div>
        </div>
               <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #005F82; color: white">Juegos de {{@App\Section::where('id',$id_section)->get()->first()->titulo}}</div>
                <div class="card-body">
                    @if ($message = Session::get('Correcto'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card">

    <table class="table">
        <tr>
            <th>Imagen</th>
            <th>Titulo</th>
            <th>Fecha de publicación</th>
            <th width="250px">Acciones</th>
        </tr>
  <tbody>
        @foreach($juegos as $juego)
        @if($juego->isAprobado==0)
        @else
        <tr>
            @if (@$juego->vigencia < now('GMT-5'))
             <td scope="row"><img src="../storage/{{$juego->urlimage1}}" onerror="this.src='../images/default.jpg'" style="width: 120px"></td>
                <td>{{$juego->titulo_juego}}</td>
                <td>{{$juego->vigencia}}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('contents.show',$juego->id) }}" >Ver</a>
                </td>
            @else
                @if(App\Versione::where('content',$juego->id)->get()->count()==1)
                @else
                    @if(@App\Versione::where('content',$juego->id)->where('isAprobado',1)->where('version','!=',$juego->version)->orderBy('vigencia','ASC')->get()->last()->vigencia < now('GMT-5'))
                     <td scope="row"><img src="../storage/{{App\Versione::where('content',$juego->id)->where('isAprobado',1)->where('version','!=',$juego->version)->orderBy('vigencia','ASC')->get()->last()['urlimage1']}}" onerror="this.src='../images/default.jpg'" style="width: 120px"></td>
                        <td>{{App\Versione::where('content',$juego->id)->where('isAprobado',1)->where('version','!=',$juego->version)->orderBy('vigencia','ASC')->get()->last()['titulo']}}</td>
                        <td>{{App\Versione::where('content',$juego->id)->where('isAprobado',1)->where('version','!=',$juego->version)->orderBy('vigencia','ASC')->get()->last()['vigencia']}}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('contents.show',$juego->id) }}">Ver</a>
                        </td>
                    @else
                    @endif
                @endif
            @endif
        </tr>
  @endif
@endforeach
  </tbody>

    </table>
</div>



@endsection