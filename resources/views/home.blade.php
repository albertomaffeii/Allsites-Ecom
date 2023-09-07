@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="me-md-3 me-xl-5">
                        <p class="mb-md-0">Your analytics dashboard</p>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-body bg-primary text-white mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="total-orders">Total Orders: {{ session('totalOrder') }}</label>
                                    <a href="{{ route('orders.index') }}" class="text-white text-decoration-none small">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-body bg-success text-white mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="total-orders">Today Orders: {{ session('todayOrder') }}</label>
                                    <a href="{{ route('orders.index') }}" class="text-white text-decoration-none small">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-body bg-warning text-white mb-3">
                                <label for="total-orders">This Month Orders: {{ session('thisMonthOrder') }}</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-body bg-danger text-white mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="total-orders">Year Orders: {{ session('thisYearOrder') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
