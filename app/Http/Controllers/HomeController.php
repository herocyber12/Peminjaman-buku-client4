<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Viewer;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // $totalpeminjam = Buku::sum('totalpeminjaman');
        $sumpinjam = Buku::where('status_buku','Dipinjam')->count();
        $sumtersedia = Buku::where('status_buku', 'Tersedia')->count();
        $pelanggan = Reservasi::select('profil.nama')
        ->selectRaw('COUNT(*) as jumlah')
        ->join('profil','reservasi.id_profil','=','profil.id_profil')
        ->groupBy('profil.nama')
        ->orderBy('jumlah', 'desc')
        ->first();

        return view('dashboard.index',[
            'nama' => $pelanggan,
            // 'totalpeminjam' => $totalpeminjam,
            'sumpinjam' =>$sumpinjam,
            'sumtersedia' => $sumtersedia,
            // 'chartData' => $chartData,
        ]);
    }

    public function chart()
    {
        $chartData = Viewer::select('tanggal as tanggal')
        ->selectRaw("COUNT(*) as tanggal_data")
        ->groupBy('tanggal')->get();

        return response()->json($chartData);
    }
}
