@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')

<div class="row">
    <div class="col-md-12">

        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Orders List</h4>
            </div>
            <div class="card-body">

                  <h4 class="text-primary">
                     <i class="fa fa-shopping-cart text-dark"></i> Order Details
                     <a href="{{ url('admin/orders') }}" class="btn btn-primary btn-sm text-white float-end mx-1">BACK</a>
                     <a href="{{ url('admin/invoice/' . $order->id . '/generate') }}" class="btn btn-secondary btn-sm text-white float-end mx-1">Download Invoice</a>
                     <a href="{{ url('admin/invoice/' . $order->id) }}" target="_blank" class="btn btn-warning btn-sm text-white float-end mx-1">View Invoice</a>
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
                     <table class="table table-bordered table-hover table-striped table-sm">
                        <thead class="table-light">
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
                                    <td width="11%" scope="row">{{ sprintf('%06d', $orderItem->id) }}</td>
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
                                    <td width="10%">${{ $orderItem->price }}</td>
                                    <td width="10%">{{ $orderItem->quantity }}</td>
                                    <td width="10%" class="fw-bold">${{ $orderItem->quantity * $orderItem->price }}</td>
                                    @php
                                        $subtotalPrice += $orderItem->quantity * $orderItem->price
                                    @endphp
                                </tr>
                            @endforeach
                        </table>
                        <br />
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th colspan="2">Payment details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="85%">Subtotal:</td>
                                    <td width="15%" class="fw-bold">${{ $subtotalPrice }}</td>
                                </tr>
                                <tr>
                                    <td width="85%">Shipping (Delivery Cost):</td>
                                    <td width="15%">$0.00{{-- $order->deliveryCost --}}</td>
                                </tr>
                                <tr>
                                    <td width="85%">Paypal Fees:</td>
                                    <td width="15%">$0.00{{-- $order->deliveryCost --}}</td>
                                </tr>
                                <tr>
                                    @php
                                        $totalPrice = $subtotalPrice + 0 + 0;
                                    @endphp
                                    <td width="85%" class="total-heading">Total Amount:</td>
                                    <td width="15%" class="total-heading">${{  $totalPrice }}</td>
                                </tr>
                            </tbody>
                        </table>
                  </div>

            </div>
         </div>
      </div>

      <div class="card border mt-3">
        <div class="card-body">
            <h4>Order Process (Order status update)</h4>
            <hr>
            <div class="col-md-12">
                <h5 class="p-1">
                    Current order status: <span class="text-uppercase text-success">{{ $order->status_message }}</span>
                </h5>
            </div>
                <div class="col-md-6 p-1">
                    <form action="{{ url('admin/orders/' . $order->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <label for="update_status">Update order status</label>
                        <div class="input-group">
                            <select name="order_status" class="form-select" style="height: 38px;">
                                <option value="">All Status</option>
                                <option value="order received" {{ Request::get('status') == 'order received' ? 'selected':'' }}>Order Received</option>
                                <option value="payment confirmed" {{ Request::get('status') == 'payment confirmed' ? 'selected':'' }}>Payment Confirmed</option>
                                <option value="completed" {{ Request::get('status') == 'completed' ? 'selected':'' }}>Completed</option>
                                <option value="pending" {{ Request::get('status') == 'pending' ? 'selected':'' }}>Pending</option>
                                <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected':'' }}>Cancelled</option>
                                <option value="out-of-delivery" {{ Request::get('status') == 'out-of-delivery' ? 'selected':'' }}>Out of delivery</option>
                            </select>
                            <button type="submit" class="btn btn-primary text-white btn-sm">Update</button>

                        </div>
                    </form>
                </div>
            </div>

        </div>
      </div>
   </div>
</div>
@endsection
