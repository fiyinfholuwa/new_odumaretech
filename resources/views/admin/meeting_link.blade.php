@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Manage Meeting Link</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('meeting.link.add')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <select class="form-control" name="course_id">
                                    <option value="">Select Course Title</option>
                                    @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="email2">Meeting Title</label>
                                <input type="text" class="form-control" id="email2" value="" required name="meeting_title" placeholder="Enter Meeting Title">
                                <small style="color:red; font-weight:500">
                                @error('link')
                                {{$message}}
                                @enderror
                                </small>
                                
                            </div>

                           <div class="form-group">
                                <label for="email2">Meeting Link</label>
                                <input type="text" class="form-control" id="email2" value="" required name="link" placeholder="Enter Meeting Session Link">
                                <small style="color:red; font-weight:500">
                                @error('link')
                                {{$message}}
                                @enderror
                                </small>
                                
                            </div>
                        
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Add Meeting Link</button>
                
                        </div>
                        
                          
                           </form>
                    </div>
                    
                </div>

                <div class="col-md-7">
                <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Check Meeting Session Link</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <td>S/N</td>
													<th>Course Title</th>
                                                    <th>Meeting Title</th>
                                                    <th>Meeting Link</th>
                                                    <th>Actions</th>
										
												</tr>
											</thead>
                                            <tbody>
                                            <?php $i = 1; ?>
                                            @foreach($meeting_link as $link)
                                            
										
											<tr>
                                            <td>{{$i++;}}</td>
                                            <td>{{$link->title}}</td>
                                            <td>{{$link->meeting_title}}</td>
                                           <td>
                                            <a target="_blank" class="btn btn-info" href="{{$link->link}}">View Meeting Session</a>
                                            
                                            </td>  
                                            <td>
                                                <a href="{{route('meeting.link.edit', $link->id)}}" ><i style="color:blue;" class="fa fa-edit"></i></a>    
                                                <a href="#" data-toggle="modal" data-target="#meeting_{{$link->id}}" ><i style="color:red;" class="fa fa-trash"></i></a>
                                                </td>
                                                
											</tr>

                                            
    <!-- Modal -->
                                        <div class="modal fade" id="meeting_{{$link->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <form action="{{route('meeting.link.delete', $link->id)}}" method="post">
                                    @csrf
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger" id="exampleModalLabel">Meeting Link Delete</h5>
                                            
                                        </div>
                                        <div class="modal-body">
                                            Are You Sure You want to delete this Meeting Link
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                    </div>

										@endforeach
                                            </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

					</div>
                    
                </div>
            </div>

@endsection