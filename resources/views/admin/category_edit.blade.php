@extends('admin.app')

@section('content')
    <div class="row" style="margin:10px">
        <!-- Edit Category Form -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Course Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="categoryName" class="font-weight-semibold">Category Name</label>
                            <input
                                type="text"
                                id="categoryName"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter Course Category Name"
                                value="{{ old('name', $category->name) }}"
                                required
                            >
                            @error('name')
                            <small class="text-danger font-weight-semibold d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-right mt-3">
                            <button class="btn btn-success">  <i class="fa fa-edit mr-1"></i>  Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Category Table -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">All Course Categories</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="my-table" class="table table-bordered table-striped table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th style="width: 60px;">S/N</th>
                                <th>Name</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                            @forelse($categories as $cat)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $cat->id) }}" title="Edit">
                                            <i class="fa fa-edit text-primary"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#category_{{ $cat->id }}" title="Delete">
                                            <i class="fa fa-trash text-danger ml-2"></i>
                                        </a>
                                    </td>
                                    @include('admin.modal.deleteCategory')
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No categories available.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
