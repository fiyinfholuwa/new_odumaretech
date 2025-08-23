@extends('admin.app')

@section('content')

    <div class="row my-3 mx-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bgc-primary">
                    <h4 class="bgc-primary-text mb-0">Add Post</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog.add') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="blogTitle" class="form-label">Blog Title</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="blogTitle"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter Blog Title"
                                required
                            >
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="postDescription" class="form-label">Post Short Description</label>
                            <textarea
                                class="form-control @error('desc') is-invalid @enderror"
                                id="postDescription"
                                name="desc"
                                placeholder="Enter Post Short Description"
                                rows="3"
                                required
                            >{{ old('desc') }}</textarea>
                            @error('desc')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="postLink" class="form-label">Post Link</label>
                            <input
                                type="url"
                                class="form-control @error('link') is-invalid @enderror"
                                id="postLink"
                                name="link"
                                value="{{ old('link') }}"
                                placeholder="Enter Post Link"
                                required
                            >
                            @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="postImage" class="form-label">Post Image</label>
                            <input
                                type="file"
                                class="form-control @error('image') is-invalid @enderror"
                                id="postImage"
                                name="image"
                                accept="image/*"
                                required
                            >
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Add Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
