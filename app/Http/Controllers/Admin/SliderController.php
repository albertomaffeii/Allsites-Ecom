<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $uploadPath = 'uploads/sliders';
            $imageFile = $request->file('image');
            $extention = $imageFile->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $imageFile->move($uploadPath,$filename);
            $validatedData['image'] = $uploadPath . '/' . $filename;
        }

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],        
        ]);

        return redirect()->route('sliders')->with('message', 'Slider added succesfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderFormRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();

        $destination = $slider->image;

        if($request->hasFile('image')){

            if(File::exists($destination)){
                File::delete($destination);
            }

            $uploadPath = 'uploads/sliders';
            $imageFile = $request->file('image');
            $extention = $imageFile->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $imageFile->move($uploadPath,$filename);
            $destination = $uploadPath . '/' . $filename;
        }

        Slider::where('id',$slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $destination,
            'status' => $validatedData['status'],        
        ]);

        return redirect()->route('sliders')->with('message', 'Slider uploaded succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        if($slider->count() > 0){

            $destination = $slider->image;

            if(File::exists($destination)){
                File::delete($destination);
            }

            $slider ->delete();

            return redirect()->route('sliders')->with('message', 'Slider deleted succesfully');
        }

        return redirect()->route('sliders')->with('message', 'Something went wrong');

    }
}
