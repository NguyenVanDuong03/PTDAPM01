<?php

namespace App\Http\Controllers;

use App\Models\DoAn;
use App\Models\LichSuGiaDoAn;
use App\Models\LoaiDoAn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DoAnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $doans = DoAn::all()->sortByDesc('MaDoAn');
        if (!Auth::check()) {
            return redirect()->route('home');
        } else {
            if (Auth::user()->VaiTro == 1) {
                return view('DoAn.admin.index', compact('doans'));
            }
            if (Auth::user()->VaiTro == 3) {
                return view('DoAn.customer.index', compact('doans'));
            }
        }
    }

    public function create()
    {
        $loaidoans = LoaiDoAn::all();
        $doans = DoAn::all();
        if (Auth::user()->VaiTro == 1) {
            return view('DoAn.admin.create', compact('loaidoans', 'doans'));
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'TenDoAn' => ['required', 'regex:/^[\pL\s\d]+$/u', 'max:50'],
            'Gia' => ['required', 'numeric'],
            'MaTheLoai' => ['required'],
            'Anh' => ['required', 'max:5120'],
            'TinhTrang' => ['required'],
        ], [
            'TenDoAn.required' => 'Tên đồ ăn không được bỏ trống',
            'TenDoAn.regex' => 'Vui lòng nhập đầy đủ thông tin',
            'Anh.required' => 'Vui lòng nhập đầy đủ thông tin',
            'Anh.reqmãuired' => 'Vui lòng nhập đầy đủ thông tin',
            'TenDoAn.max' => 'Tên đồ ăn không quá 50 ký tự',
            'Gia.required' => 'Vui lòng nhập giá đồ ăn.',
            'MaTheLoai.required' => 'Vui lòng nhập đầy đủ thông tin',
        ]);
        if (DoAn::where('TenDoAn', $request->TenDoAn)->exists()) {
            $validator->errors()->add('TenDoAn', 'Tên đồ ăn đã tồn tại');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->input('MaTheLoai') === "none" || $request->input('TinhTrang') === "none") {
            // $validator->errors()->add('MaTheLoai', 'Vui lòng nhập đầy đủ thông tin');
            // return redirect()->back()->withErrors($validator)->withInput();
            return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        }



        // $doan = DoAn::create($request->all());
        $doan = new DoAn();
        $doan->MaTheLoai = $request->input('MaTheLoai');
        $doan->TenDoAn = $request->input('TenDoAn');
        $doan->TinhTrang = $request->input('TinhTrang');

        if ($request->hasFile('Anh')) {
            $image = $request->file('Anh');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Anh'), $imageName);
            $doan->Anh = 'Anh/' . $imageName;
        }
        $doan->save();
        $lichsugia = new LichSuGiaDoAn();
        $lichsugia->MaDoAn = $doan->MaDoAn;
        $lichsugia->ThoiGianTao = now();
        $lichsugia->Gia = $request->input('Gia');
        $lichsugia->save();
        return redirect()->route('doans.index')->with('mess_success', 'Thêm thành công.');
        // // echo ("kkkkkkkkkkkkk");
    }

    /**
     * Display the specified resource.
     */
    public function show(Doan $doan, Request $request)
    {
        $lichsugiadoan = LichSuGiaDoAn::where('MaDoAn', $doan->MaDoAn)->first();
        if ($doan->Anh) {
            // Nếu có ảnh, tạo URL hoặc đường dẫn đến ảnh
            $anhURL = asset($doan->Anh); // Sử dụng asset để tạo URL từ đường dẫn lưu trong cơ sở dữ liệu
        }
        return view('DoAn.admin.show', compact('doan', 'lichsugiadoan', 'anhURL'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoAn $doan)
    {
        $anhURL = null;
        $loaidoans = LoaiDoAn::all();
        $lichsugia = LichSuGiaDoAn::where('MaDoAn', $doan->MaDoAn)->first();
        if ($doan->Anh) {
            // Nếu có ảnh, tạo URL hoặc đường dẫn đến ảnh
            $anhURL = asset($doan->Anh); // Sử dụng asset để tạo URL từ đường dẫn lưu trong cơ sở dữ liệu
        }
        if (Auth::user()->VaiTro == 1) {
            return view('DoAn.admin.edit', compact('loaidoans', 'doan', 'anhURL', 'lichsugia'));
        }
    }

    public function update(Request $request, $maDoAn)
    {
        $validator = Validator::make($request->all(), [
            'TenDoAn' => ['required'],
            'Gia' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        }
        $doan = DoAn::where('MaDoAn', $maDoAn)->first();
        $doan->MaTheLoai = $request->input('MaTheLoai');
        $doan->TenDoAn = $request->input('TenDoAn');
        $doan->TinhTrang = $request->input('TinhTrang');

        if ($request->hasFile('Anh')) {
            $image = $request->file('Anh');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Anh'), $imageName);
            $doan->Anh = 'Anh/' . $imageName;
        }
        $doan->save();

        $giaCu = LichSuGiaDoAn::where('MaDoAn', $maDoAn)->latest()->first();

        // Kiểm tra nếu giá mới khác giá cũ
        if ($request->input('Gia') != $giaCu->Gia) {
            // Tạo bản ghi mới trong bảng LichSuGia
            $lichsugia = new LichSuGiaDoAn();
            $lichsugia->MaDoAn = $maDoAn;
            $lichsugia->ThoiGianTao = now();
            $lichsugia->Gia = $request->input('Gia');
            $lichsugia->save();
        }

        return redirect()->route('doans.index')->with('mess_success', 'Sửa thành công ');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($maDoAn)
    {
        $doan = DoAn::where('MaDoAn', $maDoAn)->first();
        $doan->delete();
        if (Auth::user()->VaiTro == 1) {
            return redirect()->route('doans.index')->with('mess_success', 'Xóa đồ ăn thành công');
        }
    }
}
