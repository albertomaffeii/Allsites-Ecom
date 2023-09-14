@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Searched {{ $totalProducts }} customers for: {{ Request::get('search') }}</h4>
            </div>
            <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Last Update</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center" colspan='2'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->created_at->format($appSetting->format_date) }}</td>
                                    <td>{{ $item->updated_at->format($appSetting->format_date) }}</td>
                                    <td>{{ $item->status == '0' ? 'Active':'Inactive' }}</td>
                                    <td class="text-align: center">
                                        <a href="{{ url('admin/products/' . $item->id . '/edit') }}" class="btn btn-success btn-sm text-white"><span class="fa fa-pencil"></span> Edit</a>
                                    </td>
                                    <td class="text-align: center">
                                        <a href="{{ url('admin/products/' . $item->id . '/delete') }}" onclick="return confirm('Are you sure, you want to delete this product?')" class="btn btn-danger btn-sm text-white"><span class="fa fa-window-close"></span> Inactive</a>
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



