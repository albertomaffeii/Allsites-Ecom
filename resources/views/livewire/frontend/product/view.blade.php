<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if($product->productImages)
                            <div class="exzoom" id="exzoom">
                                <!-- Images -->
                                <div class="exzoom_img_box">
                                    <ul class='exzoom_img_ul'>
                                        @foreach ($product->productImages as $itemImg)
                                            <li><img src="{{ asset($itemImg->image) }}"/></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                            </div>
                        @else
                            <img src="{{ asset('uploads/products/no-image.png') }}" class="img-thumbnail rounded mx-auto d-block" vspace="110" alt="No Image">
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                        </h4>
                        <hr>
                        <p class="product-path">
                            <a href="/">Home</a> / <a href="{{ url('/collections/' . $product->category->slug) }}">{{ $product->category->name }}</a> / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price">{{ $appSetting->currency_type }} {{ $settings->formatNumber($product->selling_price, 2) }}</span>
                            <span class="original-price">{{ $appSetting->currency_type }} {{ $settings->formatNumber($product->original_price, 2) }}</span>
                        </div>
                        <div>
                            @if($product->productColors->count() > 0)
                                @if($product->productColors)
                                    @foreach($product->productColors as $colorItem)
                                        <label class="colorSelectionLabel text-white" style="background-color: {{ $colorItem->color->code }}" wire:click="colorSelected({{ $colorItem->id }})">{{ $colorItem->color->name }}</label>
                                    @endforeach
                                @endif
                                <div>
                                    @if($this->prodColorSelectedQuantity == 'outOfStock')
                                        <label style="width: 100%;" class="btn btn-sm py-1 mt-2 text-white bg-danger">Out of Stock</label>
                                    @elseif ($this->prodColorSelectedQuantity > 0)
                                        <label style="width: 100%;" class="btn btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                    @endif
                                </div>
                            @else
                                <div>
                                    @if($product->quantity)
                                        <label class="btn btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                    @else
                                        <label class="btn btn-sm py-1 mt-2 text-white bg-danger">Out of Stock</label>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}" readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                                <input type="hidden" wire:model="quantity_unit" value="{{ $product->quantity_unit }}" />
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:loading.attr="disabled" wire:click="addToCart( {{$product->id}} )" class="btn btn1">
                                <span wire:loading.remove wire:target="addToCart">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </span>
                                <span wire:loading wire:target="addToCart">Adding...</span>
                            </button>
                            <button type="button" wire:loading.attr="disabled" wire:click="addToWishList( {{$product->id}} )" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishList">
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addToWishList">Adding...</span>
                            </button>
                        </div>
                        @if($product)
                            <div class="col-md-12 py-3">
                                <p class="product-path">
                                    <span class="fw-bold">Brand: </span>{{ $product->brand }}
                                </p>
                            </div>
                        @endif
                        <div>
                            <h5 class="mb-0">Small Description</h5>
                            <p>{!! $product->small_description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>{!! $product->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>
                        Related
                        @if($category) 
                            {{ $category->name }} 
                        @endif
                        Products
                    </h3>
                    <div class="underline"></div>
                </div>

                
                <div class="col-md-12">
                    @if ($category)
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($category->relatedProducts as $relatedProductItem)
                                <div class="item mb-3">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            @if ($relatedProductItem->productImages->count() > 0)
                                                <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                                    <img class="product-img" style="height: 260px" src="{{ asset($relatedProductItem->productImages[0]->image) }}" alt="{{ $relatedProductItem->nome }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                            <p class="product-name">
                                                <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">{{ $relatedProductItem->name }}</a>
                                            </p>
                                            <div>
                                                <span class="product-brand">{{ $appSetting->currency_type }} {{ $settings->formatNumber($relatedProductItem->selling_price, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>                        
                    @else
                        <div class="col-md-12 p-2">
                            <h5>No related products available</h5>
                        </div>                        
                    @endif
            </div>
        </div>
    </div>


    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>
                        Other
                        @if($product) 
                            {{ $product->brand }} 
                        @endif
                        Products
                    </h3>
                    <div class="underline"></div>
                </div>

                <div class="col-md-12">
                    @if ($category)
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($category->relatedProducts as $relatedProductItem)
                                @if($relatedProductItem->brand == "$product->brand")
                                    <div class="item mb-3">
                                            <div class="product-card">
                                                <div class="product-card-img">
                                                    @if ($relatedProductItem->productImages->count() > 0)
                                                        <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                                            <img class="product-img" style="height: 260px" src="{{ asset($relatedProductItem->productImages[0]->image) }}" alt="{{ $relatedProductItem->nome }}">
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="product-card-body">
                                                    <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                                    <p class="product-name">
                                                        <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">{{ $relatedProductItem->name }}</a>
                                                    </p>
                                                    <div>
                                                        <span class="product-brand">{{ $appSetting->currency_type }} {{ $settings->formatNumber($relatedProductItem->selling_price, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>                                            
                    @else
                        <div class="col-md-12 p-2">
                            <h5>No related products available</h5>
                        </div>                        
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>


@push('scripts')

<script>
    $(function(){

        $("#exzoom").exzoom({

        // thumbnail nav options
        "navWidth": 60,
        "navHeight": 60,
        "navItemNum": 5,
        "navItemMargin": 7,
        "navBorder": 1,

        // autoplay
        "autoPlay": false,

        // autoplay interval in milliseconds
        "autoPlayTimeout": 2000

        });

    });
    
    $('.four-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })
</script>

@endpush
