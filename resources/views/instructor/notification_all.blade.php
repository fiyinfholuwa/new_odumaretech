@extends('instructor.app')

@section('content')

<div class="row" style="margin:10px">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h4 class="card-title mb-0">All Notifications</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
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
                            @php $i = 1; @endphp
                            @foreach($notifications as $notification)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $notification->title }}</td>
                                <td>{{ optional($notification->course_name)->title }}</td>
                                <td>
                                    @php
                                        $cohortIds = json_decode($notification->cohort_id, true) ?? [];
                                    @endphp

                                    @if (!empty($cohortIds))
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($cohortIds as $cohortId)
                                                @if (isset($cohorts[$cohortId]))
                                                    <li>
                                                        <span class="badge bg-primary">
                                                            {{ $cohorts[$cohortId] }}
                                                        </span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">No Cohorts</span>
                                    @endif
                                </td>
                                <td>{!! Str::limit(html_entity_decode($notification->description), 20, "...") !!}</td>
                                <td>
                                    @if ($notification->status == "pending")
                                        <span class="btn btn-warning btn-sm">Draft</span>
                                    @else
                                        <span class="btn btn-success btn-sm">Published</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('notification.edit', $notification->id) }}">
                                        <i style="color:blue;" class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#notification_{{ $notification->id }}">
                                        <i style="color:red;" class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            {{-- Include your delete modal --}}
                            @include('instructor.modal.deleteNotification')
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
        font-size: 0.8rem;
        padding: 5px 10px;
        margin-bottom: 4px;
        display: inline-block;
    }
</style>

@endsection
