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
                <h4>Sliders List
                    <a href="{{ route('sliders.create') }}" class="btn btn-primary text-white float-end btn-sm">Add Slider</a>
                </h4>
            </div>
            <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col" colspan='2'><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sliders as $item)
                                <tr>
                                    <td scope="row">{{ $loop->index +1 }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <img src="{{ asset("$item->image") }}" alt="Slider" style="width: 70px; height: 70px" class="bordered">
                                    </td>
                                    <td>{{ $item->status == '1' ? 'Hidden':'visible' }}</td>
                                    <td>
                                        <center>
                                            <a href="{{ url('admin/sliders/' . $item->id . '/edit') }}" class="btn btn-success btn-sm text-white">Edit</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ url('admin/sliders/' . $item->id . '/delete') }}"
                                             onclick="return confirm('Are you sure, you want to delete this color?')" class="btn btn-danger btn-sm text-white">Delete</a>
                                        </center>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">
                                        No Sliders Found.
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
