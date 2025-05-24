@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Manage Recorded Session Link</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('record.link.add')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <select required class="form-control" name="course_id">
                                    <option value="">Select Course Title</option>
                                    @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <select required class="form-control" name="cohort_id">
                                    <option value="">Select Cohort</option>
                                    @foreach($cohorts as $cohort)
                                    <option value="{{$cohort->id}}">{{$cohort->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>


                            
                           <div class="form-group">
                                <label for="email2">Record Session Link</label>
                                <input type="text" class="form-control" id="email2" value="" required name="link" placeholder="Enter Recorded Session Link">
                                <small style="color:red; font-weight:500">
                                @error('link')
                                {{$message}}
                                @enderror
                                </small>
                                
                            </div>
                        
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Add Record Link</button>
                
                        </div>
                        
                          
                           </form>
                    </div>
                    
                </div>

                <div class="col-md-7">
                <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Check Recorded Session Link</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <td>S/N</td>
													<th>Course Title</th>
                                                    <th>Cohort Name</th>
                                                    <th>Recorded Session Link</th>

                                                    <th>Actions</th>
										
												</tr>
											</thead>
                                            <tbody>
                                            <?php $i = 1; ?>
                                            @foreach($record_link as $link)
                                            
										
											<tr>
                                            <td>{{$i++;}}</td>
                                        
                                            <td>{{$link->title}}</td>
                                            <td>{{$link->name}}</td>
                                           <td>
                                            <a target="_blank" class="btn btn-info" href="{{$link->link}}">View recorded Session</a>
                                            
                                            </td>  
                                            <td>
                                                <a href="{{route('record.link.edit', $link->id)}}" ><i style="color:blue;" class="fa fa-edit"></i></a>    
                                                <a href="#" data-toggle="modal" data-target="#record_{{$link->id}}" ><i style="color:red;" class="fa fa-trash"></i></a>
                                                </td>
                                                
											</tr>

                                            
    <!-- Modal -->
                                        <div class="modal fade" id="record_{{$link->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <form action="{{route('record.link.delete', $link->id)}}" method="post">
                                    @csrf
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger" id="exampleModalLabel">Recorded Link Delete</h5>
                                            
                                        </div>
                                        <div class="modal-body">
                                            Are You Sure You want to delete this Recorded Link
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