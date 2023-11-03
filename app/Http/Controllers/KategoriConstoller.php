<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriConstoller extends Controller
{
    public function simpan(Request $request)
    {
        $a = mt_rand(0000,9999);
        $idk = "ID-K".$a;
        $data = [
            'id_kategori' => $idk,
            'kategori' => $request->kategori
        ];

        $result = Kategori::create($data);
        if($result){
            $header = "Berhasil";
            $text = "Berhasil Menambah Kategori";
            $icon = "success"; 
        } else {
            $header = "Gagal";
            $text = "Gagal Menambah Kategori";
            $icon = "error"; 
        }

        $data = Kategori::all();
        return response()->json([
            'data' => $data,
            'icon' => $icon,
            'text' => $text,
            'header'=> $header
        ]);
    }

    public function hapus($id)
    {
        Kategori::where('id_kategori',$id)->delete();
        return redirect()->route('buku');
    }
}
