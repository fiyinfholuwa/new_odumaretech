@extends('user.app')

@section('content')
<div class="container-fluid my-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">All Transactions</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="table table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>S/N</th>
                            <th>Reference ID</th>
                            <th>Email</th>
                            <th>Amount</th>
                            <th>Course Title</th>
                            <th>Payment Method</th>
                            <th>Admission Status</th>
                            <th>Payment Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($payments as $i => $pay)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $pay->referenceId }}</td>
                            <td>{{ $pay->user_email }}</td>
                            <td>&#8358;{{ number_format($pay->amount, 2) }}</td>
                            <td>{{ optional($pay->course_name)->title ?? 'N/A' }}</td>
                            <td>{{ $pay->payment }}</td>
                            
                            <td>
                                @if($pay->admission_status === 'accepted')
                                    <span class="badge badge-success">Accepted</span>
                                @else
                                    <span class="badge badge-danger">Locked</span>
                                @endif
                            </td>

                            <td>
                                @if($pay->payment_type === 'full')
                                    <span class="badge badge-success">Full</span>
                                @else
                                    <span class="badge badge-warning text-dark">{{ ucfirst($pay->payment_type) }}</span>
                                @endif
                            </td>

                            <td>
                                @if($pay->status === 'paid')
                                    <span class="badge badge-success text-white">Paid</span>
                                @else
                                    <span class="badge badge-warning text-dark">{{ ucfirst($pay->status) }}</span>
                                @endif
                            </td>

                            <td>
                                @if($pay->payment_type === 'full')
                                    <span class="badge badge-success">Verified</span>
                                @else
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#pay_{{ $pay->id }}">
                                        <i class="fas fa-lock"></i> Complete Payment
                                    </button>
                                @endif
                            </td>
                        </tr>

                        @include('user.modal.completePayment')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
