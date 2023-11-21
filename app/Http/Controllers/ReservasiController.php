<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Profil;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ReservasiController extends Controller
{
    public function index()
    {
        // $data = Reservasi::all();
        $reservas = Reservasi::join('profil', 'reservasi.id_profil', '=', 'profil.id_profil')->join('buku', 'reservasi.id_buku', '=', 'buku.id_buku')->select('reservasi.*', 'profil.nama as nama_profil', 'buku.nama_buku as nama_buku')->get();

        return view('reservasi.index',['data' => $reservas]);
    } 

    public function update(Request $request)
    {
        $elosql=  Reservasi::where('id_reservasi',$request->id);
        $c = $elosql->first(); // mengambil data dari database
        if($request->tombol === "hapus"){
            $result = $elosql->delete();
            if($result){
                $icon = "success";
                $message = "Berhasil Hapus Data";
                $title = "Berhasil";
            } else {
                $icon = "error";
                $message = "Gagal hapus Data";
                $title = "Gagal";
            }
        } else {
            if($request->tombol === "setuju"){
                $status_peminjaman = "Disetujui";
                $status_reservasi = "Masih Dipinjam";
                $tgl_dipinjam = Carbon::now();
                $tgl_dikembalikan = $tgl_dipinjam->copy()->addDay(3);
            } else if($request->tombol === "tolak"){
                $status_peminjaman = "Tidak Di Setujui";
                $status_reservasi = "Pengajuan Peminjaman";
            } else {
                $status_peminjaman = "Belum Disetujui";
                $status_reservasi = "Pengajuan Peminjaman";
            }

            $update = [
                'tanggal_dipinjam' => $tgl_dipinjam,
                'tanggal_dikembalikan' => $tgl_dikembalikan,
                'status_reservasi' => $status_reservasi,
                'status_peminjaman' => $status_peminjaman
            ];

            $result = $elosql->update($update);
            
            if($result){
                $icon = "success";
                $message = "Berhasil Update Data";
                $title = "Berhasil";
                $no_hp = Profil::where('id_profil',$c->id_profil)->first();
                $no_hp = strval($no_hp->no_hp);
                $namabuku = Buku::where('id_buku',$c->id_buku)->first();
                
                $response = Http::withHeaders([
                    'Authorization'=> 'j@LzeHaXb4bhIctMhNqu',
                ])->post('https://api.fonnte.com/send',[
                    'target' =>'0'.$no_hp,
                    'message' => 'Pengajuan Peminjaman anda untuk buku berjudul '.$namabuku->nama_buku.' telah disetujui silahkan ambil buku di Perpustakaan Widya Kusuma.',
                    'countryCode' => '+62',
                ]);

                $result = $response->json();
            } else {
                $icon = "error";
                $message = "Gagal Update Data";
                $title = "Gagal";
            }
        }
        return response()->json([
            'result' => $result,
            'header' => $title,
            'text' => $message,
            'icon' => $icon
        ]);
    }

    public function logreservasi()
    {
        $reservas = Reservasi::join('profil', 'reservasi.id_profil', '=', 'profil.id_profil')->join('buku', 'reservasi.id_buku', '=', 'buku.id_buku')->select('reservasi.*', 'profil.nama as nama_profil', 'buku.nama_buku as nama_buku')->get();

        return view('logreservasi.index',['data' => $reservas]);
    }
}
