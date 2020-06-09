<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|max:20',
            'email' => 'required|email',
            'image' => 'file|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名を入力してください',
            'name.max' => '20文字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '正しいメールアドレス形式で入力してください',
            'image.file' => 'もう一度画像ファイルを選択してください',
            'image.image' => '画像ファイルを選択してください',
            'image.mimes' => '拡張子「jpeg」「png」「jpg」形式の画像ファイルを選択してください',
            'image.max' => '2MB以下の画像ファイルを選択してください',
        ];
    }
}
