<div class="w-1/3 h-auto mx-auto my-8">
    <p class="my-6 text-lg text-center">{{ $restaurant->name }} 詳細</p>
    <p class="my-3">{{ $restaurant->name_katakana }}</p>
    <p class="my-3">カテゴリー:
        @foreach($restaurant->categories as $category)
            {{ $category->name }}
        @endforeach
    </p>
    <p class="my-3">レビュー: {{ $restaurant->review }}</p>
    <div class="w-full m-auto flex flex-col items-center justify-center">
        <p class="mt-8 mb-4 text-center">料理写真<p>
        <div class="w-96 h-60 relative">
            <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('storage/' . $restaurant->food_picture) }}" alt="Default Image">
        </div>
    </div>
    <div class="w-full m-auto my-12  flex flex-col items-center justify-center">
        <p class="mb-4 text-center">Google Map</P>
        @if($available_map_url)
            <iframe
                width="360"
                height="270"
                frameborder="0" style="border:0"
                src="{{ $available_map_url }}" allowfullscreen>
            </iframe>
        @endif
    </div>
    <p class="my-3">電話番号: {{ $restaurant->phone }}</p>
    <p class="my-3">コメント: {{ $restaurant->comment }}</p>

    <div class="flex justify-center mt-8">
        <button wire:click="goBack" class="border p-1 rounded-md border-gray-500 bg-white hover:bg-gray-200">お店リストに戻る</button>
    </div>
</div>
