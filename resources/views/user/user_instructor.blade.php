@extends('user.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Read Message</div>
                        </div>
                        <div class="card-body">
                           <form action="" method="post" enctype="multipart/form-data">
                               @csrf
            
                               <div class="form-group">
                                <label for="email2">Message</label>
                                <input type="text" class="form-control" readonly value="{{$chat->user_message}}" />
                                <small style="color:red; font-weight:500">
                                </small>
                            </div>

                           
                        </div>
                        
                        </form>
                    </div>
                    
                </div>
                
            </div>

@endsection