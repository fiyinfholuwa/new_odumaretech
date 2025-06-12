@extends('admin.app')

@section('content')

    <div class="row p-3">
        <!-- Add Category Form -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Add Course Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.add') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="categoryName"
                                   name="name"
                                   placeholder="e.g. Web Development"
                                   required>
                            @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mt-3 text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus-circle mr-1"></i> Add Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0">All Categories</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if(isset($categories) && count($categories) > 0)
                            <table class="table table-striped table-hover" id="my-table">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $index => $category)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editCategoryModal_{{ $category->id }}"
                                                    title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <a href="#"
                                               class="btn btn-sm btn-outline-danger"
                                               data-bs-toggle="modal"
                                               data-bs-target="#category_{{ $category->id }}"
                                               title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editCategoryModal_{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryLabel_{{ $category->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('category.update', $category->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editCategoryLabel_{{ $category->id }}">Edit Course Category</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="categoryName_{{ $category->id }}" class="font-weight-semibold">Category Name</label>
                                                            <input
                                                                type="text"
                                                                id="categoryName_{{ $category->id }}"
                                                                name="name"
                                                                class="form-control"
                                                                placeholder="Enter Course Category Name"
                                                                value="{{ old('name', $category->name) }}"
                                                                required
                                                            >
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="fa fa-edit me-1"></i> Update Category
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @include('admin.modal.deleteCategory')
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted text-center">No categories added yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
