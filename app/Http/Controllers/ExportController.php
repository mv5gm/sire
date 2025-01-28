<?php 	
			
namespace App\Http\Controllers;
		
use Illuminate\Http\Request;
use App\Exports\EstudiantesExport;
use Maatwebsite\Excel\Facades\Excel;
		
class ExportController extends Controller
{		
    public function excel(){
    	return Excel::download(new EstudiantesExport, 'estudiantes.xlsx');
    }	
}		