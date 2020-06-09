<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Section;
use App\Versione;
use DB;
use Arr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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
