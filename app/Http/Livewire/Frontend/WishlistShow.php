<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;
use App\Models\Setting;

class WishlistShow extends Component
{
    public function removeWishlistItem(int $wishlistId)
    {
        Wishlist::where('user_id', auth()->user()->id)->where('id',$wishlistId)->delete();
        $this->emit('wishlistAddUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Wishlist item removed successfully',
            'type' => 'success',
            'status' => 200
        ]);
    }

    public function render()
    {
        $settings = Setting::first();
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlist' => $wishlist,
            'settings' => $settings
        ]);
    }
}
