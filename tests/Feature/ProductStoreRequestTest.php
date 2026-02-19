<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Company;

class ProductStoreRequestTest extends TestCase
{
    /** @test */
    public function product_nameに使用できない文字が含まれるとバリデーションエラーになる()
    {
        $request = new ProductStoreRequest();

        $validator = Validator::make(
            [
                'product_name' => 'テスト$',   // ← $ は許可していない
            ],
            $request->rules(),
            $request->messages()
        );

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey(
            'product_name',
            $validator->errors()->messages()
        );
    }

    /** @test */
    public function 画面から送信した場合でも商品名に不正な文字があるとエラーになる()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::create([
            'company_name' => 'テストメーカー',
        ]);

        $response = $this->post('/products', [
            'product_name' => 'abc$',
            'company_id'   => $company->id,   // ← 実在IDを使う
            'price'        => 1000,
            'stock'        => 10,
        ]);

        $response->assertSessionHasErrors('product_name');
    }

    /** @test */
    public function 正しい商品名なら商品が登録される()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // 既存の company を1件用意
        $company = \App\Models\Company::create([
            'company_name' => 'テスト会社',
        ]);

        $response = $this->post('/products', [
            'product_name' => 'テスト商品123',
            'company_id'   => $company->id,
            'price'        => 1000,
            'stock'        => 10,
        ]);

        $response->assertRedirect(); // 登録後リダイレクトされること

        $this->assertDatabaseHas('products', [
            'product_name' => 'テスト商品123',
            'company_id'   => $company->id,
            'price'        => 1000,
            'stock'        => 10,
        ]);
    }

    /** @test */
    public function priceに半角数字以外が含まれるとバリデーションエラーになる()
    {
        $request = new ProductStoreRequest();

        $validator = Validator::make(
            [
                'price' => '12a3',
            ],
            $request->rules(),
            $request->messages()
        );

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey(
            'price',
            $validator->errors()->messages()
        );
    }

    /** @test */
    public function 在庫数が文字列だとバリデーションエラーになる()
    {
        $request = new \App\Http\Requests\ProductStoreRequest();

        $validator = \Validator::make(
            [
                'stock' => 'abc',
            ],
            $request->rules(),
            $request->messages()
        );

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey(
            'stock',
            $validator->errors()->messages()
        );
    }

    /** @test */
    public function コメントに使用できない文字が含まれるとバリデーションエラーになる()
    {
        $request = new \App\Http\Requests\ProductStoreRequest();

        $validator = \Validator::make(
            [
                'comment' => 'テスト$',
            ],
            $request->rules(),
            $request->messages()
        );

        $this->assertTrue($validator->fails());

        $this->assertArrayHasKey(
            'comment',
            $validator->errors()->messages()
        );
    }

    /** @test */
    public function priceがマイナスの場合はバリデーションエラーになる()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/products', [
            'product_name' => 'テスト商品',
            'company_id'   => 1,
            'price'        => -1,
            'stock'        => 10,
        ]);

        $response->assertSessionHasErrors('price');
    }
}