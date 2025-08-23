@extends('admin.app')

@section('content')

    <div class="row" style="margin:10px">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header  bgc-primary">
                    <div class="card-title">
                        <h4 class="bgc-primary-text">Add Innovation
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('innovation.add')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="email2">Innovation Title</label>
                            <input type="text" class="form-control" id="email2" required name="name" placeholder="Enter Innovation Title">
                            <small style="color:red; font-weight:500">
                                @error('name')
                                {{$message}}
                                @enderror
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="email2">Innovation Github Link</label>
                            <textarea type="text" class="form-control" id="email2" required name="github" placeholder="Enter Innovation Github Link"></textarea>
                            <small style="color:red; font-weight:500">
                                @error('content')
                                {{$message}}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="email2">Description (optional)</label>
                            <textarea type="text" class="form-control" id="myTextarea" name="description" placeholder="Enter Innovation Description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="email2">Requirement (optional)</label>
                            <textarea type="text" class="form-control" id="myTextarea2" name="requirement" placeholder="Enter Innovation Requirement"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email2">Start Date (optional)</label>
                                    <input type="date" class="form-control" id="email2" name="start_date">
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email2">End Date (optional)</label>
                                    <input type="date" class="form-control" id="email2" name="end_date">
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email2">Durations in week (optional)</label>
                                    <input type="number" class="form-control" id="email2" name="duration">
                                </div>

                            </div>
                        </div>



                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email2">Innovation Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Innovation Status</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Running">Running</option>
                                        <option value="Upcoming">Upcoming</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email2">Innovation Website Link</label>
                                    <input type="text" class="form-control" id="email2" required name="link" placeholder="Enter Innovation Link">
                                </div>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email2">Innovation Image</label>
                            <input type="file" class="form-control" id="email2" accept="image/*" required name="image" >
                        </div>
                </div>
                <div style="padding: 30px;" class="card-action">
                    <button class="btn btn-success">Add Innovation</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal CSS --}}
@endsection
