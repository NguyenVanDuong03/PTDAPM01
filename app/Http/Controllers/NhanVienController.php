<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\Phim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class NhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(){
        $phimDangChieus = Phim::where('TrangThai', 'Đang chiếu')->get();
        $phimSapChieus = Phim::where('TrangThai', 'Sắp chiếu')->get();
        return view('nhan-vien.employee.home', compact('phimDangChieus', 'phimSapChieus'));
    }
    public function index()
    {
        //
        $nhanViens = NhanVien::all();
        return view('nhan-vien.admin.index', compact('nhanViens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('nhan-vien.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // validate
        $validator = Validator::make($request->all(), [
            'email' => ['required','max:50', 'email'],
            'TenNhanVien' => ['required','max:50'],
            'NgaySinh' => ['required'],
            'GioiTinh' => ['required'],
            'DiaChi' => ['required', 'max:50'],
            'NgayVaoLam' => ['required', 'date'],
            'ViTri' => ['required'],
            'SDT' => ['required', 'regex:/^0\d{9}$/'],
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.max' => 'email quá dài',
            'email.email' => 'email không hợp lệ',

            'TenNhanVien.required' => 'Vui lòng nhập tên nhân viên',
            'TenNhanVien.max' => 'Tên nhân viên quá dài',

            'NgaySinh.required' => 'Vui lòng chọn ngày sinh',

            'GioiTinh.required' => 'Vui lòng chọn giới tính',

            'DiaChi.required' => 'Vui lòng nhập địa chỉ',
            'DiaChi.max' => 'Địa chỉ không quá 50 ký tự',

            'NgayVaoLam.required' => 'Vui lòng chọn ngày vào làm',
            'NgayVaoLam.date' => 'Ngày vào làm không hợp lệ',

            'ViTri.required' => 'Vui lòng chọn chức vụ',

            'SDT.required' => 'Vui lòng nhập số điện thoại',
            'SDT.regex' => 'Số điện thoại không hợp lệ',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không trùng khớp',

        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // success
        
        User::create([
            'email' => $request->email,
            'VaiTro' => 2,
            'password' => Hash::make($request->password)
        ]);
        NhanVien::create([
            'TenDangNhapNV' => $request->email,
            'TenNhanVien' => $request->TenNhanVien,
            'NgaySinh' => $request->NgaySinh,
            'GioiTinh' => $request->GioiTinh,
            'DiaChi' => $request->DiaChi,
            'NgayVaoLam' =>$request->NgayVaoLam,
            'ViTri' =>$request->ViTri,
            'SDT' =>$request->SDT,
            'Gmail' => $request->email,
        ]);
        return redirect()->route('nhanviens.index')->with('mes', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(NhanVien $nhanvien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NhanVien $nhanvien)
    {
        //
        return view('nhan-vien.admin.edit')->with('nhanvien', $nhanvien);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NhanVien $nhanvien)
    {
        //
        $validator = Validator::make($request->all(), [
            'email' => ['required','max:50', 'email'],
            'TenNhanVien' => ['required','max:50'],
            'NgaySinh' => ['required'],
            'GioiTinh' => ['required'],
            'DiaChi' => ['required', 'max:50'],
            'NgayVaoLam' => ['required', 'date'],
            'ViTri' => ['required'],
            'SDT' => ['required', 'regex:/^0\d{9}$/'],
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.max' => 'email quá dài',
            'email.email' => 'email không hợp lệ',

            'TenNhanVien.required' => 'Vui lòng nhập tên nhân viên',
            'TenNhanVien.max' => 'Tên nhân viên quá dài',

            'NgaySinh.required' => 'Vui lòng chọn ngày sinh',

            'GioiTinh.required' => 'Vui lòng chọn giới tính',

            'DiaChi.required' => 'Vui lòng nhập địa chỉ',
            'DiaChi.max' => 'Địa chỉ không quá 50 ký tự',

            'NgayVaoLam.required' => 'Vui lòng chọn ngày vào làm',
            'NgayVaoLam.date' => 'Ngày vào làm không hợp lệ',

            'ViTri.required' => 'Vui lòng chọn chức vụ',

            'SDT.required' => 'Vui lòng nhập số điện thoại',
            'SDT.regex' => 'Số điện thoại không hợp lệ',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không trùng khớp',

        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // success
        $taikhoan = User::where('email', $nhanvien->email);
        $taikhoan->update([
            'email' => $request->email,
            'VaiTro' => 2,
            'password' => Hash::make($request->password)
        ]);
        $nhanvien->update([
            'TenDangNhapNV' => $request->email,
            'TenNhanVien' => $request->TenNhanVien,
            'NgaySinh' => $request->NgaySinh,
            'GioiTinh' => $request->GioiTinh,
            'DiaChi' => $request->DiaChi,
            'NgayVaoLam' =>$request->NgayVaoLam,
            'ViTri' =>$request->ViTri,
            'SDT' =>$request->SDT,
            'Gmail' => $request->email,
        ]);
        return redirect()->route('nhanviens.index')->with('mes', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NhanVien $nhanvien)
    {
        //
        $nhanvien->delete();
        return redirect()->route('nhanviens.index')->with('mes', 'Xóa thành công!');
    }
    public function search(Request $request){
        $name = $request->name;

        $nhanViens = DB::table('nhan_viens')
        ->where('TenNhanVien', 'LIKE', '%' . $name . '%')
        ->get();
        return view('nhan-vien.admin.index', compact('nhanViens'));
    }
}
