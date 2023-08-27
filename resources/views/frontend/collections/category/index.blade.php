@extends('layouts.app')

@section('title', 'Allsites Ecom: All Categories')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Our Collections</h4>
                <div class="underline mb-4"></div>
            </div>

         @forelse ($categories as $categoryItem)

            <div class="col-6 col-md-3">
               <div class="category-card">
                  <a href="{{ url('/collections/'.$categoryItem->slug) }}">
                     <div class="category-card-img">
                        <img src="{{ asset(''.$categoryItem->image)}}" class="w-100" alt="Laptop">
                     </div>
                     <div class="category-card-body">
                        <h5>{{ $categoryItem->name }}</h5>
                     </div>
                  </a>
               </div>
            </div>
         @empty
            <div class="col-md-12">
               <h5>No categories available</h5>
            </div>
         @endforelse
      </div>
   </div>
</div>

@endsection
