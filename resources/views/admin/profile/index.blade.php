@extends('layouts.admin')

@section('title', 'Admin Profile')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-header">{{ __('Profile Picture') }}</div>
                <div class="card-body box-profile">
                    <div class="text-center">
                        @if (Auth::user()->userDetail && Auth::user()->userDetail->profile_image)
                            <img src="{{ asset(Auth::user()->userDetail->profile_image) }}" alt="Profile Image" class="rounded-circle border border-secondary" style="width: 150px; height: 150px;" >
                        @else
                            <img src="{{ asset('uploads/faces/no-image.png') }}" alt="Profile Image" class="rounded-circle border border-secondary">
                        @endif
                    </div>
                    <h3 class="py-3 profile-username text-center">{{ auth()->user()->name }}</h3>
                    <p class="text-muted text-center">System Administrator</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', auth()->user()->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', auth()->user()->email) }}" autocomplete="email" />

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="profile_image" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="panel-color" class="col-md-4 col-form-label text-md-right">{{ __('Panel Color') }}</label>
                            <div class="col-md-6">
                                <select name="panel-color" class="form-control" style="height:45px">
                                    <option value="bg-primary" {{ old('panel-color', auth()->user()->userDetail->panel_color) === 'bg-primary' ? 'selected' : '' }} style="background-color: #007BFF; color: #fff;">Primary</option>
                                    <option value="spacer1" disabled>────────────</option>
                                    <option value="bg-secondary" {{ old('panel-color', auth()->user()->userDetail->panel_color) === 'bg-secondary' ? 'selected' : '' }} style="background-color: #6C757D; color: #fff;">Secondary</option>
                                    <option value="spacer2" disabled>────────────</option>
                                    <option value="bg-success" {{ old('panel-color', auth()->user()->userDetail->panel_color) === 'bg-success' ? 'selected' : '' }} style="background-color: #28A745; color: #fff;">Success</option>
                                    <option value="spacer3" disabled>────────────</option>
                                    <option value="bg-danger" {{ old('panel-color', auth()->user()->userDetail->panel_color) === 'bg-danger' ? 'selected' : '' }} style="background-color: #DC3545; color: #fff;">Danger</option>
                                    <option value="spacer4" disabled>────────────</option>
                                    <option value="bg-warning" {{ old('panel-color', auth()->user()->userDetail->panel_color) === 'bg-warning' ? 'selected' : '' }} style="background-color: #FFC107; color: #000;">Warning</option>
                                    <option value="spacer5" disabled>────────────</option>
                                    <option value="bg-info" {{ old('panel-color', auth()->user()->userDetail->panel_color) === 'bg-info' ? 'selected' : '' }} style="background-color: #17A2B8; color: #fff;">Info</option>
                                    <option value="spacer6" disabled>────────────</option>
                                    <option value="bg-light" {{ old('panel-color', auth()->user()->userDetail->panel_color) === 'bg-light' ? 'selected' : '' }} style="background-color: #F8F9FA; color: #000;">Light</option>
                                    <option value="spacer7" disabled>────────────</option>
                                    <option value="bg-dark text-white" {{ old('panel-color', auth()->user()->userDetail->panel_color) === 'bg-dark text-white' ? 'selected' : '' }} style="background-color: #343A40; color: #fff;">Dark</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-sm text-white ">
                                    <i class="fa fa-edit fa-lg" aria-hidden="true"></i>&nbsp; {{ __('Update Profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
