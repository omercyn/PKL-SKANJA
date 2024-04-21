<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Siswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        return $next($request);

        if(!Auth::chek()){
            return redirect()->route('login');
        }
        $userRole=Auth::user()->role;

        if($userRole==3){
            return $next($request);
        }

        if($userRole==2){
            return redirect()->route('guru');
        }

        if($userRole==1){
            return redirect()->route('admin');
        }
        }
    }
