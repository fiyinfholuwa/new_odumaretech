@extends('instructor.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Review Project</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('project.review.instructor', $assignment->id)}}" method="post" enctype="multipart/form-data">
                               @csrf
                           <div class="form-group">
                                <label for="email2">Course Title</label>
                                <input type="text" class="form-control" id="email2" value="{{$assignment->course_name->title}}" readonly required name="title" placeholder="">
                            </div>
                            

                            @if($assignment->image != null)
                            <div class="form-group">
                                <label for="email2">Project Attachement</label>
                                <a target="_blank" class="btn btn-info" href="{{asset($assignment->image)}}">View Project Attachment</a>
                            </div>
                            @endif
                            @if($assignment->link != null)
                            <div class="form-group">
                                <label for="email2">Project Attachement Link</label>
                                <a target="_blank" class="btn btn-info" href="{{$assignment->link}}">View Project</a>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="email2">Grade Project</label>
                                <input type="number" max="100" class="form-control" id="email2" required name="score" placeholder="Enter  Assignment Score 0-100">
                            </div>
                           
                        <div class="card-action">
                            <button class="btn btn-primary">Review Project</button>
                
                        </div>
                           </form>
                    </div>
                    
                </div>
                
            </div>

@endsection