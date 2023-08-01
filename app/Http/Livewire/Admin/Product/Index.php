<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $products = Product::orderBy('name','ASC')->paginate(10);
        return view('livewire.admin.product.index',['products' => $products]);
    }
}
