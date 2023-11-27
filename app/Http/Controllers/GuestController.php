<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\User;
use App\Models\Reservasi;
use App\Models\Buku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function ceklogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'passowrd' => 'required'
        ]);

        $credential = $request->only('username','password');

        if(Auth::attempt($credential)){
            return back();
        }
        
        
        $user = Auth::user();
        $profilData = User::join('profil', 'users.id_profil', '=', 'profil.id_profil')
        ->where('users.id_profil', $user->id_profil)
        ->get();

        if ($profilData) {
            session(['profil' => $profilData]);
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

    public function profil()
    {
        $data = Profil::where('id_profil',auth()->user()->id_profil)->get();
        return view('pages.akun-details',['data' => $data]);
    }

    public function update(Request $request)
    {
        $id_profil = auth()->user()->id_profil;
        $files = $request->file('image');
        // dd($files);
        if(isset($files)){
            $validator = Validator::make($request->all(),[
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                'nama' => 'required|string',
                'alamat' => 'required|string',
                'no_hp' => 'required|numeric',
                'email' => 'required',
                'username' => 'required',
            ],[
                'image.mimes' => 'Foto harus format jpeg, png, jpg',
                'image.max' => 'Foto harus berukuran kurang dari 2MB',
                'nama.required' => 'Nama harus diisi',
                'no_hp.required' => 'Nomor Hp harus diisi',
                'email.required' => 'E-mail harus diisi',
                'username.required' => 'Username Harus diisi'
            ]);

            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            $data = User::join('profil', 'users.id_profil', '=', 'profil.id_profil')->where('users.id_profil', $id_profil)->select('users.username', 'users.email', 'profil.*')->first();

            if($data && $data->foto){

                $path = $data->foto;
            
            // Periksa apakah foto ada di folder
            if (Storage::disk('public')->exists($path)) {
                // Jika foto ada, hapus foto lama
                $oldFoto = Storage::disk('public')->delete([$path]);
            }
            }
            
            // Simpan foto baru
            $path = $request->file('image')->store('/img/foto', 'public');
            
            $updateProfil = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'foto' => $path,
            ];
            
            $updateUser = [
                'email' => $request->email,
                'username' => $request->username
            ];
            
            try {
                DB::transaction(function () use ($id_profil, $request, $updateProfil, $updateUser) {
                    // Update Profil dan User
                    Profil::where('id_profil', $id_profil)->update($updateProfil);
                    User::where('id_profil', $id_profil)->update($updateUser);
                });
            
                return response()->json([
                    'icon' => "success",
                    'text' => "Berhasil Update Data",
                    'title' => "Berhasil",
                    'stats' => "berhasil"
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'icon' => "error",
                    'text' => "Terjadi Kegagalan",
                    'title' => "Gagal",
                    'stats' => "gagal"
                ]);
            }
        } else {
            $validator = Validator::make($request->all(),[
                'nama' => 'required|string',
                'alamat' => 'required|string',
                'no_hp' => 'required|numeric',
                'email' => 'required',
                'username' => 'required',
            ],[
                'image.mimes' => 'Foto harus format jpeg, png, jpg',
                'image.max' => 'Foto harus berukuran kurang dari 2MB',
                'nama.required' => 'Nama harus diisi',
                'no_hp.required' => 'Nomor Hp harus diisi',
                'email.required' => 'Email Harus diisi',
                'username.required' => 'Username Harus diisi'
            ]);

            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            try{
                DB::transaction(function() use ($id_profil, $request){
                    $dataProfil = [
                        'nama' => $request->nama,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                    ];
        
                    $dataUser = [
                        'username' => $request->username,
                        'email' => $request->email,
                    ];
        
                    User::where('id_profil', $id_profil)->update($dataUser);
        
                    Profil::where('id_profil',$id_profil)->update($dataProfil);

                });
                
                return response()->json([
                    'icon' => "success",
                    'text' => "Berhasil Update Data",
                    'title' => "Berhasil",
                    'stats' => "berhasil"
                ]);
            }catch(\Exception $e){

                return response()->json([
                    'icon' => "error",
                    'text' => "Terjadi Kegagalan",
                    'title' => "Gagal",
                    'stats' => "gagal"
                ]);
            }
        }  
    }

    public function riwayat()
    {
        $data = Reservasi::join('buku','reservasi.id_buku','=','buku.id_buku')->where('reservasi.id_profil',auth()->user()->id_profil)->select('buku.cover','buku.nama_buku','reservasi.*')->get();
        return view('pages.riwayat-peminjaman',['data'=> $data]);
    }

    public function resetPassword(Request $request)
    {
        return view('pages.reset');   
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect()->route('daftar');
    }
}
