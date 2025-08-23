@extends('admin.app')

@section('content')
    <div class="row" style="margin:10px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bgc-secondary d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="card-title bgc-secondary-text mb-0">All Messages</h4>
{{--                    <form method="post" action="{{ route('messages.export') }}" class="d-flex align-items-center gap-2 mt-2 mt-md-0">--}}
{{--                        @csrf--}}
{{--                        <input name="date_from" type="date" class="form-control form-control-sm" required style="max-width: 180px;" />--}}
{{--                        <input name="date_to" type="date" class="form-control form-control-sm" required style="max-width: 180px;" />--}}
{{--                        <button type="submit" class="btn btn-light btn-sm">Export to CSV</button>--}}
{{--                    </form>--}}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="my-table" class="display table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Subject</th>
                                <th>Message</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($all_messages as $message)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->phone }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>{{ $message->message }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
