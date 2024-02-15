<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use App\Models\Profil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
        
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->stateless()->user();
       
            $finduser = User::where('id_profil', $user->id)->first();
            
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('home');
       
            }else{
                // $profil_rand = mt_rand(0000,9999);
                // $id_p = "ID-P".$profil_rand;
                
                $length = 6;
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $randomString = '';

                $charactersLength = strlen($characters);
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
                }


                $rand = mt_rand(000,999);
                $newUser = User::create([
                    'username' => $user->name.$rand,
                    'email' => $user->email,
                    'password' => encrypt($randomString),
                    'id_profil'=> $user->id,
                ]);

                $newProfil = Profil::create([
                    'id_profil' => $user->id,
                    'nama' => $user->name,
                    'alamat' => 'Belum Diisi',
                    'no_hp' => 'Belum diisi',
                    'level' => 'Member',
                ]);

                // $response = Http::withHeaders([
                //     'Authorization'=> env('APP_FONNTE'),
                // ])->post('https://api.fonnte.com/send',[
                //     'target' =>'081542355622',
                //     'message' => 'Pengguna'.$user->name.' telah membuat akun dengan Password akun '.$randomString,
                //     'countryCode' => '+62',
                // ]);

                // $result = $response->json();
      
                dd(Auth::login($newUser));

                return redirect()->intended('daftar');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}