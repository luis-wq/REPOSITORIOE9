@extends('layouts.apppostlogin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Imagenes</div>
                <div class="card-body">
                  <div id="galeriaNuevo" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img id="img1" class="d-block w-100" src="#" onerror="this.src='public/images/default.jpg'" style="width: 100%; height: 300px" alt="First slide">
    </div>
    <div class="carousel-item">
      <img id="img2" class="d-block w-100" src="#" onerror="this.src='public/images/default.jpg'" style="width: 100%; height: 300px" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img id="img3" class="d-block w-100" src="#" onerror="this.src='public/images/default.jpg'" style="width: 100%; height: 300px" alt="Second slide">
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
<br>
                    <a class="btn btn-outline-secondary btn-block" href="{{route('home')}}">Volver</a>
                </div>
            </div>
        </div>
               <div class="col-md-7">
            <div class="card">
                <div class="card-header">Agregar juego</div>
                <div class="card-body">
        @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error!</strong> Revisa todos los campos.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('contents.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Sección:</strong>
            <input type="text" class="form-control{{ $errors->has('seccion') ? ' is-invalid' : '' }}" id="seccion" name="seccion" placeholder="No tienes una sección asignada" maxlength="6" value="{{@App\Section::where('id',Auth::user()->id_section)->get()->first()->titulo}}" readonly="true">
            </div>
        </div>

<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Titulo:</strong>
          <input type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" id="titulo" name="titulo" placeholder="Titulo" maxlength="255">

        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <strong>Descripción:</strong>
                <textarea class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" id="descripcion" name="descripcion" rows="10" maxlength="2000">Introduce una descripción para el juego</textarea>
                @if($errors->has('descripcion'))
                   <small class="form-text invalid-feedback">El campo descripcion es obligatorio</small>
                @endif
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Agregar imagen 1</strong>
          <br>
            <input type="file" name="imagen1" id="cargarImagen1">
        </div>
      </div>
        <br>
         <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Agregar imagen 2</strong>
          <br>
            <input type="file" name="imagen2" id="cargarImagen2">
        </div>
      </div>
        <br>
         <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Agregar imagen 3</strong>
          <br>
            <input type="file" name="imagen3" id="cargarImagen3">
        </div>
        <br>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Url para comprar el juego:</strong>
          <input type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" id="url" name="url" placeholder="Http://www.example.com/juego" maxlength="255">

        </div>
    <div class="row">
        <div class="col text-center">
           @if(App\User::select('permisos.tipo_usuario')->join('permisos','permisos.id','=','users.tipo_usuario')->where('users.id',Auth::user()->id)->get()->first()->tipo_usuario != 'AUTOR')
           @else
                <button type="submit" class="btn btn-primary">Agregar</button>
          @endif
        </div>
        <div class="col text-center">
            <a class="btn btn-danger" href="{{ route('contents.index') }}">Cancelar</a>
        </div>
    </div>

</form>
</div>
</div>
</div>
</div>

@endsection
@section('script')
<script>
  $(document).ready(function(){
              $("#cargarImagen1").on('change',function(){
                  if (this.files && this.files[0]) {
                  var reader = new FileReader();

                  reader.onload = function(e) {
                    $('#img1').attr('src', e.target.result);
                  }

                  reader.readAsDataURL(this.files[0]);
                }
              });
              $("#cargarImagen2").on('change',function(){
                  if (this.files && this.files[0]) {
                  var reader = new FileReader();

                  reader.onload = function(e) {
                    $('#img2').attr('src', e.target.result);
                  }

                  reader.readAsDataURL(this.files[0]);
                }
              });
              $("#cargarImagen3").on('change',function(){
                  if (this.files && this.files[0]) {
                  var reader = new FileReader();

                  reader.onload = function(e) {
                    $('#img3').attr('src', e.target.result);
                  }

                  reader.readAsDataURL(this.files[0]);
                }
              });
        });
</script>
@endsection