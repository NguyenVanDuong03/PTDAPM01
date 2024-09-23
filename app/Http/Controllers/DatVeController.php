<?php

namespace App\Http\Controllers;

use App\Models\DatVe;
use App\Models\DoAn;
use App\Models\GheNgoi;
use App\Models\HoaDon;
use App\Models\HoaDon_DoAn;
use App\Models\LichChieu;
use App\Models\Phim;
use App\Models\Ve;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DatVeController extends Controller
{
    //
    public function index(){
        
        return view('DatVe.customer.ChonCho');
    }
    public function test(Request $request){
        
        $var = Session::get('var');
        echo $var;
    }
    public function hienThoiGian(Request $request){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $VaiTro = Auth::user()->VaiTro;
        if($VaiTro == 1){
            $VaiTro = 'admin';
        }else if($VaiTro == 2){
            $VaiTro = 'employee';
        }else{
            $VaiTro = 'customer';
        }
        $MaPhim = $request->input('MaPhim');
        // lưu tên phim và thời lượng vào session để hiển thị thông tin lên view.
        $Phim = Phim::where('MaPhim', $MaPhim)->first();
        Session::put('TenPhim', $Phim->TenPhim);
        Session::put('ThoiLuong', $Phim->ThoiLuong);
        //
        Session::put('MaPhim', $MaPhim);
        $NgayChieus = DB::table('lich_chieus')
            ->select('NgayChieu')
            ->where('MaPhim', $MaPhim)
            ->where('NgayChieu', '>=', Carbon::now()->format('Y-m-d'))
            ->groupBy('NgayChieu')
            ->get(); // khi select như thế này thì kết quả trả về là một mảng std object, lấy giá trị thì cần truy cập theo thuộc tính
        if(count($NgayChieus) > 0){
            $NgayChieu = $NgayChieus[0]->NgayChieu;
            // print_r ($NgayChieu->NgayChieu);
            if($request->has('NgayChieu'))
                $NgayChieu = $request->input('NgayChieu');
            $GioChieus = DB::table('lich_chieus')
                ->select('GioChieu')
                ->where('NgayChieu', $NgayChieu)
                ->where('MaPhim', $MaPhim)
                ->groupBy('GioChieu')
                ->get();
            return view('DatVe.'.$VaiTro.'.ChonThoiGian', compact('NgayChieus','NgayChieu', 'GioChieus', 'Phim'));
        }else{
            echo 'Phim này hiện chưa được chiếu, quý zị thông cảm nhaaaaaaaaaa! '.$MaPhim;
        }
        
    }
    public function hienThongTinPhong(Request $request){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $VaiTro = Auth::user()->VaiTro;
        if($VaiTro == 1){
            $VaiTro = 'admin';
        }else if($VaiTro == 2){
            $VaiTro = 'employee';
        }else{
            $VaiTro = 'customer';
        }
        // lấy thông tin và lưu lại vào session
        $NgayChieu = $request->input('NgayChieu');
        $GioChieu = $request->input('GioChieu');
        
        Session::put('NgayChieu', $NgayChieu);
        Session::put('GioChieu', $GioChieu);
        // lấy phòng chiếu có nhiều ghế trống nhất
        $MaPhim = Session::get('MaPhim');
        $Phim = Phim::where('MaPhim', $MaPhim)->first();
        $ThoiLuongPhim = Phim::where('MaPhim', $MaPhim)->first()->ThoiLuong;
        $ThoiGianKetThuc = Carbon::createFromFormat('H:i:s', $GioChieu)->addMinutes($ThoiLuongPhim)->format('H:i:s');
        // echo 'ngày chiếu: '.$NgayChieu.', giờ chiếu: '.$GioChieu.', thời lượng: '.$ThoiLuongPhim.', thời gian kết thúc: '.$ThoiGianKetThuc.' - ';
        
        
        // $result = DB::table('phong_chieus')
        //     ->select('phong_chieus.MaPhong', DB::raw('COUNT(ghe_ngois.MaGhe) as SoLuong'))
        //     ->join('ghe_ngois', 'phong_chieus.MaPhong', '=', 'ghe_ngois.MaPhong')
        //     ->join('lich_chieus', 'phong_chieus.MaPhong', '=', 'lich_chieus.MaPhong')
        //     ->where('lich_chieus.MaPhim', $MaPhim)
        //     ->where('lich_chieus.NgayChieu', $NgayChieu)
        //     ->where('lich_chieus.GioChieu', $GioChieu)
        //     ->whereRaw('checkIfGheIsEmpty(?,?,?, ghe_ngois.MaGhe) = ?', [$NgayChieu, $GioChieu, $ThoiGianKetThuc, true])
        //     ->groupBy('phong_chieus.MaPhong')
        //     ->orderByDesc('SoLuong')
        //     ->limit(1)
        //     ->get();

        $result = DB::table('phong_chieus')
            ->select('phong_chieus.MaPhong', DB::raw('count(ghe_ngois.MaGhe) as SoLuong'))
            ->join('ghe_ngois', 'phong_chieus.MaPhong', '=', 'ghe_ngois.MaPhong')
            ->whereIn('phong_chieus.MaPhong', function ($query) use ($MaPhim, $NgayChieu, $GioChieu) {
                $query->select('MaPhong')
                    ->from('lich_chieus')
                    ->where('MaPhim', $MaPhim)
                    ->where('NgayChieu', $NgayChieu)
                    ->where('GioChieu', $GioChieu);
            })
            ->whereRaw('checkIfGheIsEmpty(?,?,?, ghe_ngois.MaGhe) = ?', [$NgayChieu, $GioChieu, $ThoiGianKetThuc, true])
            ->groupBy('phong_chieus.MaPhong')
            ->orderByDesc('SoLuong')
            ->limit(1)
            ->get();
        // print_r($result);
        // echo $result[0]->MaPhong;
        if($request != null && count($result) > 0){
            $MaPhong = $result[0]->MaPhong;
            Session::put('MaPhong', $MaPhong);
            // Đã có mã phòng, bây giờ cần lấy ra ghế trong phòng đó và phải có trạng thái cho nó
            // trạng thái được đặt hay không với 0 cho chưa và 1 cho có rồi, trạng thái này là thuộc tính được tạo thêm 
            // trong model GheNgoi, và cần set cho nó giá trị phù hợp
    
            $GheTrongs = DB::table('phong_chieus')
                ->select('MaGhe', 'ViTriDay', 'ViTriCot')
                ->join('ghe_ngois', 'phong_chieus.MaPhong', '=', 'ghe_ngois.MaPhong')
                ->where('phong_chieus.MaPhong', $MaPhong)
                ->whereRaw('checkIfGheIsEmpty(?,?,?, ghe_ngois.MaGhe) = ?', [$NgayChieu, $GioChieu, $ThoiGianKetThuc, true])
                ->get();
            $GheDaDats = DB::table('phong_chieus')
                ->select('MaGhe', 'ViTriDay', 'ViTriCot')
                ->join('ghe_ngois', 'phong_chieus.MaPhong', '=', 'ghe_ngois.MaPhong')
                ->where('phong_chieus.MaPhong', $MaPhong)
                ->whereRaw('checkIfGheIsEmpty(?,?,?, ghe_ngois.MaGhe) = ?', [$NgayChieu, $GioChieu, $ThoiGianKetThuc, false])
                ->get();
            //
            // print_r($GheTrongs);
            $Ghes = [];
            for($i = 0; $i < 6; $i++){
                for($j = 0; $j < 6; $j++){
                    $GheNgoi =  new GheNgoi();
                    $Ghes[$i][$j] = $GheNgoi;
                }
            }
            // print_r($Ghes);
            foreach($GheTrongs as $GheTrong){
                // echo'vi tri day:'.$GheTrong->ViTriDay.', vi tri cot: '.$GheTrong->ViTriCot;
                // if($Ghes[$GheTrong->ViTriDay-1][$GheTrong->ViTriCot-1] == null){
                //     echo ', null';
                // }
                // lấy thông tin giá vé cho ghế
                    $GiaVe = DB::table('loai_ghes')
                        ->select('lich_su_gia_ves.GiaVe')
                        ->join('lich_su_gia_ves', 'lich_su_gia_ves.MaLoaiGhe', '=', 'loai_ghes.MaLoaiGhe')
                        ->join('ghe_ngois', 'ghe_ngois.MaLoaiGhe', '=', 'loai_ghes.MaLoaiGhe')
                        ->where('ghe_ngois.MaGhe', $GheTrong->MaGhe)
                        ->orderByDesc('lich_su_gia_ves.ThoiGianTao')
                        ->first()
                        ->GiaVe;
                    // dd($GiaVe);
                //
    
                $Ghes[$GheTrong->ViTriDay-1][$GheTrong->ViTriCot-1]->MaGhe = $GheTrong->MaGhe;
                $Ghes[$GheTrong->ViTriDay-1][$GheTrong->ViTriCot-1]->GiaVe = $GiaVe;
                $Ghes[$GheTrong->ViTriDay-1][$GheTrong->ViTriCot-1]->ViTriDay = $GheTrong->ViTriDay;
                $Ghes[$GheTrong->ViTriDay-1][$GheTrong->ViTriCot-1]->ViTriCot = $GheTrong->ViTriCot;
                $Ghes[$GheTrong->ViTriDay-1][$GheTrong->ViTriCot-1]->TrangThai = 1;
            }
            foreach($GheDaDats as $GheDaDat){
                $Ghes[$GheDaDat->ViTriDay-1][$GheDaDat->ViTriCot-1]->MaGhe = $GheDaDat->MaGhe;
                $Ghes[$GheDaDat->ViTriDay-1][$GheDaDat->ViTriCot-1]->ViTriDay = $GheDaDat->ViTriDay;
                $Ghes[$GheDaDat->ViTriDay-1][$GheDaDat->ViTriCot-1]->ViTriCot = $GheDaDat->ViTriCot;
                $Ghes[$GheDaDat->ViTriDay-1][$GheDaDat->ViTriCot-1]->TrangThai = 0;
            }
            $Key = [];
            $Key[0] = 'A';
            $Key[1] = 'B';
            $Key[2] = 'C';
            $Key[3] = 'D';
            $Key[4] = 'E';
            $Key[5] = 'F';
            return view('DatVe.'.$VaiTro.'.ChonCho', compact('Ghes', 'Key', 'Phim'));
        }else{
            echo 'Lịch chiếu bạn chọn đã bán hết vé, vui lòng chọn lịch chiếu khác, hihi thông cảm nhaa^^';
        }
        
    }
    public function hienThiDoAn(Request $request){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $VaiTro = Auth::user()->VaiTro;
        if($VaiTro == 1){
            $VaiTro = 'admin';
        }else if($VaiTro == 2){
            $VaiTro = 'employee';
        }else{
            $VaiTro = 'customer';
        }
        $MaPhim = Session::get('MaPhim');
        $Phim = Phim::where('MaPhim', $MaPhim)->first();
        // hàm này cần lưu thông tin ghế đã chọn vào session
        // các input là một mảng MaGhe[] trong request,
        // duyệt mảng này và đếm xem có bao nhiêu ghế được chọn SoGheDuocChon, lưu con số này vào session
        // nếu giá trị của input là 'x' có nghĩa ghế đấy không được chọn
        // nếu ngược lại thì input đó sẽ lưu mã ghế =>
        // đẩy nó vào sesion với key là MaGhe{{x}} với x là số thứ tự từ 0 tăng lên
        // sau sẽ dựa vào SoGheDuocChon để lấy ra đủ mã ghế đã chọn

        $MaGhes = $request->input('MaGhe');
        $SoGheDuocChon = 0;
        $IndexOfGhe = 0;
        foreach($MaGhes as $key => $MaGhe){
            if($MaGhe != 'x'){
                $SoGheDuocChon++;
                Session::put('MaGhe'.$IndexOfGhe, $MaGhe);
                $IndexOfGhe++;
            }
        }
        Session::put('SoGheDuocChon', $SoGheDuocChon);
        // lưu tổng giá vé
        $TongGiaVe = $request->input('TongGiaVe');
        Session::put('TongGiaVe', $TongGiaVe);
        // lấy tất cả đồ ăn và hiện thị lên
        $DoAns = DoAn::orderByDesc('MaDoAn')->limit(10)->get();
        return view('DatVe.'.$VaiTro.'.ChonDoAn', compact('DoAns', 'Phim'));
    }
    public function chonHinhThucThanhToan(Request $request){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $VaiTro = Auth::user()->VaiTro;
        if($VaiTro == 1){
            $VaiTro = 'admin';
        }else if($VaiTro == 2){
            $VaiTro = 'employee';
        }else{
            $VaiTro = 'customer';
        }
        if ($request->isMethod('post')) {
            // trong hàm này cần lưu lại mảng mã đồ ăn đã chọn kèm theo số lượng
            $SoDoAnDuocChon = 0;
            $IndexOfDoAn = 0;
            $MaDoAns = $request->input('MaDoAn');
            $SoLuongs = $request->input('SoLuong');
            foreach($MaDoAns as $key => $MDA){
                if($SoLuongs[$key] > 0){
                    $SoDoAnDuocChon++;
                    Session::put('DoAn'.$IndexOfDoAn, $MDA.'#'.$SoLuongs[$key]);
                    $IndexOfDoAn++;
                }
            }
            Session::put('SoDoAnDuocChon', $SoDoAnDuocChon);
            // lưu lại tiền đồ ăn;
            $TienDoAn = $request->input('TienDoAn');
            Session::put('TienDoAn', $TienDoAn);
            $TongTienHoaDon = Session::get('TongGiaVe')+Session::get('TienDoAn');
            Session::put('TongTienHoaDon', $TongTienHoaDon);
        }
        
        return view('DatVe.'.$VaiTro.'.ThanhToan');
    }
    public function thanhToanOnline(Request $request){
        $MaVoucher = $request->input('MaVoucher');
        
        // validate mã voucher này
        // có trong db và còn dùng thì báo áp mã thành công
        // ngược lại báo mã không đúng hoặc đã được dùng
        // nếu bỏ trống thì coi như không có mã (phải trim giá trị này trước)
        // và chuyển bước tiếp theo
        // chốt lại: 1 là nhập đúng, 2 là bỏ trống thì mới sang trang tiếp được
        if(trim($MaVoucher) != ''){
            $voucher = Voucher::where('MaVoucher', $MaVoucher)->first();
            if($voucher != null && Carbon::createFromFormat('Y-m-d H:i:s', $voucher->HanDung)->greaterThanOrEqualTo(Carbon::now())
                && $voucher->TinhTrang == 'Chưa sử dụng'){
                Session::put('MaVoucher', $MaVoucher);
                # voucher hợp lệ
                $TongTienHoaDon = Session::get('TongTienHoaDon');
                $TongTienHoaDon = intval($TongTienHoaDon * (1 - $voucher->TiLeChietKhau));
                Session::put('TongTienHoaDon', $TongTienHoaDon);
                $voucher->TinhTrang = 'Đã sử dụng';
                $voucher->save();
            }else{
                # báo mã không đúng hoặc đã được sử dụng
                $validator = Validator::make($request->all(), [
                    'VoucherKhongHopLe' => ['required'],
                ], [
                    'VoucherKhongHopLe.required' => 'Mã voucher không đúng hoặc đã được sử dụng',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

            }
        }
        $HD = HoaDon::orderByDesc('MaHoaDon')->first();
        if($HD == null){
            Session::put('MaHoaDon', '1');
        }else{
            Session::put('MaHoaDon', $HD->MaHoaDon + 1);
        }
        // echo 'Tổng tiền:'.Session::get('TongTienHoaDon').'-MaHoaDon:'.Session::get('MaHoaDon');
        return view('DatVe.customer.XacNhanThanhToan');
    }
    // cuối cùng, thanh toán thành công route đến hàm taoHoaDon()

    public function taoHoaDon(){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $VaiTro = Auth::user()->VaiTro;
        if($VaiTro == 1){
            $VaiTro = 'admin';
        }else if($VaiTro == 2){
            $VaiTro = 'employee';
        }else{
            $VaiTro = 'customer';
        }
        // hàm này lấy tất cả thông tin đã lưu và tạo hóa đơn, tạo vé, tạo doan_hoadon
        // sau đó chuyển hướng đến trang đặt vé thành công và cảm ơn
        // lấy tất cả thông tin
        $MaPhim = Session::get('MaPhim');
        $MaPhong = Session::get('MaPhong');
        $NgayChieu = Session::get('NgayChieu');
        $GioChieu = Session::get('GioChieu');
        $LichChieu = LichChieu::where('MaPhim', $MaPhim)
                ->where('MaPhong', $MaPhong)
                ->where('NgayChieu', $NgayChieu)
                ->where('GioChieu', $GioChieu)
                ->first();
        $SoGheDuocChon = Session::get('SoGheDuocChon');
        $MaGhes = [];
        for($i = 0; $i < $SoGheDuocChon; $i++){
            $MaGhes[] = Session::get('MaGhe'.$i);
        }
        $SoDoAnDuocChon = Session::get('SoDoAnDuocChon');
        $DoAns = [];
        for($i = 0; $i < $SoDoAnDuocChon; $i++){
            $DoAns[] = Session::get('DoAn'.$i);
        }
        // echo 'MaPhim: '.$MaPhim.', MaPhong: '.$MaPhong.', NgayChieu: '.$NgayChieu.', GioChieu: '.$GioChieu.',
            //  LichChieu: '.$LichChieu.', SoGheDuocChon: '.count($MaGhe).', SoDoAnDuocChon: '.count($DoAn);


        // tạo hóa đơn
        $MaHoaDon = Session::get('MaHoaDon');
        $HoaDon = HoaDon::create([
            'MaHoaDon' => $MaHoaDon, 
            'TenDangNhapKH' => Auth::user()->email,
        ]);

       
        // tạo các vé tương ứng với ghế ngồi
        // print_r(session()->all());
        foreach($MaGhes as $MGh){
            Ve::create([
                'MaHoaDon' => $HoaDon->MaHoaDon,
                'MaLichChieu' => $LichChieu->MaLichChieu,
                'MaGhe' => $MGh
            ]);
        }
        // lưu đồ ăn vào bảng hóa đơn đồ ăn
        foreach($DoAns as $DA){
            $DA = explode('#', $DA);
            HoaDon_DoAn::create([
                'MaDoAn' => $DA[0],
                'MaHoaDon' => $HoaDon->MaHoaDon,
                'SoLuongMua' => $DA[1]
            ]);
        }

        // $this->forgetSession();
        
        //
        return view('DatVe.'.$VaiTro.'.CamOn');
    }
    public function forgetSession(){
        Session::flush();
    }
    public function xuatVe(Request $request){
        if(!Auth::check()){
            return redirect()->route('login');
        }else if(Auth::user()->VaiTro==1){
            // admin
            return view('XuatVe.admin');
        }
        else if(Auth::user()->VaiTro==2){
            // employee
            return view('XuatVe.employee');
        }
    }
    public function xuatVeXong(Request $request){
        $MaHoaDon = $request->input('MaHoaDon');
        $mes = '';
        if(strlen(trim($MaHoaDon))==0){
            $mes = "Vui lòng nhập mã hóa đơn";
        }else{
            $HoaDon = HoaDon::where('MaHoaDon', $MaHoaDon)->first();
            if($HoaDon == null){
                $mes = "Mã hóa đơn không đúng";
            }else{
                if($HoaDon->TenDangNhapNV==null){
                    $HoaDon->TenDangNhapNV = Auth::user()->email;
                    $HoaDon->save();
                    $mes = "Xuất hóa đơn thành công!";
                }else{
                    $mes = "Hóa đơn đã được xuất trước đó!";
                }
            }
        }
        Session::put('mesXuaHoaDon', $mes);
        return redirect()->route('datves.xuatVe');
    }
    
}
