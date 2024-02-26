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

        $data_buku = Buku::latest()->take(10)->get();
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
        $kembali = $request->maxhari;
        if(auth()->user()){
            
            $row = Profil::where('id_profil',auth()->user()->id_profil)->first();
            if($row->level === "Admin"){
                return back()->withErrors(['message' => 'Admin tidak bisa melakukan peminjaman buku']);
            }
            
            $id = $request->id_buku;
            $b = Buku::where('id_buku',$id);
            
            $dataR = Reservasi::where('id_buku', $id)->orderBy('created_at','DESC')->first();
            // dd($dataR);
            if ($dataR && $id === $dataR->id_buku && auth()->user()->id_profil === $dataR->id_profil && $dataR->status_peminjaman === "Belum Disetujui" ) {
                return back()->withErrors(['message' => 'Buku Anda sedang diajukan peminjaman']);
            } else if ($dataR && $id === $dataR->id_buku && auth()->user()->id_profil === $dataR->id_profil && $dataR->status_peminjaman === "Disetujui"){
                if($dataR && $id === $dataR->id_buku && auth()->user()->id_profil === $dataR->id_profil && $dataR->status_reservasi !== "Sudah Dikembalikan"){
                    return back()->withErrors(['message' => 'Buku Anda Sudah disetujui!']);
                }else {

                }
            }

            $i = mt_rand(0000,9999);
            $idr = "ID-R".$i;
    
            $data = [
                'id_reservasi' => $idr,
                'tanggal_dipinjam' => Carbon::now(),
                'tanggal_dikembalikan' => Carbon::now()->addDays($kembali),
                'status_reservasi' => 'Pengajuan Peminjaman',
                'status_peminjaman' => 'Belum Disetujui',
                'id_profil' => auth()->user()->id_profil,
                'id_buku' => $id
            ];

            
            $reservasi = Reservasi::create($data);
    
            if($reservasi){
                
                $dataB = $b->first();
                
                $jumlah = $dataB->jumlah_buku;
                
                if($jumlah > 0){
                    $jumlah = $jumlah - 1;
                    $b->update(['jumlah_buku'=>$jumlah]);
                }
                
                if($jumlah === 0){
                    $status_buku = [
                        'status_buku' => 'Dipinjam'
                    ];
                    $buku = $b->update($status_buku);

                }
    
            Http::withHeaders([
                'Authorization'=> env('APP_FONNTE'), // TOKEN API KODE disini
            ])->post('https://api.fonnte.com/send',[
                'target' =>'081542355622', 
                'message' => 'Atas Nama '. $row->nama.' melakukan peminjaman buku yang berjudul "'. $dataB->nama_buku .'" silahkan konfirmasi permintaan halaman admin' ,
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

    public function cari()
    {
        return view('pages.cari');
    }
    public function caribuku(Request $request)
    {
         // Validasi input
         $request->validate([
            'cari' => 'required|string',
        ]);

        // Ambil input pencarian
        $keyword = $request->input('cari');

        // Lakukan pencarian berdasarkan beberapa kolom pada tabel buku
        $data = Buku::where('nama_buku', 'LIKE', "%$keyword%")
            ->orWhere('penerbit', 'LIKE', "%$keyword%")
            ->orWhere('tahun_terbit', 'LIKE', "%$keyword%")
            ->orWhere('penulis', 'LIKE', "%$keyword%")
            ->orWhere('rak', 'LIKE', "%$keyword%")
            ->get();
    
        $kategori = Kategori::get();
        $ulasanPerBuku = [];

        foreach ($data as $buku) {
            $jumlahUlasan = Review::where('id_buku', $buku->id_buku)->count();
            $ulasanPerBuku[$buku->id_buku] = $jumlahUlasan;
        }

        return view('pages.hasil',['data'=>$data,'ulasanPerBuku' => $ulasanPerBuku,'kategori'=>$kategori]);
    }

    public function advanced()
    {
        $kategori = Kategori::all();
        return view('pages.advanced',['kategori'=>$kategori]);
    }

    public function advancedbuku(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name_buku' => 'nullable|string',
            'penulis' => 'nullable|string',
            'penerbit' => 'nullable|string',
            'tahun_terbit' => 'nullable|numeric', // Menjadi nullable agar bisa kosong
            'status_buku' => 'nullable|string',
            'kategori' => 'nullable|string',
        ]);
        // Ambil input pencarian
    $keywordNameBuku = $request->input('name_buku');
    $keywordPenulis = $request->input('penulis');
    $keywordPenerbit = $request->input('penerbit');
    $keywordTahunTerbit = $request->input('tahun_terbit');
    $keywordStatusBuku = $request->input('status_buku');
    $keywordKategori = $request->input('kategori');

    // Lakukan pencarian berdasarkan beberapa kolom pada tabel buku
    $data = Buku::when($keywordNameBuku, function ($query) use ($keywordNameBuku) {
            $query->where('nama_buku', 'like', "%$keywordNameBuku%");
        })
        ->when($keywordPenulis, function ($query) use ($keywordPenulis) {
            $query->where('penulis', 'like', "%$keywordPenulis%");
        })
        ->when($keywordPenerbit, function ($query) use ($keywordPenerbit) {
            $query->where('penerbit', 'like', "%$keywordPenerbit%");
        })
        ->when($keywordTahunTerbit, function ($query) use ($keywordTahunTerbit) {
            $query->where('tahun_terbit', 'like', "%$keywordTahunTerbit%");
        })
        ->when($keywordStatusBuku, function ($query) use ($keywordStatusBuku) {
            $query->where('status_buku', $keywordStatusBuku);
        })
        ->when($keywordKategori, function ($query) use ($keywordKategori) {
            $query->where('id_kategori', $keywordKategori);
        })
        ->get();

    // Sisipkan logika pengambilan ulasan dll.
    $kategori = Kategori::get();
    $ulasanPerBuku = [];

    foreach ($data as $buku) {
        $jumlahUlasan = Review::where('id_buku', $buku->id_buku)->count();
        $ulasanPerBuku[$buku->id_buku] = $jumlahUlasan;
    }

    return view('pages.hasil', ['data' => $data, 'ulasanPerBuku' => $ulasanPerBuku, 'kategori' => $kategori]);
    }
}
