<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
	protected $fillable = ['section','titulo','sipnosis','urlimage1','urlimage2','urlimage3','version','urlcompra','isAprobado','vigencia'];
}
