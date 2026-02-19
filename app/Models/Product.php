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
        // クエリ作成（Eager Loading）
        $query->with('company');

        // キーワード検索
        if ($request->filled('keyword')) {

            // DB検索時も同じ許容文字に制限
            $query->where('product_name', 'like', '%' . $request->keyword . '%');
        }

        // メーカー検索
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        return $query;
    }
}
