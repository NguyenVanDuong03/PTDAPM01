<?php

namespace App\Http\Controllers;

use App\Models\NhaCungCap;
use App\Models\Phim;
use App\Models\TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PhimController extends Controller
{

    public function index()
    {
        $phims = Phim::orderBy('MaPhim', 'desc')->get();
        // if (Auth::user()->role == 1) {
        //     return view('Phim.admin.index', compact('phims'));
        // }
        // if (Auth::user()->role == 2) {
        //     return view('Phim.employees.index', compact('phims'));
        // }
        // if (Auth::user()->role == 3) {
        //     return view('Phim.customer.index', compact('phims'));
        // }
        return  view('Phim.admin.index', compact('phims'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $theloais = TheLoai::all();
        $nhacungcaps = NhaCungCap::all();
        return view('Phim.admin.create', compact('theloais', 'nhacungcaps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'MaTheLoai' => ['required'],
            'MaNCC' => ['required'],
            'TenPhim' => ['required', 'unique:phims,TenPhim', 'max:100', 'regex:/^[\p{L}\p{N}\s]+$/u'],
            'ThoiLuong' => ['required', 'max:300', 'regex:/^[1-9][0-9]*$/'],
            'NgayCongChieu' => ['required', 'date'],
            'image' => ['required', 'mimes:jpeg,png', 'max:5120'],
            'TrangThai' => ['required'],
            'TomTat' => ['required', 'min:50', 'max: 1000'],
        ], [
            'MaTheLoai.required' => '',
            'MaNCC.required' => '',
            'TenPhim.required' => '',
            'TenPhim.unique' => '',
            'TenPhim.max' => '',
            'TenPhim.regex' => '',
            'ThoiLuong.required' => '',
            'ThoiLuong.regex' => '',
            'ThoiLuong.max' => '',
            'NgayCongChieu.required' => '',
            'TrangThai.required' => '',
            'image.required' => '',
            'image.mimes' => '',
            'image.max' => '',
            'TomTat.required' => '',
            'TomTat.min' => '',
            'TomTat.max' => ''
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $phim = new Phim();
        $phim->MaTheLoai = $request->input('MaTheLoai');
        $phim->MaNCC = $request->input('MaNCC');
        $phim->TenPhim = $request->input('TenPhim');
        $phim->ThoiLuong = $request->input('ThoiLuong');
        $phim->NgayCongChieu = $request->input('NgayCongChieu');
        $phim->TrangThai = $request->input('TrangThai');
        $phim->TomTat = $request->input('TomTat');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $phim->DuongDan = 'images/' . $imageName;
        }
        $phim->save();

        return redirect()->route('phims.index')->with('mess_success', 'Thêm phim thành công');
    }

    public function checkDuplicate(Request $request)
    {
        $filmName = $request->input('TenPhim');
        $isDuplicate = Phim::where('TenPhim', $filmName)->exists();

        return response()->json(['isDuplicate' => $isDuplicate]);
    }

    /**
     * Display the specified resource.
     */
    public function show($MaPhim)
    {
        $phim = Phim::findOrFail($MaPhim);
        $nhacungcaps = NhaCungCap::all();
        $theloais = TheLoai::all();
        return view('Phim.admin.show', compact('phim', 'nhacungcaps', 'theloais'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($MaPhim)
    {
        $phim = Phim::find($MaPhim);
        $theloais = TheLoai::all();
        $nhacungcaps = NhaCungCap::all();
        return view('Phim.admin.edit', compact('phim', 'theloais', 'nhacungcaps'));
    }

    public function update(Request $request, $MaPhim)
    {
        $validator = Validator::make($request->all(), [
            'MaTheLoai' => ['required'],
            'MaNCC' => ['required'],
            'TenPhim' => ['required'],
            'ThoiLuong' => ['required'],
            'NgayCongChieu' => ['required', 'date'],
            'TrangThai' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Chỉnh sửa không thành công. Vui lòng nhập đầy đủ thông tin');
        }
        $tenPhim = $request->input('TenPhim');

        $existingPhim = Phim::where('TenPhim', $tenPhim)
            ->where('MaPhim', '!=', $MaPhim)
            ->exists();

        if ($existingPhim) {
            return redirect()->back()->with('mess_fail', 'Phim đã tồn tại!');
        }
        $phim = Phim::find($MaPhim);
        $phim->MaTheLoai = $request->input('MaTheLoai');
        $phim->MaNCC = $request->input('MaNCC');
        $phim->TenPhim = $request->input('TenPhim');
        $phim->ThoiLuong = $request->input('ThoiLuong');
        $phim->NgayCongChieu = $request->input('NgayCongChieu');
        $phim->TrangThai = $request->input('TrangThai');
        $phim->TomTat = $request->input('TomTat');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $phim->DuongDan = 'images/' . $imageName;
        }
        $phim->save();
        return redirect()->route('phims.index')->with('mess_success', 'Chỉnh sửa thành công.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($MaPhim)
    {
        $Phim = Phim::findOrFail($MaPhim);
        $Phim->delete();

        return redirect()->route('phims.index')->with('mess_success', 'Xoá thành công.');
    }
}
