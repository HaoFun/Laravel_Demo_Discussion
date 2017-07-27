<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePasswordRequest extends FormRequest
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
            'old_password' => 'required|min:6',
            'new_password' => 'required|confirmed|min:6',
            'id'           => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => '發生錯誤，請重試',
            'old_password.required'  => '舊密碼必須填寫',
            'old_password.min'  => '舊密碼必須6位以上',
            'new_password.required'  => '新密碼必須填寫',
            'new_password.min'  => '新密碼必須6位以上',
            'new_password.confirmed' => '兩次密碼不相符，請確認'
        ];
    }
}
