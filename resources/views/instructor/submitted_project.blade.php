@extends('instructor.app')

@section('content')

<div class="row" style="margin:10px">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-secondary text-white">
                <h4 class="card-title mb-0">Review All Projects</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="my-table" class="table table-hover table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>S/N</th>
                                <th>Course</th>
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

                                    <td>
                                        @if($assignment->status == 'pending')
                                            <span class="badge bg-warning text-dark">Under Review</span>
                                        @elseif($assignment->status == 'graded')
                                            <span class="badge bg-success">Graded</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($assignment->status) }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($assignment->status_in == 0 || $assignment->status_in == '0')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @else
                                            <span class="badge bg-primary">{{ $assignment->status_in }}%</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($assignment->status == 'graded')
                                            <button class="btn btn-danger btn-sm" disabled>Project Graded</button>
                                        @else
                                            <a href="{{ route('project.submitted.to', $assignment->id) }}" class="btn btn-outline-primary btn-sm">
                                                Grade Project
                                            </a>
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

{{-- Optional: Add some minor enhancements --}}
<style>
    .table thead th {
        vertical-align: middle;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.45em 0.6em;
    }
</style>

@endsection
