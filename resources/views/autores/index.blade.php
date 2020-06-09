@extends('layouts.apppostlogin')

@section('content')

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">Acciones</div>
                <div class="card-body">
                    <a class="btn btn-outline-secondary" href="{{route('home')}}">Volver</a>
                </div>
            </div>
        </div>
               <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="background-color: #005F82; color: white">Autores</div>
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
    <h4 class="alert-heading">Para modificar los permisos del usuario:</h4>
    <p>Doble click en el permiso, asigna el permiso y presiona: escape para cancelar o enter para aceptar.</p>
</div>
                   <table class="table" id="tabla_autores">
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Sección</th>
            <th>Mod/Contenido</th>
            <th>C/Subsecciones</th>
            <th>Publicar S/Autorización</th>
        </tr>
        @foreach($autores as $autor)
  <tbody>
    @if(App\Section::where('id',$autor->id_section)->get()->first()['id_section']!=NULL)
    @else
        <tr>
            <td id="id_autor">{{$autor->name}}</td>
            <td id="id_autor">{{$autor->email}}</td>
            <td>
                <div id="{{$autor->id}}" class="section">
                        @if($autor->id_section==NULL) No asignado @else{{App\Section::where('id',$autor->id_section)->get()->first()->titulo}}@endif
                    </div>
            </td>
            <td>
                <div id="{{$autor->id}}m" class="modificacion">
                        @if($autor->modificacion==0) No permitido @else Permitido @endif
                    </div>
            </td>
            <td>
                <div id="{{$autor->id}}s" class="subsection">
                        @if($autor->subseccion==0) No permitido @else Permitido @endif
                    </div>
            </td>
            <td>
                <div id="{{$autor->id}}i" class="independencia">
                        @if($autor->independencia==0) No permitido @else Permitido @endif
                </div>
            </td>
        </tr>
        @endif
  </tbody>
        @endforeach

    </table>
                </div>
            </div>
        </div><!--col-content-->
</div><!--row-->
</div><!--container-->
    {!! $autores->links() !!}
