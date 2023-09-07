<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Setting;


class CartShow extends Component
{
    public $cart, $totalPrice = 0;

    public function removeCartItem(int $cardId)
    {
        Cart::where('user_id', auth()->user()->id)->where('id',$cardId)->delete();
        $this->emit('CartAddedUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Cart item removed successfully',
            'type' => 'success',
            'status' => 200
        ]);
    }

    public function decrementQuantity(Int $cardId)
    {
        $cartData = Cart::where('id', $cardId)->where('user_id', auth()->user()->id)->first();
        if ($cartData)
        {
            if($cartData->productColor()->where('id', $cartData->product_color_id)->first())
            {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if($cartData->quantity >= 1){

                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => '<strong>Minimum quantity reached</strong><br /> The product cannot have a quantity lower than 0.',
                        'type' => 'warning',
                        'status' => 404
                    ]);
                }
            } else {
                if($cartData->quantity >= 1){
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $msgText = ($cartData->product->quantity == 1) ? " unit available" : " units available";
                    $this->dispatchBrowserEvent('message', [
                        'text' => '<strong>Minimum quantity reached</strong><br /> The product cannot have a quantity lower than 0.',
                        'type' => 'warning',
                        'status' => 404
                    ]);
                }
            }
        } else {

            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong!',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    public function incrementQuantity(Int $cardId)
    {
        $cartData = Cart::where('id', $cardId)->where('user_id', auth()->user()->id)->first();
        if ($cartData)
        {
            if($cartData->productColor()->where('id', $cartData->product_color_id)->first())
            {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if($productColor->quantity > $cartData->quantity){

                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
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
            } else {
                if($cartData->product->quantity > $cartData->quantity )
                {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $msgText = ($cartData->product->quantity == 1) ? " unit available" : " units available";
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only ' . $cartData->product->quantity . $msgText,
                        'type' => 'warning',
                        'status' => 404
                    ]);
                }
            }
        } else {

            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong!',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    public function render()
    {
        $settings = Setting::first();
        $this->cart = Cart::where('user_id', auth()->user()->id)
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->orderBy('products.name', 'ASC')
        ->select('carts.*', 'products.quantity as product_quantity')
        ->with('product')
        ->get();

        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart,
            'settings' => $settings
        ]);
    }

}
