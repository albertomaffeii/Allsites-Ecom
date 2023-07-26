@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Product
                    <a href="{{ url('admin/products') }}" class="btn btn-primary btn-sm text-white float-end">BACK</a>
                </h4>
            </div>
            <div class="card-body"> 

                @if($errors->any())
                    <div class="alert alert-warning">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"> 
                    @csrf          
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab-pane" aria-selected="false">SEO Tags</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">Details</button>
                        </li>                        
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Image</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="category">Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                    <option>Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">                                
                                    <label for="brand">Product Brand</label>
                                    <select name="brand" id="brand" class="form-control">
                                            <option>Select</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="name">Product Name</label>
                                    <input type="text" name="name" id="name" class="form-control" onblur="suggestSlugName('name'); suggestMetaTitle('name','meta_title');" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="slug">Product Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" />
                                </div>
                                
                                <div class="col-md-12 mb-4">
                                    <label for="slug">Small Description </label> <small>(500 words)</small>
                                    <textarea name="small_description" id="small_description" cols="30" rows="4" class="form-control"></textarea>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="slug">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                            <div class="row">
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
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="5"></textarea>
                                @error('meta_description') 
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="original_price">Original Price</label>
                                    <input type="text" class="form-control" name="original_price" />
                                    @error('original_price') 
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="selling_price">Selling Price</label>
                                    <input type="text" class="form-control" name="selling_price" />
                                    @error('selling_price') 
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" class="form-control" name="quantity" />
                                    @error('quantity') 
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="trending">Trending</label><br /><br />
                                    &nbsp;&nbsp;&nbsp;<input type="radio" name="trending" value="0" checked /> No Trending    
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="trending" value="1" /> Trending
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="status">Status</label><br /><br />
                                    &nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="0" checked /> Show    
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="1" /> Hidden
                                </div>
                            </div>
                        </div>
                    
                        <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                            <div class="row">                            
                                <div class="col-md-8 mb-4">
                                    <label for="image">Upload Images</label>
                                    <input type="file" multiple class="form-control" name="image[]" />
                                    @error('images') 
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-4 background-color: gray;">
                                    <h6>You can upload all product images</h6>
                                    <p>
                                        <small class="form-text text-muted">Select one or multiple images related to the product.<br />Use the 'Ctrl' key (or 'Command' on Mac) to select multiple images.</small>
        
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection