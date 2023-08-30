<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\Category;

class RestaurantDetail extends Component
{
    public $restaurantId;
    public $restaurant;
    public $available_map_url;


    public function mount($restaurantId)
    {
        $this->restaurantId = $restaurantId;
        $this->loadRestaurant();
    }

    public function loadRestaurant()
    {
        $this->restaurant = Restaurant::find($this->restaurantId);

        $apiKey = env('GOOGLE_MAPS_API_KEY');

        if (preg_match('#https://www.google.co.jp/maps/place/([^/]+)/@#', $this->restaurant->map_url, $matches)) {
            $this->available_map_url = "https://www.google.com/maps/embed/v1/place?key={$apiKey}&q={$matches[1]}";
        } else {
            $this->available_map_url = null;
        }
    }

    public function render()
    {
        return view('livewire.restaurant-detail');
    }

    public function goBack()
    {
        $this->dispatch('showRestaurantList');
    }
}

