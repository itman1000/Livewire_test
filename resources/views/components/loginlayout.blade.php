<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="w-full bg-gray-200 border-b border-b-gray-300 rougded-md">Gourmet Log</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body class="text-slate-700 h-screen">
    <div class="flex h-screen w-full">
        <aside class="w-1/5 bg-emerald-400 text-white py-5 shadow shadow-gray-300">
            <h1 class="mb-14 font-black text-2xl text-center">Gourmet Log</h1>
            <ul class="text-center text-base">
                <li class="py-4 border-t border-b border-white text-lg">MENU</li>
                <li class="py-3 mt-4 hover:bg-white hover:text-gray-500"><a href="/restaurants">お店リスト</a></li>
                <li class="py-3 hover:bg-white hover:text-gray-500"><a href="/restaurants/create">お店登録／編集</a></li>
                <li class="py-3 hover:bg-white hover:text-gray-500"><a href="/categories">カテゴリー管理</a></li>
                <li class="py-3 hover:bg-white hover:text-gray-500">
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <li><button class="logout_button hover:bg-white hover:text-gray-500" type="submit">ログアウト</button></li>
                    </form>
                </li>
            </ul>

            <footer>
                <p class="pt-12 fixed bottom-5 left-5">エックス</p>
            </footer>
        </aside>

        {{ $slot }}

    </div>

    @livewireScripts
</body>
</html>
