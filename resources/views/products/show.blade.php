@extends('layouts.product')

@section('content')

<!-- ページ全体の中央寄せコンテナ -->
<div class="product-show-container">

    <!-- 画面のタイトル -->
    <h1 class="page-title">商品情報詳細画面</h1>

    <!-- 商品情報詳細フォーム -->
    <div class="show-form">

        <!-- ID -->
        <div class="form-group">
            <label class="italic">ID</label>
                <span>{{ $product->id }}.</span>
            </div>

        <!-- 商品画面 -->
        <div class="form-group">
            <label>商品画像</label>

            @if($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" width="200" alt="商品画像">
            @else
                <span>画像なし</span>
            @endif
        </div>
                
        <!-- 商品名 -->
        <div class="form-group">
            <label>商品名</label>
            <span>{{ $product->product_name }}</span>
        </div>

        <!-- メーカー -->
        <div class="form-group">
            <label>メーカー</label>
            <span>{{ $product->company->company_name }}</span>
        </div>

        <!-- 価格 -->
        <div class="form-group">
            <label>価格</label>
            <span>¥{{ number_format($product->price) }}</span>
        </div>
        
        <!-- 在庫数 -->
        <div class="form-group">
            <label>在庫数</label>
            <span>{{ $product->stock }}</span>
        </div>

        <!-- コメント -->
        <div class="form-group">
            <label>コメント</label>
            <span>{{ $product->comment }}</span>
        </div>

        <!-- 編集・戻るボタンエリア -->
        <div class="form-buttons">
        
            <!-- 編集ボタン -->
            <button type="button" class="btn btn-next" onclick="location.href='{{ route('products.edit', $product->id) }}'">
                編集</button>

            <!-- 戻るボタン -->
            <button type="button" class="btn btn-back" onclick="location.href='{{ route('products.index') }}'">
                戻る</button>
        </div>
    </div>

@endsection
