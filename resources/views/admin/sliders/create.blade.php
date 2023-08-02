@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Slider
                    <a href="{{ route('sliders') }}" class="btn btn-primary text-white float-end">BACK</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class=" mb-4">
                        <label for="title">Slide Title</label>
                        <input type="text" class="form-control" name="title" max="255" />
                        @error('title') 
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description">Description</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                        @error('description') 
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> 
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="image">Slide Image</label>
                            <input type="file" class="form-control" name="image" />
                            @error('image') 
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>                       
                        <div class="col-md-6 mb-4">
                            <label for="status">Status</label><br /><br />
                            <input type="radio" name="status" value="0" checked /> Show    
                            <input type="radio" name="status" value="1" /> Hidden
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary text-white float-end">Save</button>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection