@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Manage Platform</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('dollar.save')}}" method="post">
                               @csrf
                           @if($dollar_rate !=null)
                           <div class="form-group">
                                <label for="email2">Dollar Rate</label>
                                <input type="text" class="form-control" id="email2" value="{{$dollar_rate->price}}" required name="dollar_rate" placeholder="Enter Dollar Rate">
                                <small style="color:red; font-weight:500">
                                @error('link')
                                {{$message}}
                                @enderror
                                </small>
                                <input type="hidden" name="id" value="{{$dollar_rate->id}}"/>
                            </div>

                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Update Dollar Rate</button>

                        </div>
                           @else
                           <div class="form-group">
                                <label for="email2">Dollar Rate</label>
                                <input type="text" class="form-control" id="email2"  required name="dollar_rate" placeholder="Enter Dollar Rate">

                                <small style="color:red; font-weight:500">
                                @error('link')
                                {{$message}}
                                @enderror
                                </small>

                            </div>

                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Add Dollar Rate</button>

                        </div>
                           @endif
                           </form>
                    </div>

                </div>

                <div style="margin-top: 150px;" class="col-md-7 col-lg-7">
                    <div class="row">
                        <div class="col-lg-4">
                            <h3>Delete All Contact US Messages</h3>
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#messages" ><i style="color:red;" class="fa fa-trash"></i> Delete Messages</a>
                        </div>

                        <div class="col-lg-4">
                            <h3>Delete All Free Master Class Details</h3>
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#master_class" ><i style="color:red;" class="fa fa-trash"></i> Delete MasterClass</a>
                        </div>


                        <div class="col-lg-4">
                            <h3>Delete All Corporate Training</h3>
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#corporate" ><i style="color:red;" class="fa fa-trash"></i> Delete Corporate Messages</a>
                        </div>

                    </div>
                </div>
            </div>

    @include('admin.modal.platform')

@endsection
