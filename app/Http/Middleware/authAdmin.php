<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profil;

class authAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $data = Profil::where('id_profil',auth()->user()->id_profil)->first();
            if($data->level === "Admin"){
                return $next($request);     
            } else if($data->level === "Member"){
                
                return $next($request);     
            } else {
            return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
