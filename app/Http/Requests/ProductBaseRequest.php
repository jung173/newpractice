<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class ProductBaseRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'product_name' => [
                'required',
                'string',
                // 商品名は「半角英数・日本語・記号(- / & +)のみ許可」
                'regex:/^[a-zA-Z0-9ぁ-んァ-ン一-龥ー\-\/\&\+]+$/u',
            ],
            'company_id' => [
                'required',
                'integer',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'regex:/^[0-9]+$/',
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
            ],
            'comment' => [
                'nullable',
                'string',
                'max:255',
                // コメント欄は記号を許可しない仕様
                'regex:/^[0-9a-zA-Zぁ-んァ-ヶ一-龥ー\s]+$/u',
            ],
            'img_path' => [
                'nullable',
                'image',
            ],
        ];
    }

    public function messages() {
        return [
            'product_name.required' => '商品名は必須です。',
            'product_name.regex' => '商品名は半角英数・全角文字・一部記号（- / & +）のみ入力できます。',
            'price.regex' => '価格は半角数字で入力してください。',
        ];
    }
}
