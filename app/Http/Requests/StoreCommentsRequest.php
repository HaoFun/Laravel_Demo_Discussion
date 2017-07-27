<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentsRequest extends FormRequest
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
            'discussion_id' => 'required',
            'body'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'discussion_id.required' => '發生錯誤，請重試',
            'body.required'  => 'Body必須填寫',
        ];
    }
}
