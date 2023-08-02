@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Slider
                    <a href="{{ route('sliders') }}" class="btn btn-primary text-white float-end">BACK</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/sliders/' . $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class=" mb-4">
                        <label for="title">Slide Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $slider->title }}" max="255" />
                        @error('title') 
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description">Description</label>
                        <textarea name="description" rows="3" class="form-control">{{ $slider->description }}</textarea>
                        @error('description') 
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> 
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="image">Slide Image</label>
                            <input type="file" class="form-control" name="image" />
                            <img src="{{ asset("$slider->image") }}" alt="Slider" style="height: 150px" class="bordered">
                            @error('image') 
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="status">Status</label><br /><br />
                            <input type="radio" name="status" value="0" {{ $slider->status == '0' ? 'checked':'' }} /> Show    
                            <input type="radio" name="status" value="1" {{ $slider->status == '1' ? 'checked':'' }} /> Hidden
                        </div>
                        <div class="col-md-6 mb-3 float-end">
                            <button type="submit" class="btn btn-primary text-white">Save</button>                   
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection