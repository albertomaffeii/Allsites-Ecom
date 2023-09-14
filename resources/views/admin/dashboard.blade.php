@extends('layouts.admin')

@section('title', 'Allsites Ecom - Dashboard')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">

        @if(session('message'))
            <h6 class="alert alert-success">{{ session('message') }}</h6>
        @endif
        <div class="me-md-3 me-xl-5">
            <h2>Dashboard</h2>
            <p class="mb-md-0">Your analytics dashboard</p>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="card card-body bg-primary text-white mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="total-orders">Users: {{ $totalAllUser }} </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="total-orders">Customers: {{ $totalUser }} </label>
                        <a href="{{ route('orders.index') }}" class="text-white text-decoration-none small">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="card card-body bg-warning text-white mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="total-orders">Admin Users: {{ $totalAdmin }} </label>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card card-body bg-danger text-white mb-3">
                    <label for="total-orders">New customer registration: {{ $daysSinceLastRegistration}} days ago</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="total-orders">Total Orders: {{ $totalOrder }}</label>
                        <a href="{{ route('orders.index') }}" class="text-white text-decoration-none small">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="total-orders">Today Orders: {{ $todayOrder }}</label>
                        <a href="{{ route('orders.index') }}" class="text-white text-decoration-none small">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label for="total-orders">This Month Orders: {{ $thisMonthOrder }}</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="total-orders">Year Orders: {{ $thisYearOrder }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-body bg-primary text-white mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="total-orders">Total Products: {{ $totalProducts }}</label>
                        <a href="{{ route('products') }}" class="text-white text-decoration-none small">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="total-orders">Today Categories: {{ $totalCategories }}</label>
                        <a href="{{ route('category') }}" class="text-white text-decoration-none small">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="total-orders">Total Brands: {{ $totalBrands }}</label>
                        <a href="{{ route('brands') }}" class="text-white text-decoration-none small">View</a>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row m-0 py-2 bg-white">
            <!-- Card 1: Top Sellers By product name -->
            <div class="col-md-4">
                <div class="card rounded-lg shadow">
                    <div class="card-header bg-secondary text-white">
                        Top sellers by product name
                    </div>
                    <div class="card-body text-xs table-responsive m-0 p-0">
                        <table class="table table-sm text-xs">
                            <thead>
                                <tr>
                                    <th>Procuct</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topSellers as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->total_sales }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-muted text-xs">
                        This Month Order
                    </p>
                </div>
            </div>

            <!-- Card 2: Gross Sales By Product -->
            <div class="col-md-4">
                <div class="card rounded-lg shadow">
                    <div class="card-header bg-secondary text-white">
                        Gross sales by top products
                    </div>
                    <div class="card-body text-xs table-responsive m-0 p-0">
                        <table class="table table-sm text-xs">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grossSales as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $appSetting->currency_type }} {{ $settings->formatNumber($product->total_gross_sales, 2) }}</td>
                                </tr>
                                @endforeach
                                <!-- Linhas da tabela para o Card 2 aqui -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-muted text-xs">
                        This Month Order
                    </p>
                </div>
            </div>


            <!-- Card 3: Average Gross Daily Sale -->
            <div class="col-md-4">
                <div class="card rounded-lg shadow">
                    <div class="card-header bg-secondary text-white">
                        Average gross by ticket/category
                    </div>
                    <div class="card-body text-xs table-responsive m-0 p-0">
                        <table class="table table-sm text-xs">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Average Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($averageGross as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $appSetting->currency_type}} {{
                                         $settings->formatNumber($category->average_gross_sales, 2)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer">
                    <p class="text-muted text-xs">
                        This month Order
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- plugins:js -->
<script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page-->
<script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<!-- End plugin js for this page-->

<!-- inject:js -->
<script src="{{ asset('admin/js/off-canvas.js') }}"></script>
<script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('admin/js/template.js') }}"></script>
<!-- endinject -->

<!-- Custom js for this page-->
<script src="{{ asset('admin/js/dashboard.js') }}"></script>
<script src="{{ asset('admin/js/data-table.js') }}"></script>
<script src="{{ asset('admin/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/js/dataTables.bootstrap4.js') }}"></script>
<!-- End custom js for this page-->

<script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>

@livewireScripts
