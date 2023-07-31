@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        <div class="card">
            <div class="card-header">
                <h4>Products
                    <a href="{{ route('products.create') }}" class="btn btn-primary text-white float-end btn-sm">Add Product</a>
                </h4>
            </div>
            <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col" colspan='2'><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $item)
                                <tr>
                                    <td scope="row">{{ $loop->index +1 }}</td>
                                    <td>
                                        @if($item->category)
                                            {{ $item->category->name}}
                                        @else
                                            No Category registrated
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->selling_price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->status == '1' ? 'Hidden':'visible' }}</td>
                                    <td>
                                        <center>
                                            <a href="{{ url('admin/products/' . $item->id . '/edit') }}" class="btn btn-success btn-sm text-white">Edit</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ url('admin/products/' . $item->id . '/delete') }}" onclick="return confirm('Are you sure, you want to delete this product?')" class="btn btn-danger btn-sm text-white">Delete</a>
                                        </center>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">
                                        No Products Found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        
                    </div>
                </div>
        </div>
    </div>
</div>

@push('script')

<script>

    window.addEventListener(close-modal, event => {

        $('#deleteModal').modal('hide');

    })
    
</script>


@endpush

@endsection
