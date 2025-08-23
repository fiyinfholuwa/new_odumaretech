@extends('admin.app')

@section('content')

    <div class="row" style="margin:10px">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bgc-primary">
                    <div class="card-title"><h4 class="bgc-primary-text">Edit Testimonial</h5></div>
                </div>
                <div class="card-body">
                    <form action="{{ route('testimonial.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="testimonialName">Testimonial Name</label>
                            <input type="text" class="form-control" id="testimonialName" value="{{ old('name', $testimonial->name) }}" required name="name" placeholder="Enter Testimonial Name">
                            <small class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="testimonialContent">Testimonial Content</label>
                            <textarea class="form-control" id="testimonialContent" required name="body_content" placeholder="Enter Testimonial Content" rows="4">{{ old('content', $testimonial->content) }}</textarea>
                            <small class="text-danger">
                                @error('content')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="testimonialTitle">Testimonial Designation</label>
                            <input type="text" class="form-control" id="testimonialTitle" value="{{ old('title', $testimonial->title) }}" required name="title" placeholder="Enter Testimonial Designation">
                            <small class="text-danger">
                                @error('title')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="testimonialImage">Testimonial Image</label>
                            <input type="file" class="form-control" id="testimonialImage" accept="image/*" name="image">
                            <div class="mt-2">
                                <img height="60" width="60" src="{{ asset($testimonial->image) }}" alt="Current Testimonial Image" />
                            </div>
                            <small class="text-danger">
                                @error('image')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Update Testimonial</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
