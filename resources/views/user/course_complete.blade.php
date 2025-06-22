@extends('user.app')

@section('content')
                <div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">All Completed Courses</h4>
					</div>
				
					
					<div class="row">
					@if(count($courses) > 0)

					@foreach($courses as $detail)
						<div class="col-sm-6 col-md-4">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-success bubble-shadow-small">
												<i class="fa fa-book"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">{{$detail->course_name->title}}</p>
												<!-- <h4 class="card-title">0</h4> -->
												<a href="{{route('download.certificate', $detail->course_name->id)}}" class="btn btn-danger btn-sm" >Download Certificate</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<div class="text-center text-danger card" style="padding:20px; font-weight:800;">No Completed Course Yet</div>
						@endif
						
						
					</div>
					
				</div>
@endsection