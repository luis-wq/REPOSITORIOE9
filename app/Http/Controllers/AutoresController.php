<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Section;
use App\Permiso;

class AutoresController extends Controller
{
	public function index()
    {
        $autores = User::select('users.name','users.id','users.email','users.tipo_usuario','permisos.id_section','permisos.modificacion','permisos.independencia','permisos.subseccion')->join('permisos','permisos.id_user','=','users.id')->where('users.tipo_usuario','AUTOR')->paginate(10);
        return view('autores.index',compact('autores'));
    }
	public function obtenerSecciones(Request $request)
    {
        if ($request->ajax()) { //Verificamos que es una petición Ajax
            $secciones = Section::get(); //Obtenemos todas las secciones disponibles
            foreach ($secciones as $seccion) {//Recorremos la colección para llenar un arreglo auxiliar que nos permitirá llenar el select en la vista
                $sectionArray[$seccion->id] = $seccion->titulo; //Es importante, colocar en el indice del array el valor del ID de la sección y dejar para la "vista" unicamente el titulo
            }
            return response()->json($sectionArray); //Devolvemos el arreglo en formato json para que sea más sencillo recorrerlo mediante un método each de jQuery
        }
    }
    public function actualizarPSeccion(Request $request)
    {
        if ($request->ajax()) {//Verificamos que es una petición ajax
            $actualizable = Permiso::where('id_user',$request->id)->get()->first(); //obtenemos el id del primer permiso ya que es el que debemos actualizar.
            Permiso::where('id',$actualizable->id)->update([ //Hacemos el proceso de actualizar
                'id_section' => $request->val,
            ]);
            $tituloSeccion = Section::where('id',$request->val)->get()->first()->titulo;
            return response($tituloSeccion);
        }
    }
    public function actualizarPSubSeccion(Request $request)
    {
        if ($request->ajax()) {//Verificamos que es una petición ajax
            $actualizable = Permiso::where('id_user',$request->id)->get()->first(); //obtenemos el id del 
            Permiso::where('id',$actualizable->id)->update([ //Hacemos el proceso de actualizar
                'subseccion' => $request->val,
            ]);
            $aprobacion = '';
            if ($request->val==0) {
                $aprobacion = 'No permitido';
            }else{
                $aprobacion = 'Permitido';
            }
            return response($aprobacion);
        }
    }
    public function actualizarPIndependencia(Request $request)
    {
        if ($request->ajax()) {//Verificamos que es una petición ajax
            $actualizable = Permiso::where('id_user',$request->id)->get()->first(); //obtenemos el id del 
            Permiso::where('id',$actualizable->id)->update([ //Hacemos el proceso de actualizar
                'independencia' => $request->val,
            ]);
            $aprobacion = '';
            if ($request->val==0) {
                $aprobacion = 'No permitido';
            }else{
                $aprobacion = 'Permitido';
            }
            return response($aprobacion);
        }
    }
    public function actualizarPModificacion(Request $request)
    {
        if ($request->ajax()) {//Verificamos que es una petición ajax
            Permiso::where('id_user',$request->id)->update([ //Hacemos el proceso de actualizar
                'modificacion' => $request->val,
            ]);
            $aprobacion = '';
            if ($request->val==0) {
                $aprobacion = 'No permitido';
            }else{
                $aprobacion = 'Permitido';
            }
            return response($aprobacion);
        }
    }
}
