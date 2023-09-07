@extends('layouts.app')

@section('title', 'Allsites Ecom: My Orders Details')

@section('content')

   <div class="py-3 py-md-5">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="shadow bg-white p-3">

                  <h4 class="text-primary">
                     <i class="fa fa-shopping-cart text-dark"></i> My Orders Details
                     <a href="{{ route('orders') }}" class="btn btn-danger btn-sm float-end">BACK</a>
                  </h4>
                  <hr>

                  <div class="row">
                     <div class="col-md-6">
                        <h5>Order Details</h5>
                        <hr>
                        <h6>Order Id: {{ sprintf('%06d', $order->id) }}</h6>
                        <h6>Tracking Id/No.: {{ $order->tracking_no }}</h6>
                        <h6>Ordered Data: {{ $order->created_at->format('Y-m-d \a\t h:i A') }}</h6>
                        <h6>Payment Mode: {{ $order->payment_mode }}</h6>
                        <h6 class="border p-2 text-success">
                           Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                        </h6>
                     </div>
                     <div class="col-md-6">
                        <h5>User Details</h5>
                        <hr>
                        <h6>Name: {{ $order->fullname }}</h6>
                        <h6>Email: {{ $order->email }}</h6>
                        <h6>Phone: {{ $order->phone }}</h6>
                        <h6>Address: {{ $order->address }}</h6>
                        <h6>Pin-Code: {{ $order->pincode }}</h6>
                     </div>
                  </div>

                  <br />
                  <h5>Order Items</h5>
                  <hr>
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th  scope="col">Product ID</th>
                              <th  scope="col">Image</th>
                              <th  scope="col">Prodct</th>
                              <th  scope="col">Price</th>
                              <th  scope="col">Quantity</th>
                              <th  scope="col">Total</th></tr>
                        </thead>
                        <tbody>
                            @php
                                $totalPrice = 0;
                                $subtotalPrice = 0;
                            @endphp
                            @foreach($order->orderItems as $orderItem)
                                <tr>
                                    <td width="10%" scope="row">{{ sprintf('%06d', $orderItem->id) }}</td>
                                    <td width="10%">
                                        @if($orderItem->product->productImages)
                                        <img align="left" hspace="10" src="{{ asset($orderItem->product->productImages[0]->image) }}" style="width: 120px;" alt="{{ $orderItem->product->name }}">
                                        @else
                                        <img src="{{ asset('uploads/products/no-image.png') }}" style="width: 120px;" alt="No image">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $orderItem->product->name }}
                                        @if($orderItem->productColor)
                                            @if($orderItem->productColor->color)
                                                - Color: {{ $orderItem->productColor->color->name  }}
                                            @endif
                                        @endif
                                    </td>
                                    <td width="10%">{{ $appSetting->currency_type }} {{ $settings->formatNumber($orderItem->price, 2) }}</td>
                                    <td width="10%">{{ $settings->formatNumber($orderItem->quantity, 4) }}</td>
                                    <td width="10%" class="fw-bold">{{ $appSetting->currency_type }} {{ $settings->formatNumber($orderItem->quantity * $orderItem->price, 2) }}</td>
                                    @php
                                        $subtotalPrice += $orderItem->quantity * $orderItem->price
                                    @endphp
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">Subtotal:</td>
                                <td width="10%" class="fw-bold">${{ $subtotalPrice }}</td>
                            </tr>
                            <tr>
                                <td colspan="5">Shipping (Delivery Cost):</td>
                                <td width="10%">$0.00{{-- $order->deliveryCost --}}</td>
                            </tr>
                            <tr>
                                <td colspan="5">Paypal Fees:</td>
                                <td width="10%">$0.00{{-- $order->deliveryCost --}}</td>
                            </tr>
                            <tr>
                                @php
                                    $totalPrice = $subtotalPrice + 0 + 0;
                                @endphp
                                <td colspan="5">Total Amount:</td>
                                <td width="10%" class="fw-bold">${{  $totalPrice }}</td>
                            </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection
