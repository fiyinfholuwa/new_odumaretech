@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">
            
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Courses</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S/N</th>
													<th>Title</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
                                                    <th>Image</th>
													<th>Action</th>
												</tr>
											</thead>
											
                                            <tbody>
											<?php $i = 1; ?>
                                            @foreach($courses as $course)
                                           
											<tr>
												<td>{{$i++;}}</td>
                                                <td>{{$course->title}}</td>
                                                <td>{{optional($course->cat)->name}}</td>
                                                <td>{!!Str::limit(html_entity_decode($course->description),20,"...")!!}</td>
                                                
                                                <td><img height="40" width="40" src="{{asset($course->image)}}" /></td>
                                                <td>
                                                <a href="{{route('course.edit', $course->id)}}" ><i style="color:blue;" class="fa fa-edit"></i></a>    
                                                <a href="#" data-toggle="modal" data-target="#course_{{$course->id}}" ><i style="color:red;" class="fa fa-trash"></i></a>
                                                </td>
                                                @include('admin.modal.deleteCourse')
											</tr>
											
                                            @endforeach
                                    
                                            </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

				
            </div>

@endsection