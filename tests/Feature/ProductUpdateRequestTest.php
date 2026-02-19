<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductUpdateRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 編集画面から送信した場合でも商品名に不正な文字があるとエラーになる()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create();

        $product = Product::factory()->create([
            'company_id' => $company->id,
        ]);

        $response = $this->put(
            route('products.update', $product->id),
            [
                'product_name' => 'テスト$',
                'company_id'   => $company->id,
                'price'        => 1000,
                'stock'        => 10,
                'comment'      => 'コメント',
            ]
        );

        $response->assertSessionHasErrors('product_name');
    }
}