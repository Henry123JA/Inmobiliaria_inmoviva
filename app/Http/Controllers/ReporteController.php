<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function export(){
        $user=Auth()->user();
        $currentDateTime = now()->format('Y-m-d H:i:s');
        $nota_devoluciones=NotaDevolucion::all();

        $devoluciones=new Collection();

        $devolucion=[];

        foreach($nota_devoluciones as $nota){
            $devolucion['fecha']=$nota->fecha;
            $devolucion['descripcion']=$nota->descripcion;
            $detalles=DetalleDevolucion::where('nota_devolucion_id',$nota->id)->get();
            foreach($detalles as $detalle){
                $devolucion['cantidad']=$detalle->cantidad;
                $devolucion['precio']=$detalle->precio;
                $devolucion['importe']=$detalle->importe;
                $devolucion['estado']=$detalle->estado;
                $devolucion['articulo']=$detalle->articulo->nombre;
            }
            $devoluciones->push($devolucion);

        }
        $pdf=Pdf::loadView('nota_devolucion.reporte',[
            'user'=>$user,'currentDateTime'=>$currentDateTime,'devoluciones'=>$devoluciones
        ]);
        return $pdf->download('Reporte.pdf');
    }
}
