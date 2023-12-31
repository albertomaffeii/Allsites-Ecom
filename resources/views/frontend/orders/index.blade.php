@extends('layouts.app')

@section('title', 'Allsites Ecom: Orders')

@section('content')

   <div class="py-3 py-md-5">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="shadow bg-white p-3">
                  <h4 class="mb-4">My Orders</h4>
                  <hr>

                  <div class="table-responsive">
                     <table class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th  scope="col">Order ID</th>
                              <th  scope="col">Tracking</th>
                              <th  scope="col">Username</th>
                              <th  scope="col">Payment Mode</th>
                              <th  scope="col">Ordered Date</th>
                              <th  scope="col">Status Message</th>
                              <th  scope="col">Action</th>
</tr>
                        </thead>
                        <tbody>
                           @forelse($orders as $item)
                              <tr>
                              <td scope="row">{{ sprintf('%06d', $item->id) }}</td>
                                 <td>{{ $item->tracking_no }}</td>
                                 <td>{{ $item->fullname }}</td>
                                 <td>{{ $item->payment_mode }}</td>
                                 <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                 <td>{{ $item->status_message }}</td>
                                 <td>
                                       <center>
                                          <a href="{{ url('orders/' . $item->id) }}" class="btn btn-primary btn-sm text-white">view</a>
                                       </center>
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
                     <div class="">
                        {{ $orders->links() }}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection