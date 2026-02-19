@extends('layouts.product')

@section('content')

<!-- ページ全体の中央寄せコンテナ -->
<div class="product-edit-container">

    <!-- 画面のタイトル -->
    <h1 class="page-title">商品情報編集画面</h1>

    <!-- 商品情報編集フォーム -->
    <form class="edit-form" action="{{ route('products.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- ID -->
        <div class="form-group">
            <label class="italic">ID</label>
                <span>{{ $product->id }}.</span>
            </div>

        <!-- 商品名 -->
        <div class="form-group">
            <label for="product_name">商品名<span class="italic required">*</span></label>
                <input 
                    type="text"
                    id="product_name"
                    name="product_name"
                    value="{{ old('product_name',$product->product_name) }}"
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

                <!-- メーカー一覧 -->
                @foreach ($companies as $company)
                    <option value = "{{ $company->id }}"
                        {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
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
                    value="{{ old('price',$product->price) }}"
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
                    value="{{ old('stock',$product->stock) }}"
                    class="{{ $errors->has('stock') ? 'input-error' : '' }}"
                >
        </div>

        <!-- コメント -->
        <div class="form-group">
            <label for="comment">コメント</label>
                <textarea id="comment" name="comment">{{ old('comment', $product->comment) }}</textarea>
        </div>

        <!-- 商品画像 -->
        <div class="form-group image-row">
            <label>商品画像</label>

            <!-- 右側まとめエリア -->
            <div class="image-area">
                
                @if($product->img_path)
                    <img src="{{ asset('storage/' . $product->img_path) }}" width="200">
                @else
                    <span class="no-image">画像なし</span>
                @endif

                <div class="file-wrapper">
                    <!-- 見た目用ボタン -->
                    <label for="img_path" class="file-btn">ファイルを選択</label>

                    <!-- 実際のファイル入力 -->
                    <input type="file" id="img_path" name="img_path" hidden>
                </div>
            </div>
        </div>

        <!-- 更新・戻るボタンエリア -->
        <div class="form-buttons">
            <button type="submit" class="btn btn-submit">更新</button>
            <button type="button" class="btn btn-back" onclick="location.href='{{ route('products.show', $product->id) }}'">
            戻る</button>
        </div>
    </form>
</div>

@endsection
