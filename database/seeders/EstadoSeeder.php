<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filas = [
            ["nombre"=>"Amazonas","id"=>"1"],
			["nombre"=>"Anzoátegui","id"=>"2"],
			["nombre"=>"Apure","id"=>"3"],
			["nombre"=>"Aragua","id"=>"4"],
			["nombre"=>"Barinas","id"=>"5"],
			["nombre"=>"Bolívar","id"=>"6"],
			["nombre"=>"Carabobo","id"=>"7"],
			["nombre"=>"Cojedes","id"=>"8"],
			["nombre"=>"Delta Amacuro","id"=>"9"],
			["nombre"=>"Falcón","id"=>"10"],
			["nombre"=>"Guárico","id"=>"11"],
			["nombre"=>"Lara","id"=>"12"],
			["nombre"=>"Mérida","id"=>"13"],
			["nombre"=>"Miranda","id"=>"14"],
			["nombre"=>"Monagas","id"=>"15"],
			["nombre"=>"Nueva Esparta","id"=>"16"],
			["nombre"=>"Portuguesa","id"=>"17"],
			["nombre"=>"Sucre","id"=>"18"],
			["nombre"=>"Táchira","id"=>"19"],
			["nombre"=>"Trujillo","id"=>"20"],
			["nombre"=>"Vargas","id"=>"21"],
			["nombre"=>"Yaracuy","id"=>"22"],
			["nombre"=>"Zulia","id"=>"23"],
			["nombre"=>"Distrito Capital","id"=>"24"]
			["nombre"=>"No encontrado","id"=>"25"]
        ];	

        foreach ($filas as $fila){
	        Estado::create($fila);
        }
    }
}
