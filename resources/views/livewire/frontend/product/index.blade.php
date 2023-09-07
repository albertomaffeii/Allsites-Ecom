<div>
    <div class="row">
        <div class="col-md-3">
            @if($category->brands)
                <div class="card">
                    <div class="card-header"><h4>Brands</h4></div>
                    <div class="card-body">
                        @foreach($category->brands as $brandItem)
                            <label class="d-block">
                                <input type="checkbox" wire:model="brandInputs" value="{{ $brandItem->name }}"> {{ $brandItem->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="card mt-3">
                <div class="card-header"><h4>Price</h4></div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low"> High to Low
                    </label>
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high"> Low to High
                    </label>
                </div>
            </div>

        </div>
        <div class="col-md-9">

            <div class="row">
                @forelse ($products as $productItem)
                    <div class="col-md-4">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if ($productItem->quantity > 0)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-success">Out of Stock</label>
                                @endif
                                @if ($productItem->productImages->count() > 0)
                                    <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                        <img class="product-img" style="height: 260px" src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->nome }}">
                                    </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $productItem->brand }}</p>
                                <h5 class="product-name">
                                    <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">{{ $productItem->name }}</a>
                                </h5>
                                <div>
                                <span class="selling-price">{{ $appSetting->currency_type }} {{ $settings->formatNumber($productItem->selling_price, 2) }}</span>
                                <span class="original-price">{{ $appSetting->currency_type }} {{ $settings->formatNumber($productItem->original_price, 2) }}</span>
                                </div>
                                <div class="mt-2">
                                    <a href="" class="btn btn1">Add To Cart</a>
                                    <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                    <a href="" class="btn btn1"> View </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h5>No products available for {{ $category->name }}</h5>
                        </div>
                    </div>
                @endforelse
            </div>
    </div>
</div>
