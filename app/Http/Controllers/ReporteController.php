<?php

namespace App\Http\Controllers;
use App\Models\Inventario;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function export(Request $request){
        $user = Auth()->user();
        $currentDateTime = now()->format('Y-m-d H:i:s');
    
        // Obtener las fechas desde el formulario
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
    
        // Filtrar inventarios entre las fechas indicadas
        $query = Inventario::with('propiedad', 'tipoPropiedad');
    
        if ($fromDate) {
            $query->where('fecha', '>=', $fromDate);
        }
        if ($toDate) {
            $query->where('fecha', '<=', $toDate);
        }
    
        $inventarios = $query->get();
    
        $datosInventario = [];
    
        foreach($inventarios as $inventario){
            $datosInventario[] = [
                'id' => $inventario->id,
                'propiedad' => $inventario->propiedad->nombre,
                'tipo_propiedad' => $inventario->tipoPropiedad->nombre,
                'fecha' => $inventario->fecha,
                'direccion' => $inventario->direccion,
                'imagen' => $inventario->imagen
            ];
        }
    
        // Cargar la vista para el PDF con los datos filtrados
        $pdf = Pdf::loadView('inventarios.reporte', [
            'user' => $user,
            'currentDateTime' => $currentDateTime,
            'datosInventario' => $datosInventario
        ]);
    
        return $pdf->download('Reporte.pdf');
    }
    
}
