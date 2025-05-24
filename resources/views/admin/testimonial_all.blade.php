@extends('admin.app')

@section('content')

    <div class="row" style="margin:10px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary ">
                    <h4 class="card-title text-white">All Testimonials</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="my-table" class="display table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Content</th>
                                <th>Designation</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($testimonials as $testimonial)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>{{ $testimonial->content }}</td>
                                    <td>{{ $testimonial->title }}</td>
                                    <td>
                                        <img height="40" width="40" src="{{ asset($testimonial->image) }}" alt="Testimonial Image" />
                                    </td>
                                    <td>
                                        <a href="{{ route('testimonial.edit', $testimonial->id) }}">
                                            <i style="color:blue;" class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_{{ $testimonial->id }}">
                                            <i style="color:red;" class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    @include('admin.modal.deleteTestimonial')
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
