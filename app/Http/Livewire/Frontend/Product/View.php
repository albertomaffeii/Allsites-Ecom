<?php
namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product, $prodColorSelectedQuantity;

    public function addToWishList($productId) 
    {
        if(Auth::check())
        {
            if (Wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists()) 
            {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product already added to wishlist.',
                    'type' => 'warning',
                    'status' => 409         
                ]);
                return false;

            } else {

                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product successfully added to Wishlist.',
                    'type' => 'success',
                    'status' => 200         
                ]);

            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Login to continue, please.',
                'type' => 'info',
                'status' => 401            
            ]);
            return false;
        }
    }

    public function colorSelected($productColorId) {
        $productColor = $this->product->productColors()->where('id',$productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if($this->prodColorSelectedQuantity == 0){
            $this->prodColorSelectedQuantity = 'outOfStock';
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'product' => $this->product,
            'category' => $this->category
        ]);
    }
}
