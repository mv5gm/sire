<?php 	
		
namespace Database\Seeders;
	
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pago;

class PagoSeeder extends Seeder
{		
    public function run(): void
    {
        Pago::factory(100)->create();
    }
}
