<div class="w-screen h-auto">
    @if($showDetail)
        <livewire:restaurant-detail :restaurantId="$selectedRestaurantId">
    @else
        <div class="w-11/12 h-screen my-8 mx-8">
            <h2 class="text-lg mb-5">お店リスト</h2>

            <div class="w-full mb-5 flex gap-2.5">
                <input type="text" wire:model="search" placeholder="店名やカテゴリで検索..." class="w-1/4 p-1 border border-gray-400 rounded-md">
                <button wire:click="executeSearch" class="border p-1 rounded-md border-gray-500 bg-gray-300 hover:bg-gray-200">検索</button>
                <a href="{{ route('restaurants.export') }}" class="bg-blue-500 text-white px-4 py-2 ml-24 rounded-md hover:bg-blue-300">CSVダウンロード</a>
            </div>

            <table class="w-11/12 border-collapse">
                <thead>
                    <tr>
                        <th class="border border-gray-400 px-2 py-3 text-left w-7">ID</th>
                        <th class="border border-gray-400 px-2 py-3 text-left w-48">店名</th>
                        <th class="border border-gray-400 px-2 py-3 text-left w-32">カテゴリー</th>
                        <th class="border border-gray-400 px-1 py-3 text-left w-20">レビュー</th>
                        <th class="border border-gray-400 px-2 py-3 text-left w-auto">コメント</th>
                        <th class="border border-gray-400 px-2 py-3 text-center w-12">詳細</th>
                        <th class="border border-gray-400 px-2 py-3 text-center w-12">編集</th>
                        <th class="border border-gray-400 px-2 py-3 text-center w-12">削除</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($restaurants as $restaurant)
                    <tr>
                        <td class="border border-gray-400 px-2 py-3 text-left">{{ $restaurant->id }}</td>
                        <td class="border border-gray-400 px-2 py-3 text-left">{{ $restaurant->name }}</td>
                        <td class="border border-gray-400 px-2 py-3 text-left">
                            @foreach($restaurant->categories as $category)
                                {{ $category->name }}
                            @endforeach
                        </td>
                        <td class="border border-gray-400 px-2 py-3 text-center">{{ $restaurant->review }}</td>
                        <td class="border border-gray-400 px-2 py-3 text-left">{{ $restaurant->comment }}</td>
                        <td class="border border-gray-400 px-2 py-3 text-center w-12">
                            <button wire:click="showRestaurantDetail({{ $restaurant->id }})" class="w-12 h-7 bg-green-500 text-white border-none rounded-md duration-200 hover:bg-green-300">詳細</button>
                        </td>
                        <td class="border border-gray-400 px-2 py-3 text-center w-12">
                            <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="block w-12 h-7 pt-0.5 bg-blue-500 text-white border-none rounded-md duration-200 hover:bg-blue-300">編集</a>
                        </td>
                        <td class="border border-gray-400 px-2 py-3 text-center w-12">
                            <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('本当に削除しますか？');" class="w-12 h-7 bg-red-500 text-white border-none rounded-md duration-200 hover:bg-red-300">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
