@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Category
                    <a href="{{ url('admin/category') }}" class="btn btn-primary text-white float-end">BACK</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" max="60" onblur="suggestMetaTitle('name','meta_title');" />
                            @error('name') 
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                            @error('description') 
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="image">Image</label>
                            <small class="text-secondary">Recommended image size: 225 x 225</small>
                            <input type="file" class="form-control" name="image" accept="image/jpeg, image/png" />
                            @error('image') 
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="status">Status</label><br /><br />
                            <input type="radio" name="status" value="0" checked /> Show    
                            <input type="radio" name="status" value="1" /> Hidden
                        </div>

                        <div class="col-md-12 mb-3">
                            <hr>
                            <h4>SEO Tags</h4>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" id="meta_title" />
                            @error('meta_title') 
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="meta_keyword">Meta Keyword</label>
                            <input type="text" class="form-control" name="meta_keyword" />
                            @error('meta_keyword') 
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="5"></textarea>
                            @error('meta_description') 
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary text-white float-end">Save</button>                   
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection