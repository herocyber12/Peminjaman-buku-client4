<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = Profil::all();

        return view('pengguna.index',['pengguna' => $pengguna]);
    }

    public function update(Request $request,$id)
    {   
        $files = $request->file('image');
        if(isset($files)){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'nama' => 'required|string',
                'alamat' => 'required|string',
                'no_hp' => 'required|numeric',
            ]);
            $data = Profil::where('id_profil',$id)->first();
            if(Storage::disk('public')->exists($data->foto)){
                $oldFoto = Storage::disk('public')->delete($data->foto);
                if($oldFoto){
                    $path = $request->file('image')->store('/img/foto','public');
                    $data = [
                        'foto' => $path,
                        'nama' => $request->nama,
                        'alamat' => $request->alamat,
                        'no_hp'=> $request->no_hp,
                    ];

                    $result = Profil::where('id_profil',$id)->update($data);

                    if($result){
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
                    $message = "Terjadi Kegagalan";
                    $header = "Gagal";
                }
            } else {
                $path = $request->file('image')->store('/img/foto','public');

                $data = [
                    'foto' => $path,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'no_hp'=> $request->no_hp,
                ];

                $result = Profil::where('id_profil',$id)->update($data);

                if($result){
                    $act = "success";
                    $message = "Berhasil Update Data";
                    $header = "Berhasil";
                } else {
                    $act = "error";
                    $message = "Gagal Update Data";
                    $header = "Gagal";
                }
            }
        } else {
            $request->validate([
                'nama' => 'required|string',
                'alamat' => 'required|string',
                'no_hp' => 'required|numeric',
            ]);

            $data = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp'=> $request->no_hp,
            ];

            $result = Profil::where('id_profil',$id)->update($data);

            if($result){
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
            'icon' => $act,
            'text' => $message,
            'header'=> $header
        ]);

    }
    
    public function hapus($id){
        $count = User::where('id_profil',$id)->count();
        $data = Profil::where('id_profil',$id)->first();
        $foto = Storage::disk('public')->exists($data->foto);
        if($count>0){
            if($foto){
                Storage::disk('public')->delete($data->foto);
            } 
            Profil::where('id_profil',$id)->delete();
            User::where('id_profil',$id)->delete();
        }
        return redirect()->route('pengguna');
    }
}
