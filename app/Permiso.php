<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $fillable = [
        'id_user','id_section','modificacion','independencia','subseccion',
    ];
}
