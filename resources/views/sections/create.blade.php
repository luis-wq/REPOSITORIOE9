@extends('layouts.apppostlogin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
               <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #005F82; color: white">Crear Sub Sección</div>
                <div class="card-body">
        @if ($message = Session::get('yaesta'))
    <div class="alert alert-danger">
        <strong>Error!</strong> Revisa todos los campos.<br><br>
            <p>{{ $message }}</p>
    </div>
@endif

<form action="{{ route('sections.store') }}" method="POST">
    @csrf
     <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Sección:</strong>
            <input type="text" class="form-control{{ $errors->has('seccion') ? ' is-invalid' : '' }}" id="seccion" name="seccion" placeholder="Sección" maxlength="255" value="{{App\Section::where('id',App\Permiso::where('id_user',Auth::user()->id)->get()->first()->id_section)->get()->first()->titulo}}" readonly="true">
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
          <input type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" id="descripcion" name="descripcion" placeholder="Descripcion" maxlength="255">
        </div>
      </div>
      </div>
    <div class="row">
        <div class="col text-center">
                <button type="submit" class="btn btn-primary">Agregar</button>

        </div>
        <div class="col text-center">
            <a class="btn btn-danger" href="{{ URL::previous() }}">Cancelar</a>
        </div>
    </div>

</form>
</div>
</div>
</div>
</div>
</div>

@endsection