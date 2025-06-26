@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Instructor</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('instructor.update', $user->id)}}" method="post" enctype="multipart/form-data">
                               @csrf
                           <div class="form-group">
                                <label for="email2">First Name</label>
                                <input type="text" class="form-control" readonly id="email2" value="{{$user->first_name}}"   name="first_name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="email2">Last Name</label>
                                <input type="text" class="form-control" readonly id="email2" value="{{$user->last_name}}"   name="last_name" placeholder="">
                            </div>
                            
                            <div class="form-group">
                                <label for="email2">Email</label>
                                <input type="text" class="form-control" readonly id="email2" value="{{$user->email}}"  name="email" placeholder="">
                            </div>

                            
                            <div class="form-group">
                                <label for="email2">Instructor Current Courses</label> </br>
                                <?php $j = 1; ?>
                                @foreach($courses_old as $course_old)
                                                {{$j++;}}. {{$course_old->title}}. </br>
                                @endforeach
                            </div>
                            
                        
                            <div class="form-group">
                            <label for="email2">Select Courses for Instructor</label></br>
                                @if(count($courses) > 0)
                                @foreach($courses as $course)
                                <label>{{$course->title}}:<input name="course_ids[]" value="{{$course->id}}" type="checkbox" /></label></br>
                                @endforeach
                                @else
                                <option disabled>No Courses</option>
                                @endif
                            
                            </div>


                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Update Instructor</button>
                
                        </div>
                           </form>
                    </div>
                    
                </div>
                
            </div>

@endsection