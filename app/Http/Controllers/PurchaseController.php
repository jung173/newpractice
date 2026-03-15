<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        
        // 商品存在チェック
        if (!$product) {
            return response()->json([
                'message' => '商品が存在しません'
            ], 404);
        }

        // 在庫チェック
        if ($product->stock <= 0) {
            return response()->json([
                'message' => '在庫がありません'
            ], 400);
        }


        Sale::create([
            'product_id' => $product->id
        ]);
        
        $product->stock -= 1;
        $product->save();
        
        return response()->json([
            'message' => '購入しました'
        ]);
    }
}
