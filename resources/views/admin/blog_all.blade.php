@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">

						<div class="col-md-12">
							<div class="card">
								<div class="card-header bgc-secondary">
									<h4 class="card-title bgc-secondary-text">All Posts</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="my-table" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S/N</th>
													<th>Name</th>
                                                    <th>Desc</th>
                                                    <th>Post Link</th>
                                                    <th>Image</th>
													<th>Action</th>
												</tr>
											</thead>

                                            <tbody>
											<?php $i = 1; ?>
                                            @foreach($posts as $post)

											<tr>
												<td>{{$i++;}}</td>
                                                <td>{{$post->name}}</td>
                                                <td>{{$post->desc}}</td>

                                                <td><a target="_blank" class="badge bg-secondary" href="{{$post->link}}">View Post link</a></td>

                                                <td><img height="40" width="40" src="{{asset($post->image)}}" /></td>


												<td>
                                                <a href="{{route('blog.edit', $post->id)}}" ><i style="color:blue;" class="fa fa-edit"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#post_{{$post->id}}" ><i style="color:red;" class="fa fa-trash"></i></a>
                                                </td>
                                                @include('admin.modal.deletePost')
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
