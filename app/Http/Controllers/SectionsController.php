<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Section;
use App\Permiso;
use App\Suscripcion;
use App\Versione;
use DB;
use Arr;
use Auth;
class SectionsController extends Controller
{
	public function show($id)
    {
        $id_section = $id;
        $juegos = Content::select('sections.titulo','sections.id as id_section','contents.motivo','contents.id','contents.titulo as titulo_juego','contents.sipnosis','contents.urlimage1','contents.urlimage2','contents.urlimage3','contents.vigencia','contents.isAprobado','contents.created_at','contents.updated_at','contents.version')->join('sections','sections.id','=','contents.section')->where('section',$id)->paginate(10);
        $subsecciones = Section::orderBy('titulo','ASC')->where('id_section',$id)->get();
        return view('sections.show')->with(compact('juegos'))->with(compact('subsecciones'))->with(compact('id_section'));
    }
    public function create()
    {
        return view('sections.create');
    }
    public function subscribirte($id_section)
    {
        Suscripcion::create([
            'id_user' => Auth::user()->id,
            'id_section' => $id_section,
        ]);
        $categorias = Section::orderBy('created_at','DESC')->take(3)->get();
        $juegosN = Versione::select([DB::RAW('DISTINCT(content)'), 'versiones.titulo', 'versiones.vigencia', 'versiones.id', 'versiones.sipnosis','versiones.version','versiones.urlimage1','versiones.sipnosis'])->where('vigencia','<',\Carbon\Carbon::now('GMT-5'))->orderBy('vigencia','DESC')->orderBy('content')->get();
        $content = "";
        $ids = [0];
        foreach($juegosN as $juego){
            if($content == $juego->content){
                
            }else{
                $ids = Arr::prepend($ids, $juego->id);
            }
            $content = $juego->content;
        }
        $juegosNOk = Versione::whereIn('id',$ids)->get();
        return view('home',compact('juegosNOk'),compact('categorias'));
    }
    public function store(Request $request)
    {
        Section::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'id_section' => Section::where('id',Permiso::where('id_user',Auth::user()->id)->get()->first()->id_section)->get()->first()->id,
        ]);
        $id_sectionN = Section::get()->last()->id;
        $permiso = Permiso::where('id_user',Auth::user()->id)->get()->first();
        if ($permiso->independencia==1) {
            Permiso::create([
                'id_user' => Auth::user()->id,
                'id_section' => $id_sectionN,
                'modificacion' => $permiso->modificacion,
                'independencia' => $permiso->independencia,
                'subseccion' => $permiso->subseccion,
            ]);        
        }
        $categorias = Section::orderBy('created_at','DESC')->take(3)->get();
        $juegosN = Versione::select([DB::RAW('DISTINCT(content)'), 'versiones.titulo', 'versiones.vigencia', 'versiones.id', 'versiones.sipnosis','versiones.version','versiones.urlimage1','versiones.sipnosis'])->where('vigencia','<',\Carbon\Carbon::now('GMT-5'))->orderBy('vigencia','DESC')->orderBy('content')->get();
        $content = "";
        $ids = [0];
        foreach($juegosN as $juego){
            if($content == $juego->content){
                
            }else{
                $ids = Arr::prepend($ids, $juego->id);
            }
            $content = $juego->content;
        }
        $juegosNOk = Versione::whereIn('id',$ids)->get();
        return view('home',compact('juegosNOk'),compact('categorias'));
    }

}
