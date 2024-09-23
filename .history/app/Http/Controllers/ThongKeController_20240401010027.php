<?php

namespace App\Http\Controllers;

use App\Models\ThongKe;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $start_day = $request->has('start_day') ? $request->input('start_day') : now()->toDateString();
        $end_day = $request->has('end_day') ? $request->input('end_day') : now()->toDateString();

        $soluong = 0;

        if ($request->input('kieuthongke') === 'sokhach') {
            // $soluong = ThongKe::thongKeByDay($start_day, $end_day);
            $soluong = 10;
        }

        return view('ThongKe.index', compact('soluong', 'start_day', 'end_day'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ThongKe $thongKe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ThongKe $thongKe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ThongKe $thongKe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThongKe $thongKe)
    {
        //
    }
}
