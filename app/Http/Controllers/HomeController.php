<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $totalpeminjam = Buku::sum('totalpeminjaman');
        $sumpinjam = Buku::where('status_buku','Dipinjam')->count();
        $sumtersedia = Buku::where('status_buku', 'Tersedia')->count();

        return view('dashboard.index',[
            'totalpeminjam' => $totalpeminjam,
            'sumpinjam' =>$sumpinjam,
            'sumtersedia' => $sumtersedia
        ]);
    }
   
}
