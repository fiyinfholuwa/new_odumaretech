@extends('user.app')

@section('content')
<div class="row my-4">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bgc-secondary text-white">
                <h4 class="card-title mb-0 bgc-secondary-text">All Chats</h4>
            </div>
            <div class="card-body">
                @if($chats->count())
                <div class="table-responsive">
                    <table id="my-table" class="table table-striped table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>S/N</th>
                                <th>Message</th>
                                <th>Response</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chats as $chat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Str::limit($chat->user_message, 30, '...') }}</td>
                                <td>
                                    @if(is_null($chat->instructor_message))
                                        <span class="badge bg-warning text-dark">Waiting...</span>
                                    @else
                                        {!! Str::limit(html_entity_decode($chat->instructor_message), 30, '...') !!}
                                    @endif
                                </td>
                                <td>
                                    @if(is_null($chat->instructor_message))
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <a href="{{ route('chat.user.read', $chat->id) }}" class="btn btn-sm btn-success">
                                            View Message
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <p class="text-center text-muted">No chat messages available.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
