<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;

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
            } else if($request->tombol === "tolak"){
                $status_peminjaman = "Tidak Di Setujui";
                $status_reservasi = "Pengajuan Peminjaman";
            } else {
                $status_peminjaman = "Belum Disetujui";
                $status_reservasi = "Pengajuan Peminjaman";
            }

            $update = [
                'status_reservasi' => $status_reservasi,
                'status_peminjaman' => $status_peminjaman
            ];

            $result = $elosql->update($update);
            
            if($result){
                $icon = "success";
                $message = "Berhasil Update Data";
                $title = "Berhasil";
            } else {
                $icon = "error";
                $message = "Gagal Update Data";
                $title = "Gagal";
            }
        }
        return response()->json([
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
