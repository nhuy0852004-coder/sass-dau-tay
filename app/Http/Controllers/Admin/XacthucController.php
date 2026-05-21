<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nguoidung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class XacthucController extends Controller
{
    public function hienThiDangNhap()
    {
        return view('admin.auth.dangnhap');
    }

    public function xuLyDangNhap(Request $request)
    {
        $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ],
            [
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không đúng định dạng.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
            ]
        );

        $nguoidung = Nguoidung::where('email', $request->email)->first();

        if (!$nguoidung) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Email hoặc mật khẩu không đúng.',
                ]);
        }

        if ($nguoidung->trangthai !== 'dang_hoat_dong') {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Tài khoản của bạn đang bị khóa hoặc chưa được kích hoạt.',
                ]);
        }

        if (!Hash::check($request->password, $nguoidung->matkhau)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'password' => 'Email hoặc mật khẩu không đúng.',
                ]);
        }

        Auth::login($nguoidung, $request->boolean('ghinho'));

        $request->session()->regenerate();

        return redirect()
            ->route('admin.tongquan')
            ->with('thanhcong', 'Đăng nhập thành công.');
    }

    public function hienThiDangKy()
    {
        return view('admin.auth.dangky');
    }

    public function xuLyDangKy(Request $request)
    {
        $request->validate(
            [
                'hoten' => ['required', 'string', 'max:150'],
                'email' => [
                    'required',
                    'email',
                    'max:150',
                    Rule::unique('nguoidung', 'email'),
                ],
                'sodienthoai' => ['nullable', 'string', 'max:20'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'hoten.required' => 'Vui lòng nhập họ tên.',
                'hoten.max' => 'Họ tên không được vượt quá 150 ký tự.',

                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không đúng định dạng.',
                'email.max' => 'Email không được vượt quá 150 ký tự.',
                'email.unique' => 'Email này đã được sử dụng.',

                'sodienthoai.max' => 'Số điện thoại không được vượt quá 20 ký tự.',

                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            ]
        );

        $nguoidung = Nguoidung::create([
            'hoten' => $request->hoten,
            'email' => $request->email,
            'sodienthoai' => $request->sodienthoai,
            'matkhau' => Hash::make($request->password),
            'vaitro' => 'admin',
            'trangthai' => 'dang_hoat_dong',
        ]);

        Auth::login($nguoidung);

        $request->session()->regenerate();

        return redirect()
            ->route('admin.tongquan')
            ->with('thanhcong', 'Tạo tài khoản quản trị thành công.');
    }

    public function dangXuat(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.dangnhap')
            ->with('thanhcong', 'Đăng xuất thành công.');
    }
}
