<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        // User::factory(10)->create();

        $user1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' =>password_hash('12345678', PASSWORD_DEFAULT)
        ]);

        $user2 = User::create([
            'name' => 'control',
            'email' => 'control@admin.com',
            'password' =>password_hash('12345678', PASSWORD_DEFAULT)
        ]);

        $user3 = User::create([
            'name' => 'gerente',
            'email' => 'gerente@admin.com',
            'password' =>password_hash('12345678', PASSWORD_DEFAULT)
        ]);

        $this->call(AescolarSeeder::class);
        $this->call(NivelSeeder::class);
        $this->call(SalonSeeder::class);
        $this->call(SeccionSeeder::class);
        $this->call(RoleSeeder::class);
        //$this->call(CursaSeeder::class);
        //$this->call(EstudianteSeeder::class);
        //$this->call(RepresentanteSeeder::class);
        //$this->call(PagoSeeder::class);
        //$this->call(EmpleadoSeeder::class);
    
        $user1->assignRole('admin');
        $user2->assignRole('control');
        $user3->assignRole('gerente');
    }   
}       