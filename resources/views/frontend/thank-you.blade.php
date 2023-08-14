@extends('layouts.app')

@section('title', 'Allsites Ecom Thank You for Shopping')

@section('content')

   <div class="py-3 pyt-md-4">
      <div class="container">
         <div class="row">
            <div class="col-md-12 text-center">
               @if(session('message'))
                  <div class="alert alert-success">
                     {{ session('message') }}
                  </div>
               @endif
               <div class="p-4 m-5 shadow bg-white">
                  <h2>Your Logo</h2>
                  <h4>Thank You for Shopping with Allsites Ecom</h4>
                  <br />
                  <a href="{{ route('collections') }}" class="btn btn-primary">Shop now</a>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection