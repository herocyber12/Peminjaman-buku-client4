<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;;
use Illuminate\Validation\ValidationException;
use App\Models\Profil;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function cek(Request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ])->validate();

        if (!Auth::attempt($request->only('username', 'password'))) {

            // Jika login gagal
            return back()->withErrors(['username' => 'Login gagal.']);
        }
        
        $user = Auth::user();
        $profil = $user->profil;
        if($profil) {
            $profilData = User::join('profil', 'users.id_profil', '=', 'profil.id_profil')
            ->where('users.id_profil', $user->id_profil)
            ->first();

            if ($profilData) {
                session(['profil' => $profilData]);
            }
            
            $request->session()->regenerate();

            return redirect()->route('home');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function create(Request $request)
    {
        $a = mt_rand(0000,9999);
        $b = mt_rand(0000,9999);
        $uid = "UID-".$a;
        $idp = "ID-P".$b;

        $profil = [
            'id_profil' => $idp,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'status' => 'Admin',
        ];

        $sql = Profil::create($profil);
        if($sql){
            $users = [
                'uid' => $uid,
                'username' => $request->username,
                'password' => Hash::make($request->passowrd),
                'id_profil' => $idp,
            ];

            $sql = User::create($users);
            if($sql){
                echo "<script>alert('Berhasil')</script>";
            } else {
                echo "<script>alert('Gagal menambahkan profil! Silakan ulangi beberapa saat lagi.')</script>";
            }
        } else {
            echo "<script>alert('Gagal menambahkan profil! Silakan ulangi beberapa saat lagi.')</script>";
        }
        
        return redirect()->to('login');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect()->route('auth.login');
    }
}
