<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brands</h1>
            <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form wire:submit.prevent="storeBrand()">

            <div class="modal-body">
                <div class="md-3 p-1">
                    <label for="category">Select Category</label>
                    <select wire:model.defer="category_id" class="form-control">
                        <option value=""> -- Select Category --</option>
                        @foreach($categories as $cateItem)
                            <option value="{{ $cateItem->id }}">{{ $cateItem->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>
                <div class="md-3 p-3">
                    <label for="name">Brand Name</label>
                    <input type="text" wire:model.defer="name" class="form-control"  >
                    @error('name') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>
                <div class="md-3 p-3">
                    <label for="slug">Brand Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>
                <div class="md-3 p-3">
                    <label for="status">Status</label><br />
                    &nbsp;&nbsp;&nbsp;<input type="radio" name="status" wire:model.defer="status" value='0' checked /> Visible&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status" wire:model.defer="status" value='1' /> Hidden <br />
                    @error('status') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary text-white">Save</button>
            </div>
        </form>
        </div>
    </div>
    </div>


    <div>
    <!-- Brand Update Modal -->
    <div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Brands</h1>
            <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div wire:loading class="p-2">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div><p class="p-2">Loading...</p>
        </div>
        <div wire:loading.remove>
            <form wire:submit.prevent="updateBrand()">
                <div class="modal-body">
                    <div class="md-3 p-1">
                    <label for="category">Select Category</label>
                    <select wire:model.defer="category_id" class="form-control">
                        <option value=""> -- Select Category --</option>
                        @foreach($categories as $cateItem)
                            <option value="{{ $cateItem->id }}">{{ $cateItem->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>
                    <div class="md-3 p-3">
                        <label for="name">Brand Name</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>
                    <div class="md-3 p-3">
                        <label for="slug">Brand Slug</label>
                        <input type="text" wire:model.defer="slug" class="form-control">
                        @error('slug') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>
                    <div class="md-3 p-3">
                        <label for="status">Status</label><br />
                        &nbsp;&nbsp;&nbsp;<input type="radio" name="status" wire:model.defer="status" value='0' checked /> Visible&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status" wire:model.defer="status" value='1' /> Hidden <br />
                        @error('status') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary text-white">Save</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<div>
    <!-- Brand Update Modal -->
    <div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Brands</h1>
                    <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div wire:loading class="p-2">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="p-2">Loading...</p>
                </div>
                <div wire:loading.remove>
                    <form wire:submit.prevent="deleteBrand()">
                        <div class="modal-body">
                            <h4>Are you sure want to delete this data?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary text-white">Yes, delete.</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>