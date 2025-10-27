@extends('admin.app')

@section('content')

<div class="row my-3 mx-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bgc-primary">
                <h4 class="bgc-primary-text mb-0">
                    {{ isset($tc) ? 'Update Instructor T & C' : 'Add Instructor T & C' }}
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('instructor_t_c.add') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="postDescription" class="form-label">T & C</label>
                        <textarea
                            class="form-control @error('desc') is-invalid @enderror"
                            id="myTextarea2"
                            name="desc"
                            placeholder="Enter T & C"
                            rows="3"
                        >{{ old('desc', $tc->desc ?? '') }}</textarea>
                        @error('desc')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        {{ isset($tc) ? 'Update T & C' : 'Add T & C' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
