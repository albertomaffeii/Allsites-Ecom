<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CartController extends Controller
{
   public function index()
    {
        return view('frontend.cart.index');
    }

}
