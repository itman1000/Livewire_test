<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:10',
        ],[
            'name.required' => '名前を入力してください',
            'name.string' => '文字で入力してください',
            'name.max' => ':max文字以内で入力してください',
        ]);

        $category = Category::create($validatedData);
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:10|string',
        ],[
            'name.required' => '名前を入力してください',
            'name.string' => '文字で入力してください',
            'name.max' => ':max文字以内で入力してください',
        ]);

        $category->update($validatedData);
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->restaurants()->count() > 0) {
            Session::flash('error', 'このカテゴリはレストランに使用されているため、削除できません。');
            return redirect()->back();
        }

        $category->delete();
        return redirect()->route('categories.index');
    }
}
