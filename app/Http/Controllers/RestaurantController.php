<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use App\Models\CategoryTag;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();

        return view('restaurants.index', ['restaurants' => $restaurants]);
    }


    public function create()
    {
        $categories = Category::all();
        return view('restaurants.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'name_katakana' => 'required|regex:/^[ァ-ヾ]+$/u',
            'category' => 'required|array',
            'review' => 'required|integer|between:1,5',
            'phone' => 'nullable|digits_between:1,15',
            'comment' => 'required|string|max:300',
        ]);

        $restaurant = Restaurant::create($request->all());

        foreach($request->category_ids as $categoryId) {
            CategoryTag::create([
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryId
            ]);
        }

        return redirect()->route('restaurants.index');
    }

    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.show', ['restaurant' => $restaurant]);
    }

    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.edit', ['restaurant' => $restaurant]);
    }


    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:20',
            'name_katakana' => 'required|regex:/^[ァ-ヾ]+$/u',
            'category' => 'required|array',
            'review' => 'required|integer|between:1,5',
            'phone' => 'nullable|digits_between:1,15',
            'comment' => 'required|string|max:300',
        ]);

        $restaurant->update($request->all());

        CategoryTag::where('restaurant_id', $id)->delete();
        foreach($request->category_ids as $categoryId) {
            CategoryTag::create([
                'restaurant_id' => $restaurant->id,
                'category_id' => $categoryId
            ]);
        }

        return redirect()->route('restaurants.index');
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('restaurants.index');
    }
}

