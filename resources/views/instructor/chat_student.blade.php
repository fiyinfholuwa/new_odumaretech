@extends('instructor.app')

@section('content')

<div class="row" style="margin:10px">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0 text-white">All Student Chats</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="my-table" class="display table table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>S/N</th>
                                <th>User Message</th>
                                <th>Instructor Response</th>
                                <th>Status / Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chats as $index => $chat)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span title="{{ $chat->user_message }}">
                                        {!! Str::limit(strip_tags($chat->user_message), 50, '...') !!}
                                    </span>
                                </td>
                                <td>
                                    @if(is_null($chat->instructor_message))
                                        <span class="badge bg-warning text-dark">Pending...</span>
                                    @else
                                        <span title="{{ $chat->instructor_message }}">
                                            {!! Str::limit(strip_tags($chat->instructor_message), 50, '...') !!}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($chat->instructor_status === 'replied')
                                        <span class="badge bg-success">Replied</span>
                                    @else
                                        <a href="{{ route('instructor.student.chat.reply', $chat->id) }}" class="btn btn-sm btn-primary">
                                            Reply Chat
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

@endsection
