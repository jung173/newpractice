@extends('layouts.product')

@section('content')

<!-- ページ全体の中央寄せコンテナ -->
<div class="product-create-container">

    <!-- 画面のタイトル -->
    <h1 class="page-title">商品新規登録画面</h1>

    <!-- 商品新規登録フォーム -->
    <form class="create-form" method="POST"
        action="{{ route('products.store') }}"
        enctype="multipart/form-data">
        @csrf <!-- LaravelのCSRF対策 -->

        <!-- 商品名 -->
        <div class="form-group">
            <label for="product_name">商品名<span class="italic required">*</span></label>
                <input
                    type="text"
                    id="product_name"
                    name="product_name"
                    value="{{ old('product_name') }}"
                    class="{{ $errors->has('product_name') ? 'input-error' : '' }}"
                >
        </div>

        <!-- メーカー名 -->
        <div class="form-group">
            <label for="company_id">メーカー名<span class="italic required">*</span></label>
            <select 
                id="company_id"
                name="company_id"
                class="{{ $errors->has('company_id') ? 'input-error' : '' }}"
            >
                <!-- 初期状態：未選択 -->
                <option value="" disabled selected hidden></option>

                <!-- メーカー一覧 -->
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- 価格 -->
        <div class="form-group">
            <label for="price">価格<span class="italic required">*</span></label>
                <input 
                    type="number"
                    id="price"
                    name="price"
                    value="{{ old('price') }}"
                    class="{{ $errors->has('price') ? 'input-error' : '' }}"
                >
        </div>

        <!-- 在庫数 -->
        <div class="form-group">
            <label for="stock">在庫数<span class="italic required">*</span></label>
                <input 
                    type="number"
                    id="stock"
                    name="stock"
                    value="{{ old('stock') }}"
                    class="{{ $errors->has('stock') ? 'input-error' : '' }}"
                >
        </div>

        <!-- コメント -->
        <div class="form-group">
            <label for="comment">コメント</label>
                <textarea id="comment" name="comment"></textarea>
        </div>

        <!-- 商品画像 -->
        <div class="form-group image-row">
            <label>商品画像</label>

            <div class="file-wrapper">
                <!-- 見た目用ボタン -->
                <label for="img_path" class="file-btn">ファイルを選択</label>

                <!-- 実際のファイル入力 -->
                <input type="file" id="img_path" name="img_path" hidden>
            </div>
        </div>

        <!-- 登録・戻るボタンエリア -->
        <div class="form-buttons">
            <button type="submit" class="btn btn-submit">新規登録</button>
            <button type="button" class="btn btn-back" onclick="location.href='{{ route('products.index') }}'">
            戻る</button>
        </div>

    </form>
</div>

@endsection
