<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductSearchRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{

    public function index(ProductSearchRequest $request) {

        // 検索条件に基づいて商品一覧を取得（検索ロジックは Model に委譲）
        $products = Product::search($request)->get();

        // メーカー一覧を取得（検索フォームのセレクトボックス用）
        $companies = Company::listForSelect();

        // 商品一覧画面へデータを渡して表示
        return view('products.index', compact('products', 'companies'));
    }

    //詳細ボタン（商品詳細画面へ遷移）
    public function show($id) {
        $product = Product::with('company')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    //削除ボタン（DELETE リクエスト）
    public function destroy($id) {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', '削除しました');
    }

    //新規登録ボタン（createページへ）
    public function create() {
        $companies = Company::listForSelect();
        return view('products.create', compact('companies'));
    }

    //編集ボタン（商品情報編集へ遷移）
    public function edit($id) {
        $product = Product::findOrFail($id);
        $companies = Company::listForSelect();
        return view('products.edit', compact('product', 'companies'));
    }

    // 商品更新処理
    public function update(ProductUpdateRequest $request, $id) {
        $product = Product::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('img_path')) {
            $data['img_path'] = $request->file('img_path')->store('products', 'public');
        }

        $product->update($data);

        // return redirect()->route('products.show', $id);　→現状ではリダイレクト時画面のため
        return redirect()->back();
    }

    //画像処理
    public function store(ProductStoreRequest $request) {
        $data = $request->validated();

        if ($request->hasFile('img_path')) {
            $data['img_path'] = $request->file('img_path')->store('products', 'public');
        } else {
            $data['img_path'] = null;
        }

        Product::create($data);

        // return redirect()->route('products.index');　→現状ではリダイレクト時画面のため
        return redirect()->back();
    }


}
