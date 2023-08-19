@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Category
                    <a href="{{ route('category') }}" class="btn btn-primary btn-sm text-white float-end">BACK</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category/' . $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" max="60" value="{{ $category->name }}" />
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="slug">Slug</label><br /><br />
                            {{ $category->slug }}
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $category->description }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="image">Image</label>
                            <small class="text-secondary">Recommended image size: 225 x 225</small>
                            <input type="file" class="form-control" name="image" accept="image/jpeg, image/png" />
                            <img src="{{ asset("$category->image") }}" width="150px">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="status">Status</label><br /><br />
                            <input type="radio" name="status" value="0" {{ $category->status == '0' ? 'checked':'' }} /> Show
                            <input type="radio" name="status" value="1" {{ $category->status == '1' ? 'checked':'' }} /> Hidden
                        </div>

                        <div class="col-md-12 mb-3">
                            <hr>
                            <h4>SEO Tags</h4>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" value="{{ $category->meta_title }}" />
                            @error('meta_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="meta_keyword">Meta Keyword</label>
                            <input type="text" class="form-control" name="meta_keyword" value="{{ $category->meta_keyword }}" />
                            @error('meta_keyword')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="5">{{ $category->meta_description }}</textarea>
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
