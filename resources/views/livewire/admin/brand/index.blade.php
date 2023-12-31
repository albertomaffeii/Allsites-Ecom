@include('livewire.admin.brand.modal-form')

    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Brands List 
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-primary text-white float-end btn-sm">Add Brands</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Status</th>
                                <th scope="col" colspan='2'><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($brands as $item)
                                <tr>
                                    <td scope="row">{{ $loop->index +1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if($item->category)
                                            {{ $item->category->name }}                                        
                                        @else
                                            No Category
                                        @endif

                                    </td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->status == '1' ? 'Hidden':'visible' }}</td>
                                    <td>
                                        <center>
                                            <a href="#" wire:click="editBrand({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="btn btn-success btn-sm text-white">Edit</a>
                                        </center> 
                                    </td>
                                    <td>
                                        <center>
                                            <a href="#" wire:click="deleteBrand({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal" class="btn btn-danger btn-sm text-white">Delete</a>
                                        </center>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        No Brands Found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                </div>
                .
                <div class="">{{ $brands -> links() }}</div>
                
            </div>
        </div>
    </div>
</div>

@push('script')

<script>

    window.addEventListener(close-modal, event => {

        $('#addBrandModal').modal('hide');
        $('#updateBrandModal').modal('hide');
        $('#deleteBrandModal').modal('hide');
        
    })
    
</script>


@endpush