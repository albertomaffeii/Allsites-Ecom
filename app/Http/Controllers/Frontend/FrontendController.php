<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        $trendingProducts = Product::where('trending','1')->latest()->take(15)->get();
        $newArrivalsProdcts = Product::latest()->take(14)->get();
        $featuredProducts = Product::where('featured','1')->latest()->take(14)->get();
        return view('frontend.index', compact('sliders', 'trendingProducts', 'newArrivalsProdcts', 'featuredProducts'));
    }

    public function searchProducts(Request $request)
    {
        $searchTerm = $request->search;

        if ($searchTerm) {
            $searchProducts = Product::where('name', 'LIKE', '%' . $searchTerm . '%')
                ->latest()
                ->paginate(10);

            $totalProducts = $searchProducts->total();

            return view('frontend.pages.search', compact('searchProducts', 'totalProducts'));
        } else {
            return redirect()->back()->with('message', 'Empty Search');
        }
    }

    public function newArrival()
    {
        $newArrivalsProdcts = Product::latest()->take(16)->get();
        return view('frontend.pages.new-arrival', compact('newArrivalsProdcts'));
    }

    public function featuredProducts()
    {
        $featuredProducts = Product::where('featured','1')->latest()->get();
        return view('frontend.pages.featured-products', compact('featuredProducts'));
    }

    public function categories()
    {
        $categories = Category::where('status', '0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        if($category) {

            $products = $category->products()->get();
            return view('frontend.collections.products.index', compact('products', 'category'));

        } else {

            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if($category)
        {
            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            if($product)
            {
                return view('frontend.collections.products.view', compact('product', 'category'));
            } else {
                return redirect()->back();
            }

        } else {
            return redirect()->back();
        }
    }

    public function thankyou()
    {
        return view('frontend.thank-you');
    }

}
