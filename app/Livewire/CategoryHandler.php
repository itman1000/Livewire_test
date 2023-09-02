<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoryHandler extends Component
{
    use WithPagination;

    public $name;
    public $categories;
    public $editingId = null;
    public $editingName = '';

    protected $rules = [
        'name' => 'required|string|max:10',
    ];

    protected $messages = [
        'name.required' => '名前を入力してください',
        'name.string' => '文字で入力してください',
        'name.max' => ':max文字以内で入力してください',
    ];


    public function mount()
    {
        $this->categories = Category::all();
    }

    public function store()
    {
        $this->validate();

        Category::create(['name' => $this->name]);
        $this->name = '';
        $this->categories = Category::all();
    }

    public function edit($id)
    {
        $this->editingId = $id;
        $this->editingName = Category::find($id)->name;
    }

    public function update()
    {
        if ($this->editingId) {
            $this->name = $this->editingName;
            $this->validate();
            Category::find($this->editingId)->update(['name' => $this->editingName]);
            $this->editingId = null;
            $this->editingName = '';
            $this->name = '';
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
