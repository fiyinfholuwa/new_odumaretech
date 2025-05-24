@extends('admin.app')

@section('content')

    <div class="row" style="margin:10px">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title">
                        <h4 class="text-white">Edit Post</h4>
                        </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog.update', $post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="blogTitle">Blog Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id="blogTitle"
                                value="{{ $post->name }}"
                                required
                                name="name"
                                placeholder="Enter Blog Title"
                            >
                            <small style="color:red; font-weight:500">
                                @error('name') {{ $message }} @enderror
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="postDesc">Post Short Description</label>
                            <textarea
                                class="form-control"
                                id="postDesc"
                                required
                                name="desc"
                                placeholder="Enter Post Short Description"
                            >{{ $post->desc }}</textarea>
                            <small style="color:red; font-weight:500">
                                @error('desc') {{ $message }} @enderror
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="postLink">Post Link</label>
                            <input
                                type="text"
                                class="form-control"
                                id="postLink"
                                required
                                value="{{ $post->link }}"
                                name="link"
                                placeholder="Enter Post Link"
                            >
                        </div>

                        <div class="form-group">
                            <label for="postImage">Post Image</label>
                            <input
                                type="file"
                                class="form-control"
                                id="postImage"
                                accept="image/*"
                                name="image"
                            >
                            <div class="mt-2">
                                <img height="60" width="60" src="{{ asset($post->image) }}" alt="Current Post Image" />
                            </div>
                        </div>

                        <div class="card-action">
                            <button class="btn btn-success">Update Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
