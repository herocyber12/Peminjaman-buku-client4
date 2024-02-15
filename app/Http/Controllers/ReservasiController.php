<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Profil;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
    public function index()
    {
        // $data = Reservasi::all();
        $reservas = Reservasi::join('profil', 'reservasi.id_profil', '=', 'profil.id_profil')->join('buku', 'reservasi.id_buku', '=', 'buku.id_buku')->select('reservasi.*', 'profil.nama as nama_profil', 'buku.nama_buku as nama_buku')->orderBy('reservasi.created_at','DESC')->get();

        return view('reservasi.index',['data' => $reservas]);
    } 

    public function update(Request $request)
    {
        $elosql=  Reservasi::where('id_reservasi',$request->id);
        $c = $elosql->first(); // mengambil data dari database
        $reser_buku = $elosql->first();
        $lk = Buku::where('id_buku',$reser_buku->id_buku);
        if($request->tombol === "hapus"){
            if($reser_buku->status_peminjaman === "Disetujui" || $reser_buku->status_peminjaman === "Tidak Di Setujui"){
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
                $jumlahBuku = $lk->first();
                $total_buku = $jumlahBuku->jumlah_buku + 1;
    
                if($jumlahBuku !== 0){
                    $update = [
                        'jumlah_buku' => $total_buku
                    ];
                } else {
                    $update = [
                        'status_buku'=>'Tersedia',
                        'jumlah_buku' => $total_buku
                    ];
    
                }
                
                $id_buku = $lk->update($update);
    
                if($id_buku){
    
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
                    $icon = "error";
                    $message = "Gagal hapus Data";
                    $title = "Gagal";
    
                }
            }
            
        } else {
            if($request->tombol === "setuju"){
                $status_peminjaman = "Disetujui";
                $status_reservasi = "Masih Dipinjam";
            } else if($request->tombol === "tolak"){
                $jumlahBuku = $lk->first();
                $total_buku = $jumlahBuku->jumlah_buku + 1;
                
                if($jumlahBuku !== 0){
                    $update = [
                        'jumlah_buku' => $total_buku
                    ];
                } else {
                    $update = [
                        'status_buku'=>'Tersedia',
                        'jumlah_buku' => $total_buku
                    ];
                }
                
                $id_buku = $lk->update($update);
                
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
                $no_hp = Profil::where('id_profil',$c->id_profil)->first();
                $no_hp = strval($no_hp->no_hp);
                $namabuku = Buku::where('id_buku',$c->id_buku)->first();
                
                $response = Http::withHeaders([
                    'Authorization'=> env('APP_FONNTE'),
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
        $reservas = Reservasi::join('profil', 'reservasi.id_profil', '=', 'profil.id_profil')->join('buku', 'reservasi.id_buku', '=', 'buku.id_buku')->select('reservasi.*', 'profil.nama as nama_profil', 'buku.nama_buku as nama_buku')->orderBy('reservasi.created_at','DESC')->get();

        return view('logreservasi.index',['data' => $reservas]);
    }

    public function perpanjang($id)
    {
        // $id = decrypt($id);
        
        $tgl_skrng = Carbon::now();
        $tgl_dikembalikan = $tgl_skrng->copy()->addDay(3);

        $result = Reservasi::where('id_reservasi', $id)->update([
            'tanggal_dikembalikan' => $tgl_dikembalikan,
        ]);

        $send = Reservasi::join('profil', 'reservasi.id_profil', '=', 'profil.id_profil')->join('buku', 'reservasi.id_buku', '=', 'buku.id_buku')->select('reservasi.*', 'profil.*', 'buku.nama_buku as nama_buku')->where('reservasi.id_reservasi',$id)->first();
        // dd($send->nama);
        $response = Http::withHeaders([
            'Authorization'=> env('APP_FONNTE'),
        ])->post('https://api.fonnte.com/send',[
            'target' =>'0'.$send->no_hp,
            'message' => 'Perpanjangan peminjaman buku anda untuk buku berjudul '.$send->nama_buku.' telah diperpenjang sampai tanggal'.$send->tanggal_dikembalikan,
            'countryCode' => '+62',
        ]);
        
        if($response->successful()){
            
            $response = Http::withHeaders([
                'Authorization'=> env('APP_FONNTE'),
            ])->post('https://api.fonnte.com/send',[
                'target' =>'081542355622',
                'message' =>'User dengan nama '.$send->nama .' melakukann perpanjangan peminjaman buku untuk buku berjudul '.$send->nama_buku.' telah diperpenjang sampai tanggal'.$send->tanggal_dikembalikan,
                'countryCode' => '+62',
            ]);

            if($response->successful()){

                echo 'berhasil memperpanjang peminjaman buku anda dengan judul '.$send->nama_buku;
                sleep(5);
                return redirect()->route('home');
            }
        }

    }

    public function ubahStats(Request $request)
    {
        // $id = $request->id;
        $id = $request->id;
        try{
            DB::transaction(function() use ($id, $request){

                $row = Reservasi::where('id_reservasi',$id);
                $data = $row->first();

                $lk = Buku::where('id_buku',$data->id_buku);
                $jumlahBuku = $lk->first();
                    $total_buku = $jumlahBuku->jumlah_buku + 1;
                    
                    if($jumlahBuku !== 0){
                        $update = [
                            'jumlah_buku' => $total_buku
                        ];
                    } else {
                        $update = [
                            'status_buku'=>'Tersedia',
                            'jumlah_buku' => $total_buku
                        ];
                    }
                    
                $id_buku = $lk->update($update);
                
                $row->update([
                    'status_reservasi' => 'Sudah Dikembalikan'
                ]);
        
                Buku::where('id_buku',$data->id_buku)->update([
                    'status_buku' => 'Tersedia'
                ]);
            });
            return redirect()->route('reservasi');
            
        } catch(\Exception $e){
            
            return redirect()->route('reservasi');
        }
    }

    public function selesaiPinjam (Request $request)
    {
        $id = $request->id_reser;
        $data = Reservasi::where('id_reservasi',$id);
        $id_buku = $data->first();
        $lk = Buku::where('id_buku',$id_buku->id_buku);
        $buku = $lk->first();

        // $jumlahBuku = $lk->first();
        $total_buku = isset($buku->jumlah_buku) + 1;
        
        if($buku->jumlah_buku !== 0){
            $update = [
                'jumlah_buku' => $total_buku
            ];
        } else if ($buku->jumlah_buku === 0){
            $update = [
                'status_buku' => 'Tersedia',
                'jumlah_buku' => $total_buku
            ];
        }
        $updateR = [
            'status_reservasi'=>'Sudah Dikembalikan'
        ];
        $result_reservasi = $data->update($updateR);
        
        $result_buku = $lk->update($update);
        if($result_buku){
            $message = "Selamat ! anda telah menyelesaikan  peminjaman buku ini.";
            
        } else {
            $message = "Gagal memperbarui data buku";
        }

        return back()->withErrors(["message"=>$message]);
        
    }

}
