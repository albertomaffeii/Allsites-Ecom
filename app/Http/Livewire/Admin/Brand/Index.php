<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class Index extends Component
{ 
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name, $slug, $status, $brand_id;

    public function rules()
    {
        $brandId = Route::current()->parameter('brands');

        return [
            'name' => [
                'required',
                'string',
                Rule::unique('brands')->ignore($brandId),
            ],
            'status' => 'required|nullable'
        ];

    }

    public function storeBrand()
    {
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'status' => $this->status
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
        $this->status =  $brand->status;
        
    }

    public function updateBrand() 
    {
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'status' => $this->status
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
       // Buscar as Brands paginadas do banco de dados
       $brands = Brand::orderBy('name','ASC')->paginate(10);
       return view('livewire.admin.brand.index', compact('brands'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
