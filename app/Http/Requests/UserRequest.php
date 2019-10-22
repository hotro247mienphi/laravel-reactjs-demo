<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        $id = request()->route('id');

        $general = [
            'name' => 'required|min:6|max:128',
            'email' => 'required|email',
        ];

        /** if id not exist, then add params validate */
        if (!$id) {
            $general ['password'] = 'required|min:6|max:12';
        }

        return $general;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Ten khong the bo trong',
            'name.min' => 'Ten toi thieu phai chua :min ky tu',
            'name.max' => 'Ten toi da :max ky tu',

            'email.required' => 'Email khong the bo trong',
            'email.email' => 'Email khong hop le',

            'password.required' => 'Mat khau khong the bo trong',
            'password.min' => 'Mat khau thieu phai chua :min ky tu',
            'password.max' => 'Mat khau toi da :max ky tu',
        ];
    }
}
