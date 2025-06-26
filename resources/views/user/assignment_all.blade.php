@extends('user.app')

@section('content')

<style>
    .go-back-btn {
        background-color: #f0f0f0;
        color: #333;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        transition: background-color 0.2s ease-in-out;
    }

    .go-back-btn:hover {
        background-color: #e2e2e2;
        color: #000;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #343a40;
    }

    .table thead th {
        background-color: #f8f9fa;
        color: #495057;
    }

    .btn-submit {
        background-color: #dc3545;
        border: none;
    }

    .btn-submit:hover {
        background-color: #c82333;
    }
</style>

<style>
    .go-back-btn {
        background-color: #f8f9fa;
        color: #333;
        border: 1px solid #ccc;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        display: flex;
        align-items: center;
    }

    .go-back-btn:hover {
        background-color: #e9ecef;
        color: #000;
        border-color: #bbb;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #343a40;
        margin-left: 16px;
    }

    @media (max-width: 576px) {
        .page-title {
            font-size: 1.25rem;
            margin-left: 10px;
        }
    }
</style>

<div class="row mx-2 my-3">
    <div class="d-flex align-items-center flex-wrap">
        <button class="go-back-btn" onclick="history.back()">
            <i class="fas fa-arrow-left me-2"></i>Go Back
        </button>
        <h4 class="page-title mb-0">{{ $course_title->title }}</h4>
    </div>
</div>

<div class="row mx-2">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bgc-secondary border-bottom">
                <h4 class="card-title mb-0 bgc-secondary-text">Assignment List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="my-table" class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignments as $index => $assignment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $assignment->title }}</td>
<td>{!! \Illuminate\Support\Str::limit(strip_tags($assignment->description), 30) !!}</td>
                                    <td>
                                        <a href="{{ route('assignment.submit', $assignment->id) }}" class="btn btn-sm btn-submit text-white">
                                            Submit Assignment
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @if(count($assignments) === 0)
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No assignments available.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
