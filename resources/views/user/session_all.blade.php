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
                                                    <th>Meeting Link</th>
                                                    <th>Time Left</th>
												</tr>
											</thead>
											
                                            <tbody>
											<?php $i = 1; ?>
                                            @foreach($sessions as $session)
                                           
											<tr>
												<td>{{$i++;}}</td>
                                                <td>{{$session->title}}</td>
                                            
                                                
                                                <td><a target="_blank" class="btn btn-info" href="{{$session->description}}">View Meeting Link</a></td>
                                                <td>
                                                    @include('user.countdown')
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