<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Review;
use App\Models\Reservasi;
use App\Models\Profil;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index()
    {
        $data_buku = Buku::join('kategori','buku.id_kategori','=','kategori.id_kategori')
    ->select('buku.*','kategori.kategori')->get();

    $ulasanPerBuku = [];

    foreach ($data_buku as $buku) {
        $jumlahUlasan = Review::where('id_buku', $buku->id_buku)->count();
        $ulasanPerBuku[$buku->id_buku] = $jumlahUlasan;
    }

    return view('pages.index',['data'=>$data_buku, 'ulasanPerBuku' => $ulasanPerBuku]);
    }

    public function details($id_buku)
    {
        $data_buku = Buku::join('kategori','buku.id_kategori','=','kategori.id_kategori')->where('id_buku',$id_buku)->select('buku.*','kategori.kategori')->get();
        $recomendation = Buku::join('kategori','buku.id_kategori','=','kategori.id_kategori')->inRandomOrder()->select('buku.*','kategori.kategori')->get();
        $review = Review::where('id_buku',$id_buku)->get();
        $profil = Profil::all();

        // dd($review);
        return view('pages.detail_buku',['data' => $data_buku,'review' => $review,'random' => $recomendation,'profil' => $profil]);
        
    }

    public function komentar(Request $request)
    {
        $r = mt_rand(0000,9999);
        $id_review = 'ID-R'.$r;

        $data = [
            'id_review' => $id_review,
            'komentar' => $request->komen,
            'id_profil' => $request->id_profil,
            'id_buku' => $request->id_buku
        ];

        $result = Review::create($data);
        return back();
    }

    public function pinjam(Request $request)
    {
        $id = $request->id_buku;
        $buku = Buku::where('id_buku',$id);
        $tgl_dipinjam = Carbon::now();
        $tgl_dikembalikan = $tgl_dipinjam->addDay(3);
        $i = mt_rand(0000,9999);
        $idr = "ID-R".$i;

        $data = [
            'id_reservasi' => $idr,
            'tanggal_dipinjam' => $tgl_dipinjam,
            'tanggal_dikembalikan' => $tgl_dikembalikan,
            'status_reservasi' => 'Pengajuan Peminjaman',
            'status_peminjaman' => 'Belum Disetujui',
            'id_profil' => 'ID-P45654',
            'id_buku' => $id
        ];
        $reservasi = Reservasi::create($data);

        if($reservasi){
            
        $status_buku = [
            'status_buku' => 'Dipinjam'
        ];
        $buku = $buku->update($status_buku);

            return back();
        }
    
    }
}
