<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\OrderClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function dailySells(Request $request)
    {
        $dailySells = OrderClient::select(DB::raw('SUM(total_price) as total'), DB::raw('DAY(created_at) AS day'))
        ->whereRaw('DAY(created_at) > (DAY(CURRENT_DATE)-15)')
        ->groupByRaw(DB::raw('day'))
        ->orderByRaw('day')
        ->get();

        return response()->json($dailySells);
    }

    public function monthlySells(Request $request)
    {
        $monthlySells = OrderClient::select(DB::raw('SUM(total_price) as total'), DB::raw('MONTH(created_at) AS month'))
        ->whereRaw('MONTH(created_at) > (MONTH(CURRENT_DATE)-15)')
        ->groupByRaw(DB::raw('month'))
        ->orderByRaw('month')
        ->get();

        return response()->json($monthlySells);
    }

    public function bestClient()
    {
        $bestClient = Client::select('clients.name',DB::raw('SUM(order_clients.total_price) AS total'))
        ->join('order_clients', 'clients.id', '=','order_clients.client_id')
        ->whereRaw(DB::raw('MONTH(order_clients.created_at) = MONTH(CURRENT_DATE())'))
        ->groupByRaw(DB::raw('name'))
        ->orderByDesc('total')
        ->limit(5)
        ->get();

        return response()->json($bestClient);
    }
}
