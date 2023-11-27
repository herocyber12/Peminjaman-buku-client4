<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectGoogle()
    {
        Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
{
    try {
        $user = Socialite::driver('google')->user();

        // Cek apakah pengguna sudah terdaftar dalam database
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // Jika pengguna sudah terdaftar, lakukan login
            auth()->login($existingUser);
        } else {
            
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->google_id = $user->id; // atau field lainnya sesuai kebutuhan
            $newUser->save();

            // Login dengan akun baru
            auth()->login($newUser);
        }

        // Redirect ke halaman yang sesuai setelah login
        return redirect('/home');
    } catch (\Exception $e) {
        // Handle exception jika terjadi kesalahan
        return redirect('login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
    }
}

}
