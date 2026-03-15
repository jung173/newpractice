@extends('layouts.product')

@section('content')

<!-- ページ全体の中央寄せコンテナ -->
<div class="product-index-container">

    <!-- ページタイトル -->
    <h1 class="page-title">商品一覧画面</h1>

    <!-- 非同期検索用フォーム -->
    <form id="search-form"
        method="GET"
        action="{{ route('products.index') }}"
        class="search-form">

        <!-- キーワード検索 -->
        <input type="text" name="keyword" placeholder="検索キーワード" value="{{ request('keyword') }}">

        <!-- メーカー検索 -->
        <select name="company_id">
            <option value="" disabled selected>メーカー名</option>
            <option value="">全て</option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}"
                    {{ request('company_id') == $company->id ? 'selected' : '' }}>
                    {{ $company->company_name }}
                </option>
            @endforeach
        </select>

        <!-- 検索ボタン -->
        <button type="submit" class="btn btn-search">検索</button>

        <!-- 価格検索 -->
        <div class="search-range">
            <label>価格</label>
            <input type="number" name="price_min" placeholder="下限">
            ～
            <input type="number" name="price_max" placeholder="上限">
        </div>
        
        <!-- 在庫検索 -->
        <div class="search-range">
            <label>在庫</label>
            <input type="number" name="stock_min" placeholder="下限">
            ～
            <input type="number" name="stock_max" placeholder="上限">
        </div>

    </form>

    <!-- 非同期で差し替える一覧エリア -->
    <div id="product-list">
        @include('products._list')
    </div>
</div>

@endsection
