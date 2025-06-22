@extends('instructor.app')

@section('content')

            <div class="row" style="margin:10px">
            
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">All Chats</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S/N</th>
                                                    <th>Message</th>
                                                    <th>Response</th>
													<th>View Message</th>
													<!-- <th>Action</th> -->
												</tr>
											</thead>
											
                                            <tbody>
											<?php $i = 1; ?>
                                            @foreach($chats as $chat)
                                           
											<tr>
												<td>{{$i++;}}</td>
                                                <td>{{$chat->user_message}}</td>
                                                <td>
                                                    @if($chat->instructor_message == NULL)
                                                    <span class="btn btn-warning btn-sm">pending...</span>
                                                    @else
                                                    {!!Str::limit(html_entity_decode($chat->instructor_message),10,"...")!!}
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                    @if($chat->instructor_status == "replied")
                                                    <span class="btn btn-success btn-sm">Replied</span>
                                                    @else
                                                    <span><a href="{{route('instructor.student.chat.reply', $chat->id)}}" class="btn btn-success btn-sm">Reply Chat</a></span>
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