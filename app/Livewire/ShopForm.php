<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\CategoryTag;

class ShopForm extends Component
{
    use WithFileUploads;

    public $name;
    public $name_katakana;
    public $selected_categories = [];
    public $categories;
    public $review = 5;
    public $image;
    public $map_url;
    public $available_map_url;
    public $phone;
    public $comment;
    public $restaurant = null;

    public $showConfirmationModal;

    protected $rules = [
        'name' => 'required|string|max:50',
        'name_katakana' => 'required|string|max:100',
        'selected_categories' => 'required|array|min:1',
        'review' => 'required|integer|min:1|max:5',
        'image' => 'nullable|image|max:2048',
        'map_url' => 'nullable|string|max:1200',
        'phone' => 'nullable|string|max:15',
        'comment' => 'nullable|string|max:150',
    ];

    protected $messages = [
        'name.required' => '店名は必須です。',
        'name.string' => '店名は文字列で入力してください。',
        'name.max' => '店名は最大50文字までです。',

        'name_katakana.required' => '店名のフリガナは必須です。',
        'name_katakana.string' => '店名のフリガナは文字列で入力してください。',
        'name_katakana.max' => '店名のフリガナは最大100文字までです。',

        'selected_categories.required' => 'カテゴリーは必須です。',
        'selected_categories.array' => 'カテゴリーは配列形式で選択してください。',

        'review.required' => 'レビューは必須です。',
        'review.integer' => 'レビューは整数で入力してください。',
        'review.min' => 'レビューは1以上を選択してください。',
        'review.max' => 'レビューは5以下を選択してください。',

        'image.image' => 'アップロードされたファイルは画像でなければなりません。',
        'image.max' => '画像は2MB以下のものをアップロードしてください。',

        'map_url.string' => 'Google Map URLは文字列で入力してください。',
        'map_url.max' => 'Google Map URLは最大1200文字までです。',

        'phone.string' => '電話番号は文字列で入力してください。',
        'phone.max' => '電話番号は最大15文字までです。',

        'comment.string' => 'コメントは文字列で入力してください。',
        'comment.max' => 'コメントは最大150文字までです。',
    ];

    public function mount(Restaurant $restaurant = null)
    {
        $this->showConfirmationModal = false;

        if ($restaurant->exists) {
            $this->restaurant = $restaurant;
            $this->category = $this->restaurant->category;
            $this->name = $this->restaurant->name;
            $this->name_katakana = $this->restaurant->name_katakana;
            $this->review = $this->restaurant->review;
            $this->image = $this->restaurant->image;
            $this->map_url = $this->restaurant->map_url;
            $this->phone = $this->restaurant->phone;
            $this->comment = $this->restaurant->comment;
        }
    }

    public function showConfirmation()
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        if (preg_match('#https://www.google.co.jp/maps/place/([^/]+)/@#', $this->map_url, $matches)) {
            $this->available_map_url = "https://www.google.com/maps/embed/v1/place?key={$apiKey}&q={$matches[1]}";
        } else {
            $this->available_map_url = null;
        }

        $this->validate();
        $this->showConfirmationModal = true;
    }

    public function submitForm()
    {
        $this->validate();

        if ($this->image) {
            $imageName = $this->image->store('restaurants', 'public');
        }

        if (!$this->restaurant) {
            $restaurant = Restaurant::create([
                'user_id' => auth()->id(),
                'name' => $this->name,
                'name_katakana' => $this->name_katakana,
                'review' => $this->review,
                'image' => $imageName ?? null,
                'map_url' => $this->map_url ?? null,
                'phone' => $this->phone,
                'comment' => $this->comment,
            ]);
            $restaurant->categories()->sync($this->selected_categories);
        } else {
            $this->restaurant->update([
                'name' => $this->name,
                'name_katakana' => $this->name_katakana,
                'review' => $this->review,
                'image' => $imageName ?? null,
                'map_url' => $this->map_url ?? null,
                'phone' => $this->phone,
                'comment' => $this->comment,
            ]);
            $this->restaurant->categories()->sync($this->selected_categories);
        }

        $this->showConfirmationModal = false;

        return view('livewire.shop-form');
    }

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.shop-form', ['categories' => $this->categories]);
    }
}
