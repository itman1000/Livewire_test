<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Restaurant;
use Livewire\Attributes\On;
use Livewire\WithPagination;


class RestaurantList extends Component
{
    use WithPagination;

    public $restaurants;
    public $showDetail = false;
    public $selectedRestaurantId = null;
    public $search = '';

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

    public function executeSearch()
    {
        $this->restaurants = Restaurant::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhereHas('categories', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.restaurant-list', ['restaurantsList' => Restaurant::paginate(5)]);
    }
}
