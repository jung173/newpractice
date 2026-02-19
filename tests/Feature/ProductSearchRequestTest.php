<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Requests\ProductSearchRequest;
use Illuminate\Support\Facades\Validator;

class ProductSearchRequestTest extends TestCase
{
    /** @test */
    public function keywordに使用できない文字が含まれるとバリデーションエラーになる()
    {
        // FormRequestのルールとメッセージを取得
        $request = new ProductSearchRequest();

        $validator = Validator::make(
            ['keyword' => 'abc$'],        // テストする値
            $request->rules(),
            $request->messages()
        );

        // バリデーションに失敗することを確認
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('keyword', $validator->errors()->messages());
    }

    /** @test */
    public function keywordが使用可能な文字列ならバリデーションが通る()
    {
        $request = new ProductSearchRequest();

        $validator = Validator::make(
            ['keyword' => 'abc123あア亜-&/+'],
            $request->rules(),
            $request->messages()
        );

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function keywordに日本語が含まれていてもバリデーションが通る()
    {
        $request = new ProductSearchRequest();

        $validator = Validator::make(
            ['keyword' => '商品テスト'],
            $request->rules(),
            $request->messages()
        );

        $this->assertFalse($validator->fails());
    }
}