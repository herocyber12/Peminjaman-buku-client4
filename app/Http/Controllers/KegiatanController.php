<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    public function index()
    {
        $data = Kegiatan::get();
    
        return view('upload-kegiatan.index',['data' => $data]);
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'nama_kegiatan' => 'required'
        ],[
            'image.required' => 'Foto Tidak boleh kosong',
            'image.mimes' => 'Format foto harus jpg,png, dan jpeg',
            'image.max'=> 'Foto harus berukuran dibawah 2MB',
            'nama_kegiatan.required' => 'Nama Kegiatan tidak boleh kosong',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        if($request->hasFile('image')){
            $path = $request->file('image')->store('/img/banner','public');
            $simpan = [
                'banner' => $path,
                'nama_kegiatan' => $request->nama_kegiatan
            ];

            $result = Kegiatan::create($simpan);
            if($result){
                $title = 'Berhasil';
                $text = "Berhasil Upload Kegiatan";
                $icon = "success";
            }else {
                $title = "Gagal";
                $text = "Gagal Upload Kegiatan";
                $icon = "error";
            }
        }

        return response()->json([
            'icon' => $icon,
            'text' => $text,
            'title' => $title
        ]);
    }
}
