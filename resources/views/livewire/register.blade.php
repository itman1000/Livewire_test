<div>
    <div class="h-3/5 w-1/2 border border-slate-300 mx-auto mt-10 my-50 rounded-md" id="container-register">
        <div class="h-12 bg-sky-300 rounded-t">
            <h3 class="text-xl text-center py-3">ユーザー登録</h3>
        </div>
        <div class="p-6 flex flex-col items-center">
            @if (session()->has('message'))
                <div class="mb-4 text-green-600">{{ session('message') }}</div>
            @endif

            <form wire:submit.prevent="register" class="w-1/2">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">名前</label>
                    <input type="text" wire:model="name" id="name" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
                    <input type="email" wire:model="email" id="email" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">パスワード</label>
                    <input type="password" wire:model="password" id="password" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="passwordConfirmation" class="block text-sm font-medium text-gray-700">パスワード確認</label>
                    <input type="password" wire:model="passwordConfirmation" id="passwordConfirmation" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <div class="mt-4 flex justify-center">
                    <button type="submit" class="px-4 py-2 mt-5 bg-blue-600 text-white rounded-md hover:bg-blue-700">登録</button>
                </div>
            </form>

        </div>
    </div>
    <div class="text-xs text-red-500 text-center mt-5">
        <div>@error('name') {{ $message }} @enderror</div>
        <div>@error('email') {{ $message }} @enderror</div>
        <div>@error('password') {{ $message }} @enderror</div>
    </div>
</div>
