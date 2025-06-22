@extends('user.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Send Message</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('chat.user.add')}}" method="post" enctype="multipart/form-data">
                               @csrf
            
                            <div class="form-group">
                                <label for="email2">Select Course</label>
                                <select class="form-control" required name="course_id" >
                                    <option value="" selected disabled>Select Course</option>
                                    @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="email2">Message</label>
                                <textarea class="form-control" name="message" rows="6"></textarea>
                                <small style="color:red; font-weight:500">
                                </small>
                            </div>

                            
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Send Message</button>
                
                        </div>
                        </form>
                    </div>
                    
                </div>
                
            </div>

@endsection