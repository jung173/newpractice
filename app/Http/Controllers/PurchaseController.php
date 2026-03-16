<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Sale;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        $product_id = $request->product_id;

        DB::transaction(function () use ($product_id) {

            // 行ロック付き商品取得
            $product = Product::where('id', $product_id)
                ->lockForUpdate()
                ->first();
            
            // 商品存在チェック
            if (!$product) {
                abort(404, '商品が存在しません');
            }

            // 在庫チェック
            if ($product->stock <= 0) {
                abort(400, '在庫がありません');
            }

            // 購入履歴登録
            Sale::create([
                'product_id' => $product->id
            ]);
                
            // 在庫減算
            $product->stock -= 1;
            $product->save();
        });

        return response()->json([
            'message' => '購入しました'
        ]);
    }
}

