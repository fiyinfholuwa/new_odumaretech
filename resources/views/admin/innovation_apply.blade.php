@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">

						<div class="col-md-12">
							<div class="card">
								<div class="card-header bg-secondary">
									<h4 class="card-title text-white">Innovation Collaborators</h4>

                                    <form method="post" action="{{ route('innovation.export') }}">
                                        @csrf
                                        <div class="row d-flex align-items-center">

                                            <div class="col-lg-4 col-12">
                                                <input name="date_from" class="form-control" type="date" placeholder="Start Date" required />
                                            </div>

                                            <div class="col-lg-4 col-12">
                                                <input name="date_to" class="form-control" type="date" placeholder="End Date" required />
                                            </div>

                                            <div class="col-lg-2 col-12 ml-lg-3 mt-2 mt-lg-0">
                                                <button type="submit" class="btn btn-danger">Export to CSV</button>
                                            </div>

                                        </div>
                                    </form>



                                </div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="my-table" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S/N</th>
													<th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Innovation Topic</th>
                                                    <th>GitHub</th>
                                                    <th>Action</th>

												</tr>
											</thead>

                                            <tbody>
											<?php $i = 1; ?>
                                            @foreach($innovation_apply as $request)

											<tr>
												<td>{{$i++;}}</td>
                                                <td>{{$request->name}}</td>
                                                <td>{{$request->email}}</td>
                                                <td>{{$request->topic}}</td>
                                                <td><a class="btn btn-primary btn-sm" target="_blank" href="{{$request->gender}}">view link</a></td>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#inn_{{$request->id}}" ><i style="color:red;" class="fa fa-trash"></i></a>
                                                </td>

                                                @include('admin.modal.deleteInno')

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
