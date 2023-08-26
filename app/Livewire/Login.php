<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = '';
    public $password = '';

    public function login()
    {
        $credentials = ['email' => $this->email, 'password' => $this->password];

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        session()->flash('error', 'メールアドレスまたはパスワードが正しくありません。');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
