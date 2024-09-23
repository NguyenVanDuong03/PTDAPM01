<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        if(Auth::user()->VaiTro==1){
            return $next($request);
        }
        if(Auth::user()->VaiTro==2){
            return redirect()->route('employee.home');
        }
        if(Auth::user()->VaiTro==3){
            return redirect()->route('customer.home');
        }
    }
}
