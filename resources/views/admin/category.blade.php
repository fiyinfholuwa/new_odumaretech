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
                                            <a href="{{ route('category.edit', $category->id) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#"
                                               class="btn btn-sm btn-outline-danger"
                                               data-bs-toggle="modal"
                                               data-bs-target="#category_{{ $category->id }}"
                                               title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
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
