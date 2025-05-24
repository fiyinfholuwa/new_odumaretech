@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Assess Applicant</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('applicant.update', $applicant->id)}}" method="post" enctype="multipart/form-data">
                               @csrf
                           <div class="form-group">
                                <label for="email2">First Name</label>
                                <input type="text" class="form-control" readonly id="email2" value="{{$applicant->first_name}}"   name="first_name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="email2">Last Name</label>
                                <input type="text" class="form-control" readonly id="email2" value="{{$applicant->last_name}}"   name="last_name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="email2">Gender</label>
                                <input type="text" class="form-control" readonly id="email2" value="{{$applicant->gender}}"   name="gender" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="email2">Email</label>
                                <input type="text" class="form-control" readonly id="email2" value="{{$applicant->email}}"  name="email" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="email2">Resume</label> </br>
                                <a class="btn btn-danger" target="_blank" href="{{asset($applicant->resume)}}">view resume</a>
                            </div>

                            <div class="form-group">
                                <label for="email2">Applicant Selected Courses</label> </br>
                                <?php $j = 1; ?>
                                @foreach($applicant->course_ids as $course)
                                    {{$j++;}}. {{$course}}. </br>
                                @endforeach
                            </div>
                            
                            <div class="form-group">
                            <label for="email2">Select Courses for Applicant</label></br>
                                @if(count($courses) > 0)
                                @foreach($courses as $course)
                                <label>{{$course->title}}:<input name="course_ids[]" value="{{$course->id}}" type="checkbox" /></label></br>
                                @endforeach
                                @else
                                <option disabled>No Courses</option>
                                @endif
                            </div>

                            <div class="form-group">
                                <select required class="form-control" name="status" id="validationCustom02">
                                <option disabled value="" selected >Validate Applicants</option>
                                <option value="approved"  >Approve</option>
                                <option value="rejected"  >Reject</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Validate Applicant</button>
                
                        </div>
                           </form>
                    </div>
                    
                </div>
                
            </div>

@endsection