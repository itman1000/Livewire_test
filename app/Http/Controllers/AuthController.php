<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->route('auth.dashboard');
        }

        return back()->withErrors(['email' => 'メールアドレスまたはパスワードが正しくありません']);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ],[
            'name.required' => '名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '@を付けてメールアドレスの形式にしてください',
            'email.unique' => 'そのメールアドレスはすでに登録されています',
            'password.required' => 'パスワードを入力してください',
            'password.min' => ':min文字以上入力してください',
            'password.confirmed' => 'パスワードが一致しません',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user);

        return redirect()->route('auth.dashboard', ['user' => $user]);
    }

    public function dashboard()
    {
        $user = Auth::user();
        return view('auth.dashboard', ['user' => $user]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
