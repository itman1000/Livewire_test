<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livewire Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body class="text-slate-700 h-screen">
    <header>
        <div class="container mx-auto flex justify-between items-center bg-sky-200 py-2 px-4">
            <h1 class="text-2xl font-bold">Livewire Test</h1>
            <div class="">
                <a href="/login" wire:navigate class="mx-2 hover:cursor-pointer font-light">ログイン</a>
                <a href="/register" wire:navigate class="hover:cursor-pointer font-light">登録</a>
            </div>
        </div>
    </header>

    <main class="h-screen">
        <livewire:login />
    </main>

@livewireScripts
</body>
</html>
