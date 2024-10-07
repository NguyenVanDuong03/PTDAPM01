<?php

namespace App\Http\Controllers;

use App\Models\LoaiPhong;
use App\Models\PhongChieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Spatie\Ignition\Contracts\Solution;

class PhongChieuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phongchieus = PhongChieu::all();
        if (!Auth::check()) {
            return redirect()->route('home');
        } else {
            if (Auth::user()->VaiTro == 1) {
                return view('PhongChieu.admin.index', compact('phongchieus'));
            }
            if (Auth::user()->VaiTro == 3) {
                return view('PhongChieu.customer.index', compact('phongchieus'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loaiphongs = LoaiPhong::all();
        if (Auth::user()->VaiTro == 1) {
            return view('PhongChieu.admin.create', compact('loaiphongs'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TenPhong' => ['required', 'unique:phong_chieus,TenPhong', 'max:20', 'regex:/^[\p{L}\p{N}\s]+$/u'],
            'SoLuongGhe' => ['required', 'numeric', 'max:50', 'regex:/^[1-9][0-9]*$/'],
            'TinhTrang' => ['required'],
            'LoaiPhong' => ['required'],
        ], [
            // 'SoLuongGhe.min' => 'Thêm không thành công. Vui lòng nhập đầy đủ thông tin',
            'TenPhong.required' => '',
            'TenPhong.unique' => '',
            'TenPhong.max' => '',
            'TenPhong.regex' => '',
            'SoLuongGhe.max' => '',
            'SoLuongGhe.required' => '',
            'SoLuongGhe.numeric' => '',
            'SoLuongGhe.regex' => '',
            'TinhTrang.required' => '',
            'LoaiPhong.required' => '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // if ($request->input('TinhTrang') === "none") {
        //     return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        // }


        PhongChieu::create([
            'TenPhong' => $request->input('TenPhong'),
            'SoLuongGhe' => $request->input('SoLuongGhe'),
            'TinhTrang' => $request->input('TinhTrang'),
            'MaLoaiPhong' => $request->input('LoaiPhong'),
        ]);
        return redirect()->route('phongchieus.index')->with('mess_success', 'Thêm phòng thành công');
    }

    function checkDuplicate(Request $request)
    {
        $TenPhong = $request->input('TenPhong');
        $isDuplicate = PhongChieu::where('TenPhong', $TenPhong)->exists();

        return response()->json(['isDublicate' => $isDuplicate]);
    }

    public function show(PhongChieu $phongChieu)
    {
        //
    }

    public function edit(PhongChieu $phongchieu)
    {
        //
        return view('PhongChieu.admin.edit', compact('phongchieu'));
    }


    public function update(Request $request, PhongChieu $phongchieu)
    {

        $validator = Validator::make($request->all(), [
            'SoLuongGhe' => ['required'],
            'TinhTrang' => ['required'],
            // 'TenPhong' => ['TenPhong'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        }

        $phongchieu->update($request->all());
        return redirect()->route('phongchieus.index')->with('mess_success', ' Sửa thành công');
    }

    public function destroy(PhongChieu $phongchieu, Request $request)
    {
        $phongchieu->delete();
        if (Auth::user()->VaiTro == 1) {
            return redirect()->route('phongchieus.index')->with('mess_success', 'Xóa thành công!');
        } else {
            return redirect()->route('home');
        }
    }
}
