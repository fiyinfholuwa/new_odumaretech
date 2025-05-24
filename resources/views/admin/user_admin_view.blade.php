@extends('admin.app')

@section('content')

    <div class="row" style="margin:10px">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add User</div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.user.add')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="email2">First Name</label>
                            <input type="text" class="form-control" id="email2" required name="first_name" placeholder="Enter First Name">
                            <small style="color:red; font-weight:500">
                                @error('first_name')
                                {{$message}}
                                @enderror
                            </small>

                        </div>

                        <div class="form-group">
                            <label for="email2">Last Name</label>
                            <input type="text" class="form-control" id="email2" required name="last_name" placeholder="Enter Last Name">
                            <small style="color:red; font-weight:500">
                                @error('last_name')
                                {{$message}}
                                @enderror
                            </small>

                        </div>

                        <div class="form-group">
                            <label for="email2">Email</label>
                            <input type="text" class="form-control" id="email2" required name="email" placeholder="Enter Email">
                            <small style="color:red; font-weight:500">
                                @error('email')
                                {{$message}}
                                @enderror
                            </small>

                        </div>
                        <div class="form-group">
                            <label for="email2">Password</label>
                            <input type="text" class="form-control" id="email2" required name="password" placeholder="Enter Password">
                            <small style="color:red; font-weight:500">
                                @error('password')
                                {{$message}}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="course_id" id="validationCustom02"  required>
                                <option value="">Select Course Category</option>
                                @if(count($courses) > 0)
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->title}}</option>
                                    @endforeach
                                @else
                                    <option disabled>No Course</option>
                                @endif
                            </select>
                        </div>


                        <div class="form-group">
                            <select class="form-control" name="cohort_id" id="validationCustom02"  required>
                                <option value="">Select Course Cohort</option>
                                @if(count($cohorts) > 0)
                                    @foreach($cohorts as $cohort)
                                        <option value="{{$cohort->id}}">{{$cohort->name}}</option>
                                    @endforeach
                                @else
                                    <option disabled>No Course</option>
                                @endif
                            </select>
                        </div>

                <div class="card-action">
                    <button type="submit" class="btn btn-primary">Add User</button>

                </div>
                </form>
            </div>

        </div>

    </div>

@endsection
