<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use App\Models\CategoryTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class RestaurantController extends Controller
{
    public $showDetail = false;
    public $selectedRestaurantId = null;

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

    public function showDetail($restaurantId) {
        $this->showDetail = true;
        $this->selectedRestaurantId = $restaurantId;
    }

    public function export()
    {
        $restaurants = Restaurant::all();
        $csvFileName = 'restaurants.csv';
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['ID', '店名', 'フリガナ', 'カテゴリー', 'レビュー', 'コメント']);

        foreach ($restaurants as $restaurant) {
            $categories = $restaurant->categories->pluck('name')->implode(', ');
            fputcsv($handle, [$restaurant->id, $restaurant->name, $restaurant->name_katakana, $categories, $restaurant->review, $restaurant->comment]);
        }

        fclose($handle);

        return response('', 200, $headers);
    }
}

