@extends('instructor.app')

@section('content')

<div class="row" style="margin:10px">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-secondary text-white">
                <h4 class="card-title mb-0">Review All Assignments</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="my-table" class="table table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>S/N</th>
                                <th>Course</th>
                                <th>Assignment Title</th>
                                <th>Status</th>
                                <th>Grade</th>
                                <th>Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($assignments as $assignment)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $assignment->course_name->title ?? 'N/A' }}</td>
                                <td>{{ $assignment->assignment_name->title ?? 'N/A' }}</td>

                                <td>
                                    @if($assignment->status === 'pending')
                                        <span class="badge bg-warning text-dark">Under Review</span>
                                    @elseif($assignment->status === 'graded')
                                        <span class="badge bg-success">Graded</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($assignment->status) }}</span>
                                    @endif
                                </td>

                                <td>
                                    @if(empty($assignment->status_in) || $assignment->status_in == 0)
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-primary">{{ $assignment->status_in }}%</span>
                                    @endif
                                </td>

                                <td>
                                    @if($assignment->status === 'graded')
                                        <div class="d-flex flex-column">
                                            <span class="badge bg-danger mb-1">Graded</span>
                                            <a href="{{ route('assignment.submitted.to', $assignment->id) }}" class="btn btn-sm btn-outline-secondary">Update Grade</a>
                                        </div>
                                    @else
                                        <a href="{{ route('assignment.submitted.to', $assignment->id) }}" class="btn btn-sm btn-outline-primary">Grade Assignment</a>
                                    @endif
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

<style>
    .badge {
        font-size: 0.85rem;
        padding: 0.45em 0.6em;
    }
</style>

@endsection
