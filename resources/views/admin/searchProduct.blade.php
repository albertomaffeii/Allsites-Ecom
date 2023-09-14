@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Searched {{ $totalProducts }} Products for: {{ Request::get('search') }}
                    <a href="{{ route('products.create') }}" class="btn btn-primary text-white float-end btn-sm">Add Product</a>
                </h4>
            </div>
            <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Category</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center" colspan='2'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $item)
                                <tr>
                                    <td scope="row">
                                        @if($item->category)
                                            {{ $item->category->name}}
                                        @else
                                            No Category registrated
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $appSetting->currency_type }} {{ $settings->formatNumber($item->selling_price, 2) }}</td>
                                    <td>{{ $settings->formatNumber($item->quantity, 4) }}</td>
                                    <td>{{ $item->status == '1' ? 'Hidden':'visible' }}</td>
                                    <td class="text-align: center">
                                        <a href="{{ url('admin/products/' . $item->id . '/edit') }}" class="btn btn-success btn-sm text-white">Edit</a>
                                    </td>
                                    <td class="text-align: center">
                                        <a href="{{ url('admin/products/' . $item->id . '/delete') }}" onclick="return confirm('Are you sure, you want to delete this product?')" class="btn btn-danger btn-sm text-white">Delete</a>
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
                    {{ $products->links() }}
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection

@push('script')

<script>

    window.addEventListener(close-modal, event => {

        $('#deleteModal').modal('hide');

    })

</script>


@endpush



