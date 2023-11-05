<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class GuestController extends Controller
{
    public function ceklogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'passowrd' => 'req'
        ]);

        $credential = $request->only('username','password');

        if(Auth::attempt($credential)){
            return back();
        }

        $request->session()->regenerate();

        return redirect()->route('daftar');
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ],[
            'required' => 'Kolom Harus Diisi',
            'nama.required' => 'Nama Harus Diisi',
            'alamat.required' => 'Alamat Harus Diisi',
            'no_hp.required' => 'Nomor HP Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'username.required' => 'Username Harus Diisi',
            'password.required' => 'Password Harus Diisi',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $a = mt_rand(0000,9999);
        $b = mt_rand(0000,9999);
        $uid = "UID-".$a;
        $idp = "ID-P".$b;

        $profil = [
            'id_profil' => $idp,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'status' => 'Member',
        ];

        $sql = Profil::create($profil);
        if($sql){
            $users = [
                'uid' => $uid,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_profil' => $idp,
            ];

            $sql = User::create($users);
            if($sql){
                echo "<script>alert('Berhasil')</script>";

                $response = Http::withHeaders([
                    'Authorization'=> 'j@LzeHaXb4bhIctMhNqu',
                ])->post('https://api.fonnte.com/send',[
                    'target' => '081542355622',
                    'message' => 'Atas Nama '.$request->nama.' Mendaftarkan Diri Ke Member Perpustakaan Widya Kusuma',
                    'countryCode' => '+62',
                ]);

            } else {
                echo "<script>alert('Gagal menambahkan profil! Silakan ulangi beberapa saat lagi.')</script>";
            }
        } else {
            echo "<script>alert('Gagal menambahkan profil! Silakan ulangi beberapa saat lagi.')</script>";
        }
        
        return redirect()->to('guest/login');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect()->route('daftar');
    }
}
