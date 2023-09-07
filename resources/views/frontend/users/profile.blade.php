@extends('layouts.app')

@section('title', 'Allsites Ecom: User Profile')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">User Profile
                            <a href="{{ route('passwordCreate') }}" class="btn btn-warning btn-sm text-white float-end"> Change Password</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updateUserDetails') }}" method="post">
                            @csrf
                            <div class="shadow bg-white p-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="username">Full Name</label>
                                        <input type="text" name="username" class="form-control" value="{{ Auth::user()->name }}" />
                                        @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Personal Tax Code</label>
                                        <input type="text" name="personal_tax_code" class="form-control" value="{{ Auth::user()->userDetail->personal_tax_code ?? '' }}" placeholder="Enter Personal Tax Code" />
                                        @error('personal_tax_code')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Email Address</label>
                                        <input type="email" name="email" readonly value="{{ Auth::user()->email }}" class="form-control" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Billing Email </label>
                                        <input type="email" name="billing_email" value="{{ Auth::user()->userDetail->billing_email ?? '' }}" class="form-control" placeholder="Enter Billing Email" />
                                        @error('billing_email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Phone Number</label>
                                        <input type="tel" name="phone" value="{{ Auth::user()->userDetail->phone ?? '' }}" class="form-control" placeholder="Enter Phone Number" />
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label>Zip/Pin Code</label>
                                        <input type="number" name="pin_code" value="{{ Auth::user()->userDetail->pin_code ?? '' }}" class="form-control" placeholder="Enter Zip-code" />
                                        @error('pin_code')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Country</label>
                                        <input type="text" name="country" value="{{ Auth::user()->userDetail->country ?? '' }}" class="form-control" placeholder="Enter your country" />
                                        @error('country')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Full Address</label>
                                        <textarea name="address" class="form-control" rows="2">{{ Auth::user()->userDetail->address ?? '' }}</textarea>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary btn-sm text-white">Save Data</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
