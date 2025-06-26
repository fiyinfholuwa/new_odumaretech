@extends('user.app')

@section('content')

<style>
    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .text-muted-small {
        font-size: 0.95rem;
        color: #6c757d;
    }
</style>

<div class="row mt-4 mx-2">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bgc-secondary">
                <h4 class="card-title mb-0 bgc-secondary-text">{{ $course_title->title }}</h4>
            </div>

            <div class="card-body">
                @if(count($notifications) > 0)
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Content</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($notifications as $index => $notification)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $notification->title }}</td>
                                <td>{!! \Illuminate\Support\Str::limit($notification->description, 150) !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <h5 class="text-muted">No notifications available for this course.</h5>
                    <p class="text-muted-small">Updates and important information will appear here when shared by your instructor.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
