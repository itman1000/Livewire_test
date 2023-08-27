<x-layout>
    <div class="h-3/5 w-1/2 border border-slate-300 mx-auto mt-10 my-50 rounded-md">
        <div class="h-12 bg-emerald-300 rounded-t">
            <h3 class="text-xl text-center py-3">ユーザー登録</h3>
        </div>

        <div class="p-6 flex flex-col items-center">
            <form action="{{ route('auth.register') }}" method="post" class="w-1/2">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">名前</label>
                    <input type="text" name="name" value="{{ old('name')}}" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">メールアドレス</label>
                    <input type="text" name="email" value="{{ old('email')}}" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">パスワード</label>
                    <input type="password" name="password" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">確認用パスワード</label>
                    <input type="password" name="password_confirmation" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4 flex justify-center">
                    <button type="submit" class="px-4 py-2 mt-5 bg-blue-600 text-white rounded-md hover:bg-blue-700">登録</button>
                </div>
            </form>
        </div>
        @if($errors->any())
            <div class="errors">
                <ul class="text-xs text-red-500 text-center mt-10">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

</x-layout>
