<x-layout>
    <div class="container-create">
        <h2>お店 新規登録／編集画面</h2>

        <form action="/shops" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-name">
                <label for="name">店名</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-name_kana">
                <label for="name_kana">店名 フリガナ</label>
                <input type="text" id="name_kana" name="name_kana" required>
            </div>

            <div class="form-checkbox">
                <label>カテゴリー</label>
                @foreach ($categories as $category)
                    <div class="checkbox">
                        <input type="checkbox" id="category_{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                        <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-review">
                <label for="review">レビュー</label>
                <select id="review" name="review" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="form-image">
                <label for="image">料理画面</label>
                <input type="file" id="image" name="image">
            </div>

            <div class="form-map">
                <label for="map_url">Google Map URL</label>
                <input type="text" id="map_url" name="map_url">
            </div>

            <div class="form-phone">
                <label for="phone">電話番号</label>
                <input type="text" id="phone" name="phone">
            </div>

            <div class="form-comment">
                <label for="comment">コメント</label>
                <textarea id="comment" name="comment" rows="4"></textarea>
            </div>

            <div class="form-submit">
                <button type="submit">確認画面</button>
            </div>
        </form>
    </div>
</x-layout>
