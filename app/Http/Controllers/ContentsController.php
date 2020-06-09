<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Versione;
use App\Permiso;
use Auth;
class ContentsController extends Controller
{
    public function indexDifusor()
    {
        $juegos = Content::select('sections.titulo','contents.motivo','contents.id','contents.titulo as titulo_juego','contents.sipnosis','contents.urlimage1','contents.urlimage2','contents.version','contents.urlimage3','contents.vigencia','contents.isAprobado','contents.created_at','contents.updated_at')->join('sections','sections.id','=','contents.section')->paginate(10);
        return view('contents.index_difusor',compact('juegos'));
    }
    public function index()
    {
        $secciones = Permiso::where('id_user',Auth::user()->id)->get();
        foreach ($secciones as $seccion) {
            $seccionesArray[$seccion->id_section] =$seccion->id_section;
        }
        $juegos = Content::select('sections.titulo','contents.motivo','contents.id','contents.titulo as titulo_juego','contents.sipnosis','contents.urlimage1','contents.urlimage2','contents.version','contents.urlimage3','contents.vigencia','contents.isAprobado','contents.created_at','contents.updated_at')->join('sections','sections.id','=','contents.section')->whereIn('sections.id',$seccionesArray)->paginate(10);
        return view('contents.index',compact('juegos'));
    }
    public function destroy($content)
    {
    	Content::where('id',$content)->delete();
        return back()->with('Correcto','Registro Eliminado correctamente');
    }
    public function show($id)
    {
        $juego = Content::select('sections.titulo','contents.motivo','contents.id','contents.titulo as titulo_juego','contents.sipnosis','contents.urlimage1','contents.urlimage2','contents.version','contents.urlimage3','contents.vigencia','contents.isAprobado','contents.urlcompra','contents.created_at','contents.updated_at','contents.section')->join('sections','sections.id','=','contents.section')->where('contents.id',$id)->get()->first();
        $isActual = Content::where('id',$id)->get()->first();
        if($isActual->vigencia == NULL){
        
        }else{
            if($isActual->vigencia < \Carbon\Carbon::now('GMT-5')){//aqui sabemos si la version en vigencia esta activa por la fecha
                    
            }else{
                if(Versione::where('content',$id)->get()->count()==1){
                    
                }else{
                    $juego = Versione::where('content',$id)->where('isAprobado',1)->where('version','!=',$isActual->version)->orderBy('vigencia','ASC')->get()->last();
                }
                
            }
    }
        
        return view('contents.show',compact('juego'));
    }
    public function edit($id)
    {
        $juego = Content::select('sections.titulo','contents.motivo','contents.id','contents.titulo as titulo_juego','contents.sipnosis','contents.urlimage1','contents.urlimage2','contents.version','contents.urlimage3','contents.vigencia','contents.isAprobado','contents.created_at','contents.updated_at','contents.urlcompra')->join('sections','sections.id','=','contents.section')->where('contents.id',$id)->get()->first();
        return view('contents.edit',compact('juego'));
    }
    public function aprobar($id)
    {
        $juego = Content::select('sections.titulo','contents.motivo','contents.id','contents.titulo as titulo_juego','contents.sipnosis','contents.urlimage1','contents.urlimage2','contents.version','contents.urlimage3','contents.vigencia','contents.isAprobado','contents.created_at','contents.updated_at')->join('sections','sections.id','=','contents.section')->where('contents.id',$id)->get()->first();
        return view('contents.aprobar',compact('juego'));
    }
    public function actualizaAprobado(Request $request, $id)
    {
        $request->validate([
            'version' => 'required',
            'aprobar' => 'required',
            'fecha' => 'required',
            'motivo' => 'required',
        ]);
        //proceso para saber si es una versión extra
        $versionActual = Content::where('id',$id)->get()->first();
        if ($versionActual->version != $request->version) {
            if ($request->aprobar==1) {
            $versionNueva = Versione::where('content',$id)->where('version',$request->version)->get()->first();
            Content::where('id',$id)->update([
                'version' => $versionNueva->version,
                'isAprobado' => 1,
                'vigencia' => $versionNueva->vigencia,
                'motivo' => $versionNueva->motivo,
                'titulo' => $versionNueva->titulo,
                'sipnosis' => $versionNueva->sipnosis,
                'urlimage1' => $versionNueva->urlimage1,
                'urlimage2' => $versionNueva->urlimage2,
                'urlimage3' => $versionNueva->urlimage3,
                'urlcompra' => $versionNueva->urlcompra,
            ]);

            }
        }
        Content::where('id',$id)->update([
            'version' => $request->version,
            'isAprobado' => $request->aprobar,
            'vigencia' => $request->fecha,
            'motivo' => $request->motivo,
        ]);
        Versione::where('content',$id)->where('version',$request->version)->update([
            'version' => $request->version,
            'isAprobado' => $request->aprobar,
            'vigencia' => $request->fecha,
            'motivo' => $request->motivo,
        ]);
        
        $juegos = Content::select('sections.titulo','contents.motivo','contents.id','contents.titulo as titulo_juego','contents.sipnosis','contents.urlimage1','contents.urlimage2','contents.version','contents.urlimage3','contents.vigencia','contents.isAprobado','contents.created_at','contents.updated_at')->join('sections','sections.id','=','contents.section')->paginate(10);
        return view('contents.index_difusor',compact('juegos'));
    }
    public function create()
    {
        return view('contents.create');
    }
    public function store(Request $request)
    {
    $customMessages = [
            'seccion.required' => 'No tienes una sección asignada, espera a que el difusor te asigne una sección para poder publicar contenido',];
        $request->validate([
            'seccion' => 'required',
            'imagen1' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'imagen2' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'imagen3' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'titulo' => 'required',
            'descripcion' => 'required',
        ], $customMessages);
        $file = $request->file('imagen1');
        $namefile = \Carbon\Carbon::now()->toArray()['year'].\Carbon\Carbon::now()->toArray()['month'].\Carbon\Carbon::now()->toArray()['day'].\Carbon\Carbon::now()->toArray()['hour'].\Carbon\Carbon::now()->toArray()['minute'].\Carbon\Carbon::now()->toArray()['second'].$file->getClientOriginalName();
        $request->file('imagen1')->storeAs('public',$namefile);
        $file2 = $request->file('imagen2');
        $namefile2 = \Carbon\Carbon::now()->toArray()['year'].\Carbon\Carbon::now()->toArray()['month'].\Carbon\Carbon::now()->toArray()['day'].\Carbon\Carbon::now()->toArray()['hour'].\Carbon\Carbon::now()->toArray()['minute'].\Carbon\Carbon::now()->toArray()['second'].$file2->getClientOriginalName();
        $request->file('imagen2')->storeAs('public',$namefile2);
        $file3 = $request->file('imagen3');
        $namefile3 = \Carbon\Carbon::now()->toArray()['year'].\Carbon\Carbon::now()->toArray()['month'].\Carbon\Carbon::now()->toArray()['day'].\Carbon\Carbon::now()->toArray()['hour'].\Carbon\Carbon::now()->toArray()['minute'].\Carbon\Carbon::now()->toArray()['second'].$file3->getClientOriginalName();
        $request->file('imagen3')->storeAs('public',$namefile3);
        $vigencia = \Carbon\Carbon::now('GMT-5');
        if (Permiso::where('id_user',Auth::user()->id)->get()->first()->independencia==1) {
            Content::create([
                'section' => $request->seccion,
                'titulo' => $request->titulo,
                'sipnosis' => $request->descripcion,
                'urlimage1' => $namefile,
                'urlimage2' => $namefile2,
                'urlimage3' => $namefile3,
                'version' => 1,
                'urlcompra' => $request->url,
                'isAprobado' => 1,
                'vigencia' => $vigencia->toDateTimeString(),
            ]);
        $content = Content::get()->last();
        Versione::create([
            'content' => $content->id,
            'titulo' => $request->titulo,
            'sipnosis' => $request->descripcion,
            'urlimage1' => $namefile,
            'urlimage2' => $namefile2,
            'urlimage3' => $namefile3,
            'version' => 1,
            'urlcompra' => $request->url,
            'isAprobado' => 1,
            'vigencia' => $vigencia->toDateTimeString(),
        ]);
        }else{
            Content::create([
                'section' => $request->seccion,
                'titulo' => $request->titulo,
                'sipnosis' => $request->descripcion,
                'urlimage1' => $namefile,
                'urlimage2' => $namefile2,
                'urlimage3' => $namefile3,
                'version' => 1,
                'urlcompra' => $request->url,
            ]);
        $content = Content::get()->last();
        Versione::create([
            'content' => $content->id,
            'titulo' => $request->titulo,
            'sipnosis' => $request->descripcion,
            'urlimage1' => $namefile,
            'urlimage2' => $namefile2,
            'urlimage3' => $namefile3,
            'version' => 1,
            'urlcompra' => $request->url,
        ]);
        }
        $NuevoJuego = Content::get()->last();
        return redirect()->route('contents.show',$NuevoJuego->id);
    }
    public function obtenerVersion(Request $request){
        if ($request->ajax()) {
            $juego = Versione::where('content', $request->juego)->where('version', $request->version)->get()->first();
            return response()->json($juego);
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'imagen1' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'imagen2' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'imagen3' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'titulo' => 'required',
            'url' => 'required',
            'descripcion' => 'required',
        ]);
        $versionActual = Versione::where('content',$id)->get()->last()->version;
        $versionNueva = $versionActual + 1;
        $file = $request->file('imagen1');
        $namefile = \Carbon\Carbon::now()->toArray()['year'].\Carbon\Carbon::now()->toArray()['month'].\Carbon\Carbon::now()->toArray()['day'].\Carbon\Carbon::now()->toArray()['hour'].\Carbon\Carbon::now()->toArray()['minute'].\Carbon\Carbon::now()->toArray()['second'].$file->getClientOriginalName();
        $request->file('imagen1')->storeAs('public',$namefile);
        $file2 = $request->file('imagen2');
        $namefile2 = \Carbon\Carbon::now()->toArray()['year'].\Carbon\Carbon::now()->toArray()['month'].\Carbon\Carbon::now()->toArray()['day'].\Carbon\Carbon::now()->toArray()['hour'].\Carbon\Carbon::now()->toArray()['minute'].\Carbon\Carbon::now()->toArray()['second'].$file2->getClientOriginalName();
        $request->file('imagen2')->storeAs('public',$namefile2);
        $file3 = $request->file('imagen3');
        $namefile3 = \Carbon\Carbon::now()->toArray()['year'].\Carbon\Carbon::now()->toArray()['month'].\Carbon\Carbon::now()->toArray()['day'].\Carbon\Carbon::now()->toArray()['hour'].\Carbon\Carbon::now()->toArray()['minute'].\Carbon\Carbon::now()->toArray()['second'].$file3->getClientOriginalName();
        $request->file('imagen3')->storeAs('public',$namefile3);
        Versione::create([
            'content' => $id,
            'version' => $versionNueva,
            'titulo' => $request->titulo,
            'sipnosis' => $request->descripcion,
            'urlimage1' => $namefile,
            'urlimage2' => $namefile2,
            'urlimage3' => $namefile3,
            'urlcompra' => $request->url,
        ]);
        return redirect()->route('contents.index');
    }
}
