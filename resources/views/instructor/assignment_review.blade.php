@extends('instructor.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Review Assignment</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('assignment.review.instructor', $assignment->id)}}" method="post" enctype="multipart/form-data">
                               @csrf
                           <div class="form-group">
                                <label for="email2">Assignment Title</label>
                                <input type="text" class="form-control" id="email2" value="{{$assignment->assignment_name->title}}" readonly required name="title" placeholder="Enter  Assignment Title">
                            </div>


                            @if($assignment->image != null)
                            <div class="form-group">
                                <label for="email2">Assignment Attachement</label>
                                <a target="_blank" class="btn btn-info" href="{{asset($assignment->image)}}">View Assignment Attachment</a>
                            </div>
                            @endif
                            @if($assignment->link != null)
                            <div class="form-group">
                                <label for="email2">Assignment Attachement Link</label>
                                <a target="_blank" class="btn btn-info" href="{{$assignment->link}}">View Assignment</a>
                            </div>
                            @endif


                            <div class="form-group">
                                <label for="email2">Give  Assignment Review</label>
                                <textarea required class="form-control" row="2" name="review" placeholder="Give Assignment Review">
                                {{$assignment->review}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="email2">Grade Assignment</label>
                                <input type="number" value="{{$assignment->status_in}}" max="100" class="form-control" id="email2" required name="score" placeholder="Enter  Assignment Score 0-100">
                            </div>

                        <div class="card-action">
                            <button class="btn btn-primary">Review Assignment</button>

                        </div>
                           </form>
                    </div>

                </div>

            </div>

@endsection
