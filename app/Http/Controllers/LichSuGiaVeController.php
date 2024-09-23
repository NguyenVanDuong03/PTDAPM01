<?php

namespace App\Http\Controllers;

use App\Models\LichSuGiaVe;
use App\Models\LoaiGhe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LichSuGiaVeController extends Controller
{

    public function index()
    {
        $lichsugiaves = LichSuGiaVe::orderBy('MaGiaVe', 'desc')->get();
        if (Auth::user()->role == 1) {
        return view('LichSuGiaVe.admin.index', compact('lichsugiaves'));
        }
        if (Auth::user()->role == 2) {
            return view('LichSuGiaVe.employees.index', compact('lichsugiaves'));
        }
        if (Auth::user()->role == 3) {
            return view('LichSuGiaVe.customer.index', compact('lichsugiaves'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     // if (Auth::user()->role == 1) {
    //     $loaighes = LoaiGhe::all();
    //     return view('LichSuGiaVe.admin.create', compact('loaighes'));
    //     // }
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'MaLoaiGhe' => 'required',
    //         'ThoiGianTao' => 'required',
    //         'GiaVe' => 'required',
    //     ]);
    //     LichSuGiaVe::create($request->all());
    //     return redirect()->route('lichsugiaves.index')->with('mes', 'Thêm mới thành công');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show($MaGiaVe)
    // {
    //     $lichsugiaves = LichSuGiaVe::findOrFail($MaGiaVe);
    //     if (Auth::user()->role == 1) {
    //         return view('LichSuGiaVe.admin.show', compact('lichsugiaves'));
    //     }
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit($MaGiaVe)
    // {
    //     $lichsugiave = LichSuGiaVe::find($MaGiaVe);
    //     $loaighes = LoaiGhe::all();
    //     // if (Auth::user()->role == 1) {
    //     return view('LichSuGiaVe.admin.edit', compact('lichsugiave', 'loaighes'));
    //     // }
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, $MaGiaVe)
    // {
    //     $request->validate([
    //         'MaLoaiGhe' => 'required',
    //         'ThoiGianTao' => 'required',
    //         'GiaVe' => 'required',
    //     ]);
    //     $lichsugiaves = LichSuGiaVe::find($MaGiaVe);
    //     $lichsugiaves->MaLoaiGhe = $request->input('MaLoaiGhe');
    //     $lichsugiaves->ThoiGianTao = $request->input('ThoiGianTao');
    //     $lichsugiaves->GiaVe = $request->input('GiaVe');
    //     $lichsugiaves->save();

    //     return redirect()->route('lichsugiaves.index')->with('mes', 'Cập nhật thành công!');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy($MaGiaVe)
    // {
    //     $lichsugiaves = LichSuGiaVe::findOrFail($MaGiaVe);
    //     $lichsugiaves->delete();
    //     // if (Auth::user()->role == 1) {
    //     return redirect()->route('lichsugiaves.index')->with('mes', 'Xóa thành công!');
    //     // }
    // }
}
