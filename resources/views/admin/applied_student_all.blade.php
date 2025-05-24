@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">

						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Manage All Applied Students</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S/N</th>
													<th>Full Name</th>
													<th>Email</th>
													<th>Student ID</th>
													<th>Admission Status</th>
                                                    <th>Cohort</th>
                                                    <th>Course</th>
                                                    <th>Actions</th>
												</tr>
											</thead>

                                            <tbody>
											<?php $i = 1; ?>
                                            @foreach($applied as $ap)

											<tr>
												<td>{{$i++}}</td>
                                                <td>{{$ap->first_name}} {{$ap->last_name}}</td>
                                                <td>{{$ap->email}}</td>
                                                <td>{{$ap->student_id}}</td>
                                                <td>
                                                    @if($ap->admission_status == 'accepted')
                                                        <span class="badge bg-success text-white">{{$ap->admission_status}}</span>
                                                    @else
                                                        <span class="badge bg-danger text-white">{{$ap->admission_status}}</span>
                                                    @endif
                                                </td>
                                                <td>{{$ap->cohort_name}}</td>
                                                <td>{{optional($ap->course_name)->title}}</td>
                                                <td>
                                                <a href="#" data-toggle="modal" data-target="#applied_{{$ap->id}}" ><i style="color:blue;" class="fa fa-edit"></i></a>
                                                    <a href="#" data-toggle="modal"  data-target="#lock_{{$ap->id}}" ><i style="color:#ffffff;" class="fa fa-arrows-alt btn btn-primary">Manage Account</i></a>
                                                </td>

											</tr>
											@include('admin.modal.update_user_cohort')


                                            <div class="modal fade" id="lock_{{$ap->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('user.lock.lock', $ap->id)}}" method="post">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-danger" id="exampleModalLabel">User Lock</h5>

                                                            </div>
                                                            <div class="modal-body">
                                                                Are You Sure You want to Lock this user Account
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="lock" class="btn btn-danger btn-sm">Lock Account</button>
                                                                <button type="submit" name="unlock" class="btn btn-success btn-sm">Unlock Account</button>
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

@endsection
