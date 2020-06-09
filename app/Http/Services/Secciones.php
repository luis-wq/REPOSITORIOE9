<?php

namespace App\Services;

use App\Section;

class Secciones
{
    public function get()
    {
        $secciones = Section::orderBy('titulo','ASC')->get();
        return $secciones;
    }
}