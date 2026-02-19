<style>
    /* =========================
    　　ベース設定
       ========================= */

    /* 
     * ブラウザ標準の余白をリセット
     * レイアウト計算をシンプルにするため必須
     */
    body {
        margin: 0;
    }

    /*
     * 画面全体を中央寄せするラッパー
     * ・min-height: 100vh → 画面高さいっぱいを確保
     * ・flex中央寄せ → ログイン画面を常に中央表示
     * ・padding → スマホで上下が切れないようにする保険
     */
    .page-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;  /* 横中央 */
        align-items: center;      /* 縦中央 */
        padding: 40px 20px;       /* 小画面対応（重要） */
    }

    /*
     * ログイン画面のメインボックス
     * max-widthでPC表示時の横伸びを防ぐ
     */
    .login-box {
        width: 100%;
        max-width: 640px;
        padding: 40px;
    }

    /*
     * スマホ・タブレット向け調整
     * paddingを減らして画面占有率を下げる
     */
    @media screen and (max-width: 768px) {
        .login-box {
            padding: 20px;
        }
    }

    /* =========================
    　　タイトル
       ========================= */

    /*
     * 画面タイトル
     * flex指定はテキスト中央揃えを確実にするため
     */
    .page-title {
        font-weight: normal;   /* h1のデフォルト太字を解除 */
        font-size: 38px;
        margin: 0;
        margin-bottom: 60px;   /* フォームとの余白 */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /*
     * 入力欄1行分のラッパー
     * 中央揃え＆縦方向の間隔をここで管理
     */
    .login-form-group {
        /*
        * デザイン仕様に基づく余白
        * ※ 数値変更時は全体バランス要確認
        */
        margin-bottom: 95px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /*
     * 最後の入力欄のみ余白を消す
     * ボタンエリアとの距離は別で制御するため
     */
    .last-input {
        margin-bottom: 0;
    }

    /*
     * 入力フィールド共通スタイル
     * width:100% → login-box内で最大幅を使う
     */
    .input-field {
        width: 100%;
        height: 52px;
        font-size: 22px;
        padding: 12px 25px;
    }

    /* =========================
    　　ボタンエリア
       ========================= */

    /*
     * 新規登録・ログインボタンのラッパー
     * gapでボタン間隔を管理（marginより安全）
     */
    .form-buttons {
        margin-top: 70px;
        display: flex;
        gap: 150px;
        align-items: center;
        justify-content: center;
    }

    /*
     * ボタン共通スタイル
     * aタグ・buttonタグ両対応
     */
    .btn {
        box-sizing: border-box;
        border: 1px solid #ccc;
        cursor: pointer;
        color: black;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 27px;
        font-family: inherit;

        width: 190px;
        height: 48px;
        border-radius: 9999px;

        /*
         * paddingを0にしないと
         * buttonとaで高さズレが起きる
         */
        padding: 0;
        line-height: 1;

        /* iOS / Safari のデフォルト装飾を無効化 */
        appearance: none;
        -webkit-appearance: none;

        /* aタグの下線対策 */
        text-decoration: none;
    }

    /* 新規登録ボタン（注意：色変更はデザイン影響大） */
    .btn-register {
        background-color: #FF9800;
    }

    /* 戻るボタン */
    .btn-back {
        background-color: #0ac1ff;
    }
</style>

<x-guest-layout>
    <!-- 
        画面全体の中央寄せ用ラッパー
        ※ flex中央寄せはCSS側で制御
    -->
    <div class="page-wrapper">

        <!-- 
            セッションステータス表示
            ・ログアウト後
            ・パスワードリセット後
            などのメッセージを表示
            ※ Laravel Breeze / Jetstream 標準
        -->

        <!-- 
            ログイン画面のメインコンテナ
            幅制御・余白はCSS側で管理
        -->
        <div class="login-box">

            <!-- 画面タイトル -->
            <h1 class="page-title">
                ユーザー新規登録画面
            </h1>

            <!-- 
                ユーザー新規登録フォーム
                action: 認証用ルート(register)
                method: POST（CSRF必須）
            -->
            <form method="POST" action="{{ route('register') }}">
                @csrf  <!-- CSRF対策（削除不可） -->

                <!-- =========================
                　　　メールアドレス入力
                　　　========================= -->
                <div class="login-form-group">
                    <!-- 
                        Laravel Blade コンポーネント
                        ・type / name はバリデーションと連動
                        ・old()で入力値を保持
                        .メッセージ表示のためpatternは削除した
                    -->
                    <x-text-input 
                        class="input-field"
                        id="email"
                        name="email"
                        type="text"
                        placeholder="メールアドレス"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        inputmode="email"
                        
                    />

                    <!-- バリデーションエラー表示 -->
                    <x-input-error 
                        :messages="$errors->get('email')" 
                        class="mt-2" 
                    />
                </div>

                <!-- =========================
                　　　パスワード入力
                　　　========================= -->
                <div class="login-form-group last-input">
                    <!-- 
                        .メッセージ表示のためpatternは削除した
                    -->
                    <x-text-input
                        class="input-field"
                        id="password"
                        name="password"
                        type="password"
                        placeholder="パスワード"
                        required
                        autocomplete="current-password"
                        inputmode="latin"
                        
                    />

                    <!-- バリデーションエラー表示 -->
                    <x-input-error 
                        :messages="$errors->get('password')" 
                        class="mt-2" 
                    />
                </div>

                <!-- =========================
                　　　ボタンエリア
            　　　　　========================= -->
                <div class="form-buttons">

                    <!-- 
                        新期登録実行ボタン
                        submitでフォーム送信
                        登録完了後にログイン画面へ遷移
                    -->

                    <button
                        type="submit"
                        class="btn btn-register"
                    >
                        新規登録
                    </button>

                    <!-- 
                        ユーザーログイン画面へ遷移
                        aタグにしているのは
                        「画面遷移」であるため
                    -->
                    <a 
                        href="{{ route('login') }}" 
                        class="btn btn-back"
                    >
                        戻る
                    </a>

                </div>

            </form>
        </div>
    </div>
</x-guest-layout>
