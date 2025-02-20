<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {		
        function permisos($nombreModulo,$clase,$roles,$segundoNombreModulo = null){

        	$nombreModuloDescr = $nombreModulo;

        	if ($segundoNombreModulo!= null) {
        		$nombreModuloDescr = $segundoNombreModulo;
        	}

        	$permiso1 = $clase::create(['name' => $nombreModulo.'.index','descripcion'=>$nombreModuloDescr.' Ver' ] );
	        $permiso2 = $clase::create(['name' => $nombreModulo.'.store','descripcion'=>$nombreModuloDescr.' Guardar'  ] );
	        $permiso3 = $clase::create(['name' => $nombreModulo.'.create','descripcion'=>$nombreModuloDescr.' Crear'] );
	        $permiso4 = $clase::create(['name' => $nombreModulo.'.show','descripcion'=>$nombreModuloDescr.' Mostrar'] );
	        $permiso5 = $clase::create(['name' => $nombreModulo.'.update','descripcion'=>$nombreModuloDescr.' Actualizar'] );
	        $permiso6 = $clase::create(['name' => $nombreModulo.'.destroy','descripcion'=>$nombreModuloDescr.' Borrar'] );
	        $permiso7 = $clase::create(['name' => $nombreModulo.'.edit','descripcion'=>$nombreModuloDescr.' Editar'] );

	        foreach ($roles as $rol) {
	        	$rol->givePermissionTo($permiso1);
	        	$rol->givePermissionTo($permiso2);
	        	$rol->givePermissionTo($permiso3);
	        	$rol->givePermissionTo($permiso4);
	        	$rol->givePermissionTo($permiso5);
	        	$rol->givePermissionTo($permiso6);
	        	$rol->givePermissionTo($permiso7);
	    	}	
        }		

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleControl = Role::create(['name' => 'control']);
        $roleGerente = Role::create(['name' => 'gerente']);
        
        permisos('users',Permission::class,[$roleAdmin],'usuarios');
        permisos('roles',Permission::class,[$roleAdmin]);		
        permisos('estudiantes',Permission::class,[$roleAdmin,$roleControl]);
        permisos('representantes',Permission::class,[$roleAdmin,$roleControl]);
        permisos('ingresos',Permission::class,[$roleAdmin,$roleGerente]);
        permisos('pagos',Permission::class,[$roleAdmin,$roleGerente]);
        permisos('empleados',Permission::class,[$roleAdmin,$roleGerente]);
        permisos('plan',Permission::class,[$roleAdmin,$roleControl],'secciones');
        permisos('gastos',Permission::class,[$roleAdmin,$roleGerente]);		
        
        $permisoDashboard = Permission::create(['name'=>'dashboard','descripcion'=>'Panel']);
        
        $roleAdmin->givePermissionTo($permisoDashboard);
        $roleControl->givePermissionTo($permisoDashboard);
        $roleGerente->givePermissionTo($permisoDashboard);
    }	
}		