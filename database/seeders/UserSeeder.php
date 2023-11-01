<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {

         // DB::table('users')->insert([
         //        'name' => 'Admin',
         //        'email' => 'admin@cmonit.com',
         //        'password' => Hash::make('Cmonit2023'),
         //    ]);
        for ($i = 16; $i <= 20; $i++) {
            DB::table('users')->insert([
                'name' => 'Agente ' . $i,
                'email' => 'agente' . $i . '@cmonit.com',
                'password' => Hash::make('Cmonit2023'),
            ]);
        }
        $this->command->info('Se han insertado 5 usuarios en la tabla.');
    }
}
