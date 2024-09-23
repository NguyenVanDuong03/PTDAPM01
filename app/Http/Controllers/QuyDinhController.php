<?php

namespace App\Http\Controllers;

use App\Models\QuyDinh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuyDinhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quydinhs = QuyDinh::orderBy('MaQuyDinh', 'desc')->get();
        if (!Auth::check()) {
            return redirect()->route('login');
        } else {
            if (Auth::user()->VaiTro == 1) {
                return view('QuyDinh.admin.index', compact('quydinhs'));
            }
            if (Auth::user()->VaiTro == 2) {
                return view('QuyDinh.employees.index', compact('quydinhs'));
            }
            if (Auth::user()->VaiTro == 3) {
                return view('QuyDinh.customer.index', compact('quydinhs'));
            }
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('QuyDinh.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TieuDe' => ['required'],
            'NoiDung' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', 'Vui lòng nhập đầy đủ thông tin');
        }
        $tenQuyDinh = $request->input('TieuDe');
        if (QuyDinh::where('TieuDe', $tenQuyDinh)->exists()) {
            return redirect()->back()->with('mess_fail', 'Quy định đã tồn tại');
        }

        QuyDinh::create([
            'TieuDe' => $request->input('TieuDe'),
            'NoiDung' => $request->input('NoiDung'),
        ]);

        return redirect()->route('quydinhs.index')->with('mess_success', 'Thêm mới thành công.');
    }
    public function show($MaQuyDinh)
    {
        $quydinh = QuyDinh::findOrFail($MaQuyDinh);
        return view('QuyDinh.admin.show', compact('quydinh'));
    }

    public function edit($MaQuyDinh)
    {
        $quydinh = QuyDinh::find($MaQuyDinh);
        return view('QuyDinh.admin.edit', compact('quydinh'));
    }

    public function update(Request $request, $MaQuyDinh)
    {
        $validator = Validator::make($request->all(), [
            'TieuDe' => ['required'],
            'NoiDung' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('mess_fail', ' Vui lòng nhập đầy đủ thông tin');
        }

        $tenQuyDinh = $request->input('TieuDe');

        $existingQuyDinh = QuyDinh::where('TieuDe', $tenQuyDinh)
            ->where('MaQuyDinh', '!=', $MaQuyDinh)
            ->exists();

        if ($existingQuyDinh) {
            return redirect()->back()->with('mess_fail', 'Quy định đã tồn tại!');
        }

        $quydinhs = QuyDinh::find($MaQuyDinh);
        $quydinhs->TieuDe = $request->input('TieuDe');
        $quydinhs->NoiDung = $request->input('NoiDung');
        $quydinhs->save();

        return redirect()->route('quydinhs.index')->with('mess_success', 'Chỉnh sửa thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($MaQuyDinh)
    {
        $quydinhs = QuyDinh::findOrFail($MaQuyDinh);
        $quydinhs->delete();
        return redirect()->route('quydinhs.index')->with('mess_success', 'Xoá thành công.');
    }
}
