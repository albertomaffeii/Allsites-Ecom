<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Mail\PlaceOrderMailable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class CheckoutShow extends Component
{
    public $carts, $order, $totalProductAmount = 0;

    public $fullname, $personal_tax_code, $email, $billing_email, $phone, $pincode, $country, $address, $payment_mode = NULL, $payment_id = NULL;

    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];

    public function paidOnlineOrder($value)
    {
        $this->payment_id = $value;
        $this->payment_mode = 'Paid by PayPal';

        $codOrder = $this->placeOrder();
        if ($codOrder) {

            Cart::where('user_id', auth()->user()->id)->delete();

            try{
                $order = Order::findOrFail($codOrder->id);
                Mail::to("$order->billing_email")->send(new PlaceOrderMailable($order));
            } catch(\Exception $e){
                return redirect('thank-you')->with('message', '<h2>Oops! Something Went Wrong</h2><p>We´re sorry, but there was an issue sending your order confirmation email. Please don´t worry; your order has been received and is being processed.<br />If you have any concerns or need further assistance, please don´t hesitate to contact our customer support team.</p>');
            }

            session()->flash('message', 'Order placed successfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order placed successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
        } else {

            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500
            ]);

        }
    }

    public function validationForAll()
    {
        $this->validate();
    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'personal_tax_code' => 'required|string|max:20',
            'email' => 'required|email|max:121',
            'billing_email' => 'required|email|max:121',
            'phone' => 'required|string|max:20|min:10',
            'pincode' => 'required|string|max:8|min:5',
            'country' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no'=> Str::random(10),
            'fullname' => $this->fullname,
            'personal_tax_code' => $this->personal_tax_code,
            'email' => $this->email,
            'billing_email' => $this->billing_email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'country' => $this->country,
            'address' => $this->address,
            'status_message' => 'Order Received',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id
        ]);

        foreach ($this->carts as $cartItem) {
            $order = Orderitem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'quantity_unit' => $cartItem->quantity_unit,
                'price' => $cartItem->product->selling_price
            ]);

            if ($cartItem->product_color_id != NULL) {

                $cartItem->productColor()->where('id', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);

            } else {

                $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
            }
        }

        return $order;
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();

        if ($codOrder) {

            Cart::where('user_id', auth()->user()->id)->delete();

            try{
                $order = Order::findOrFail($codOrder->order_id);

                Mail::to($order->billing_email)->send(new PlaceOrderMailable($order));
            }catch(\Exception $e){
                return redirect('thank-you')->with('message', '<h2>Oops! Something Went Wrong</h2><p>We´re sorry, but there was an issue sending your order confirmation email. Please don´t worry; your order has been received and is being processed.<br />If you have any concerns or need further assistance, please don´t hesitate to contact our customer support team.</p>');
            }

            session()->flash('message', 'Order placed successfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order placed successfully',
                'type' => 'success',
                'status' => 200
            ]);

            return redirect()->to('thank-you');

        } else {

            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500
            ]);

        }
    }

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }

        return $this->totalProductAmount;
    }

    public function render()
    {
        $settings = Setting::first();
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->totalProductAmount = $this->totalProductAmount();
        $this->personal_tax_code = Auth::user()->userDetail->personal_tax_code ?? '';
        $this->billing_email = Auth::user()->userDetail->billing_email ?? '';
        $this->country = Auth::user()->userDetail->country ?? '';
        $this->phone  = Auth::user()->userDetail->phone ?? '';
        $this->pincode = Auth::user()->userDetail->pin_code ?? '';
        $this->address = Auth::user()->userDetail->address ?? '';

        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount,
            'settings' => $settings,
        ]);
    }
}
