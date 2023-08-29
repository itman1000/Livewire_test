<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Restaurant;

class RestaurantList extends Component
{
    public $restaurants;

    public function mount()
    {
        $this->restaurants = Restaurant::all();
    }

    public function showDetails($restaurantId)
    {
        // お店の詳細情報を取得して表示するロジック
        // この部分は具体的な実装が必要です。
    }

    public function render()
    {
        return view('livewire.restaurant-list');
    }
}
