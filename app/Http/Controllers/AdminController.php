<?php

namespace App\Http\Controllers;

use App\Models\Phim;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        $phimDangChieus = Phim::where('TrangThai', 'Đang chiếu')->get();
        $phimSapChieus = Phim::where('TrangThai', 'Sắp chiếu')->get();
        return view('admin.index', compact('phimDangChieus', 'phimSapChieus'));
    }
    public function datVe(){
        $phimDangChieus = Phim::where('TrangThai', 'Đang chiếu')->get();
        $phimSapChieus = Phim::where('TrangThai', 'Sắp chiếu')->get();
        return view('admin.DatVe', compact('phimDangChieus', 'phimSapChieus'));
    }
}
