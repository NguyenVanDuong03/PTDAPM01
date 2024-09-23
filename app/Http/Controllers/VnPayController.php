<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Faker\Factory as Faker;

class VnPayController extends Controller
{
    public function vnpay_payment()

    {
        $f = Faker::create();

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/datve/hoanthanh"; //local
        // $vnp_Returnurl = "https://datvexf.ductran.site/datve/hoanthanh"; //public
        // $vnp_TmnCode = "NX28R3IB"; // Mã website tại VNPAY // public
        $vnp_TmnCode = "6P2BGGX4"; // Mã website tại VNPAY // local
        // $vnp_HashSecret = "DZJIGDCNAZMVUNUBGZFZHRBWOEMHIHOE"; // public
        $vnp_HashSecret = "QHFWH3FBS9WEN9I8BNSWQGUUQLRMCL68"; // local
        // $vnp_TxnRef =Session::get('MaHoaDon')+1;
        $vnp_TxnRef = strval(Session::get('MaHoaDon')) . strval($f->numerify('####'));
        $vnp_OrderInfo = "Thanh toán vé xem phim";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = Session::get('TongTienHoaDon') * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        // Add Params of 2.0.1 Version
        // $vnp_ExpireDate = '';
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            // "vnp_Amount" => $vnp_Amount,
            "vnp_Amount" => '200000000',
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $vnp_ExpireDate,

        );

        // dd(
        //     $inputData
        // );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            exit();
        } else {
            return response()->json($returnData);
        }
    }
}
