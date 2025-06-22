@extends('instructor.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Reply Message</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('admin.chat.replied', $chat->id)}}" method="post" enctype="multipart/form-data">
                               @csrf
            
                               <div class="form-group">
                                <label for="email2">Message</label>
                                <input type="text" class="form-control" readonly value="{{$chat->user_message}}" />
                                <small style="color:red; font-weight:500">
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="email2"> Reply Message</label>
                                <textarea class="form-control" name="message" rows="6"></textarea>
                                <small style="color:red; font-weight:500">
                                </small>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Reply Message</button>
                
                        </div>
                        </form>
                    </div>
                    
                </div>
                
            </div>

@endsection