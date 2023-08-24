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
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Product Images</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false">Product Colors</button>
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
                                <div class="col-md-4 mb-4">
                                    <label for="original_price">Original Price</label>
                                    <input type="text" step="0.00" class="form-control" name="original_price" />
                                    @error('original_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="selling_price">Selling Price</label>
                                    <input type="text" step="0.00" class="form-control" name="selling_price" />
                                    @error('selling_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div>
                                        <label for="sku">SKU</label>
                                        <input type="text" class="form-control" name="sku" />
                                        @error('sku')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-4">
                                    <div>
                                        <label for="quantity">Quantity</label>
                                        <input type="text" step="0.0000" class="form-control" name="quantity" />
                                        @error('quantity')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label for="quantity_unit">Quantity Unit</label>
                                    <select  style="height:45px;" class="form-control" name="quantity_unit">
                                        <option value="">Select an option</option>
                                        <option value="pcs">Pieces (pcs)</option>
                                        <option value="kg">Kilograms (kg)</option>
                                        <option value="g">Grams (g)</option>
                                        <option value="m">Meters (m)</option>
                                        <option value="cm">Centimeters (cm)</option>
                                        <option value="mm">Millimeters (mm)</option>
                                    </select>
                                    @error('quantity_unit')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div>
                                        <label for="gross_weight">Gross Weight (kg)</label>
                                        <input type="text" step="0.0000" class="form-control" name="gross_weight" />
                                        @error('gross_weight')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div>
                                        <label for="net_weight">Net Weight (kg)</label>
                                        <input type="text" step="0.0000" class="form-control" name="net_weight" />
                                        @error('net_weight')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-4">
                                    <div>
                                        <label>Type of Packaging</label><br>
                                        <select style="height:45px;" class="form-control" name="packaging_type">
                                            <option value="">Select an option</option>
                                            <option value="tube">Tube</option>
                                            <option value="box">Box</option>
                                        </select>
                                        @error('packaging_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div>
                                        <label for="height">Height (m)</label>
                                        <input type="text" step="0.00" class="form-control" name="height" />
                                        @error('height')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div>
                                        <label for="width_or_diameter">Width or Diameter (m)</label>
                                        <input type="text" step="0.00" class="form-control" name="width_or_diameter" />
                                        @error('width_or_diameter')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div>
                                        <label for="length">Length (m)</label>
                                        <input type="text" step="0.00" class="form-control" name="length" />
                                        @error('length')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="bg-light p-3 border border-secondary">
                                        <label for="trending">Trending</label><br />
                                        <input type="radio" name="trending" value="0" checked /> No Trending
                                        &nbsp;&nbsp;
                                        <input type="radio" name="trending" value="1" /> Trending
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="bg-light p-3 border border-secondary">
                                        <label for="featured">Featured</label><br />
                                        <input type="radio" name="featured" value="0" checked /> No Featured
                                        &nbsp;&nbsp;
                                        <input type="radio" name="featured" value="1" /> Featured
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="bg-light p-3 border border-secondary">
                                        <label for="status">Status</label><br />
                                        <input type="radio" name="status" value="0" checked /> Show
                                        &nbsp;&nbsp;
                                        <input type="radio" name="status" value="1" /> Hidden
                                    </div>
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
                                <div class="col-md-4 mb-4 bg-info p-3">
                                    <h6>You can upload all product images</h6>
                                    <small class="form-text text-muted">Select one or multiple images related to the product.<br />Use the 'Ctrl' key (or 'Command' on Mac) to select multiple images.</small>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">
                            <div class="col-md-12 mb-4">
                                <label for="image">Select Color</label>
                                    <div class="row">
                                        @forelse($colors as $colorItem)
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-3">

                                                    Color: &nbsp;<input type="checkbox" name="colors[{{ $colorItem->id }}]" value="{{ $colorItem->id }}" />
                                                    &nbsp;&nbsp;{{ $colorItem->name }}<br />
                                                    Quantity: &nbsp;<input type="text" name="colorquantity[{{ $colorItem->id }}]" style="width:70px; border:1px solid" />

                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h5>No colors found.</h5>
                                            </div>
                                        @endforelse
                                    </div>
                                @error('images')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm text-white">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
