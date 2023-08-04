<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class Index extends Component
{ 
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name, $slug, $status, $brand_id, $category_id;

    public function rules(){
        return[
            'name' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|integer',
            'status' => 'nullable'
        ];
    }

    /*public function rules()
    {
        $brand = Brand::where('slug', $this->slug)->first();

        if ($brand != null) {

            
            $brandId = $brand->id;

            // Regras de validação para a atualização de um registro existente
            return [
                'slug' => [
                    'required',
                    'string',
                    Rule::unique('brands')->ignore($brandId, 'id'),
                ],        
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'status' => 'required|nullable'
            ];
        } else {
            return [
                'slug' => [
                    'required',
                    'string',
                    'unique:brands,slug',],
                'name' => 'required|string',
                'category_id' => 'required|integer',
                'status' => 'required|nullable'
            ];
        }
    }*/

    public function storeBrand()
    {
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status,
            'category_id' => $this->category_id
        ]);

        session()->flash('message', 'Brand Added Successfully');

        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        return redirect()->route('brands');
    }


    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = 0;
        $this->brand_id = NULL;
        $this->category_id = NULL;        
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function openModal(){
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $this->brand_id = $brand_id;
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status =  $brand->status;
        $this->category_id =  $brand->category_id;        
    }

    public function updateBrand() 
    {
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status,
            'category_id' => $this->category_id
        ]);

        session()->flash('message', 'Brand Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        return redirect()->route('brands');
    }

    public function deleteBrand($brand_id) 
    {
        $this->brand_id = $brand_id;
        $this->destroyBrand();
    }

    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();

        session()->flash('message', 'Brand Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        return redirect()->route('brands');
        
    }

    public function render()
    {
       $categories = Category::where('status','0')->get();
       $brands = Brand::orderBy('name','ASC')->paginate(10);
       return view('livewire.admin.brand.index', ['brands' => $brands, 'categories'=>$categories])
            ->extends('layouts.admin')
            ->section('content');
    }
}
