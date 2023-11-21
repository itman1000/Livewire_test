<x-layout>
    <div>
        <div class="h-auto w-1/2 border border-slate-300 mx-auto mt-10 rounded-md" id="container-login">
            <div class="h-12 bg-emerald-300 rounded-t">
                <h3 class="text-xl text-center py-3">ログイン</h3>
            </div>

            <div class="p-6 flex flex-col items-center">
                <form action="{{ route('auth.login') }}" method="post" class="w-1/2">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">メールアドレス</label>
                        <input type="text" name="email" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">パスワード</label>
                        <input type="password" name="password" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" name="remember"> このブラウザに認証情報を記憶
                    </div>
                    <div class="mb-4 flex justify-center">
                        <button type="submit" class="px-4 py-2 mt-4 bg-blue-600 text-white rounded-md hover:bg-blue-400">ログイン</button>
                    </div>
                </form>

                <a href="{{ route('login.google') }}" class="px-4 py-2 mt-4 bg-red-600 text-white rounded-md hover:bg-red-400">Googleでログイン</a>
            </div>
        </div>

        @if($errors->any())
            <div class="errors">
                <ul class="text-xs text-red-500 text-center mt-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-layout>
