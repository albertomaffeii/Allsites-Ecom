@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Color
                    <a href="{{ route('colors') }}" class="btn btn-primary btn-sm text-white float-end">BACK</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/colors/' . $color->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="name">Color Name</label>
                            <input type="text" class="form-control" name="name" max="30" value="{{ $color->name }}" />
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="code">Color Code</label>
                            <input type="text" class="form-control" name="code" max="10" value="{{ $color->code }}" />
                            @error('code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="status">Status</label><br /><br />
                            <input type="radio" name="status" value="0" {{ $color->status == '0' ? 'checked':'' }} /> Show
                            <input type="radio" name="status" value="1" {{ $color->status == '1' ? 'checked':'' }} /> Hidden
                        </div>
                        <div class="col-md-6 mb-3">
                            <button type="submit" class="btn btn-primary text-white">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
