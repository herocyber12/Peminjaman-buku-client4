<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Profil;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class ProfilController extends Controller
{
    public function update(Request $request)
    {
        $id_profil = auth()->user()->id_profil;
        $files = $request->file('image');
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

            $data = User::join('profil','users.id_profil','=','profil.id_profil')->where('users.id_profil',$id_profil)->select('users.username','users.email','profil.*')->first();
            
            if(Storage::disk('public')->exists($data->foto))
            {
                $oldFoto = Storage::disk('public')->delete([$data->foto]);

                if($oldFoto)
                {
                    $path = $request->file('image')->store('/img/foto','public');

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

                    Profil::where('id_profil', $id_profil)->update($updateProfil);

                    User::where('id_profil', $id_profil)->update($updateUser);
        
                    return response()->json([
                        'icon' => "success",
                        'text' => "Berhasil Update Data",
                        'title' => "Berhasil",
                        'stats' => "berhasil"
                    ]);
                } else {

                    return response()->json([
                        'icon' => "error",
                        'text' => "Terjadi Kegagalan",
                        'title' => "Gagal",
                        'stats' => "gagal"
                    ]);
                }
            } else {
                $path = $request->file('image')->store('/img/foto','public');

                    try{
                        DB::transaction(function() use ($id_profil,$request) {

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
        
                            Profil::where('id_profil', $id_profil)->update($updateProfil);
        
                            User::where('id_profil', $id_profil)->update($updateUser);
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
                    };  
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
}
