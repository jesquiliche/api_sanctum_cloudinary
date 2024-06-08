<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Asegúrate de importar el modelo User
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    public function run()
    {
        
        //Crear usuario administrador
        User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin_password'), // Puedes establecer una contraseña predeterminada
              
        ]);
        
        $faker = Faker::create();

        // Genera 20 usuarios de prueba
        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password') // Puedes establecer una contraseña predeterminada
            ]);
        }
    }
}
