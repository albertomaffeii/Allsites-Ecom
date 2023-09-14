<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Faker\Provider\UserAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $settings = Setting::first();

        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBrands = Brand::count();

        $todayDate = Carbon::now()->format('Y-m-d');
        $thisDay = Carbon::now()->format('d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalOrder = Order::count();
        $todayOrder = Order::whereDate('created_at', $todayDate)->count();
        $thisMonthOrder = Order::whereMonth('created_at', $thisMonth)->count();
        $thisYearOrder = Order::whereYear('created_at', $thisYear)->count();

        $totalAllUser = User::count();
        $totalUser = User::where('role_as','0')->count();
        $totalAdmin = User::where('role_as','1')->count();
        $lastUserRegistration = User::orderBy('created_at', 'desc')->first();
        $lastRegistrationDate = $lastUserRegistration->created_at;
        $daysSinceLastRegistration = now()->diffInDays($lastRegistrationDate);

        $topSellers = DB::table('orders')
        ->join('orderitems', 'orders.id', '=', 'orderitems.order_id')
        ->join('products', 'orderitems.product_id', '=', 'products.id')
        ->whereYear('orders.created_at', $thisYear)
        ->whereDate('orders.created_at', '>=', $thisMonth)
        ->select('products.name', DB::raw('SUM(orderitems.quantity) as total_sales'))
        ->groupBy('products.name')
        ->orderByDesc('total_sales')
        ->take(5)
        ->get();

        $grossSales = DB::table('products')
        ->leftJoin('orderitems', function ($join) use ($thisYear, $thisMonth) {
            $join->on('products.id', '=', 'orderitems.product_id')
                ->whereYear('orderitems.created_at', $thisYear)
                ->whereDate('orderitems.created_at', '>=', $thisMonth);
        })
        ->select('products.name', DB::raw('SUM(orderitems.quantity * orderitems.price) as total_gross_sales'))
        ->groupBy('products.name')
        ->orderByDesc('total_gross_sales')
        ->take(5)
        ->get();

        $averageGross = DB::table('products')
        ->leftJoin('orderitems', function ($join) use ($thisYear, $thisMonth) {
            $join->on('products.id', '=', 'orderitems.product_id')
                ->join('orders', 'orderitems.order_id', '=', 'orders.id')
                ->whereYear('orders.created_at', $thisYear)
                ->whereMonth('orders.created_at', $thisMonth);
        })
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('categories.name', DB::raw('AVG(orderitems.quantity * orderitems.price) as average_gross_sales'))
        ->groupBy('categories.name')
        ->orderByDesc('average_gross_sales')
        ->take(5)
        ->get();

        return view('admin.dashboard', compact('settings', 'totalProducts', 'totalCategories', 'totalBrands', 'totalAllUser', 'totalUser', 'totalAdmin', 'daysSinceLastRegistration', 'todayDate', 'thisDay', 'thisMonth', 'thisYear', 'totalOrder', 'todayOrder', 'thisMonthOrder', 'thisYearOrder', 'topSellers', 'grossSales', 'averageGross'));
    }

    public function adminSearch(Request $request)
    {
        $searchTerm = $request->search;
        $searchType = $request->type;
        $settings = Setting::first();

        if ($searchTerm && $searchType == 0) {
            $products = Product::where('name', 'LIKE', '%' . $searchTerm . '%')
                ->latest()
                ->paginate(10);

            $totalProducts = $products->total();

            return view('admin.searchProduct', compact('products', 'settings', 'totalProducts'));

        } elseif ($searchTerm && $searchType == 1) {
            $products = User::where('name', 'LIKE', '%' . $searchTerm . '%')
            ->latest()
            ->paginate(10);

            $totalProducts = $products->total();

            return view('admin.searchUser', compact('products', 'settings', 'totalProducts'));

        } elseif ($searchTerm && $searchType == 2) {
            $products = User::where('name', 'LIKE', '%' . $searchTerm . '%')
            ->latest()
            ->paginate(10);

            $totalProducts = $products->total();

            return view('admin.searchUser', compact('products', 'settings', 'totalProducts'));

        } else {
            return redirect()->back()->with('message', 'Empty Search');
        }
    }


}
