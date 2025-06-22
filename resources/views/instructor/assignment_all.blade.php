@extends('instructor.app')

@section('content')
<style>
.badge-cohort {
    background: #6c757d;
    color: #fff;
    margin-right: 3px;
    font-size: 12px;
}
</style>

<div class="row my-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-white">All Assignments</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Cohort(s)</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignments as $i => $assignment)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $assignment->title }}</td>
                                <td>{{ optional($assignment->course_name)->title }}</td>
                                <td>
                                    @php
                                        $cohortIds = json_decode($assignment->cohort_id, true) ?? [];
                                    @endphp
                                    @foreach($cohortIds as $cid)
                                        <span class="badge badge-cohort">
                                            {{ optional(\App\Models\Cohort::find($cid))->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>{!! Str::limit(strip_tags($assignment->description), 30, '...') !!}</td>
                                <td>
                                    @if($assignment->status === 'pending')
                                        <span class="badge bg-warning">Draft</span>
                                    @else
                                        <span class="badge bg-success">Published</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('assignment.edit', $assignment->id) }}" class="text-primary me-2" title="Edit">
                                        <i class="fa fa-edit fa-lg"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#assignment_{{ $assignment->id }}" title="Delete">
                                        <i class="fa fa-trash fa-lg text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                            @include('instructor.modal.deleteAssignment')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
