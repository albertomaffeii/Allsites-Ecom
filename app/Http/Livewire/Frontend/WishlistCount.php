<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistCount extends Component
{
    public $wishlistCount;

     
    protected $listeners = ['wishlistAddUpdated' => 'checkWishlistCount'];

    public function checkWishlistCount()
    {
        if (Auth::check()) {
            return $this->wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();
        } else {
            $this->wishlistCount = 0; 
        }
        
    }

    public function render()
    {
        return view('livewire.frontend.wishlist-count', [
            'wishlistCount' => $this->checkWishlistCount()
        ]);
    }
}
