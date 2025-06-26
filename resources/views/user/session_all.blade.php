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

    .btn-meeting {
        background-color: #0dcaf0;
        color: white;
        font-weight: 500;
        border: none;
        padding: 6px 14px;
        border-radius: 4px;
    }

    .btn-meeting:hover {
        background-color: #0bb8de;
        color: #fff;
    }

    .text-muted-small {
        font-size: 0.95rem;
        color: #6c757d;
    }
</style>

<div class="row mt-4 mx-2">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bgc-secondary border-bottom">
                <h4 class="card-title mb-0 bgc-secondary-text">{{ $course_title->title }}</h4>
            </div>

            <div class="card-body">
                @if(count($sessions) > 0)
                <div class="table-responsive">
                    <table id="my-table" class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Meeting Link</th>
                                <th>Time Left</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($sessions as $index => $session)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $session->title }}</td>

                                <td>
                                    <a href="{{ $session->description }}" class="btn btn-meeting" target="_blank">
                                        <i class="fas fa-video me-1"></i> Join Meeting
                                    </a>
                                </td>

                                <td>
                                    @include('user.countdown', ['session' => $session])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <h5 class="text-muted">No upcoming sessions scheduled.</h5>
                    <p class="text-muted-small">Your live sessions will appear here once scheduled by your instructor.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
