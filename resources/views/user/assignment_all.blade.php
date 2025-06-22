@extends('user.app')

@section('content')

            <div class="row" style="margin:10px">
            
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">{{$course_title->title}}</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S/N</th>
													<th>Title</th>
                                                    <th>Content</th>
                                                    <th>Submit</th>
												</tr>
											</thead>
											
                                            <tbody>
											<?php $i = 1; ?>
                                            @foreach($assignments as $assignment)
											<tr>
												<td>{{$i++;}}</td>
                                                <td>{{$assignment->title}}</td>
                                                <td>{{$assignment->description}}</td>
                                                <td><a href="{{route('assignment.submit', $assignment->id)}}" class="btn btn-danger btn-sm" >submit assignment</a></td>
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