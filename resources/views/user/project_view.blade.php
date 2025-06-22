@extends('user.app')

@section('content')
                <div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">All Projects</h4>
						
					</div>
				
					
					<div class="row">
					@if(count($fetch_user_details) > 0)

					@foreach($fetch_user_details as $detail)
						<div class="col-sm-6 col-md-4">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-dark bubble-shadow-small">
												<i class="fa fa-tasks"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">{{$detail->course_name->title}}</p>
												<!-- <h4 class="card-title">0</h4> -->
                                                @if(count($projects) > 0)
                                                @foreach($projects as $project)
                                                @if($project->course_id == $detail->course_id  && $project->cohort_id == $detail->cohort_id)
                                                <a href="{{route('project.submit', ['id' => $detail->course_id, 'co' => $detail->cohort_id])}}" class="btn btn-danger btn-sm" >Submit Project</a>
                                                @else
                                                <span class="btn btn-primary btn-sm">No Project Yet</span>
                                                @endif
                                                @endforeach
                                                @else
                                                <span class="btn btn-primary btn-sm">No Project Yet</span>
                                                @endif
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<div class="text-center text-danger card" style="padding:20px; font-weight:800;">No Project Yet</div>
						@endif
						
						
					</div>
					
				</div>
@endsection