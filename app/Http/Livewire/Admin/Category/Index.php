<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $PaginationTheme = "bootstrap";

    public $category_id;

    public function deleteCategory($category_id) {

        $this->category_id = $category_id;
    }

    public function destroyCategory() {

        $category = Category::find($this->category_id);
    
        if ($category) {
            $path = 'uploads/category/' . $category->image;
            if (File::exists($path) && $category->image != 'no-image.png') {
                File::delete($path);
            }
            $category->delete();
    
            session()->flash('message', 'Category deleted.');
    
            $this->dispatchBrowserEvent('close-modal');
        } else {
            
            session()->flash('message', 'This category has been previously deleted.');
    
            $this->dispatchBrowserEvent('close-modal');

        }
    }    

    public function render()
    {
        $categories = Category::orderBy('name','ASC')->paginate(10);
        return view('livewire.admin.category.index',['categories' => $categories]);
    }
}
