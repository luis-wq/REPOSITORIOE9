<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Versione extends Model
{
	protected $fillable = ['content','version','titulo','sipnosis','urlimage1','urlimage2','urlimage3','urlcompra','isAprobado','vigencia'];
}
