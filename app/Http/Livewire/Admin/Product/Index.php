<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {

        $settings = Setting::first();
        $products = Product::orderBy('name','ASC')->paginate(10);
        return view('livewire.admin.product.index',[
            'products' => $products,
            'settings' => $settings
        ]);
    }
}
