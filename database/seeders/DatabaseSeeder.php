<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // USUARIOS
        DB::table('users')->insert(
            [
                'usuario' => 'gerardomanrique', 
                'tipo' => 0,
                'num_identificacion' => '1234567890', 
                'correo_electronico' => 'gerardomanrique@saluddomiciliaria.net', 
                'password' => Hash::make('1234567890'), 
                'estado' => 0, 
            ]
        );

        // PROFESIONALES
        DB::table('profesionales')->insert(
            [
                'user_id' => '1', 
                'nombre' => 'Gerardo', 
                'apellidos' => 'Manrique', 
                'correo_electronico' => 'gerardomanrique@saluddomiciliaria.net', 
                'num_celular' => '3103942911', 
                'ubicacion' => 'bogota', 
            ]
        );

        DB::table('users')->insert(
            [
                'usuario' => 'danielarcos', 
                'tipo' => 1,
                'num_identificacion' => '123456789', 
                'correo_electronico' => 'danielarcos@sgmail.com', 
                'password' => Hash::make('123456789'), 
                'estado' => 0, 
            ]
        );

        // PACIENTES
        DB::table('pacientes')->insert(
            [
                'user_id' => '2', 
                'nombre' => 'Daniel', 
                'apellidos' => 'Arcos', 
                'correo_electronico' => 'danielarcos@sgmail.com', 
                'num_celular' => '3053342201', 
                'ubicacion' => 'bogota', 
            ]
        );


        // HISTORIAS
        DB::table('historias')->insert(
            [
                'id_profesional' => 1,
                'id_paciente' => 1,
                'inf_relevante' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'consecutivo' => 1,
                'estado' => 1,
                'inf_antecedentes' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'evolucion_final' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'concepto_profesional' => 'Diagnostico problemas cardiovasculares',
                'recomendaciones' => 'Mejorar alimentación, realizar ejercicio, comer frutas',
                'fecha' => '2023-12-07',
                'hora' => '10:00',
                'imagen' => 'paciente.png',
            ]
        );

    }
}
