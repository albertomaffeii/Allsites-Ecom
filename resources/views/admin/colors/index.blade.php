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
                <h4>Colors List
                    <a href="{{ route('colors.create') }}" class="btn btn-primary text-white float-end btn-sm">Add Color</a>
                </h4>
            </div>
            <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Color Name</th>
                                <th scope="col">Color Code</th>
                                <th scope="col">Status</th>
                                <th scope="col" colspan='2'><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($colors as $item)
                                <tr>
                                    <td scope="row">{{ $loop->index +1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->status == '1' ? 'Hidden':'Visible' }}</td>
                                    <td>
                                        <center>
                                            <a href="{{ url('admin/colors/' . $item->id . '/edit') }}" class="btn btn-success btn-sm text-white">Edit</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ url('admin/colors/' . $item->id . '/delete') }}"
                                             onclick="return confirm('Are you sure, you want to delete this color?')" class="btn btn-danger btn-sm text-white">Delete</a>
                                        </center>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">
                                        No Colors Found.
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

@endsection
