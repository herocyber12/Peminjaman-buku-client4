<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $data_buku = Buku::get();
        // dd($data_buku);
        return view('buku.index',[
            'data_buku' => $data_buku,
            'kategori' => $kategori,
        ]);
    }


    public function simpan(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama_buku' => 'required|string',
            'penerbit' => 'required|string',
            'penulis' => 'required|string',
            'tahun_terbit' => 'required|numeric',
            'kategori' => 'required',
            'sinopsis' => 'required',
        ]);

        $t = mt_rand(0000,9999);
        $idbuku = "ID-B".$t;
        
        
        if( $request->hasFile('image')){
           
            $path = $request->file('image')->store('/img/cover','public');
        } else {
            return "gagal";
        }
        $data = [
            'id_buku' => $idbuku,
            'cover' => $path,
            'qrcode' => "coba",
            'sinopsis' => $request->input('sinopsis'),
            'nama_buku'=> $request->nama_buku,
            'penerbit' => $request->penerbit,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'status_buku' => 'Tersedia',
            'id_kategori' => $request->kategori,
            'totalpeminjaman' => 0
        ];

        $result = Buku::create($data);

        if($result)
        {
            $act = "success";
            $message = "Berhasil Tambah Data";
            $header = "Berhasil";
        } else {
            $act = "error";
            $message = "Gagal Tambah Data";
            $header = "Gagal";
        }
        return response()->json([
            'act' => $header,
            'message' => $message,
            'header' => $act,
        ]);
    }

    public function update(Request $request,$id)
    {   
        $files = $request->file('image');
        if(isset($files)){
            $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'nama_buku' => 'required|string',
                    'penerbit' => 'required|string',
                    'penulis' => 'required|string',
                    'tahun_terbit' => 'required|numeric',
                    'kategori' => 'required',
                    'sinopsisEdit' => 'required',
                ]);
            
            $data = Buku::where('id_buku',$id)->first();
            if(Storage::disk('public')->exists($data->cover))
            {
                $oldCover = Storage::disk('public')->delete($data->cover);
                if($oldCover){
                    if($request->hasFile('image')){
                        $path = $request->file('image')->store('/img/cover','public');
                        $update = [
                            'cover' => $path,
                            'qrcode' => "coba",
                            'sinopsis' => $request->input('sinopsisEdit'),
                            'nama_buku'=> $request->nama_buku,
                            'penerbit' => $request->penerbit,
                            'penulis' => $request->penulis,
                            'tahun_terbit' => $request->tahun_terbit,
                            'id_kategori' => $request->kategori
                        ];
    
                        $doUpdate = Buku::where('id_buku',$id)->update($update);
                        if($doUpdate){
                            $act = "success";
                            $message = "Berhasil Update Data";
                            $header = "Berhasil";
                        } else {
                            $act = "error";
                            $message = "Gagal Update Data";
                            $header = "Gagal";
                        }
                    } else {
                        $act = "error";
                        $message = "File Harus Gambar";
                        $header = "Gagal";
                    }
                } else {
                    $act = "error";
                    $message = "Terjadi kegagalan";
                    $header = "Gagal";
                }
            } else {
                $act = "error";
                $message = "Gambar tidak ada di sistem";
                $header = "Gagal";
            }
        } else {
            $where = Buku::where('id_buku',$id);
            
            $request->validate([
                    'nama_buku' => 'required|string',
                    'penerbit' => 'required|string',
                    'penulis' => 'required|string',
                    'tahun_terbit' => 'required|numeric',
                    'kategori' => 'required',
                ]);
            $update = [
                'qrcode' => "coba",
                'sinopsis' => $request->input('sinopsisEdit'),
                'nama_buku'=> $request->nama_buku,
                'penerbit' => $request->penerbit,
                'penulis' => $request->penulis,
                'tahun_terbit' => $request->tahun_terbit,
                'id_kategori' => $request->kategori
            ];
            $doUpdate = $where->update($update);
            if($doUpdate){
                $act = "success";
                $message = "Berhasil Update Data";
                $header = "Berhasil";
            } else {
                $act = "error";
                $message = "Gagal Update Data";
                $header = "Gagal";
            }
        }

        return response()->json([
            'act' => $header,
            'message' => $message,
            'header' => $act,
        ]);
    }
    
    public function hapus($id)
    {
        $buku = Buku::where('id_buku',$id)->first();
        if(Storage::disk('public')->exists($buku->cover)){
            Storage::disk('public')->delete($buku->cover);
            Buku::where('id_buku',$id)->delete();
        }
        return redirect()->route('buku');
    }
}
