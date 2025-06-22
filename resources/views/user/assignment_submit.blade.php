@extends('user.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Submit Assignment</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('assignment.submit.user', $assignment->id)}}" method="post" enctype="multipart/form-data">
                               @csrf
                           <div class="form-group">
                                <label for="email2">Assignment Title</label>
                                <input type="text" class="form-control" id="email2" value="{{$assignment->title}}" readonly required name="title" placeholder="Enter  Assignment Title">
                            </div>

                               <div class="form-group">
                                   <label for="email2">Assignment Description</label>
                                   <textarea class="form-control" readonly required name="title" placeholder="Enter  Assignment Title">{{$assignment->description}}</textarea>
                               </div>

                                @if(!is_null($assignment->image))
                                   <div class="form-group">
                                       <label for="email2">Assignment Attached File</label>
                                       <a class="badge bg-primary text-white" href="{{asset($assignment->image)}}">click here to open the file</a>
                                   </div>

                               @endif
                               <div class="form-group">
                                <label for="email2">Assignment Attachement (Optional)</label>
                                <input type="file" class="form-control" id="email2"  name="image" >
                                <input type="hidden" value="{{$assignment->id}}"  name="assignment_id" >
                                <input type="hidden" value="{{$assignment->course_id}}"  name="course_id" >
                            </div>
                            <div class="form-group">
                                <label for="email2">Assignment Attachement Link (Optional)</label>
                                <textarea class="form-control" name="link" placeholder="Assignment Attachment Link" ></textarea>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Submit Assignment</button>

                        </div>
                           </form>
                    </div>

                </div>

            </div>

@endsection
