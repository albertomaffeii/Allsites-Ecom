<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout.index');
    }

}
