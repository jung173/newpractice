<!-- 商品一覧テーブル -->
    <table class="product-table">

        <!-- テーブルヘッダー -->
        <tr class="table-header">
            <th class="italic col-id" data-sort="id">
                ID<span class="sort-icon"></span></th>
            <th class="col-img">商品画像</th>
            <th class="col-name" data-sort="product_name">
                商品名 <span class="sort-icon"></span>
            </th>

            <th class="col-price" data-sort="price">
                価格 <span class="sort-icon"></span>
            </th>

            <th class="col-stock" data-sort="stock">
                在庫数 <span class="sort-icon"></span>
            </th>

            <th class="col-company" data-sort="company_name">
                メーカー名 <span class="sort-icon"></span>
            </th>

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
                    <form class="delete-form"
                            action="{{ route('products.destroy', $product->id) }}"
                            method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete"
                                type="submit"
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