<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductColor;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use App\Http\Requests\CategoryFormRequest; 

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();

        return view('admin.products.index', compact('categories', 'products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::where('status','0')->get();

        return view('admin.products.create', compact('categories', 'brands', 'colors'));
    }    
    
    public function store(ProductFormRequest $request) {
        
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);
        $colors = Color::where('status','0')->get();

        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $validatedData['trending'],
            'status' => $validatedData['status'],
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/products';
            $i = 1;

            foreach ($request->file('image') as $imageFile) {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extention;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName = $uploadPath . '/' . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        if($request->colors){
            foreach($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0
                ]);
            }
        }

        return redirect()->route('products')->with('message','Product Added Succesfully');
    }
    
    public function edit(int $product_id)
    {
        $categories = Category::all();
        $brands = Brand::all();        
        $product = Product::findOrFail($product_id);
        $product_color = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id', $product_color)->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'colors'));
    }

    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();

        $product = Category::findOrFail($validatedData['category_id'])
                        ->products()->where('id',$product_id)->first();
        if ($product){

            $product->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'brand' => $validatedData['brand'],
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $validatedData['trending'],
                'status' => $validatedData['status'],
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            if($request->hasFile('image')){
                $uploadPath = 'uploads/products';
                $i = 1;
    
                foreach ($request->file('image') as $imageFile) {
                    $extention = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $extention;
                    $imageFile->move($uploadPath,$filename);
                    $finalImagePathName = $uploadPath . '/' . $filename;
    
                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }

            if($request->colors){
                foreach($request->colors as $key => $color) {
                    $product->productColors()->create([
                        'product_id' => $product->id,
                        'color_id' => $color,
                        'quantity' => $request->colorquantity[$key] ?? 0
                    ]);
                }
            }
    
            return redirect('/admin/products')->with('message','Product Updated Succesfully');
                
        } else {
            return redirect('/admin/products')->with('message','No Such Product Found');
        }
    }

    public function destroyImage(int $product_image_id)
    {
        $productImage = ProductImage::findOrFail($product_image_id);

        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }

        $productImage->delete();

        return redirect()->back()->with('message','Product Image Deleted');

    }

    public function destroy(int $product_id){

        $product = Product::findOrFail($product_id);
        if ($product->productImage) {
            if (File::exists($productImage->image)) {
                File::delete($productImage->image);
            }
        }

        $product->delete();
        return redirect()->route('products')->with('message', 'Product deleted successfully!');

    }

    public function updateProdColorQty(Request $request, $prod_color_id) 
    {
        $productColorData = Product::findOrFail($request->product_id)
                ->productColors()->where('id', $prod_color_id)->first();
        
        $productColorData->update([
            'quantity' => $request->qty
        ]);

        return response()->json(['message'=>'Product color quantity updated']);
    }

    public function deleteProdColor($prod_color_id) {

        $prodColor = ProductColor::findOrFail($prod_color_id);
        $prodColor ->delete();

        return response()->json(['message'=>'Product color deleted']);        
    }


}