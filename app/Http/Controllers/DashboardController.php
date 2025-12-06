<?php

namespace App\Http\Controllers;

use App\Models\Donat;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'donat' => Donat::count(),
            'transaksi' => Transaksi::count(),
        ]);
    }
}
