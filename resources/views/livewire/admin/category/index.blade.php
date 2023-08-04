<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Category Delete</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form wire:submit.prevent="destroyCategory">

            <div class="modal-body">
                <h6>
                    Are you sure that you want to delete this category?
                </h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary text-white">Yes. Delete.</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Category
                        <a href="{{ route('category.create') }}" class="btn btn-primary text-white float-end btn-sm">Add Category</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col" colspan='2'><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $item)
                                <tr>
                                    <td scope="row">{{ $loop->index +1 }}</td>
                                    <td><img src="{{ asset("$item->image") }}" style="height: 60px; width: 60px;"></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->status == '1' ? 'Hidden':'visible' }}</td>
                                    <td>
                                        <center>
                                            <a href="{{ url('admin/category/' . $item->id . '/edit') }}" class="btn btn-success btn-sm text-white">Edit</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="#" wire:click="deleteCategory({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger btn-sm text-white">Delete</a>
                                        </center>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        No Categories Found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $categories -> links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

<script>

    window.addEventListener(close-modal, event => {

        $('#deleteModal').modal('hide');

    })
    
</script>


@endpush