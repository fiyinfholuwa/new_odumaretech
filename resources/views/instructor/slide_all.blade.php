@extends('instructor.app')

@section('content')
<div class="row my-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bgc-secondary text-white d-flex justify-content-between align-items-center">
                <h4 class="card-title bgc-secondary-text mb-0">All Slides</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="my-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Cohorts</th>
                                <th>Slide</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slides as $i => $slide)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $slide->title }}</td>
                                    <td>{{ optional($slide->course_name)->title }}</td>
                                    <td>
                                        @php
                                            $cohortIds = json_decode($slide->cohort_id, true) ?? [];
                                        @endphp
                                        @foreach($cohortIds as $cid)
                                            <span class="badge bg-success">
                                                {{ optional(\App\Models\Cohort::find($cid))->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a target="_blank" class="btn btn-sm btn-outline-info" href="{{ asset($slide->image) }}">
                                            <i class="fa fa-file"></i> View Slide
                                        </a>
                                    </td>
                                    <td>
                                        @if($slide->status === 'pending')
                                            <span class="badge bg-warning">Draft</span>
                                        @else
                                            <span class="badge bg-success">Published</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('slide.edit', $slide->id) }}" class="text-primary me-2" title="Edit">
                                            <i class="fa fa-edit fa-lg"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#slide_{{ $slide->id }}" title="Delete">
                                            <i class="fa fa-trash fa-lg text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                @include('instructor.modal.deleteSlide')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
