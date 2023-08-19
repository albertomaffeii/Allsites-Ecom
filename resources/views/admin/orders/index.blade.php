@extends('layouts.admin')

@section('title', 'Orders List')

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

                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="date">Filter by Date</label>
                            <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}" class="form-control"  style="height: 38px;" />
                        </div>
                        <div class="col-md-3">
                            <label for="status">Filter by Status</label>
                            <select name="status" class="form-control" style="height: 38px;">
                                <option value="">All Status</option>
                                <option value="order received" {{ Request::get('status') == 'order received' ? 'selected':'' }}>Order Received</option>
                                <option value="completed" {{ Request::get('status') == 'completed' ? 'selected':'' }}>Completed</option>
                                <option value="pending" {{ Request::get('status') == 'pending' ? 'selected':'' }}>Pending</option>
                                <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected':'' }}>Cancelled</option>
                                <option value="out-of-delivery" {{ Request::get('status') == 'out-of-delivery' ? 'selected':'' }}>Out of delivery</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br/>
                            <button type="submit" class="btn btn-primary text-white btn-sm">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Order ID</th>
                                <th scope="col">Tracking</th>
                                <th scope="col">Username</th>
                                <th scope="col">Payment Mode</th>
                                <th class="text-center" scope="col">Ordered Date</th>
                                <th scope="col">Status Message</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $item)
                                <tr>
                                    <td class="text-center" scope="row">{{ sprintf('%06d', $item->id) }}</td>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ $item->fullname }}</td>
                                    <td>{{ $item->payment_mode }}</td>
                                    <td class="text-center">{{ $item->created_at->format('Y/m/d') }}</td>
                                    <td>{{ $item->status_message }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/orders/' . $item->id) }}" class="btn btn-primary btn-sm text-white">view</a>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                            <td colspan="7">
                            No Orders Found.
                            </td>
                            </tr>
                            @endforelse
                        </tbody>
                     </table>
                     <div>
                        {{ $orders->links() }}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection
