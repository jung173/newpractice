<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    protected $fillable = [
        'product_name',
        'company_id',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function scopeSearch($query, $request) {
        // Eager Loading
        $query->with('company');

        // キーワード検索
        if ($request->filled('keyword')) {
            $query->where('product_name', 'like', '%' . $request->keyword . '%');
        }

        // メーカー検索
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        // 価格（下限）
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        // 価格（上限）
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // 在庫（下限）
        if ($request->filled('stock_min')) {
            $query->where('stock', '>=', $request->stock_min);
        }

        // 在庫（上限）
        if ($request->filled('stock_max')) {
            $query->where('stock', '<=', $request->stock_max);
        }
        /*
        |--------------------------------------------------------------------------
        | 🔥 ソート処理追加
        |--------------------------------------------------------------------------
        */

        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');

        // 許可カラム
        $allowedSorts = ['id', 'product_name', 'price', 'stock', 'company_name'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        // メーカー名ソートはJOINが必要
        if ($sort === 'company_name') {
            $query->leftJoin('companies', 'products.company_id', '=', 'companies.id')
                    ->select('products.*')
                    ->orderBy('companies.company_name', $direction);
        } else {
            $query->orderBy($sort, $direction);
        }

        return $query;
    }
}
