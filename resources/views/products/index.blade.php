@extends('layouts.product')

@section('content')

<!-- ページ全体の中央寄せコンテナ -->
<div class="product-index-container">

    <!-- ページタイトル -->
    <h1 class="page-title">商品一覧画面</h1>

    <!-- 検索フォーム -->
    <form method="GET" action="{{ route('products.index') }}" class="search-form">

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
    </form>


    <!-- 商品一覧テーブル -->
    <table class="product-table">

        <!-- テーブルヘッダー -->
        <tr class="table-header">
            <th class="italic col-id">ID</th>
            <th class="col-img">商品画像</th>
            <th class="col-name">商品名</th>
            <th class="col-price">価格</th>
            <th class="col-stock">在庫数</th>
            <th class="col-company">メーカー名</th>

            <!-- 新規登録ボタン -->
            <th class="col-action">
                <a href="{{ route('products.create') }}"
                    class="btn btn-create"
                    >新規登録
                </a>
            </th>
        </tr>

        <!-- 商品一覧ループ -->
        @foreach ($products as $product)
        <tr>
            <!-- ID -->
            <td>{{ $product->id }}</td>

            <!-- 画像 -->
            <td>
                @if ($product->img_path)
                    <img class="product-img"
                        src="{{ asset('storage/' . $product->img_path) }}"
                        width="60">
                @else
                    画像なし
                @endif
            </td>

            <!-- 商品名 -->
            <td>{{ $product->product_name }}</td>

            <!-- 価格 -->
            <td>{{ number_format($product->price) }}円</td>

            <!-- 在庫数 -->
            <td>{{ $product->stock }}</td>

            <!-- メーカー名 -->
            <td>{{ $product->company->company_name }}</td>
            
            <!-- 操作ボタン -->
            <td class="action-cell">
                <div class="action-buttons">

                    <!-- 詳細ボタン -->
                    <a href="{{ route('products.show', $product->id) }}"
                        class="btn btn-detail"
                        >詳細
                    </a>

                    <!-- 削除ボタン -->
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete"
                                type="submit"
                                onclick="return confirm('削除しますか？');"
                            >削除
                        </button>
                    </form>
                    
                    <!-- 一時ログアウトボタン -->
                    <!-- <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form> -->

                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection
