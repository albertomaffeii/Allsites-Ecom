<?php
namespace App\Http\Controllers\Admin;

use App\Models\Color;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use Illuminate\Http\Request;


use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\QueryException;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    } 

    public function store(ColorFormRequest $request) {
        
        $validatedData = $request->validated();

        Color::create($validatedData);

        return redirect()->route('colors')->with('message', 'Color Added Succesfully');

    }

    public function edit(int $color_id)
    {
        $colors = Color::all();
        
        $color = Color::findOrFail($color_id);
        return view('admin.colors.edit', compact('color'));
    }

    public function update(ColorFormRequest $request, int $color_id)
    {
        $validatedData = $request->validated();

        Color::find($color_id)->update($validatedData);

        return redirect()->route('colors')->with('message','Color Updated Succesfully');
    }

    public function destroy(int $color_id){

        $color = Color::findOrFail($color_id);        

        $color->delete();

        return redirect()->route('colors')->with('message', 'Color deleted successfully!');

    }

}