@endsection
@section('script')
<script>
    var sectionSelect = false; //Para saber si el difusor presiono doble click sobre la tabla
    var subsectionSelect = false; //Para saber si el difusor presiono doble click sobre la tabla
    var independenciaSelect = false; //Para saber si el difusor presiono doble click sobre la tabla
    var modificacionSelect = false; //Para saber si el difusor presiono doble click sobre la tabla
    var auxSection = '';
    var auxsubSection = '';
    var auxIndependencia = '';
    var auxModificacion = '';
    $(document).ready(function(){
        $(".section").dblclick(function(event){
            var id_user = this.id;
            auxSection = this.innerText;
        if(sectionSelect) return;
            $.get('/obtenerSecciones', {}, function (secciones){ //Método ajax para consultar las secciones disponibles y llenar el select
                var inputHtml = '<select id="'+id_user+'" class="form-control sseccion">'; //Creamos la variable que contendrá la vista que mandaremos al td de la tabla, y le asignamos la apertura del select
                inputHtml += '<option value="">Selecciona una opción</option>'; //Agregamos la opción sin valor para forzar a selecciona una opción
                $.each(secciones, function(index,value){//Recorremos el json obtenido de la función. Declaramos el index y el value para que sea más sencillo el llenado del select
                    inputHtml += '<option value="'+index+'">'+value+'</option>'; //Agregamos las secciones que obtengamos colocando el index en el value del elemento option y el value en el texto a mostrar
                });
                inputHtml += '</select>'; //Cerramos el select
                $('#'+id_user).text('');
                $('#'+id_user).append(inputHtml);
                sectionSelect = true; //Asignamos true a la variable aux
            });
        });
        $(".subsection").dblclick(function(event){
            var id_user = this.id;
            auxsubSection = this.innerText;
        if(subsectionSelect) return;
                var inputHtml = '<select id="'+id_user+'" class="form-control suseccion">'; //Creamos la variable que contendrá la vista que mandaremos al td de la tabla, y le asignamos la apertura del select
                inputHtml += '<option value="">Selecciona una opción</option>'; //Agregamos la opción sin valor para forzar a selecciona una opción
                inputHtml += '<option value="1">Permitir</option>'; //Agregamos las dos opciones
                inputHtml += '<option value="0">NO Permitir</option>'; //Agregamos las dos opciones
                inputHtml += '</select>'; //Cerramos el select
                $('#'+id_user).text('');
                $('#'+id_user).append(inputHtml);
                subsectionSelect = true; //Asignamos true a la variable aux
        });
        $(".independencia").dblclick(function(event){
            var id_user = this.id;
            auxIndependencia = this.innerText;
        if(independenciaSelect) return;
                var inputHtml = '<select id="'+id_user+'" class="form-control sindependencia">'; //Creamos la variable que contendrá la vista que mandaremos al td de la tabla, y le asignamos la apertura del select
                inputHtml += '<option value="">Selecciona una opción</option>'; //Agregamos la opción sin valor para forzar a selecciona una opción
                inputHtml += '<option value="1">Permitir</option>'; //Agregamos las dos opciones
                inputHtml += '<option value="0">NO Permitir</option>'; //Agregamos las dos opciones
                inputHtml += '</select>'; //Cerramos el select
                $('#'+id_user).text('');
                $('#'+id_user).append(inputHtml);
                independenciaSelect = true; //Asignamos true a la variable aux
        });
        $(".modificacion").dblclick(function(event){
            var id_user = this.id;
            auxModificacion = this.innerText;
        if(modificacionSelect) return;
                var inputHtml = '<select id="'+id_user+'" class="form-control smodificacion">'; //Creamos la variable que contendrá la vista que mandaremos al td de la tabla, y le asignamos la apertura del select
                inputHtml += '<option value="">Selecciona una opción</option>'; //Agregamos la opción sin valor para forzar a selecciona una opción
                inputHtml += '<option value="1">Permitir</option>'; //Agregamos las dos opciones
                inputHtml += '<option value="0">NO Permitir</option>'; //Agregamos las dos opciones
                inputHtml += '</select>'; //Cerramos el select
                $('#'+id_user).text('');
                $('#'+id_user).append(inputHtml);
                modificacionSelect = true; //Asignamos true a la variable aux
        });
        $('table#tabla_autores>tbody').on('keydown',".sseccion",function(event){ //Proceso de carga por ajax del permiso de asignación de sección
            console.log('presiono: ', event.which); //Para conocer que tecla presione
            event.preventDefault(); // Evitar que no se presione
            if ( event.which == 13 ) { //Presionando Enter
                var val = this.value; //obtenemos el valor seleccionado por el difusor
                var id = this.parentElement.id; //id del usuario al que se asignará el permiso
                if ($.trim(val) != '') { //Comprobamos que se seleccionó una sección
                    $.get('/actualizarPSeccion',{val:val,id:id},function(response){ //Realizamos la petición AJAX mandandole el valor seleccionado y el id del usuario
                            $('#'+id).text(response); //Mandamos el titulo de la nueva sección asignada
                    });
                }else{
                    alert('Seleccione una sección');
                    $('#'+this.parentElement.id).text(auxSection); //Mandamos el valor que tenía el TD
                }
                sectionSelect = false;
            }else  if ( event.which == 27 ) {
                $('#'+this.parentElement.id).text(auxSection);
                sectionSelect = false;
            }
        });
        $('table#tabla_autores>tbody').on('keydown',".suseccion",function(event){ //Proceso de carga por ajax del permiso de asignación de sección
            event.preventDefault(); // Evitar que no se presione
            if ( event.which == 13 ) { //Presionando Enter
                var val = this.value; //obtenemos el valor seleccionado por el difusor
                var id = this.parentElement.id; //id del usuario al que se asignará el permiso
                if ($.trim(val) != '') { //Comprobamos que se seleccionó una sección
                    $.get('/actualizarPSubSeccion',{val:val,id:id},function(response){ //Realizamos la petición AJAX mandandole el valor seleccionado y el id del usuario
                            $('#'+id).text(response); //Mandamos el titulo de la nueva sección asignada
                    });
                }else{
                    alert('Seleccione una opción');
                    $('#'+this.parentElement.id).text(auxsubSection); //Mandamos el valor que tenía el TD
                }
                subsectionSelect = false;
            }else  if ( event.which == 27 ) {
                $('#'+this.parentElement.id).text(auxsubSection);
                subsectionSelect = false;
            }
        });
        $('table#tabla_autores>tbody').on('keydown',".sindependencia",function(event){ //Proceso de carga por ajax del permiso de asignación de sección
            event.preventDefault(); // Evitar que no se presione
            if ( event.which == 13 ) { //Presionando Enter
                var val = this.value; //obtenemos el valor seleccionado por el difusor
                var id = this.parentElement.id; //id del usuario al que se asignará el permiso
                if ($.trim(val) != '') { //Comprobamos que se seleccionó una sección
                    $.get('/actualizarPIndependencia',{val:val,id:id},function(response){ //Realizamos la petición AJAX mandandole el valor seleccionado y el id del usuario
                            $('#'+id).text(response); //Mandamos el titulo de la nueva sección asignada
                    });
                }else{
                    alert('Seleccione una opción');
                    $('#'+this.parentElement.id).text(auxIndependencia); //Mandamos el valor que tenía el TD
                }
                independenciaSelect = false;
            }else  if ( event.which == 27 ) {
                $('#'+this.parentElement.id).text(auxIndependencia);
                independenciaSelect = false;
            }
        });
        $('table#tabla_autores>tbody').on('keydown',".smodificacion",function(event){ //Proceso de carga por ajax del permiso de asignación de sección
            event.preventDefault(); // Evitar que no se presione
            if ( event.which == 13 ) { //Presionando Enter
                var val = this.value; //obtenemos el valor seleccionado por el difusor
                var id = this.parentElement.id; //id del usuario al que se asignará el permiso
                if ($.trim(val) != '') { //Comprobamos que se seleccionó una sección
                    $.get('/actualizarPModificacion',{val:val,id:id},function(response){ //Realizamos la petición AJAX mandandole el valor seleccionado y el id del usuario
                            $('#'+id).text(response); //Mandamos el titulo de la nueva sección asignada
                    });
                }else{
                    alert('Seleccione una opción');
                    $('#'+this.parentElement.id).text(auxModificacion); //Mandamos el valor que tenía el TD
                }
                modificacionSelect = false;
            }else  if ( event.which == 27 ) {
                $('#'+this.parentElement.id).text(auxModificacion);
                modificacionSelect = false;
            }
        });

    });
</script>
@endsection
