@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add Cohort With Price</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('cohort_m.add')}}" method="post">
                               @csrf

                               <div class="form-group">
                                <label for="email2">Amount (#)</label>
                                <input type="number" class="form-control" id="email2" required name="price" placeholder="Enter Course cohort Price">
                                <small style="color:red; font-weight:500">
                                @error('name')
                                {{$message}}
                                @enderror
                                </small>
                               
                            </div>
                           <div class="form-group">
                                <label for="email2">Course</label>
                                <select required class="form-control" name="course_id">
                                    <option value="">Select Course</option>
                                    @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                    @endforeach
                                </select>
                                <small style="color:red; font-weight:500">
                                @error('course_id')
                                {{$message}}
                                @enderror
                                </small>
                               
                            </div>

                            <div class="form-group">
                                <label for="email2">Course</label>
                                <select required class="form-control" name="cohort_id">
                                    <option value="">Select Cohort</option>
                                    @foreach($cohorts as $cohort)
                                    <option value="{{$cohort->id}}">{{$cohort->name}}</option>
                                    @endforeach
                                </select>
                                <small style="color:red; font-weight:500">
                                @error('cohort_id')
                                {{$message}}
                                @enderror
                                </small>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Add cohort with Price</button>
                
                        </div>
                           </form>
                    </div>
                </div>

                <div class="col-md-8">
                <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Cohorts With Prices</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <td>S/N</td>
													<th>Price</th>
                                                    <th>Course Title</th>
                                                    <th>Cohort</th>
													<th>Action</th>
												</tr>
											</thead>
											
                                            <tbody>
                                            <?php $i = 1; ?>
											@if(isset($cohort_courses))
                                            @foreach($cohort_courses as $cohort)
                                           
											<tr>
                                            <td>{{$i++;}}</td>
                                                <td>{{$cohort->price}}</td>
                                                <td>{{optional($cohort->course_name)->title}}</td>
                                                <td>{{optional($cohort->cohort_name)->name}}</td>
                                                <td>
                                                <a href="{{route('cohort_m.edit', $cohort->id)}}" ><i style="color:blue;" class="fa fa-edit"></i></a>    
                                                <a href="#" data-toggle="modal" data-target="#cohort_{{$cohort->id}}" ><i style="color:red;" class="fa fa-trash"></i></a>
                                            </td>
                                                @include('admin.modal.deletecohortcourse')
											</tr>
											
                                            @endforeach
                                            @endif
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