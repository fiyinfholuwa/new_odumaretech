@extends('instructor.app')

@section('content')

<div class="row" style="margin:10px">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">All Final Projects</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="my-table" class="table table-hover table-striped align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Course</th>
                                <th>Cohort(s)</th>
                                <th>Attachment</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ optional($project->course_name)->title }}</td>
                                    
                                    <td>
                                        @php
                                            $cohortIds = json_decode($project->cohort_id, true) ?? [];
                                        @endphp
                                        @if(!empty($cohortIds))
                                            @foreach($cohortIds as $id)
                                                @if(isset($cohorts[$id]))
                                                    <span class="badge bg-primary mb-1">{{ $cohorts[$id] }}</span>
                                                @endif
                                            @endforeach
                                        @else
                                            <span class="text-muted">No Cohort</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ asset($project->image) }}" class="btn btn-sm btn-info" target="_blank">
                                            View Attachment
                                        </a>
                                    </td>

                                    <td>
                                        @if($project->status === 'pending')
                                            <span class="badge bg-warning text-dark">Draft</span>
                                        @else
                                            <span class="badge bg-success">Published</span>
                                        @endif
                                    </td>

                                    <td>
                                        {!! Str::limit(strip_tags($project->description), 30, '...') !!}
                                    </td>

                                    <td>
                                        <a href="{{ route('project.instructor', $project->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#project_{{ $project->id }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        @include('instructor.modal.deleteproject')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table-responsive -->
            </div>
        </div>
    </div>
</div>

@endsection
