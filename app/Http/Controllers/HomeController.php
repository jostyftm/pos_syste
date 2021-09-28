<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\OrderClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bestClients = Client::select('clients.name',DB::raw('SUM(order_clients.total_price) AS total'))
        ->join('order_clients', 'clients.id', '=','order_clients.client_id')
        ->whereRaw(DB::raw('MONTH(order_clients.created_at) = MONTH(CURRENT_DATE())'))
        ->groupByRaw(DB::raw('name'))
        ->orderByDesc('total')
        ->get();
        
        return view('dashboard.home', compact('bestClients'));
    }
}
