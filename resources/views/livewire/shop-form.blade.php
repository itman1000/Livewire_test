<div class="w-1/3 h-auto mx-auto my-8 mt-8">
    <h2 class="text-lg mb-8 text-center">お店 新規登録／編集画面</h2>

    <form wire:submit.prevent="showConfirmation">
        <div class="mb-4 ml-20">
            <label for="name" class="block mb-1">店名<span class="text-red-500 ml-1 leading-5">*</span></label>
            <input type="text" id="name" name="name" wire:model="name" placeholder="店名を入力" class="w-4/5 p-1 mr-2 border border-gray-400 rounded-md">
        </div>

        <div class="mb-4 ml-20">
            <label for="name_katakana" class="block mb-1">店名 フリガナ<span class="text-red-500 ml-1 leading-5">*</span></label>
            <input type="text" id="name_katakana" name="name_katakana" wire:model="name_katakana" placeholder="フリガナを入力" class="w-4/5 p-1 mr-2 border border-gray-400 rounded-md">
        </div>

        <div class="mb-4 ml-20">
            <label class="mb-1 block">カテゴリー<span class="text-red-500 ml-1 leading-5">*</span></label>
            <div class="flex flex-wrap">
                @foreach ($categories as $category)
                    <div class="mr-4 mb-2 flex-shrink-0">
                        <input type="checkbox" id="category_{{ $category->id }}" name="selected_categories[]" value="{{ $category->id }}" wire:model="selected_categories">
                        <label for="category_{{ $category->id }}" class="ml-1">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-4 ml-20">
            <label for="review" class="block mb-1">レビュー(最高:5/最低:1)<span class="text-red-500 ml-1 leading-5">*</span></label>
            <select id="review" name="review" required wire:model="review" class="border border-gray-400 rounded-md p-1">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="mb-4 ml-20">
            <label for="image" class="block mb-1">料理画面</label>
            <input type="file" id="image" name="image" wire:model="image">
        </div>


        <div class="mb-4 ml-20">
            <label for="map_url" class="block mb-1">Google Map URL</label>
            <input type="text" id="map_url" name="map_url" wire:model="map_url" placeholder="https://www.google.com/maps/･･･" class="w-4/5 p-1 mr-2 border border-gray-400 rounded-md">
        </div>

        <div class="mb-4 ml-20">
            <label for="phone" class="block mb-1">電話番号</label>
            <input type="text" id="phone" name="phone" placeholder="電話番号を入力" wire:model="phone" class="w-4/5 p-1 mr-2 border border-gray-400 rounded-md">
        </div>

        <div class="mb-4 ml-20">
            <label for="comment" class="block mb-1">コメント</label>
            <textarea id="comment" name="comment" rows="4" wire:model="comment" class="w-4/5 p-1 mr-2 border border-gray-400 rounded-md resize-none"></textarea>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="border py-1 px-6 mb-2 rounded-md border-gray-500 hover:bg-gray-200">確認画面へ</button>
        </div>
    </form>

    <div class="text-xs text-red-500 text-center mt-2">
        @error('name') <span class="error">{{ $message }}</span> @enderror
        @error('name_katakana') <span class="error">{{ $message }}</span> @enderror
        @error('selected_categories') <span class="error">{{ $message }}</span> @enderror
        @error('review') <span class="error">{{ $message }}</span> @enderror
        @error('image') <span class="error">{{ $message }}</span> @enderror
        @error('map_url') <span class="error">{{ $message }}</span> @enderror
        @error('phone') <span class="error">{{ $message }}</span> @enderror
        @error('comment') <span class="error">{{ $message }}</span> @enderror
    </div>

    @if($showConfirmationModal)
    <div class="fixed inset-0 flex items-center justify-center z-10">
        <div class="bg-white p-8 rounded-lg shadow-lg w-3/4 md:w-2/3 lg:w-1/2 z-20">
            <h3 class="text-xl font-bold mb-4 text-center">確認画面</h3>
            <p class="my-2">店名: {{ $name }}</p>
            <p class="my-2">店名 フリガナ: {{ $name_katakana }}</p>
            <p class="my-2">カテゴリー:
                @foreach($categories as $category)
                    @if(in_array($category->id, $this->selected_categories))
                        {{ $category->name }}&nbsp;
                    @endif
                @endforeach
            </p>
            <p class="my-2">レビュー: {{ $review }}</p>
            <div class="flex">
                <div class="my-2">
                    <p class="my-2">料理画面<p>
                    @if($image)
                        <img src="{{ $image->temporaryUrl() }}" alt="Uploaded Image" width="240">
                    @endif
                </div>
                <div class="my-2 ml-8">
                    <p class="my-2">Google Map</P>
                    @if($map_url)
                        {{-- {{ urldecode($map_url) }} --}}
                        <iframe
                            width="240"
                            height="180"
                            frameborder="0" style="border:0"
                            src="{{ $available_map_url }}" allowfullscreen>
                        </iframe>
                    @endif
                </div>
            </div>
            <p class="my-2">電話番号: {{ $phone }}</p>
            <p class="my-2">コメント: {{ $comment }}</p>

            <div class="mt-4 flex justify-end">
                <button wire:click="submitForm" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">送信</button>
                <button wire:click="$set('showConfirmationModal', false)" class="bg-gray-300 px-4 py-2 rounded">キャンセル</button>
            </div>
        </div>
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>
    @endif

</div>
