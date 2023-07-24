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
                    <h4>List Brands
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-primary text-white float-end btn-sm">Add Brands</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th colspan='2'><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($brands as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
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
                                        No BrandsFound
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