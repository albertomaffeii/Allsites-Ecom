<?php
namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Setting;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product, $prodColorSelectedQuantity, $quantityCount = 1, $productColorId, $quantity_unit;

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

    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
        $productColor = $this->product->productColors()->where('id',$productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if($this->prodColorSelectedQuantity == 0){
            $this->prodColorSelectedQuantity = 'outOfStock';
        }
    }

    public function incrementQuantity()
    {
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }
    }

    public function decrementQuantity()
    {
        if($this->quantityCount > 0){
            $this->quantityCount--;
        }
    }

    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $productId)->where('status', '0')->exists()) {
                // Check for product color quantity and insert to cart
                if ($this->product->productColors()->count() >= 1) {
                    if ($this->prodColorSelectedQuantity != NULL) {
                        $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                        if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->where('product_color_id', $productColor->id)->exists())
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product already added to cart',
                                'type' => 'warning',
                                'status' => 200
                            ]);

                        } else {

                            if ($productColor->quantity > 0) {
                                if ($productColor->quantity >= $this->quantityCount) {

                                    // Insert Product to cart with color
                                    cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount,
                                        'quantity_unit' => $this->quantity_unit
                                    ]);

                                    $this->emit('CartAddedUpdated');

                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Product added to Cart',
                                        'type' => 'success',
                                        'status' => 200
                                    ]);

                                } else {
                                    $msgText = ($productColor->quantity == 1) ? " unit available" : " units available";
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Only ' . $productColor->quantity . $msgText,
                                        'type' => 'warning',
                                        'status' => 404
                                    ]);
                                }
                            }
                        }

                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Select your product color',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                } else {

                    if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->where('product_color_id', NULL)->exists())
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product already added to cart',
                                'type' => 'warning',
                                'status' => 200
                            ]);

                        } else {

                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity >= $this->quantityCount) {

                                // Insert Product to cart without color
                                cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount,
                                    'quantity_unit' => $this->quantity_unit
                                ]);

                                $this->emit('CartAddedUpdated');

                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product added to Cart',
                                    'type' => 'success',
                                    'status' => 200
                                ]);

                            } else {
                                $msgText = ($this->product->quantity == 1) ? " unit available" : " units available";
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only ' . $this->product->quantity . $msgText,
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Out of stock',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product does not exist',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Login to add to cart',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
        $this->quantity_unit = $this->product->quantity_unit;
    }

    public function render()
    {
        $settings = Setting::first();
        return view('livewire.frontend.product.view', [
            'product' => $this->product,
            'category' => $this->category,
            'settings' => $settings
        ]);
    }
}
