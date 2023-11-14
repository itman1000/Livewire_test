<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => '30文字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '@を付けてメールアドレスの形式にしてください',
            'email.unique' => 'そのメールアドレスはすでに登録されています',
            'email.max' => '50文字以内で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => ':min文字以上入力してください',
            'password.confirmed' => 'パスワードが一致しません',
        ];
    }
}
