@extends('admin.app')

@section('content')
    <div class="row my-3">
        <!-- Coupon Form -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header  bg-primary">
                    <h3 class="card-title text-white mb-0">Add Coupon Code</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('coupon.add') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="code" class="form-label">Coupon Code</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter Coupon Code" required>
                        </div>

                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount (%)</label>
                            <input type="number" class="form-control" id="discount" name="discount" placeholder="Enter Discount" required>
                        </div>

                        <div class="mb-3">
                            <label for="number" class="form-label">Accessed Users</label>
                            <input type="number" class="form-control" id="number" name="number" placeholder="Enter Accessed Users Number" required>
                        </div>

                        <div class="mb-3">
                            <label for="course_id" class="form-label">Select Course</label>
                            <select class="form-select" name="course_id" id="course_id" required>
                                <option value="" selected disabled>Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Add Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Coupon Table -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary">
                    <h3 class="card-title mb-0 text-white">All Coupons</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Code</th>
                                <th scope="col">Discount (%)</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">Accessed Users</th>
                                <th scope="col">Total Used</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp
                            @foreach($coupons ?? [] as $coupon)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->discount }}</td>
                                    <td>{{ $coupon->course_name->title }}</td>
                                    <td>{{ $coupon->number }}</td>
                                    <td>{{ $coupon->user_id }}</td> {{-- Replace with actual usage count --}}
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="#" class="text-primary me-2" data-bs-toggle="modal" data-bs-target="#editCouponModal_{{$coupon->id}}">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#coupon_{{ $coupon->id }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Edit Coupon Modal -->
                                <div class="modal fade" id="editCouponModal_{{$coupon->id}}" tabindex="-1" aria-labelledby="editCouponModalLabel_{{$coupon->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header bg-primary">
                                                    <h3 class="modal-title text-white" id="editCouponModalLabel_{{$coupon->id}}">Edit Coupon</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="form-group mb-3">
                                                        <label for="code_{{$coupon->id}}">Coupon Code</label>
                                                        <input type="text" class="form-control" id="code_{{$coupon->id}}" name="code" required value="{{ $coupon->code }}">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="discount_{{$coupon->id}}">Discount (%)</label>
                                                        <input type="number" class="form-control" id="discount_{{$coupon->id}}" name="discount" required value="{{ $coupon->discount }}">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="number_{{$coupon->id}}">Accessed Users</label>
                                                        <input type="number" class="form-control" id="number_{{$coupon->id}}" name="number" required value="{{ $coupon->number }}">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="course_id_{{$coupon->id}}">Select Course</label>
                                                        <select class="form-control" id="course_id_{{$coupon->id}}" name="course_id" required>
                                                            <option value="">Select Course</option>
                                                            @foreach($courses as $course)
                                                                <option value="{{ $course->id }}" {{ $course->id == $coupon->course_id ? 'selected' : '' }}>{{ $course->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update Coupon</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @include('admin.modal.deleteCoupon')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
