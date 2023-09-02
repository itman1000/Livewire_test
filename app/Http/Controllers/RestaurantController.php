<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use App\Models\CategoryTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class RestaurantController extends Controller
{
    public function create()
    {
        return view('restaurants.create');
    }

    public function index($page = 1)
    {
        return view('restaurants.index', ['page' => $page]);
    }

    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $page = request()->query('page', 1);
        return view('restaurants.edit', ['restaurant' => $restaurant, 'page' => $page]);
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

