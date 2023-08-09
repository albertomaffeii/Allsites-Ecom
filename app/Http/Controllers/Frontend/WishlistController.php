<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Wishlist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        } else {
            $wishlist = collect();
        }
    
        return view('frontend.wishlist.index', [
            'wishlist' => $wishlist
        ]);
    }
}
