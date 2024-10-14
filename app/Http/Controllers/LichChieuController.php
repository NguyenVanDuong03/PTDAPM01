<?php

namespace App\Http\Controllers;

use App\Models\InforLichChieu;
use App\Models\LichChieu;
use App\Models\Phim;
use App\Models\PhongChieu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class LichChieuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $phongs = PhongChieu::withTrashed()->get();
        $infoLichChieus = [];
        // $thongtinPhim = [];
        $ngayDang = $request->has('NgayDang') ? $request->input('NgayDang') : now()->toDateString();
        foreach ($phongs as $phong) {
            // $thongtinphongchieu = new InforLichChieu($phong->MaPhong);
            $infoLichChieu = new InforLichChieu();
            $infoLichChieu->NgayChieu = $ngayDang;
            $infoLichChieu->MaPhong = $phong->MaPhong;

            $infoLichChieu->lichChieus = LichChieu::where('NgayChieu', '=', $ngayDang)
                ->where('MaPhong', '=', $phong->MaPhong)
                ->get();
            $infoLichChieus[] = $infoLichChieu;
        }
        return view('LichChieu.admin.index', compact('infoLichChieus', 'ngayDang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // hàm này không dùng đến
    public function create()
    {
        $phims = Phim::all();
        $phongchieus = PhongChieu::all();
        return view('LichChieu.admin.create', compact('phims', 'phongchieus'));
    }
    public function create_form(Request $request){
        $validator = Validator::make($request->all(), [
            'NgayChieu' => ['required', 'date'],
            'MaPhong' => ['required', 'exists:phongchieus,MaPhong'],
        ],
        [
            'NgayChieu.required' => 'Vui lòng chọn ngày chiếu',
            'NgayChieu.date' => 'Ngày chiếu không hợp lệ',
            'MaPhong.required' => 'Vui lòng chọn phòng chiếu',
            'MaPhong.exists' => 'Phòng chiếu không tồn tại',
        ]);
        $phims = Phim::all();
        $phongchieus = PhongChieu::all();
        //
        $NgayChieu = $request->input('NgayChieu');
        $MaPhong = $request->input('MaPhong');
        $infoLichChieu = new InforLichChieu();
        $infoLichChieu->NgayChieu = $NgayChieu;
        $infoLichChieu->MaPhong = $MaPhong;
        $infoLichChieu->LichChieus = LichChieu::where('NgayChieu', '=', $NgayChieu)
            ->where('MaPhong', '=', $MaPhong)
            ->get();
        Session::flash('bat-dau-them-lich', 'oke');
        return view('LichChieu.admin.create', compact('infoLichChieu', 'phims', 'phongchieus', 'NgayChieu', 'MaPhong'));
    }

    /**
     * Store a newly created resource in storage.
     */



    public function store(Request $request)
    {

        $MaLichChieus = $request->input('MaLichChieu');
        $NgayChieu = $request->input('NgayChieu');
        $MaPhong = $request->input('MaPhong');
        // validate
        $ListOfTimes = [];
        foreach($MaLichChieus as $key => $MaLChs){

            if($request->input('MaPhim')[$key] != -1){
                // != -1 thì là item có giá trị cần chỉnh sửa và lưu => validate nó
                $ThoiLuongPhim = Phim::where("MaPhim", $request->input('MaPhim')[$key])->first()->ThoiLuong;
                $GioChieu = $request->input('GioChieu')[$key];
                print($GioChieu);
                $GioKetThuc = InforLichChieu::addMinutesToTime($GioChieu, $ThoiLuongPhim);
                $Times = [InforLichChieu::NormalizationTimeString($GioChieu) , $GioKetThuc];
                $ListOfTimes[] = $Times;
            }
            print_r($ListOfTimes);

        }
        print(count($ListOfTimes));
        if($this->checkTimeOverlap($ListOfTimes)){
            $request->merge(['MaPhong'=> $MaPhong]);
            $request->merge(['NgayChieu'=> $NgayChieu]);
            Session::flash('error', 'Thời gian chiếu có chồng lặp, vui lòng kiểm tra lại');
            return redirect()->route('lichchieus.create_form', $request->all());
            // return redirect()->back()->withErrors(['error' => 'Thời gian chiếu có chồng lặp, vui lòng kiểm tra lại']);
        }else{
            echo 'không trùng';
        }

        if($request->has('NgayChieu')){
            // echo $NgayChieu;
            foreach ($MaLichChieus as $key => $maLCh) {
                if($maLCh != -1){
                    // nếu có mã thì lịch chiếu đã tồn tại => cần sửa lịch chiếu
                    // nếu mã phim là -1, có nghĩa là xóa lịch chiếu này, ngược lại thì sửa
                    $LichChieu = LichChieu::where('MaLichChieu', $maLCh)->first();
                    if($request->input('MaPhim')[$key] == -1){
                        $LichChieu->delete();
                    }else{
                        $LichChieu->update([
                            'MaPhim' => $request->input('MaPhim')[$key],
                            'MaPhong' => $MaPhong,
                            'NgayChieu' => $NgayChieu,
                            'GioChieu' => $request->input('GioChieu')[$key]
                        ]);
                    }
                }else{
                // nếu mã là -1 thì lịch chiếu chưa có trong db
                // kiểm tra xem phim có được chọn hay không, phim được chọn thì mới thêm
                // nếu value của phim là -1 thì là chưa được chọn

                    // if($request->input('MaPhim')[$key] != -1){
                        LichChieu::create([
                            'MaPhim' => $request->input('MaPhim')[$key],
                            'MaPhong' => $MaPhong,
                            'NgayChieu' => $NgayChieu,
                            'GioChieu' => $request->input('GioChieu')[$key]
                        ]);
                    // }
                }
            }
            return redirect()->route('lichchieus.index')->with('mes', 'Thêm lịch chiếu thành công');
        }else{
            echo 'ngay chieu null';
        }

    }



    /**
     * Display the specified resource.
     */
    public function show(LichChieu $lichChieu)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    // hàm này không dùng đến
    public function edit(Request $request)
    {

        $phims = Phim::all();
        $phongchieus = PhongChieu::all();
        //
        $NgayChieu = $request->input('NgayChieu');
        $MaPhong = $request->input('MaPhong');
        $infoLichChieu = new InforLichChieu();
        $infoLichChieu->NgayChieu = $NgayChieu;
        $infoLichChieu->MaPhong = $MaPhong;
        $infoLichChieu->LichChieus = LichChieu::where('NgayChieu', '=', $NgayChieu)
            ->where('MaPhong', '=', $MaPhong)
            ->get();
        Session::flash('bat-dau-them-lich', 'oke');
        return view('LichChieu.admin.create', compact('infoLichChieu', 'phims', 'phongchieus', 'NgayChieu', 'MaPhong'));
    }

    public function update(Request $request, LichChieu $lichChieu)
    {
        //
        $MaLichChieus = $request->input('MaLichChieu');
        $NgayChieu = $request->input('NgayChieu');
        $MaPhong = $request->input('MaPhong');
        // validate
        // $ListOfTimes = [];
        // foreach($MaLichChieus as $key => $MaLChs){

        //     if($request->input('MaPhim')[$key] != -1){
        //         // != -1 thì là item có giá trị cần chỉnh sửa và lưu => validate nó
        //         $ThoiLuongPhim = Phim::where("MaPhim", $request->input('MaPhim')[$key])->first()->ThoiLuong;
        //         $GioChieu = $request->input('GioChieu')[$key];
        //         print($GioChieu);
        //         $GioKetThuc = InforLichChieu::addMinutesToTime($GioChieu, $ThoiLuongPhim);
        //         $Times = [InforLichChieu::NormalizationTimeString($GioChieu) , $GioKetThuc];
        //         $ListOfTimes[] = $Times;
        //     }
        //     print_r($ListOfTimes);

        // }
        // print(count($ListOfTimes));
        // if($this->checkTimeOverlap($ListOfTimes)){

        //     return redirect()->back()->withErrors(['error' => 'Thời gian chiếu có chồng lặp, vui lòng kiểm tra lại']);
        //     // return redirect()->route('')->with(['error' => 'Thời gian chiếu có chồng lặp, vui lòng kiểm tra lại']);
        //     // Session::flash('bat-dau-them-lich', 'oke');
        //     // return view('LichChieu.admin.create', compact('infoLichChieu', 'phims', 'phongchieus', 'NgayChieu', 'MaPhong'));
        // }else{
        //     echo 'không trùng';
        // }

        if($request->has('NgayChieu')){
            // echo $NgayChieu;
            foreach ($MaLichChieus as $key => $maLCh) {
                if($maLCh != -1){
                    // nếu có mã thì lịch chiếu đã tồn tại => cần sửa lịch chiếu
                    // nếu mã phim là -1, có nghĩa là xóa lịch chiếu này, ngược lại thì sửa
                    $LichChieu = LichChieu::where('MaLichChieu', $maLCh)->first();
                    if($request->input('MaPhim')[$key] == -1){
                        $LichChieu->delete();
                    }else{
                        $LichChieu->update([
                            'MaPhim' => $request->input('MaPhim')[$key],
                            'MaPhong' => $MaPhong,
                            'NgayChieu' => $NgayChieu,
                            'GioChieu' => $request->input('GioChieu')[$key]
                        ]);
                    }
                }else{
                // nếu mã là -1 thì lịch chiếu chưa có trong db
                // kiểm tra xem phim có được chọn hay không, phim được chọn thì mới thêm
                // nếu value của phim là -1 thì là chưa được chọn

                    if($request->input('MaPhim')[$key] != -1){
                        LichChieu::create([
                            'MaPhim' => $request->input('MaPhim')[$key],
                            'MaPhong' => $MaPhong,
                            'NgayChieu' => $NgayChieu,
                            'GioChieu' => $request->input('GioChieu')[$key]
                        ]);
                    }
                }
            }
            return redirect()->route('lichchieus.index')->with('mes', 'Đã lưu thay dổi');
        }else{
            echo 'ngay chieu null';
        }

    }
    function checkTimeOverlap($a)
    {
        print('hàm');
        $count = count($a);
        print($count);

        for ($i = 0; $i < $count - 1; $i++) {
            $t1i = Carbon::parse($a[$i][0]);
            $t2i = Carbon::parse($a[$i][1]);
            print('for 1');
            for ($j = $i + 1; $j < $count; $j++) {
                $t1j = Carbon::parse($a[$j][0]);
                $t2j = Carbon::parse($a[$j][1]);

                if ($t1i <= $t2j && $t1j <= $t2i) {
                    // Có sự trùng lặp thời gian
                    print('trùng');
                    return true;
                }
                print('khong trung ..');
            }
        }

    // Không có chồng lấp thời gian
        return false;
    }
    // function checkTimeOverlap($a)
    // {
    //     $count = count($a);

    //     for ($i = 0; $i < $count - 1; $i++) {
    //         for ($j = $i + 1; $j < $count; $j++) {
    //             $t1i = $a[$i][0];
    //             $t2i = $a[$i][1];
    //             $t1j = $a[$j][0];
    //             $t2j = $a[$j][1];

    //             if ($t1i <= $t2j && $t1j <= $t2i) {
    //                 // Có sự trùng lặp thời gian
    //                 return true;
    //             }
    //         }
    //     }

    //     // Không có chồng lấp thời gian
    //     return false;
    // }

    // private function checkNonOverlappingItems($items)
    // {
    //     $sortedItems = array_values($items);
    //     usort($sortedItems, function ($a, $b) {
    //         return strcmp($a['start'], $b['start']);
    //     });

    //     $n = count($sortedItems);
    //     $overlappingSlots = [];

    //     for ($i = 1; $i < $n; $i++) {
    //         if ($sortedItems[$i]['start'] < $sortedItems[$i - 1]['end']) {
    //             $overlappingSlots[] = [
    //                 'Phim1' => $sortedItems[$i]['phim'],
    //                 'ThoiGian1' => $sortedItems[$i]['start'],
    //                 'Phim2' => $sortedItems[$i - 1]['phim'],
    //                 'ThoiGian2' => $sortedItems[$i - 1]['start'],
    //             ];
    //         }
    //     }

    //     return $overlappingSlots;
    // }

    public function updatecustom(Request $request)
    {
    //     $itemsFromForm = [];
    //     $deleteLichChieus = [];

    //     foreach ($request->input('MaLichChieu') as $key => $maLichChieu) {
    //         $itemsFromForm[] = [
    //             'phim' => $request->input('MaPhim')[$key],
    //             'start' => $request->input('ThoiGian')[$key],
    //             'end' => Carbon::parse($request->input('ThoiGian')[$key])->addMinutes(Phim::where('MaPhim', $request->input('MaPhim')[$key])->pluck('ThoiLuong')->first())->format('H:i'),
    //         ];

    //         // Nếu phim có giá trị là "None", thì thêm MaLichChieu vào danh sách để xóa
    //         if ($request->input('MaPhim')[$key] == 'None') {
    //             $deleteLichChieus[] = $maLichChieu;
    //         }
    //     }

    //     // Kiểm tra sự chồng chéo
    //     $overlappingSlots = $this->checkNonOverlappingItems($itemsFromForm);

    //     if (!empty($overlappingSlots)) {
    //         return redirect()->back()->withErrors(['message' => 'Thoi gian chieu bi trung.']);
    //         echo ('trung');
    //     } else {

    //         $mlchs = $request->input('MaLichChieu');
    //         foreach ($mlchs as $key => $mlch) {
    //             $lch = LichChieu::where('MaLichChieu', $mlch)->first();
    //             if ($request->input('MaPhim')[$key] == 'None') {
    //                 $lch->delete();
    //             } else {
    //                 // echo('ok');
    //                 $currentDateTime = \Carbon\Carbon::parse($lch->ThoiGianBatDau);
    //                 $newTime = \Carbon\Carbon::parse($request->input('ThoiGian')[$key]);
    //                 $currentDateTime->setTime($newTime->hour, $newTime->minute);
    //                 $lch->update([
    //                     'MaPhim' => $request->input('MaPhim')[$key],
    //                     'ThoiGianBatDau' => $currentDateTime,
    //                     'MaPhong' => $request->input('MaPhong'),
    //                 ]);
    //             }
    //         }
    //         return redirect()->route('lichchieus.index')->with('mess_success', 'Cập nhật lịch chiếu thành công');
    //     }
    }



    // public function updatecustoma(Request $request)
    // {


    //     $mlchs = $request->input('MaLichChieu');

    //     foreach ($mlchs as $key => $mlch) {
    //         $lch = LichChieu::where('MaLichChieu', $mlch)->first();

    //         if ($request->input('MaPhim')[$key] == 'None') {
    //             $lch->delete();
    //         } else {
    //             $newTime = \Carbon\Carbon::parse($request->input('ThoiGian')[$key]);
    //             echo ("<br> New time" . $newTime);

    //             $thoiLuongPhim = Phim::where('MaPhim', $request->input('MaPhim'))->pluck('ThoiLuong')->first(); // Assume ThoiLuong is stored in minutes

    //             $thoiGianBatDau = $newTime;
    //             echo ("<br>thoiGianBatDau " . $thoiGianBatDau);

    //             $khunggiochieus = LichChieu::where('MaPhong', $request->input('MaPhong'))
    //                 ->whereDate('ThoiGianBatDau', '=', date('Y-m-d', strtotime($request->input('ThoiGianBatDau'))))
    //                 ->pluck('ThoiGianBatDau');

    //             foreach ($khunggiochieus as $khunggio) {
    //                 echo ($khunggio);
    //                 echo ("<br>dgdgd");

    //                 $endTimeExistingShowtime = strtotime($khunggio) + $thoiLuongPhim * 60; // Convert thoiLuongPhim to seconds
    //                 $startTimeNewShowtime = strtotime($thoiGianBatDau);

    //                 if ($startTimeNewShowtime < $endTimeExistingShowtime && $endTimeExistingShowtime > $startTimeNewShowtime) {
    //                     echo ('trunfg gio');
    //                     // return redirect()->back()->with('mess_fail', 'Thêm không thành công. Vui lòng nhập đầy đủ thông tin');
    //                 }
    //             }
    //         }
    // }
    // }



    public function destroy(LichChieu $lichChieu)
    {
        //
    }
}
