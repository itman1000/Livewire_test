<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoryHandler extends Component
{
    use WithPagination;

    public $categories;
    public $editingId = null;
    public $editingName = '';

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:10',
        ],[
            'name.required' => '名前を入力してください',
            'name.string' => '文字で入力してください',
            'name.max' => ':max文字以内で入力してください',
        ]);

        Category::create($validatedData);
        $this->categories = Category::all();
    }

    public function edit($id)
    {
        $this->editingId = $id;
        $this->editingName = Category::find($id)->name;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'editingName' => 'required|max:10|string',
        ],[
            'editingName.required' => '名前を入力してください',
            'editingName.string' => '文字で入力してください',
            'editingName.max' => ':max文字以内で入力してください',
        ]);

        if ($this->editingId) {
            $category = Category::find($this->editingId);
            $category->name = $validatedData['editingName'];
            $category->save();
            $this->editingId = null;
            $this->categories = Category::all();
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->restaurants()->count() > 0) {
            session()->flash('error', 'このカテゴリはレストランに使用されているため、削除できません。');
            return;
        }

        $category->delete();
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.category-handler', ['categoriesList' => Category::paginate(5)]);
    }
}
