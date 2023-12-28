<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Review;
use App\Models\Reservasi;
use App\Models\Profil;
use App\Models\Kategori;
use App\Models\Kegiatan;
use App\Models\Viewer;
use App\Models\Tamu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class LandingController extends Controller
{
    public function index()
    {
        $ip = request()->ip();
        $encryptedIp = Crypt::encryptString($ip);

        Viewer::create([
            'id_cache' => $encryptedIp,
            'tanggal' => date('Y-m-d')
        ]);

        $data_buku = Buku::latest()->take(8)->get();
        $ulasanPerBuku = [];

        foreach ($data_buku as $buku) {
            $jumlahUlasan = Review::where('id_buku', $buku->id_buku)->count();
            $ulasanPerBuku[$buku->id_buku] = $jumlahUlasan;
        }

        $kegiatan = Kegiatan::get();

        return view('pages.index',[
            'data'=>$data_buku, 
            'ulasanPerBuku' => $ulasanPerBuku,
            'kegiatan' => $kegiatan
        ]);
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
        $recomendation = Buku::inRandomOrder()->take(6)->get();
        $review = Review::where('id_buku',$id_buku)->get();
        $profil = Profil::all();

        return view('pages.detail_buku',['data' => $data_buku,'review' => $review,'random' => $recomendation,'profil' => $profil]);
        
    }

    public function komentar(Request $request)
    {
        if(auth()->user()){

            $validator = Validator::make($request->all(),[
                'koment' => 'required',
            ],[
                'koment.required' => 'Komentar tidak boleh kosong',
            ]);

            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $r = mt_rand(0000,9999);
            $id_review = 'ID-R'.$r;
    
            $data = [
                'id_review' => $id_review,
                'komentar' => $request->koment,
                'id_profil' => auth()->user()->id_profil,
                'id_buku' => $request->id_buku
            ];
            $result = Review::create($data);
            return back();
        } else {
            return redirect()->route('guest.profil');
        }
    }

    public function pinjam(Request $request)
    {
        if(auth()->user()){

            $row = Profil::where('id_profil',auth()->user()->id_profil)->first();
            if($row->level === "Admin"){
                return back()->withErrors(['message' => 'Admin tidak bisa melakukan peminjaman buku']);
            }
            
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
            $namabuku = $b->first();
    
            Http::withHeaders([
                'Authorization'=> 'j@LzeHaXb4bhIctMhNqu', // TOKEN API KODE disini
            ])->post('https://api.fonnte.com/send',[
                'target' =>'081542355622', 
                'message' => 'Atas Nama '. $row->nama.' melakukan peminjaman buku yang berjudul "'. $namabuku->nama_buku .'" silahkan konfirmasi permintaan halaman admin' ,
                'countryCode' => '+62',
            ]);
    
                return back();
            }
        } else {
            return redirect()->route('login');
        }
    
    }

    public function kategori()
    {
        $data = Buku::orderBy('created_at','DESC')->get();
        $kategori = Kategori::get();
        $ulasanPerBuku = [];

        foreach ($data as $buku) {
            $jumlahUlasan = Review::where('id_buku', $buku->id_buku)->count();
            $ulasanPerBuku[$buku->id_buku] = $jumlahUlasan;
        }
        return view('pages.kategori',['data'=>$data, 'kategori' => $kategori,'ulasanPerBuku'=>$ulasanPerBuku]);   
    }

    public function detailskategori($kategori)
    {
        $data = Buku::where('id_kategori',$kategori)->get();
        $a = Kategori::where('kategori',$kategori)->first();
        $kategori = $a->kategori;
        $ulasanPerBuku = [];

        foreach ($data as $buku) {
            $jumlahUlasan = Review::where('id_buku', $buku->id_buku)->count();
            $ulasanPerBuku[$buku->id_buku] = $jumlahUlasan;
        }

        return view('pages.details-kategori',['data'=>$data,'ulasanPerBuku' => $ulasanPerBuku,'kategori'=>$kategori]);
    }

    public function detailstats($stats)
    {
        $data = Buku::where('status_buku',$stats)->get();
        $kategori = $stats;
        $ulasanPerBuku = [];

        foreach ($data as $buku) {
            $jumlahUlasan = Review::where('id_buku', $buku->id_buku)->count();
            $ulasanPerBuku[$buku->id_buku] = $jumlahUlasan;
        }

        return view('pages.details-kategori',['data'=>$data,'ulasanPerBuku' => $ulasanPerBuku,'kategori'=>$kategori]);
    }

    public function tamucreate(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan
        ];

        $result = Tamu::create($data);
        
        if($result){
            $stats = "Berhasil";
        } else {
            $stats = "Gagal";
        }
        return response()->json(['stats' => $stats]);
    }
}
