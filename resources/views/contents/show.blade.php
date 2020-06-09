@extends('layouts.apppostlogin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{$juego->titulo_juego}}</div>
                <div class="card-body">
                    <div id="galeriaNuevo" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img id="img1" class="d-block w-100" src="../storage/{{$juego->urlimage1}}" onerror="this.src='../images/default.jpg'" style="width: 100%; height: 300px" alt="First slide">
    </div>
    <div class="carousel-item">
      <img id="img2" class="d-block w-100" src="../storage/{{$juego->urlimage2}}" onerror="this.src='../images/default.jpg'" style="width: 100%; height: 300px" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img id="img3" class="d-block w-100" src="../storage/{{$juego->urlimage3}}" onerror="this.src='../images/default.jpg'" style="width: 100%; height: 300px" alt="Second slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#galeriaNuevo" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#galeriaNuevo" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                    <br><br>
                    <a href="{{$juego->urlcompra}}" class="btn btn-success btn-block" >Comprar</a>
                    <br>
                    @if(@Auth::user()->tipo_usuario == 'AUTOR' && @Auth::user()->id_section == $juego->section)
                    <strong>Selecciona una versión:</strong>
          <select id="version" name="version" class="form-control{{ $errors->has('version') ? ' is-invalid' : '' }}">
                <option value="">Selecciona una opción</option>
                @foreach(App\Versione::where('content',$juego->id)->get() as $version)
                  <option value="{{$version->version}}">{{$version->version}} ({{$version->motivo}})</option>
                @endforeach
            </select>
                    <br>
                    @else
                    @endif
                    <a class="btn btn-secondary btn-block" href="{{URL::previous()}}">Volver</a>
                </div>
            </div>
        </div>
               <div class="col-md-7">
            <div class="card">
                <div class="card-header" style="background-color: #005F82; color: white">Sipnosis</div>
                <div class="card-body">
                    <p class="card-text" style="color: black; text-align: justify; font-family: cursive; font-style: oblique; font-size: 1rem">{{$juego->sipnosis}} </p>
                    <p class="card-text"><small class="text-muted" id="desc_aprobado">Creado por Enrique y @if($juego->isAprobado==0) NO aprobado ({{$juego->motivo}}) @else aprobado @endif {{$juego->vigencia}} </small><br><small class="text-muted" id="edicion">Última edición: {{$juego->updated_at}}</small><br><small class="text-muted" id="vers">Versión {{@$juego->version}}</small></p>
                </div>
            </div>
        </div>
                    @if ($message = Session::get('Correcto'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
</div>



@endsection
@section('script')
<script>
  $(document).ready(function(){
    $('#version').on('change',function(){
      var version = $(this).val();
      var juego = {{$juego->id}};
      if ($.trim(version) != '') { //para saber si se selecciono una versión
                    $.get('/obtenerVersion', {version: version,juego: juego}, function (juego){
                        $('#descripcion').text(juego['sipnosis']);
                        if (juego['isAprobado']==0) {
                            $('#desc_aprobado').text('Creado por Enrique y NO aprobado ('+juego['motivo']+')');
                        }else{
                            $('#desc_aprobado').text('Creado por Enrique y aprobado '+juego['vigencia']);
                        }
                        var date = new Date(juego['updated_at']);
                        $('#edicion').text('Última edición: '+date.toISOString().replace('T',' '));
                        $('#vers').text('Versión: '+juego['version']);
                        $('#img1').attr("src", "../storage/"+juego['urlimage1']);
                        $('#img2').attr("src", "../storage/"+juego['urlimage2']);
                        $('#img3').attr("src", "../storage/"+juego['urlimage3']);
                    });
                }
    });

  });
</script>
@endsection