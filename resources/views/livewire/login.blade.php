<div class="h-96 w-1/2 border border-slate-300 mx-auto mt-10 rounded-md" id="container-login">
    <div class="h-12 bg-sky-300 rounded-t">
        <h3 class="text-xl text-center py-3">ログイン</h3>
    </div>
    <div class="p-6 flex flex-col items-center">
        @if (session()->has('error'))
            <div class="mb-4 text-red-600">{{ session('error') }}</div>
        @endif

        <form wire:submit.prevent="login" class="w-1/2">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
                <input type="email" wire:model="email" id="email" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">パスワード</label>
                <input type="password" wire:model="password" id="password" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <div class="mt-4 flex justify-center">
                <button type="submit" class="px-4 py-2 mt-4 bg-blue-600 text-white rounded-md hover:bg-blue-400">ログイン</button>
            </div>
        </form>
    </div>
</div>

