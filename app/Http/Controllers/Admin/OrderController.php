<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        //$todayDate = Carbon::today()->toDateString();
        //$orders = Order::whereDate('created_at', $todayDate)->orderBy('id', 'DESC')->paginate(10);

        $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != null, function ($q) use ($request) {

                        return $q->whereDate('created_at', $request->date);
                    }, function ($q) use ($todayDate){

                        return $q->whereDate('created_at', $todayDate);
                    })
                    ->when($request->status != null, function ($q) use ($request) {

                        return $q->where('status_message', $request->status);
                    })
                    ->orderBy('id', 'DESC')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            return view('admin.orders.view', compact('order')); // Alterei 'admin.orders.index' para 'admin.orders.show'
        } else {
            return redirect()->route('admin.orders')->with('message', 'Order not found'); // Usei route() para redirecionar para a rota
        }
    }

    public function updateOrderStatus(Request $request, int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            $order->update([
                'status_message' => $request->order_status
            ]);
            return redirect('admin/orders/' . $orderId)->with('message','Order status updated');
        }else {
            return redirect('admin/orders/' . $orderId)->with('message','Order not found');
        }
    }

    public function edit(Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
