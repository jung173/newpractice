<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>商品管理</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Vite（JS読み込み） --}}
    @vite(['resources/js/app.js'])

    {{-- 商品画面用CSS --}}
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
</head>
<body>

    @yield('content')

</body>
</html>