@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add Coupon Code</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('coupon.add')}}" method="post">
                               @csrf
                           <div class="form-group">
                                <label for="email2">Coupon Code</label>
                                <input type="text" class="form-control" id="email2" required name="code" placeholder="Enter Coupon Code">
                                
                            </div>
                            <div class="form-group">
                                <label for="email2">Discount (%)</label>
                                <input type="number" class="form-control" id="email2" required name="discount" placeholder="Enter Discount"> 
                            </div>
                            <div class="form-group">
                                <label for="email2">Accessed Users</label>
                                <input type="number" class="form-control" id="email2" required name="number" placeholder="Enter Accessed Users Number"> 
                            </div>
                            <div class="form-group">
                                <label for="email2">Select Course</label>
                                <select class="form-control" name="course_id">
                                    <option value="" selected >Select Course</option>
                                    @foreach($courses as $course)
                                        <option value = "{{$course->id}}">{{$course->title}}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Add Coupon</button>
                
                        </div>
                           </form>
                    </div>
                    
                </div>

                <div class="col-md-8">
                <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Coupons</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <td>S/N</td>
													<th>Code</th>
                                                    <th>Discount (%)</th>
													
                                                    <th>Course Name</th>
                                                    <th>Accessed users</th>
                                                    <th>Total Used</th>
                                                    <th>Actions</th>
												</tr>
											</thead>
											
                                            <tbody>
                                            <?php $i = 1; ?>
											@if(isset($coupons))
                                            @foreach($coupons as $coupon)
                                           
											<tr>
                                            <td>{{$i++;}}</td>
                                                <td>{{$coupon->code}}</td>
                                                <td>{{$coupon->discount}}</td>
                                                
                                                <td>{{$coupon->course_name->title}}</td>
                                                <td>{{$coupon->number}}</td>
                                                <td>{{$coupon->user_id}}</td>
                                                <td>
                                                <a href="{{route('coupon.edit', $coupon->id)}}" ><i style="color:blue;" class="fa fa-edit"></i></a>    
                                                <a href="#" data-toggle="modal" data-target="#coupon_{{$coupon->id}}" ><i style="color:red;" class="fa fa-trash"></i></a>
                                                </td>
                                                @include('admin.modal.deleteCoupon')
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