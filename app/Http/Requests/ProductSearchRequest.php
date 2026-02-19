<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 今回は誰でも検索できるので true にする
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules() {
        return [
            'keyword' => [
                'nullable',  // 未入力OK
                'string',    // 文字列
                'regex:/^[a-zA-Z0-9ぁ-んァ-ン一-龥ー\-\/\&\+]+$/u', // 許可文字のみ
            ],
            'company_id' => [
                'nullable',  // 未選択OK
                'integer',   // 数値
                Rule::exists('companies', 'id'),
            ], // companies.id に存在するか
        ];
    }

    /**
     * カスタムエラーメッセージ
     */
    public function messages() {
        return [
            'keyword.regex' => '商品名は半角英数・全角文字・一部記号（- / & +）のみ入力できます。',
        ];
    }
}
