<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\TinTuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class TinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tintucs = TinTuc::all()->sortByDesc('MaTinTuc');
        if (!Auth::check()) {
            return redirect()->route('home');
        } else {
            if (Auth::user()->VaiTro == 1) {
                return view('TinTuc.admin_employee.index', compact('tintucs'));
            }
            if (Auth::user()->VaiTro == 2) {
                return view('TinTuc.admin_employee.index', compact('tintucs'));
            }
            if (Auth::user()->VaiTro == 3) {
                return view('TinTuc.customer.index', compact('tintucs'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nhanviens = NhanVien::all();
        if (Auth::user()->VaiTro == 2 || Auth::user()->VaiTro == 1) {
            return view('TinTuc.admin_employee.create', compact('nhanviens'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TenSuKien' => ['required', 'max: 40', 'regex:/^[\pL\s\d]+$/u'],
            'TomTat' => ['required', 'max: 300'],
            'NgayDang' => ['required'],
            'TenDangNhapNV' => ['required', Rule::exists('nhan_viens', 'TenDangNhapNV')],
            'NoiDung' => ['required', 'max: 1000'],
            'Anh' => ['required', 'max:5120'],
        ], [
            'TenSuKien.required' => 'Tên sự kiện không được bỏ trống',
            'TenSuKien.max' => 'Tên sự kiện không quá 40 từ',
            'TenSuKien.regex' => 'Vui lòng kiểm tra lại thông tin',
            'TomTat.required' => 'Tóm tắt không được bỏ trống',
            'TomTat.max' => 'Tóm tắt không quá 300 ký tự',
            'NgayDang.required' => 'Ngày đăng không được bỏ trống',
            'NoiDung.required' => 'Nội dung không được bỏ trống',
            'NoiDung.max' => 'Nội dung không quá 1000 ký tự',
            'Anh.required' => 'Ảnh tin tức không được bỏ trống',
            'TenDangNhapNV.exists' => 'Tên đăng nhập nhân viên không tồn tại',
            'TenDangNhapNV.required' => 'Tên đăng nhập nhân viên không được bỏ trống',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $tintuc = new TinTuc();
        $tintuc->TenSuKien = $request->input('TenSuKien');
        $tintuc->TomTat = $request->input('TomTat');
        $tintuc->NgayDang = $request->input('NgayDang');
        $tintuc->TenDangNhapNV = $request->input('TenDangNhapNV');
        $tintuc->NoiDung = $request->input('NoiDung');
        if ($request->hasFile('Anh')) {
            $image = $request->file('Anh');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Anh'), $imageName);
            $tintuc->Anh = 'Anh/' . $imageName;
        }
        $tintuc->save();

        return redirect()->route('tintucs.index')->with('mess_success', 'Thêm thành công');
    }


    /**
     * Display the specified resource.
     */
    public function show(TinTuc $tinTuc, Request $request)
    {
        echo ("hsdf");

        if ($tinTuc->Anh) {
            // Nếu có ảnh, tạo URL hoặc đường dẫn đến ảnh
            $anhURL = asset($tinTuc->Anh); // Sử dụng asset để tạo URL từ đường dẫn lưu trong cơ sở dữ liệu
        }else{
            echo("hsdf");
            // return view('TinTuc.admin_employee.show', compact('tinTuc'));
        }
        $
        if (!Auth::check()) {
            return redirect()->route('home');
        } else {
            if (Auth::user()->VaiTro == 1) {
                return view('TinTuc.admin_employee.show', compact('tinTuc', 'anhURL'));
            }
            if (Auth::user()->VaiTro == 3) {
                return view('TinTuc.customer.index', compact('tinTuc', 'anhURL'));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TinTuc $tintuc)
    {
        $anhURL = null;
        if ($tintuc->Anh) {
            // Nếu có ảnh, tạo URL hoặc đường dẫn đến ảnh
            $anhURL = asset($tintuc->Anh); // Sử dụng asset để tạo URL từ đường dẫn lưu trong cơ sở dữ liệu
        }
        return view('TinTuc.admin_employee.edit', compact('tintuc', 'anhURL'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TinTuc $tintuc)
    {
        $validator = Validator::make($request->all(), [
            'TenSuKien' => ['required', 'max: 40', 'regex:/^[\pL\s\d]+$/u'],
            'TomTat' => ['required', 'max: 300'],
            'NgayDang' => ['required'],
            'TenDangNhapNV' => ['required', 'regex:/^[\pL\s\d.@]+$/u', Rule::exists('nhan_viens', 'TenDangNhapNV')],
            'NoiDung' => ['required', 'max: 1000'],
        ], [
            'TenSuKien.required' => 'Tên sự kiện không được bỏ trống',
            'TenSuKien.max' => 'Tên sự kiện không quá 40 từ',
            'TenSuKien.regex' => 'Vui lòng kiểm tra lại thông tin',
            'TomTat.required' => 'Tóm tắt không được bỏ trống',
            'TomTat.max' => 'Tóm tắt không quá 300 ký tự',
            'NgayDang.required' => 'Ngày đăng không được bỏ trống',
            'NoiDung.required' => 'Nội dung không được bỏ trống',
            'NoiDung.max' => 'Nội dung không quá 1000 ký tự',
            'TenDangNhapNV.regex' => 'Vui lòng kiểm tra lại thông tin',
            'TenDangNhapNV.exists' => 'Tên đăng nhập nhân viên không tồn tại',
            'TenDangNhapNV.required' => 'Tên đăng nhập nhân viên không được bỏ trống',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // if ($validator->fails()) {
        //     return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        // }
        if ($request->hasFile('Anh')) {
            $image = $request->file('Anh');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Anh'), $imageName);
            $tintuc->Anh = 'Anh/' . $imageName;
        }
        $tintuc->update($request->all());
        return redirect()->route('tintucs.index')->with('mess_success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TinTuc $tintuc)
    {
        $tintuc->delete();
        return redirect()->route('tintucs.index')->with('mess_success', 'Xóa thành công');
    }
}
