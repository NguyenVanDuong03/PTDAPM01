<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VangLaiController extends Controller
{
    //
    public function home(){
        
        if(Auth::check() && Auth::user()->VaiTro==1){
            return redirect()->route('admin.home');
        }
        $phimDangChieus = Phim::where('TrangThai', 'Đang chiếu')->get();
        $phimSapChieus = Phim::where('TrangThai', 'Sắp chiếu')->get();
        return view('vang-lai.home', compact('phimDangChieus', 'phimSapChieus'));
    }
}
