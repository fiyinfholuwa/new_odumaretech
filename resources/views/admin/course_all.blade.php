@extends('admin.app')

@section('content')
    <div class="row my-3">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header  bg-secondary">
                    <h3 class="card-title mb-0 text-white">All Courses</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Course Type</th>
                                <th>Description</th>
                                <th>Assigned Instructor</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ optional($course->cat)->name }}</td>
                                    <td>₦{{ number_format($course->price, 2) }}</td>
                                    <td>
                                        @php
                                            $types = [
                                                'internal' => 'success',
                                                'external' => 'info',
                                            ];
                                            $label = ucfirst($course->course_type);
                                            $class = $types[$course->course_type] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $class }}">{{ $label }}</span>
                                    </td>
                                    <td>{!! Str::limit(strip_tags($course->description), 20, '...') !!}</td>
                                    <td>{{ optional($course->instructor_name)->name ?? 'Not Set' }}</td>

                                    <td>
                                        <img src="{{ asset($course->image) }}" alt="Course Image" width="40" height="40" class="rounded-circle">
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">

                                            <a href="{{ route('course.curriculum', $course->id) }}"
                                               class="badge bg-dark text-light d-inline-flex align-items-center"
                                               title="Set Curriculum">
                                                <i class="fa fa-book me-1"></i> Curriculum
                                            </a>

                                            <a href="#" data-bs-toggle="modal" data-bs-target="#assignInstructorModal_{{ $course->id }}"
                                               class="badge bg-success text-light d-inline-flex align-items-center"
                                               title="Assign Instructor">
                                                <i class="fa fa-user-plus me-1"></i> Instructor
                                            </a>

                                            <a href="{{ route('course.edit', $course->id) }}"
                                               class="badge bg-primary text-light d-inline-flex align-items-center"
                                               title="Edit">
                                                <i class="fa fa-edit me-1"></i> Edit
                                            </a>

                                            <a href="#" data-bs-toggle="modal" data-bs-target="#course_{{ $course->id }}"
                                               class="badge bg-danger text-light d-inline-flex align-items-center"
                                               title="Delete">
                                                <i class="fa fa-trash me-1"></i> Delete
                                            </a>

                                            @include('admin.modal.deleteCourse')
                                        </div>
                                    </td>

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
