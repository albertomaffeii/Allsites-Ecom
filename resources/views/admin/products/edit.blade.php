@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Edit Product
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

                <form action="{{ url('admin/products/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                            <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false">Product colors</button>
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
                                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected':'' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="brand">Product Brand</label>
                                    <select name="brand" id="brand" class="form-control">
                                            <option>Select</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->name }}" {{ $brand->name == $product->brand ? 'selected':'' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="name">Product Name</label>
                                    <input type="text" name="name" id="name" value="{{$product->name }}" class="form-control" onblur="suggestSlugName('name'); suggestMetaTitle('name','meta_title');" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="slug">Product Slug</label>
                                    <input type="text" name="slug" id="slug" value="{{$product->slug }}" class="form-control" />
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label for="slug">Small Description </label> <small>(500 words)</small>
                                    <textarea name="small_description" id="small_description" cols="30" rows="4" class="form-control">{{$product->small_description}}</textarea>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="slug">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$product->description}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $product->meta_title }}" />
                                    @error('meta_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <input type="text" class="form-control" name="meta_keyword" value="{{ $product->meta_keyword }}" />
                                    @error('meta_keyword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" name="meta_description" id="meta_description" cols="30" rows="5">{{$product->meta_description}}</textarea>
                                @error('meta_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="original_price">Original Price</label>
                                    <input type="text" class="form-control" name="original_price" value="{{ $product->original_price }}" />
                                    @error('original_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="selling_price">Selling Price</label>
                                    <input type="text" class="form-control" name="selling_price" value="{{ $product->selling_price }}" />
                                    @error('selling_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" class="form-control" name="quantity" value="{{ $product->quantity }}" />
                                    @error('quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="trending">Trending</label><br /><br />
                                    &nbsp;&nbsp;&nbsp;<input type="radio" name="trending" value="0" {{ $product->trending == '0' ? 'checked':'' }} /> No Trending
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="trending" value="1" {{ $product->trending == '1' ? 'checked':'' }} /> Trending
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="status">Status</label><br /><br />
                                    &nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="0" {{ $product->status == '0' ? 'checked':'' }} /> Show
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="1" {{ $product->status == '1' ? 'checked':'' }} /> Hidden
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
                                    <small class="form-text text-muted">To include new images on this product, select one or multiple images related to the product.<br />Use the 'Ctrl' key (or 'Command' on Mac) to select multiple images.</small>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                @if($product->productImages)
                                    <div class="row">
                                        @foreach($product->productImages as $image)
                                            <div class="col-md-2">
                                                <img src="{{ asset($image->image) }}" style="height:120px;" class="md-3 border" />
                                                <a href="{{ url('admin/product-image/' . $image->id . '/delete') }}" class="d-block text-decoration-none mdi mdi-trash-can-outline menu-icon"> Remove</a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <h5>
                                        No image Added
                                    </h5>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">
                            <div class="col-md-12 mb-4">
                                <h4 class="mb-4">Add Product color</h4>
                                <label for="image">Select Color</label>
                                    <div class="row">
                                        @forelse($colors as $colorItem)
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-3">

                                                    Color: &nbsp;<input type="checkbox" name="colors[{{ $colorItem->id }}]" value="{{ $colorItem->id }}" />
                                                    &nbsp;&nbsp;{{ $colorItem->name }}<br />
                                                    Quantity: &nbsp;<input type="number" name="colorquantity[{{ $colorItem->id }}]" style="width:70px; border:1px solid" />

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
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Color Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($product->productColors->isEmpty())
                                            <tr>
                                                <td colspan="4">No colors found.</td>
                                            </tr>
                                        @else
                                            @foreach ($product->productColors as $prodColor)
                                                <tr class="prod-color-tr">
                                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                                    <td>{{ $prodColor->color->name }}</td>
                                                    <td>
                                                        <div class="input-group" style="width: 250px">
                                                            <input type="text" value="{{ $prodColor->quantity }}" class="productColorQuantity form-control form-control-sm" />
                                                            <button type="button" value="{{ $prodColor->id }}" class="updateProductColorBtn btn btn-warning btn-sm text-white">Update this color</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" value="{{ $prodColor->id }}" class="deleteProductColorBtn btn btn-danger btn-sm text-white">Delete this color</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="py-2 float-end">
                        <button type="submit" class="btn btn-primary btn-sm text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
$(document).ready(function () {

    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.updateProductColorBtn', function () {

        var product_id = "{{ $product->id }}";
        var prod_color_id = $(this).val();
        var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();

        if(qty <= 0){
            alert('Quantity is required')
            return false;
        }

        var data = {
            'product_id' : product_id,
            'qty' : qty
        };

        $.ajax({
            type: "POST",
            url: "/admin/product-color/"+prod_color_id,
            data: data,
            success: function (response) {
                alert(response.message)
            }
        })
    })

    $(document).on('click', '.deleteProductColorBtn', function () {

        var prod_color_id = $(this).val();
        var thisClick = $(this);

        $.ajax({
            type: "GET",
            url: "/admin/product-color/"+prod_color_id+"/delete",
            success: function (response) {
                thisClick.closest('.prod-color-tr').remove();
                alert(response.message)
            }
        })
    });

})
</script>

@endsection
