@extends('user.app')

@section('content')

            <div class="row" style="margin:10px">
            
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Submitted Projects</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S/N</th>
													<th>Course</th>

                                                    <th>Status</th>
                                                    <th>Grade</th>
												</tr>
											</thead>
											
                                            <tbody>
											<?php $i = 1; ?>
                                            @foreach($assignments as $assignment)
                                           
											<tr>
												<td>{{$i++;}}</td>
                                                <td>{{$assignment->course_name->title}}</td>
                                        
                                                <td>@if($assignment->status == "pending")
													<span class="btn btn-warning btn-sm">under review<span>
													@else
													<span class="btn btn-success btn-sm">{{$assignment->status}}<span>
													@endif
												</td>
                                                <td>
													@if($assignment->status_in == 0 || $assignment->status_in == "0")
													<span class="btn btn-warning btn-sm">under review</span>
													@else
													<span class="btn btn-success btn-sm">{{$assignment->status_in}}</span>
													@endif
												</td>
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