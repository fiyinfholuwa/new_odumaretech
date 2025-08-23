@extends('admin.app')

@section('content')
<div class="row my-3">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bgc-primary d-flex justify-content-between align-items-center">
                <h3 class="mb-0 bgc-primary-text">Manage Coupons</h3>
                <!-- Add Coupon Button -->
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addCouponModal">
                    <i class="fa fa-plus me-1"></i> Add Coupon
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>S/N</th>
                                <th>Code</th>
                                <th>Discount (%)</th>
                                <th>Course</th>
                                <th>Accessed Users</th>
                                <th>Total Used</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($coupons ?? [] as $index => $coupon)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->discount }}</td>
                                <td>{{ $coupon->course_name->title ?? '—' }}</td>
                                <td>{{ $coupon->number }}</td>
                                <td>{{ $coupon->user_id ?? 0 }}</td> {{-- Replace with actual usage count --}}
                                <td>
                                    <!-- Edit -->
                                    <a href="#" class="text-warning me-2" data-bs-toggle="modal" data-bs-target="#editCoupon_{{$coupon->id}}">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <!-- Delete -->
                                    <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteCoupon_{{$coupon->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Coupon Modal -->
                            <div class="modal fade" id="editCoupon_{{$coupon->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content shadow">
                                            <div class="modal-header bgc-primary text-white">
                                                <h3 class="modal-title bgc-primary-text">Edit Coupon</h3>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Coupon Code</label>
                                                    <input type="text" class="form-control" name="code" value="{{ $coupon->code }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Discount (%)</label>
                                                    <input type="number" class="form-control" name="discount" value="{{ $coupon->discount }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Accessed Users</label>
                                                    <input type="number" class="form-control" name="number" value="{{ $coupon->number }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Select Course</label>
                                                    <select class="form-select" name="course_id" required>
                                                        <option value="">Select Course</option>
                                                        @foreach($courses as $course)
                                                            <option value="{{ $course->id }}" {{ $course->id == $coupon->course_id ? 'selected' : '' }}>
                                                                {{ $course->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Delete Coupon Modal -->
                            <div class="modal fade" id="deleteCoupon_{{$coupon->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('coupon.delete', $coupon->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content shadow">
                                            <div class="modal-header bg-danger text-white">
                                                <h3 class="modal-title text-white">Delete Coupon</h3>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                Are you sure you want to delete coupon <b>{{ $coupon->code }}</b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Coupon Modal -->
<div class="modal fade" id="addCouponModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('coupon.add') }}" method="POST">
            @csrf
            <div class="modal-content shadow">
                <div class="modal-header bgc-primary text-white">
                    <h3 class="modal-title bgc-primary-text">Add Coupon</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Coupon Code</label>
                        <input type="text" class="form-control" name="code" placeholder="Enter Coupon Code" required>
                    </div>
                    <div class="mb-3">
                        <label>Discount (%)</label>
                        <input type="number" class="form-control" name="discount" placeholder="Enter Discount" required>
                    </div>
                    <div class="mb-3">
                        <label>Accessed Users</label>
                        <input type="number" class="form-control" name="number" placeholder="Enter Accessed Users" required>
                    </div>
                    <div class="mb-3">
                        <label>Select Course</label>
                        <select class="form-select" name="course_id" required>
                            <option value="" selected disabled>Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Add Coupon</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
