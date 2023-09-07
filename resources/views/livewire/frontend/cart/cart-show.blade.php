<div>
<div class="py-3 py-md-5">
        <div class="container">
            <h4>My Cart</h4>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header bg-light m-3 border d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-5">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse($cart as $cartItem)
                            @if($cartItem->product)
                                <div class="cart-item m-3">
                                    <div class="row">
                                        <div class="col-md-5 my-auto">
                                            <a href="{{ url('collections/' . $cartItem->product->category->slug . '/' . $cartItem->product->slug) }}">
                                                <label class="product-name-card">
                                                    @if($cartItem->product->productImages[0])
                                                        <img align="left" src="{{ asset($cartItem->product->productImages[0]->image) }}" style="width: 120px;" alt="{{ $cartItem->product->name }}">
                                                    @else
                                                        <img src="{{ asset('uploads/products/no-image.png') }}" style="width: 120px;" alt="No image">
                                                    @endif
                                                    {{ $cartItem->product->name }}
                                                    @if($cartItem->productColor)
                                                        @if($cartItem->productColor->color)
                                                             - Color: {{ $cartItem->productColor->color->name  }}
                                                        @endif
                                                    @endif
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">{{ $appSetting->currency_type }} {{ $settings->formatNumber($cartItem->product->selling_price, 2) }} </label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <button type="button" wire:loading.attr="disabled" wire:click="decrementQuantity({{ $cartItem->id }})" class="btn btn1"><i class="fa fa-minus"></i></button>

                                                    <input type="text" value="{{ $settings->formatNumber($cartItem->quantity, 4) }}" readonly class="input-quantity" />
                                                    <input type="hidden" name="quantity_unit" value="{{ $cartItem->product->quantity_unit }}" />

                                                    <button type="button" wire:loading.attr="disabled" wire:click="incrementQuantity({{ $cartItem->id }})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">
                                                {{ $appSetting->currency_type }} {{ $settings->formatNumber($cartItem->product->selling_price * $cartItem->quantity, 2) }}</label>

                                            @php
                                                $totalPrice += $cartItem->product->selling_price * $cartItem->quantity
                                            @endphp
                                        </div>
                                        <div class="col-md-1 col-12 my-auto">
                                            <div class="remove">
                                                <button type="button" wire:loading.attr="disabled" wire:click="removeCartItem({{ $cartItem->id }})" class="btn btn-danger btn-sm">
                                                    <span wire:loading.remove wire:target="removeCartItem({{ $cartItem->id }})">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading wire:target="removeCartItem({{ $cartItem->id }})">
                                                        <i class="fa fa-trash"></i> Removing
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @empty

                            <div>No items available in the cart</div>

                        @endforelse

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h4>Get the best deals & Offers <a href="{{ route('collections') }}">shop now</a></h4>

                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3 m-3">
                        <h4>Total:
                            <span class="float-end">{{ $appSetting->currency_type }} {{ $settings->formatNumber($totalPrice, 2) }}</span>
                        </h4>
                        <hr>
                        <a href="{{ route('checkout') }}" class="btn btn-warning w-100">Checkout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
