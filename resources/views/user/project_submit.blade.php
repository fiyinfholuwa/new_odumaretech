@extends('user.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Submit Project</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('project.submit.user', $project->id)}}" method="post" enctype="multipart/form-data">
                               @csrf
                           <div class="form-group">
                                <label for="email2">Project Title</label>
                                <input type="text" class="form-control" id="email2" value="{{$project->title}}" readonly required name="title" placeholder="Enter  Project Title">
                            </div>
                            
                            <div class="form-group">
                                <label for="email2">Project Description</label>
                                <input type="text" class="form-control" id="email2" value="{{$project->description}}" readonly required name="title" placeholder="Enter Project Description">
                            </div>
                            <div class="form-group">
                            <label for="email2">Attachement</label>
                            <a target="_blank" class="btn btn-info" href="{{asset($project->image)}}">View Attachement</a>
                            </div>
                            <h3 class="text-info">Submit Project</h3>

                            <div class="form-group">
                                <label for="email2">Project Attachement (Optional)</label>
                                <input type="file" class="form-control" id="email2"  name="image" >
                                <input type="hidden" value="{{$project->id}}"  name="asessement_id" >
                                <input type="hidden" value="{{$project->course_id}}"  name="course_id" >
                            </div>
                            <div class="form-group">
                                <label for="email2">Project Attachement Link</label>
                                <textarea required class="form-control" name="link" placeholder="Project Attachment Link" ></textarea>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Submit Project</button>
                        </div>
                           </form>
                    </div>
                    
                </div>
                
            </div>

@endsection