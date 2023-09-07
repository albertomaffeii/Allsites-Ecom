<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\SettingController;

class OrderController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('frontend.orders.index', compact('orders', 'settings'));
    }

    public function show(Int $orderId)
    {
        $settings = Setting::first();
        $order = Order::where('user_id', auth()->user()->id)->where('id', $orderId)->first();
        if($order) {

            return view('frontend.orders.view', compact('order', 'settings'));

        }else {

            return redirect()->back()->with('message', 'No Order found');

        }
    }
}
