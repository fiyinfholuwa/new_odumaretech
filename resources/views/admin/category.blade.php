@extends('admin.app')

@section('content')

<div class="row p-3">
    <!-- Categories Table -->
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bgc-secondary text-white d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0 bgc-secondary-text">All Categories</h5>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="fa fa-plus-circle me-1"></i> Add Category
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if(isset($categories) && count($categories) > 0)
                        <table class="table table-striped table-hover" id="my-table">
                            <thead class="table-light">
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

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editCategoryModal_{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryLabel_{{ $category->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('category.update', $category->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Course Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="categoryName_{{ $category->id }}">Category Name</label>
                                                        <input type="text"
                                                               id="categoryName_{{ $category->id }}"
                                                               name="name"
                                                               class="form-control"
                                                               value="{{ old('name', $category->name) }}"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-edit me-1"></i> Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
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

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('category.add') }}" method="POST">
                @csrf
                <div class="modal-header bgc-primary text-white">
                    <h4 class="modal-title bgc-primary-text" id="addCategoryLabel">Add Course Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus-circle me-1"></i> Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
