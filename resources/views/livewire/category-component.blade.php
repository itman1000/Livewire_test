<div class="w-11/12 h-auto mx-8 my-8">
    <h2 class="text-lg mb-5">カテゴリー管理</h2>

    <form action="{{ route('categories.store') }}" method="POST" class="w-full mb-5 gap-2.5">
        @csrf
        <div class="w-full mb-2">
            <label for="text">新規カテゴリー<span class="text-red-500 ml-1 leading-5">*</span></label>
        </div>
        <input type="text" name="name" class="w-1/5 p-1 mr-2 border border-gray-400 rounded-md" placeholder="新規カテゴリー名を入力">
        <button type="submit" class="border p-1 rounded-md border-gray-500 bg-gray-300 hover:bg-gray-200">登録</button>
    </form>

    <table class="w-3/5 border-collapse ">
        <thead>
            <tr>
                <th class="border border-gray-400 px-2 py-3 text-left w-7">ID</th>
                <th class="border border-gray-400 px-2 py-3 text-left">カテゴリー</th>
                <th class="border border-gray-400 px-2 py-3 text-center w-12">編集</th>
                <th class="border border-gray-400 px-2 py-3 text-center w-12">削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td class="border border-gray-400 px-2 py-3 text-left w-7">{{ $category->id }}</td>
                <td class="border border-gray-400 px-2 py-3 text-left">{{ $category->name }}</td>
                <td class="border border-gray-400 px-2 py-3 text-left w-12">
                    <div class="w-12 h-7 bg-blue-500 text-white border-none rounded-md duration-200 hover:bg-blue-300">
                        <a class="text-sm align-middle ml-2" href="{{ route('categories.edit', $category->id) }}">編集</a>
                    </div>
                </td>
                <td class="border border-gray-400 px-2 py-3 text-left w-12">
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-12 h-7 bg-red-500 text-white border-none rounded-md duration-200 hover:bg-red-300" onclick="return confirm('本当にこのカテゴリを削除しますか？');">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
