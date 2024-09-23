<?php

namespace App\Http\Controllers;

use App\Models\TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TheLoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $theloais = TheLoai::orderBy('MaTheLoai', 'desc')->get();
        if(!Auth::check()){
            return redirect()->route('login');
        }else if(Auth::user()->VaiTro == 1){
            return view('TheLoaiPhim.admin.index', compact('theloais'));
        }else{
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('TheLoaiPhim.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TenTheLoai' => ['required'],
            'MoTa' => ['nullable'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Thêm không thành công. Vui lòng nhập đầy đủ thông tin');
        }
        $tenTheloai = $request->input('TenTheLoai');
        if (TheLoai::where('TenTheLoai', $tenTheloai)->exists()) {
            return redirect()->back()->with('mess_fail', 'Thể loại phim đã tồn tại!');
        }
        TheLoai::create([
            'TenTheLoai' => $request->input('TenTheLoai'),
            'MoTa' => $request->input('MoTa'),
        ]);

        return redirect()->route('theloais.index')->with('mess_success', 'Thêm mới thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($MaTheLoai)
    {
        $theloais = TheLoai::findOrFail($MaTheLoai);
        return view('TheLoaiPhim.admin.show', compact('theloais'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($MaTheLoai)
    {
        $theloai = TheLoai::find($MaTheLoai);
        return view('TheLoaiPhim.admin.edit', compact('theloai'));
    }

    public function update(Request $request, $MaTheLoai)
    {
        $validator = Validator::make($request->all(), [
            'TenTheLoai' => ['required'],
            'MoTa' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Chỉnh sửa không thành công. Vui lòng nhập đầy đủ thông tin');
        }

        $tenTheloai = $request->input('TenTheLoai');

        $existingTheLoai = TheLoai::where('TenTheLoai', $tenTheloai)
            ->where('MaTheLoai', '!=', $MaTheLoai) 
            ->exists();

        if ($existingTheLoai) {
            return redirect()->back()->with('mess_fail', 'Thể loại phim đã tồn tại!');
        }

        $theloais = TheLoai::find($MaTheLoai);
        $theloais->TenTheLoai = $request->input('TenTheLoai');
        $theloais->MoTa = $request->input('MoTa');
        $theloais->save();

        return redirect()->route('theloais.index')->with('mess_success', 'Chỉnh sửa thành công.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($MaTheLoai)
    {
        $theloais = TheLoai::findOrFail($MaTheLoai);
        $theloais->delete();
        return redirect()->route('theloais.index')->with('mess_success', 'Xoá thành công.');
    }
}
