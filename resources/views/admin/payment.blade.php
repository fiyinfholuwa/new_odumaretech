@extends('admin.app')

@section('content')
<div class="row m-3">

    <!-- Page Header -->
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body bgc-primary d-flex justify-content-between align-items-center">
                <h4 class="mb-0 bgc-primary-text fw-bold">
                    <i class="fas fa-exchange-alt me-2"></i> All Transactions
                </h4>
                <span class="badge bg-dark fs-6">Total: {{ count($payments) }}</span>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Reference</th>
                                <th>Email</th>
                                <th>Amount</th>
                                <th>Course</th>
                                <th>Method</th>
                                <th>Admission</th>
                                <th>Type</th>
                                <th>Bank Info</th>
                                <th>Status</th>
                                <th>Resolution</th>
                                <th>Error Fix</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $i => $pay)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td><span class="fw-bold">{{ $pay->referenceId }}</span></td>
                                <td>{{ $pay->user_email }}</td>
                                <td><span class="badge bg-primary">#{{ $pay->amount }}</span></td>
                                <td>{{ optional($pay->course_name)->title ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $pay->payment == 'bank transfer' ? 'bg-warning text-dark' : 'bg-info' }}">
                                        {{ ucfirst($pay->payment) }}
                                    </span>
                                </td>
                                <td>
                                    @if($pay->admission_status === "accepted")
                                        <span class="badge bg-success">Accepted</span>
                                    @else
                                        <span class="badge bg-danger">Locked</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pay->payment_type === "full")
                                        <span class="badge bg-success">Full</span>
                                    @else
                                        <span class="badge bg-warning text-dark">{{ ucfirst($pay->payment_type) }}</span>
                                    @endif
                                </td>

                                <!-- Bank Transfer Info -->
                                <td>
                                    @if($pay->payment === "bank transfer")
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bank_transfer_{{$pay->id}}">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                        @include('admin.modal.bank_transfer', ['pay' => $pay])
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td>
                                    <span class="badge {{ $pay->status == 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ ucfirst($pay->status) }}
                                    </span>
                                </td>

                                <!-- Payment Resolution -->
                                <td>
                                    @if($pay->status == "paid")
                                        <span class="badge bg-success">Complete</span>
                                    @else
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#pay_complete_{{$pay->id}}">
                                            <i class="fas fa-lock"></i> Resolve
                                        </button>
                                        @include('admin.modal.lockUser', ['pay' => $pay])
                                    @endif
                                </td>

                                <!-- Fix Error -->
                                <td>
                                    @if($pay->payment_type !== 'full' && $pay->admission_status == 'accepted' && $pay->status !== 'paid')
                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#pay_resolve_{{$pay->id}}">
                                            <i class="fas fa-tools"></i> Fix
                                        </button>
                                        <div class="modal fade" id="pay_resolve_{{$pay->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                         <form action="{{route('admin.fix.payment', $pay->id)}}" method="post">
                                             @csrf
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <h5 class="modal-title text-danger" id="exampleModalLabel">Fix Erroneous Payment</h5>

                                                 </div>
                                                 <div class="modal-body">
                                                     <div class="form-group">
                                                         <label>Amount</label>
                                                         <input required name="amount" type="number" value="{{$pay->amount}}" placeholder="Amount" class="form-control"/>
                                                     </div>
                                                    <div class="form-group">
                                                         <label>Payment Type</label>
                                                         <select required class="form-control" name="payment_type">
                                                             <option value="{{$pay->payment_type}}">{{$pay->payment_type}}</option>
                                                             <option value="first installment">first installment</option>
                                                             <option value="second installment">second installment</option>
                                                             <option value="full">full</option>

                                                         </select>
                                                     </div>

                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                     <button type="submit"  class="btn btn-success btn-sm">Fix Payment</button>
                                                 </div>
                                             </div>
                                         </form>
                                     </div>
                                 </div>

                                    @else
                                        <span class="badge bg-success">No Error</span>
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
