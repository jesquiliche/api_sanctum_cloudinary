<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data=[
            [
            "nombre"=>"Blanco",
            "descripcion"=>"Blanco"
            ],
            [
                "nombre"=>"Tinto",
                "descripcion"=>"Tinto"
                ],
            [
            "nombre"=>"Rosado",
            "descripcion"=>"Rosado"
            ],
            [
            "nombre"=>"Cava",
            "descripcion"=>"Cava"
            ],
            [
            "nombre"=>"Bloque IV",
            "descripcion"=>"Sistemas y comunicaciones"
            ],
        ];
        DB::table('tipos')->insert($data);
    }
}
