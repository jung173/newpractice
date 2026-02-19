<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-200 min-h-screen flex items-center justify-center">

    <!-- ログインカード -->
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">

        <!-- ロゴ（不要なら消してOK） -->
        <div class="flex justify-center mb-6">
            {{ $logo ?? '' }}
        </div>

        <!-- フォーム本体 -->
        {{ $slot }}

    </div>

</body>
</html>