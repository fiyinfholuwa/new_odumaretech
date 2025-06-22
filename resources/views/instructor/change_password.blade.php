@extends('user.app')

@section('content')

    <div class="row" style="margin:10px">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Change Password</div>
                </div>
                <div class="card-body">
                    <form action="{{route('user.password.change')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                        <label for="email2">Old Password</label>
                        <input type="password" class="form-control" id="email2" required name="old_password" placeholder="Enter Old Password">
                        <small style="color:red; font-weight:500">
                        @error('old_password')
                        {{$message}}
                        @enderror
                        </small>
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="email2">New Password</label>
                        <input type="password" class="form-control" id="email2" required name="new_password" placeholder="Enter New Password">
                        <small style="color:red; font-weight:500">
                        @error('new_password')
                        {{$message}}
                        @enderror
                        </small>
                        
                    </div>

                    <div class="form-group">
                        <label for="email2">New Password</label>
                        <input type="password" class="form-control" id="email2" required name="new_password_confirmation" placeholder="Enter New Password  Confirmation">
                        <small style="color:red; font-weight:500">
                        @error('new_password_confirmation')
                        {{$message}}
                        @enderror
                        </small>
                    </div>
                    
                </div>
                <div class="card-action">
                    <button class="btn btn-primary">Change Password</button>
        
                </div>
                    </form>
            </div>
        </div>
        
    </div>

@endsection