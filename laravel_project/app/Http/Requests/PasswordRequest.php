<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => '現在のパスワードを入力してください',
            'new_password.required' => '新しいパスワードを入力してください',
            'new_password.min' => '6文字以上で入力してください',
            'confirm_password.required' => '確認のため新しいパスワードを再度入力してください',
            'confirm_password.same' => '「新しいパスワード」と「新しいパスワードの確認」が異なっています',
        ];
    }
}
