@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">

						<div class="col-md-12">
							<div class="card">
								<div class="card-header bgc-secondary">
									<h4 class="card-title bgc-secondary-text">All Instructor Applications</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="my-table" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S/N</th>
													<th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Application Status</th>
                                                    <th>Actions</th>

												</tr>
											</thead>

                                            <tbody>
											<?php $i = 1; ?>
                                            @foreach($applicants as $applicant)

											<tr>
												<td>{{$i++;}}</td>
                                                <td>{{$applicant->first_name}}</td>
                                                <td>{{$applicant->last_name}}</td>
                                                <td>{{$applicant->email}}</td>

                                                <td>@if($applicant->status=="pending")
                                                    <span class="btn btn-warning btn-sm">{{$applicant->status}}</span>
                                                    @elseif($applicant->status =="approved")
                                                    <span class="btn btn-success btn-sm">{{$applicant->status}}</span>
                                                    @else
                                                    <span class="btn btn-danger btn-sm">{{$applicant->status}}</span>
                                                    @endif
                                                </td>

                                                <td>
                                                @if($applicant->status =="approved" ||  $applicant->status =="rejected")
                                                <span class="btn btn-secondary">proccessed <i class="fa fa-check"></i></span>
                                                @else
                                                <a class="btn btn-dark btn-sm text-white" href="{{route('applicant.edit', $applicant->id)}}" >Assess Applicant</a>
                                                @endif

                                                <a href="#" data-bs-toggle="modal" data-bs-target="#applicant_{{$applicant->id}}" ><i style="color:red;" class="fa fa-trash"></i></a>
                                                </td>
                                                @include('admin.modal.deleteApplicant')
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
