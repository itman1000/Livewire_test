<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\HotpepperService;

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

    public function dashboard(HotpepperService $hotpepperService)
    {
        $user = Auth::user();

        $params = [
            'large_area' => 'Z022',
            'count' => 10,
            'order' => 4,
        ];

        $result = $hotpepperService->searchRestaurants($params);


        $greetings = [
            "今週試してみたいお店は見つかりましたか？",
            "今日は新しい味を冒険してみませんか？",
            "今日はどんな国の料理に挑戦しましょうか？",
            "今日の気分を上げるための絶品料理を探しましょう！",
            "今日は家族や友人との食事の場所を探してみませんか？",
            "新しい料理やお店を発見するのは今日の一つの楽しみですね！",
            "今日の気分に合ったお店を見つけましょう！",
            "今日は何を食べたい気分ですか？",
            "お腹が空いてきたら新しいお店を探してみませんか？",
            "今日はどんな美味しいものを発見しましょうか？",
        ];

        $randomGreeting = $greetings[array_rand($greetings)];


        return view('auth.dashboard', [
            'user' => $user,
            'restaurants' => $result['results']['shop'],
            'randomGreeting' => $randomGreeting,
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
