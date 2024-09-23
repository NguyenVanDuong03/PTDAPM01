<?php

namespace App\Http\Controllers;

use App\Mail\SampleEmail;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Faker\Factory as Faker;
class AuthController extends Controller
{
    private $OTP = '';
    public function __construct(){
        // $this->middleware('guest')->except(['logout', 'dashboard']);
    }
    public function register(){
        return view('auth.login');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'TenKhachHang' => 'required|string|max:250|regex:/^[a-zA-Z]*$/',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]+$/',
            'NgaySinh' => 'required'
        ],[
            'TenKhachHang.required' => 'Vui lòng nhập họ tên',
            'TenKhachHang.string' => 'Tên không hợp lệ',
            'TenKhachHang.max' => 'Tên không dài quá 250 ký tự',
            'TenKhachHang.regex' => 'Họ tên không chứa ký tự là số và ký tự đặc biệt',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng Email',
            'email.max' => 'Email không hợp lệ',
            'email.unique' => 'Tên đăng nhập đã tồn tại trong hệ thống. Vui lòng chọn tên khác',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự',
            'password.regex' => 'Mật khẩu phải chứa số, chữ và một ký tự đặc biệt',
            'password.confirmed' => 'Mật khẩu xác nhận không trùng khớp',
            'NgaySinh.required' => 'Vui lòng nhập đầy đủ thông tin trước khi chọn Đăng ký',
        ]);
    
        if ($validator->fails()) {
            $request->session()->put('register_fail', 'active');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // $request->validate([
        //     'TenKhachHang' => 'required|string|max:250',
        //     'email' => 'required|email|max:250|unique:users',
        //     'password' => 'required|min:8|confirmed',
        //     'NgaySinh' => 'required'
        // ],[
        //     'TenKhachHang.required' => 'Vui lòng nhập họ tên',
        //     'TenKhachHang.string' => 'Tên không hợp lệ',
        //     'TenKhachHang.max' => 'Tên không dài quá 250 ký tự',
        //     'email.required' => 'Vui lòng nhập email',
        //     'email.email' => 'Email không hợp lệ',
        //     'email.max' => 'Email không hợp lệ',
        //     'email.unique' => 'Email đã tồn tại',
        //     'password.required' => 'Vui lòng nhập mật khẩu',
        //     'password.min' => 'Mật khẩu tối thiểu 8 ký tự',
        //     'password.confirmed' => 'Vui lòng xác nhận lại mật khẩu',
        //     'NgaySinh.required' => 'Vui lòng chọn ngày sinh',
        // ]);
        User::create([
            'email' => $request->email,
            'VaiTro' => 3,
            'password' => Hash::make($request->password)
        ]);
        KhachHang::create([
            'TenDangNhapKH' => $request->email,
            'TenKhachHang' => $request->TenKhachHang,
            'NgaySinh' => $request->NgaySinh,
            'GioiTinh' => $request->GioiTinh,
            'Gmail' => $request->email,
        ]);
        
        
        /*
        $credentials = $request->only('email', 'password');:
         Dòng mã này tạo ra một mảng $credentials chứa giá trị của hai trường email và password
          từ yêu cầu ($request). Phương thức only() được sử dụng để lấy ra các trường cụ thể 
          từ yêu cầu, trong trường hợp này là email và password
        */
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
        ->withSuccess('Bạn đã đăng ký tài khoản thành công!');


    }
    public function login(){
        return view('auth.login');
    }
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',   
            'password' => 'required'
        ],[
            'email.required' => 'Vui lòng nhập tên đăng nhập',
            'email.regex' => 'Email không hợp lệ',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard')
            ->withSuccess('Bạn đã đăng nhập thành công!');
        }
        return back()->withErrors([
            'email' => 'Tên đăng nhập hoặc mật khẩu không chính xác.!'
        ])->onlyInput('email');
    }
    public function dashboard(){
        if(Auth::check()){
            switch(Auth::user()->role){
                case 1: return redirect()->route('admin.home');
                    break;
                case 2: return redirect()->route('employee.home');
                    break;
                case 3: return redirect()->route('customer.home');
                    break;
                default: return redirect()->route('admin.home');
            }
        }
        return redirect()->route('login')
        ->withError([
            'email' => 'Please login to access the dashboard.'
        ])->onlyInput('email');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
        ->withSuccess('You have logout successfully!');
    }
    public function changeInfo(){
        if(Auth::user()->VaiTro==3){
            return view('auth.change-info.khach-hang');
        }
    }
    public function storeInfoChange(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required','max:50', 'email'],
            'TenKhachHang' => ['required','max:50'],
            'NgaySinh' => ['required'],
            'GioiTinh' => ['required'],
            'SDT' => ['required', 'regex:/^0\d{9}$/'],
            'password' => 'required|min:8|confirmed',
            'confirmPassword' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.max' => 'email quá dài',
            'email.email' => 'email không hợp lệ',

            'TenKhachHang.required' => 'Vui lòng nhập tên nhân viên',
            'TenKhachHang.max' => 'Tên nhân viên quá dài',

            'NgaySinh.required' => 'Vui lòng chọn ngày sinh',

            'GioiTinh.required' => 'Vui lòng chọn giới tính',

            'SDT.required' => 'Vui lòng nhập số điện thoại',
            'SDT.regex' => 'Số điện thoại không hợp lệ',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không trùng khớp',

            'confirmPassword.required' => 'Vui lòng xác nhận mật khẩu!'

        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // success
        
        $user_ = Auth::user();
        $user = User::where('email', $user_->email)->first();
        $credentials = [
            'email' => $request->email,
            'password' => $request->confirmPassword
        ];
        if(Auth::attempt($credentials)){
            $user->update([
                'email' => $request->email,
                'VaiTro' => 3,
                'password' => Hash::make($request->password)
            ]);
            $user->update([
                'TenDangNhapKH' => $request->email,
                'TenKhachHang' => $request->TenNhanVien,
                'NgaySinh' => $request->NgaySinh,
                'GioiTinh' => $request->GioiTinh,
                'SDT' =>$request->SDT,
                'Gmail' => $request->email,
            ]);
            return redirect()->route('dashboard')
            ->withSuccess('Bạn đã đổi thông tin thành công!');
        }
        return back()->withErrors([
            'confirmPassword' => 'Mật khẩu không chính xác!'
        ])->onlyInput('confirmPassword');
    }
    public function home(){
        if(!Auth::check()){
            return redirect()->route('vanglais.home');
        }else if(Auth::user()->VaiTro==1){
            return redirect()->route('admin.home');
        }else if(Auth::user()->VaiTro==2){
            return redirect()->route('employee.home');
        }else{
            return redirect()->route('customer.home');
        }
    }
    public function nhapEmail(){
        return view('auth.forgot-password.NhapEmail');
    }
    public function nhapOTP(Request $request){
        $email = $request->input('email');
        $validator = Validator::make($request->all(), [
            'email' => ['required','max:50', 'email' , function ($attribute, $value, $fail) {
                $exists = User::where('email', $value)->exists();
                if (!$exists) {
                    $fail('Email không tồn tại trong hệ thống.');
                }
            }],
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.max' => 'Độ dài email không quá 50 ký tự',
            'email.email' => 'Vui lòng nhập đúng định dạng email'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $f = Faker::create();
        $OTP = $f->numerify('######');
        $this->sendEmail($email, 'NoReply', $OTP);

        return view('auth.forgot-password.NhapOTP');
    }
    public function sendEmail($email, $sub, $mes)
    {
        // $toEmail = 'a@gmail.com';
        // $subject = 'cd';
        // $message = 'nd';

        // Mail::to($email)->send(new SampleEmail($sub, $mes));

    }
    public function nhapMatKhauMoi(Request $request){
        $OTP = $request->input('OTP');

        return view('auth.forgot-password.NhapMatKhauMoi');

    }
}
