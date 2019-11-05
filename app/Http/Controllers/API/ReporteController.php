<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function ventasDiario()
    {
        $ventas = DB::table('ventas')
            ->select('fecha', DB::raw('SUM(valor_total) as total'))
            ->groupBy('fecha')
            ->orderBy('fecha')->get();
        return response()->json($ventas);
    }

    public function gastosDiario()
    {
        $gastos = DB::table('gastos')
            ->select('fecha', DB::raw('SUM(valor_total) as total'))
            ->groupBy('fecha')
            ->orderBy('fecha')->get();
        return response()->json($gastos);
    }
}
