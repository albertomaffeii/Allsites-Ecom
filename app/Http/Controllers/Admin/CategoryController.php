<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Log;



class CategoryController extends Controller
{
    public function index(){

        return view('admin.category.index');

    }

    public function create(){

        return view('admin.category.create');

    }

    public function store(CategoryFormRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $filename = "no-image.png";
            $uploadPath = "uploads/category/";

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();

                // Verifique se a extensão é permitida (jpg, jpeg, png)
                if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                    $filename = time() . '.' . $ext;
                    $file->move($uploadPath, $filename);
                } else {
                    return redirect()->route('category.create')->with('error', "The image extension must be in 'jpg', 'jpeg' or 'png' format.");
                }
            }

            Category::create([
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['name']),
                'description' => $validatedData['description'],
                'image' => $uploadPath.$filename,
                'status' => $validatedData['status'],
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            return redirect()->route('category')->with('message', 'Category Added Successfully');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('category.create')->with('error', 'A category with that name already exists!');
            }
            throw $e;
        }
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, Category $category)
    {
        try {
            $validatedData = $request->validated();

            $filename = "no-image.png";
            $uploadPath = "uploads/category/";

            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                $path = public_path($category->image);

                if (File::exists($path) && $category->image != 'uploads/category/no-image.png') {

                    File::delete($path);

                }

                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();

                // Verifique se a extensão é permitida (jpg, jpeg, png)
                if (in_array($ext, ['jpg', 'jpeg', 'png'])) {

                    $filename = time() . '.' . $ext;
                    $file->move($uploadPath, $filename);

                } else {

                    return redirect()->route('category.create')->with('error', "The image extension must be in 'jpg', 'jpeg' or 'png' format.");

                }
            }

            $category->update([
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['name']),
                'description' => $validatedData['description'],
                'image' => $uploadPath . $filename,
                'status' => $validatedData['status'],
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            return redirect()->route('category')->with('message', 'Category Updated Successfully');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('category.edit', ['category' => $category->id])->with('error', 'A category with that name already exists!');
            }
            throw $e;
        }
    }
}
