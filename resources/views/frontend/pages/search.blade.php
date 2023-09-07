@extends('layouts.app')

@section('title', 'Allsites Ecom: Search Product')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4>Search {{ $totalProducts }} Results</h4>
                <div class="underline mb-4"></div>
            </div>

            @forelse ($searchProducts as $productItem)
                <div class="col-md-10">
                    <div class="product-card">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="product-card-img">
                                    <label class="stock bg-success">New</label>
                                    @if ($productItem->productImages->count() > 0)
                                        <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                            <img class="product-img" style="height: 260px" src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->nome }}">
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="product-card-body">
                                    <p class="product-brand">{{ $productItem->brand }}</p>
                                    <h5 class="product-name">
                                        <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">{{ $productItem->name }}</a>
                                    </h5>
                                    <div>
                                        <span class="selling-price">{{ $appSetting->currency_type }} {{ $settings->formatNumber($productItem->selling_price, 2) }}</span>
                                        <span class="original-price">{{ $appSetting->currency_type }} {{ $settings->formatNumber($productItem->original_price, 2) }}</span>
                                    </div>
                                    <p style="height: 70px; overflow: hidden">
                                        <strong>Description: </strong> {{ $productItem->description }}
                                    </p>
                                    <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}" class="btn btn-sm btn-outline-secondary">View more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12 p-2">
                    <h5>Sorry, we couldn't find any products matching your search: {{ Request::get('search') }}</h5>
                </div>
            @endforelse

            <div class="col-md-10">
                {{ $searchProducts->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
