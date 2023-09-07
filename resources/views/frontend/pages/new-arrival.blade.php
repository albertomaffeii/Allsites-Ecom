@extends('layouts.app')

@section('title', 'Allsites Ecom: New Arrivals Product')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>New Arrivals</h4>
                <div class="underline mb-4"></div>
            </div>

            @forelse ($newArrivalsProdcts as $productItem)
                <div class="col-md-3">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label class="stock bg-success">New</label>
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
                <div class="col-md-12 p-2">
                    <h5>No products available</h5>
                </div>
            @endforelse

            <div class="text-center">
                <a href="{{ route('collections') }}" class="btn btn-warning text-white btn-sm px-3">View More</a>
            </div>
        </div>
    </div>
</div>

@endsection
