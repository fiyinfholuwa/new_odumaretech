@extends('admin.app')

@section('content')
    <div class="row" style="margin:10px">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title"><h5 class="text-white">Manage Master Class Link </h5></div>
                </div>
                <div class="card-body">
                    <form action="{{ route('masterclass.link.add') }}" method="post">
                        @csrf

                        @if($masterclass_link != null)
                            <input type="hidden" name="id" value="{{ $masterclass_link->id }}"/>

                            <div class="form-group">
                                <label for="link">Master Class Link</label>
                                <input type="text" class="form-control" id="link" name="link" value="{{ $masterclass_link->link }}" required placeholder="Enter Master Class Link">
                                <small style="color:red; font-weight:500">@error('link') {{ $message }} @enderror</small>
                            </div>

                            <div class="form-group">
                                <label for="title">Master Class Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $masterclass_link->title }}" required placeholder="Enter Master Class Title">
                            </div>

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ $masterclass_link->date }}" required>
                            </div>

                            <div class="form-group">
                                <label for="time">Time</label>
                                <input type="time" class="form-control" id="time" name="time" value="{{ $masterclass_link->time }}" required>
                            </div>

                            <div class="form-group">
                                <label for="visible">Visibility</label>
                                <select class="form-control" name="visible" required>
                                    <option value="">Select Option</option>
                                    <option value="on" {{ $masterclass_link->visible == 'on' ? 'selected' : '' }}>Yes</option>
                                    <option value="off" {{ $masterclass_link->visible == 'off' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="card-action">
                                <button class="btn btn-primary">Update Link</button>
                            </div>

                        @else

                            <div class="form-group">
                                <label for="link">Master Class Link</label>
                                <input type="text" class="form-control" id="link" name="link" required placeholder="Enter Master Class Link">
                            </div>

                            <div class="form-group">
                                <label for="title">Master Class Title</label>
                                <input type="text" class="form-control" id="title" name="title" required placeholder="Enter Master Class Title">
                            </div>

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>

                            <div class="form-group">
                                <label for="time">Time</label>
                                <input type="time" class="form-control" id="time" name="time" required>
                            </div>

                            <div class="form-group">
                                <label for="visible">Visibility</label>
                                <select class="form-control" name="visible" required>
                                    <option value="">Select Option</option>
                                    <option value="on">Yes</option>
                                    <option value="off">No</option>
                                </select>
                            </div>

                            <div class="card-action">
                                <button class="btn btn-success">Add Link</button>
                            </div>

                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h5 class="card-title text-white">Test Master Class Link</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Visibility</th>
                                        <th>Master Class URL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i = 1; @endphp
                                    @if($masterclass_link)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $masterclass_link->title }}</td>
                                            <td>{{ $masterclass_link->date }}</td>
                                            <td>{{ $masterclass_link->time }}</td>
                                            <td>
                                                @if($masterclass_link->visible == 'on')
                                                    <span class="btn btn-success">Yes</span>
                                                @else
                                                    <span class="btn btn-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a target="_blank" class="btn btn-info" href="{{ $masterclass_link->link }}">View</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">No Master Class Link Found</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
