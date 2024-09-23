<?php

namespace App\Http\Controllers;

use App\Models\GheNgoi;
use App\Models\LichSuGiaVe;
use App\Models\LoaiGhe;
use App\Models\PhongChieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GheNgoiController extends Controller
{

    public function index()
    {
        $ghengois = GheNgoi::orderBy('MaGhe', 'desc')->get();

        return view('Ghe.admin.index', compact('ghengois'));
        // if (Auth::user()->role == 1) {
        //     return view('Ghe.admin.index', compact('ghengois'));
        // }
        // if (Auth::user()->role == 2) {
        //     return view('GheNgoi.employees.index', compact('ghengois'));
        // }
        // if (Auth::user()->role == 3) {
        //     return view('GheNgoi.customer.index', compact('ghengois'));
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phongchieus = PhongChieu::all();
        $loaighes = LoaiGhe::all();
        return view('Ghe.admin.create', compact('phongchieus', 'loaighes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ViTriDay' => ['required'],
            'ViTriCot' => ['required'],
            'MaPhong' => ['required'],
            'MaLoaiGhe' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Thêm không thành công. Vui lòng nhập đầy đủ thông tin');
        }

        $viTriDay = $request->input('ViTriDay');
        $viTriCot = $request->input('ViTriCot');
        $maPhong = $request->input('MaPhong');

        $existingGheNgoi = GheNgoi::where('ViTriDay', $viTriDay)
            ->where('ViTriCot', $viTriCot)
            ->where('MaPhong', $maPhong)
            ->exists();

        if ($existingGheNgoi) {
            return redirect()->back()->with('mess_fail', 'Ghế đã tồn tại trong phòng này');
        }

        $gheNgoi = new GheNgoi();
        $gheNgoi->ViTriDay = $viTriDay;
        $gheNgoi->ViTriCot = $viTriCot;
        $gheNgoi->MaPhong = $maPhong;
        $gheNgoi->MaLoaiGhe = $request->input('MaLoaiGhe');
        $gheNgoi->save();

        return redirect()->route('ghengois.index')->with('mes', 'Thêm mới thành công');
    }

    public function show($MaGhe)
    {
        $ghengois = GheNgoi::findOrFail($MaGhe);
        if (Auth::user()->role == 1) {
            return view('Ghe.admin.show', compact('ghengois'));
        }
    }

    public function edit($MaGhe)
    {
        $ghengoi = GheNgoi::find($MaGhe);
        $phongchieus = PhongChieu::all();
        $loaighes = LoaiGhe::all();
        return view('Ghe.admin.edit', compact('ghengoi', 'phongchieus', 'loaighes'));
    }
    public function update(Request $request, $MaGhe)
    {
        $validator = Validator::make($request->all(), [
            'ViTriDay' => ['required'],
            'ViTriCot' => ['required'],
            'MaPhong' => ['required'],
            'MaLoaiGhe' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Chỉnh sửa không thành công. Vui lòng nhập đầy đủ thông tin');
        }

        $viTriDay = $request->input('ViTriDay');
        $viTriCot = $request->input('ViTriCot');
        $maPhong = $request->input('MaPhong');

        // Kiểm tra xem vị trí dãy và vị trí cột đã tồn tại trong cùng một phòng chưa
        $existingGheNgoi = GheNgoi::where('ViTriDay', $viTriDay)
            ->where('ViTriCot', $viTriCot)
            ->where('MaPhong', $maPhong)
            ->where('MaGhe', '!=', $MaGhe) // Loại bỏ bản ghi hiện tại
            ->exists();

        if ($existingGheNgoi) {
            return redirect()->back()->with('mess_fail', 'Ghế đã tồn tại trong phòng này');
        }

        $gheNgoi = GheNgoi::find($MaGhe);
        $gheNgoi->ViTriDay = $viTriDay;
        $gheNgoi->ViTriCot = $viTriCot;
        $gheNgoi->MaPhong = $maPhong;
        $gheNgoi->MaLoaiGhe = $request->input('MaLoaiGhe');
        $gheNgoi->save();

        return redirect()->route('ghengois.index')->with('mess_success', 'Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($MaLoaiGhe)
    {
        $ghengois = GheNgoi::findOrFail($MaLoaiGhe);
        $ghengois->delete();
        return redirect()->route('ghengois.index')->with('mess_success', 'Xóa thành công!');
    }
}
