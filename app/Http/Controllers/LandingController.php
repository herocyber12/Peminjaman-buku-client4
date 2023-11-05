<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Review;
use App\Models\Reservasi;
use App\Models\Profil;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class LandingController extends Controller
{
    public function index()
    {
        $data_buku = Buku::get();
        $ulasanPerBuku = [];

        foreach ($data_buku as $buku) {
            $jumlahUlasan = Review::where('id_buku', $buku->id_buku)->count();
            $ulasanPerBuku[$buku->id_buku] = $jumlahUlasan;
        }

        return view('pages.index',['data'=>$data_buku, 'ulasanPerBuku' => $ulasanPerBuku]);
    }

    public function details($id_buku)
    {
        $buku = Buku::where('id_buku',$id_buku)->first();
        $data_buku = Buku::where('id_buku',$id_buku)->get();
        $c = $buku->totalpeminjaman + 1;
        $update = [
            'totalpeminjaman' => $c,
        ];

        Buku::where('id_buku',$id_buku)->update($update);
        $recomendation = Buku::inRandomOrder()->get();
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
        $b = Buku::where('id_buku',$id);
        $i = mt_rand(0000,9999);
        $idr = "ID-R".$i;

        $data = [
            'id_reservasi' => $idr,
            'status_reservasi' => 'Pengajuan Peminjaman',
            'status_peminjaman' => 'Belum Disetujui',
            'id_profil' => auth()->user()->id_profil,
            'id_buku' => $id
        ];
        
        $reservasi = Reservasi::create($data);

        if($reservasi){
            
        $status_buku = [
            'status_buku' => 'Dipinjam'
        ];
        $buku = $b->update($status_buku);
        $no_hp = Profil::where('id_profil',auth()->user()->id_profil)->first();
        $namabuku = $b->first();

        Http::withHeaders([
            'Authorization'=> 'j@LzeHaXb4bhIctMhNqu', // API KODE disini
        ])->post('https://api.fonnte.com/send',[
            'target' =>'081542355622', 
            'message' => 'Atas Nama '. $no_hp->nama.' melakukan peminjaman buku yang berjudul "'. $namabuku->nama_buku .'" silahkan konfirmasi permintaan halaman admin' ,
            'countryCode' => '+62',
        ]);

            return back();
        }
    
    }
}
