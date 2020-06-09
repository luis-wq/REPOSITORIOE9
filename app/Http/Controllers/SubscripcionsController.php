<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Section;
use App\Suscripcion;
class SubscripcionsController extends Controller
{
	public function index()
    {
        $subscripciones = Suscripcion::select('suscripcions.created_at','suscripcions.id_section','suscripcions.id as subsid','users.name','users.id','users.email')->join('users','users.id','=','suscripcions.id_user')->paginate(10);
        return view('subscripcions.index')->with(compact('subscripciones'));
    }

}
