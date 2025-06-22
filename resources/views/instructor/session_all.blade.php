@extends('instructor.app')

@section('content')
<div class="row my-4">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">All Sessions</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="session-table" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Cohort</th>
                                <th>Description</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($sessions as $session)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $session->title }}</td>
                                    <td>{{ optional($session->course_name)->title ?? '-' }}</td>
<td>
    @php
        $cohortIds = json_decode($session->cohort_id, true) ?? [];
    @endphp

    @if (!empty($cohortIds))
        <ul class="list-unstyled mb-0">
            @foreach ($cohortIds as $cohortId)
                @if (isset($cohorts[$cohortId]))
                    <li><span class="badge bg-primary">{{ $cohorts[$cohortId]->name }}</span></li>
                @else
                    <li><span class="badge bg-secondary">Unknown (ID {{ $cohortId }})</span></li>
                @endif
            @endforeach
        </ul>
    @else
        <span class="text-muted">None</span>
    @endif
</td>

                                    <td>
                                        <a target="_blank" class="btn btn-info btn-sm" href="{{ $session->description }}">
                                            View Link
                                        </a>
                                    </td>

                                    <td>
                                        @include('instructor.countdown', ['session' => $session])
                                    </td>

                                    <td>
                                        @if($session->status === 'pending')
                                            <span class="btn btn-warning btn-sm">Draft</span>
                                        @else
                                            <span class="btn btn-success btn-sm">Published</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('session.edit', $session->id) }}">
                                            <i class="fa fa-edit text-primary"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#session_{{ $session->id }}">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                @include('instructor.modal.deleteSession', ['session' => $session])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
