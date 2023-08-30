<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Restaurant;
use Livewire\Attributes\On;

class RestaurantList extends Component
{
    public $restaurants;
    public $showDetail = false;
    public $selectedRestaurantId = null;

    public function mount()
    {
        $this->restaurants = Restaurant::all();
    }

    public function showRestaurantDetail($restaurantId) {
        $this->showDetail = true;
        $this->selectedRestaurantId = $restaurantId;
    }

    #[On('showRestaurantList')]
    public function showRestaurantList() {
        $this->showDetail = false;
        $this->selectedRestaurantId = null;
    }

    public function render()
    {
        return view('livewire.restaurant-list');
    }
}
