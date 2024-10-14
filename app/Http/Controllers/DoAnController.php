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
            'Anh' => ['required', 'max:20480', 'mimes:jpeg,jpg,png,gif'],
            'TenDoAn' => ['required', 'regex:/^[\p{L}\p{N}\s]+$/u', 'max:255'],
            'MaTheLoai' => ['required'],
            'MoTa' => ['required', 'min:50', 'regex:/^[\p{L}\p{N}\s]+$/u'],
            'Gia' => ['required', 'numeric', 'min:1000'],
            'TinhTrang' => ['required'],
        ], [
            'Anh.required' => 'Ảnh đồ ăn không được bỏ trống',
            'Anh.mimes' => 'Ảnh phải có định dạng JPG, PNG, GIF',
            'Anh.max' => 'Ảnh không vượt quá 20MB',
            'TenDoAn.required' => 'Tên đồ ăn không được bỏ trống',
            'TenDoAn.max' => 'Tên đồ ăn không quá 255 ký tự',
            'TenDoAn.regex' => 'Tên đồ ăn không chứa ký tự đặc biệt',
            'MaTheLoai.required' => 'Thể loại đồ ăn không được bỏ trống',
            'MoTa.required' => 'Mô tả đồ ăn không được bỏ trống',
            'MoTa.min' => 'Mô tả đồ ăn tối thiểu 50 ký tự',
            'MoTa.regex' => 'Mô tả đồ ăn không chứa ký tự đặc biệt',
            'Gia.required' => 'Giá đồ ăn không được bỏ trống',
            'Gia.min' => 'Giá đồ ăn tối thiểu 1000 (VND)',
            'TinhTrang.required' => 'Trạng thái đồ ăn không được bỏ trống',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $doan = new DoAn();
        $doan->MaTheLoai = $request->input('MaTheLoai');
        $doan->MoTa = $request->input('MoTa');
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
        return redirect()->route('doans.index')->with('mess_success', 'Thêm đồ ăn thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doan $doan, Request $request)
    {
        // $lichsugiadoan = LichSuGiaDoAn::where('MaDoAn', $doan->MaDoAn)->first();
        $lichsugiadoan = LichSuGiaDoAn::where('MaDoAn', $doan->MaDoAn)
            ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian giảm dần
            ->first();
        if ($doan->Anh) {
            // Nếu có ảnh, tạo URL hoặc đường dẫn đến ảnh
            $anhURL = asset($doan->Anh); // Sử dụng asset để tạo URL từ đường dẫn lưu trong cơ sở dữ liệu
        }

        if (!Auth::check()) {
            return redirect()->route('home');
        } else {
            if (Auth::user()->VaiTro == 1) {
                return view('DoAn.admin.show', compact('doan', 'lichsugiadoan', 'anhURL'));
            }
            if (Auth::user()->VaiTro == 3) {
                return view('DoAn.customer.index', compact('doan', 'lichsugiadoan', 'anhURL'));
            }
        }
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
            'TenDoAn' => ['required', 'regex:/^[\pL\s\d]+$/u', 'max:50', 'min:1'],
            'Gia' => ['required', 'numeric', 'regex:/^[^-][\d.]+$/', 'max:1000000'],
            'MaTheLoai' => ['required'],
            'Anh' => ['max:5120'],
            'TinhTrang' => ['required'],
        ], [
            'TenDoAn.required' => 'Tên đồ ăn không được bỏ trống',
            'TenDoAn.regex' => 'Vui lòng nhập đầy đủ thông tin',
            'Anh.max' => 'Kích thước file ảnh không quá 5MB',
            'TenDoAn.max' => 'Tên đồ ăn không quá 50 ký tự',
            'Gia.required' => 'Giá không được bỏ trống',
            'Gia.regex' => 'Giá không được là số âm',
            'Gia.max' => 'Giá không quá 1.000.000',
            'Gia.numeric' => 'Giá không được là số thập phân',
            'Gia.min' => 'Thêm không thành công. Vui lòng nhập đầy đủ thông tin',
            'MaTheLoai.required' => 'Vui lòng nhập đầy đủ thông tin',
        ]);
        // if (DoAn::where('TenDoAn', $request->TenDoAn)->exists()) {
        //     $validator->errors()->add('TenDoAn', 'Tên đồ ăn đã tồn tại');
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $currentItem = DoAn::find($maDoAn);
        if ($currentItem->TenDoAn != $request->TenDoAn && DoAn::where('TenDoAn', $request->TenDoAn)->exists()) {
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
            return redirect()->route('doans.index')->with('mess_success', 'Xóa thành công');
        }else{
            return redirect()->route('home');
        }
    }
}
