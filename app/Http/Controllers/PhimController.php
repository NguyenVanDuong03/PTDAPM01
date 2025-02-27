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
            'ThoiLuong' => ['required', 'numeric','max:300', 'regex:/^[1-9][0-9]*$/'],
            'NgayCongChieu' => ['required', 'after_or_equal:today'],
            'TrangThai' => ['required'],
            'TomTat' => ['required', 'min:50', 'max: 1000'],
            'image' => ['required', 'mimes:jpg,png', 'max:5120'],
        ], [
            'MaTheLoai.required' => 'Tên thể loại không được bỏ trống',
            'MaNCC.required' => 'Tên nhà cung cấp không được bỏ trống',
            'TenPhim.required' => 'Tên phim không được bỏ trống',
            'TenPhim.unique' => 'Phim đã tồn tại',
            'TenPhim.max' => 'Tên phim vượt quá 100 ký tự',
            'TenPhim.regex' => 'Tên phim không được chứa ký tự đặc biệt',
            'ThoiLuong.required' => 'Thời lượng phim không được bỏ trống',
            'ThoiLuong.regex' => 'Thời lượng phim phải là số dương',
            'ThoiLuong.max' => 'Thời lượng phim quá 300 phút',
            'ThoiLuong.numeric' => 'Thời lượng phim không được chứa ký tự đặc biệt và chữ',
            'NgayCongChieu.required' => 'Ngày công chiếu không được bỏ trống',
            'NgayCongChieu.after_or_equal' => 'Ngày công chiếu không được trong quá khứ',
            'TrangThai.required' => 'Trạng thái không được bỏ trống',
            'image.required' => 'Ảnh phim không được bỏ trống',
            'image.mimes' => 'Ảnh phải có định dạng JPG, PNG.',
            'image.max' => 'Ảnh phim vượt quá 5MB',
            'TomTat.required' => 'Tóm tắt không được bỏ trống',
            'TomTat.min' => 'Tóm tắt phim không đủ 50 ký tự',
            'TomTat.max' => 'Tóm tắt phim vượt quá 1000 ký tự'
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
        $phim->MoTa = $request->input('TomTat');

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
