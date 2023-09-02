<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Restaurant;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class RestaurantList extends Component
{
    use WithPagination;

    public $showDetail = false;
    public $selectedRestaurantId = null;
    public $search = '';
    public $page = 1;
    protected $queryString = ['page'];


    public function mount($page = 1)
    {
        $this->page = $page;
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

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();
        $this->restaurants = Restaurant::all();
    }

    public function executeSearch()
    {
        $query = Restaurant::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhereHas('categories', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
        }

        return $query->paginate(5);
    }

    public function render()
    {
        $restaurants = $this->executeSearch();
        $this->page = $restaurants->currentPage();

        return view('livewire.restaurant-list', [
            'restaurants' => $restaurants,
        ]);
    }
}
