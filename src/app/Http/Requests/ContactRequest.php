<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'tel' => $this->tel1 . $this->tel2 . $this->tel3,
        ]);
    }

    public function rules()
    {
        return [
            "first_name" => "required|string|max:8",
            "last_name" => "required|string|max:8",
            "gender" => "required",
            "email" => "required|email",
            "tel1" => "required|numeric",
            "tel2" => "required|numeric",
            "tel3" => "required|numeric",
            "tel" => "required|numeric|digits_between:1,5",
            "address" => "required",
            "building"    => "nullable",
            "category_id" => "required",
            "detail" => "required|max:120",
        ];
    }

    public function messages()
    {
        return [
            "first_name.required" => "姓を入力してください",
            "last_name.required"  => "名を入力してください",
            "gender.required" => "性別を選択してください",
            "email.required" => "メールアドレスを入力してください",
            "email.email" => "メールアドレスはメール形式で入力してください",
            "tel.required" => "電話番号を入力してください",
            "tel.numeric" => "電話番号は 半角英数字で入力してください",
            "tel.digits_between" => "電話番号は 5桁まで数字で入力してください",
            "address.required" => "住所を入力してください",
            "category_id.required" => "お問い合わせの種類を選択してください",
            "detail.required" => "お問い合わせ内容を入力してください",
            "detail.max" => "お問い合わせ内容は120文字以内で入力してください",
        ];
    }
}
