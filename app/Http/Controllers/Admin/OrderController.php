<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(Request $request)
    {
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
            return view('admin.orders.view', compact('order'));
        } else {
            return redirect()->route('admin.orders')->with('message', 'Order not found');
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

    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $settings = Setting::first();
        return view('admin.invoice.generate-invoice', compact('order', 'settings'));
    }

    public function generateInvoice(int $orderId)
{
    $order = Order::findOrFail($orderId);
    $settings = Setting::first();
    $pdf = Pdf::loadView('admin.invoice.generate-invoice', compact('order', 'settings'));

    $todayDate = Carbon::now()->format('Y-m-d');
    $invoiceNumber = sprintf('%06d', $order->id);

    return $pdf->download('Invoice#-' . $invoiceNumber . '-' . $todayDate . '.pdf');
}

    public function generateInvoice_OLD(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];

        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);

        $todayDate = Carbon::now()->format('Y-m-d');
        $invoiceNumber = sprintf('%06d', $order->id);

        return $pdf->download('Invoice#-' . $invoiceNumber . '-' . $todayDate . '.pdf');
    }
}
