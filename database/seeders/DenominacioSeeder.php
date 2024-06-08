<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DenominacioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "nombre" => "Jumilla",
                "descripcion" => "Jumilla"
            ],
            [
                "nombre" => "Rioja",
                "descripcion" => "Rioja"
            ],
            [
                "nombre" => "Rivera del Duero",
                "descripcion" => "Duero"
            ],
            [
                "nombre" => "Rueda",
                "descripcion" => "Rueda"
            ],
            [
                "nombre" => "Toro",
                "descripcion" => "Toro"
            ],
            [
                "nombre" => "Cava",
                "descripcion" => "Cava"
            ],
            [
                "nombre" => "Alella",
                "descripcion" => "Alella"
            ],
            [
                "nombre" => "Penedés",
                "descripcion" => "Penedés"
            ],
        ];
        DB::table('denominaciones')->insert($data);
        //
    }
}
