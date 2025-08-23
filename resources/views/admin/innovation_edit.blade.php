@extends('admin.app')

@section('content')

    <div class="row" style="margin:10px">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bgc-primary">
                    <div class="card-title">
                        <h4 class="bgc-primary-text">Edit Innovation
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('innovation.update', $innovation->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- If you use PUT or PATCH method, add this: --}}
                        {{-- @method('PUT') --}}

                        <div class="form-group">
                            <label for="email2">Innovation Title</label>
                            <input type="text" class="form-control" id="email2" required name="name" placeholder="Enter Innovation Title" value="{{ old('name', $innovation->name) }}">
                            <small style="color:red; font-weight:500">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="email2">Innovation Github Link</label>
                            <textarea class="form-control" id="email2" required name="github" placeholder="Enter Innovation Github Link">{{ old('github', $innovation->github) }}</textarea>
                            <small style="color:red; font-weight:500">
                                @error('github')
                                {{ $message }}
                                @enderror
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="email2">Description (optional)</label>
                            <textarea class="form-control" id="myTextarea" name="description" placeholder="Enter Innovation Description">{{ old('description', $innovation->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="email2">Requirement (optional)</label>
                            <textarea class="form-control" id="myTextarea2" name="requirement" placeholder="Enter Innovation Requirement">{{ old('requirement', $innovation->requirement) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email2">Start Date (optional)</label>
                                    <input type="date" class="form-control" id="email2" name="start_date" value="{{ old('start_date', $innovation->start_date) }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email2">End Date (optional)</label>
                                    <input type="date" class="form-control" id="email2" name="end_date" value="{{ old('end_date', $innovation->end_date) }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email2">Durations in week (optional)</label>
                                    <input type="number" class="form-control" id="email2" name="duration" value="{{ old('duration', $innovation->duration) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email2">Innovation Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Innovation Status</option>
                                        <option value="Completed" {{ (old('status', $innovation->status) == 'Completed') ? 'selected' : '' }}>Completed</option>
                                        <option value="Running" {{ (old('status', $innovation->status) == 'Running') ? 'selected' : '' }}>Running</option>
                                        <option value="Upcoming" {{ (old('status', $innovation->status) == 'Upcoming') ? 'selected' : '' }}>Upcoming</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email2">Innovation Website Link</label>
                                    <input type="text" class="form-control" id="email2" required name="link" placeholder="Enter Innovation Link" value="{{ old('link', $innovation->link) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email2">Innovation Image</label>
                            <input type="file" class="form-control" id="email2" accept="image/*" name="image" >
                            @if ($innovation->image)
                                <div style="margin-top: 10px;">
                                    <img height="60" width="60" src="{{ asset($innovation->image) }}" alt="Innovation Image" />
                                </div>
                            @endif
                        </div>

                </div>

                <div style="padding: 30px;" class="card-action">
                    <button class="btn btn-success">Update Innovation</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
