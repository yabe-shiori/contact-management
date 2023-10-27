<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'last_name' => ['required', 'max:255'],
            'first_name' => ['required', 'max:255'],
            // 'name' => ['required', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'email', 'max:255'],
            'postcode' =>  ['required', 'regex:/^[0-9]{3}-[0-9]{4}$/'],
            'address' => ['required', 'max:255'],
            'opinion' => ['required', 'max:120'],
        ];
    }
    public function messages()
    {
        return [
            'last_name.required' => '苗字を入力してください',
            'last_name.max' => '苗字は255文字以内で入力してください',
            'first_name.required' => '名前を入力してください',
            'first_name.max' => '名前は255文字以内で入力してください',
            // 'name.required' => '名前を入力してください',
            // 'name.max' => '名前は255文字以内で入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスを正しく入力してください',
            'email.max' => 'メールアドレスは255文字以内で入力してください',
            'postcode.required' => '郵便番号を入力してください',
            'postcode.regex' => '郵便番号を正しく入力してください',
            'address.required' => '住所を入力してください',
            'address.max' => '住所は255文字以内で入力してください',
            'opinion.required' => 'ご意見を入力してください',
            'opinion.max' => 'ご意見は120文字以内で入力してください',
        ];
    }
}
