<?php

namespace App\Services;

use App\Section;

class Subsecciones
{
    public function get($id)
    {
        $subsecciones = Section::orderBy('titulo','ASC')->where('id_section',$id)->get();
        return $subsecciones;
    }
}