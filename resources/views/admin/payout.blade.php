@extends('admin.app')

@section('content')
<style>
    .bank-card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 1rem;
        background: #fafafa;
        margin-top: 1rem;
        transition: all 0.3s ease;
    }

    .bank-card:hover {
        background: #f3f3f3;
        transform: translateY(-2px);
    }

    .bank-card h6 {
        font-weight: 600;
        color: #555;
    }

    .bank-card p {
        margin-bottom: 0.3rem;
    }

    .modal-footer button {
        min-width: 100px;
    }

    .no-data {
        text-align: center;
        padding: 1rem;
        color: #777;
    }
</style>

<div class="card shadow-sm">
    <div class="card-header bgc-primary text-white">
        <h4 class="mb-0">Payout History</h4>
    </div>
    <div class="card-body">
        <table id="basic-datatables" class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Wallet Balance</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Requested On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payouts as $tx)
                    <tr>
                        <td>{{ optional($tx->user)->first_name }}</td>
                        <td>{{ optional($tx->user)->last_name }}</td>
                        <td>${{ optional($tx->user)->referral_bonus }}</td>
                        <td>${{ number_format($tx->amount, 2) }}</td>
                        <td>
                            <span class="badge 
                                @if($tx->status == 'approved') bg-success 
                                @elseif($tx->status == 'rejected') bg-danger 
                                @else bg-warning text-dark @endif">
                                {{ ucfirst($tx->status) }}
                            </span>
                        </td>
                        <td>{{ $tx->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            @if($tx->status == 'pending')
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#processModal_{{ $tx->id }}">
                                    Process Payment
                                </button>
                            @else
                                <span class="text-muted">Processed</span>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="processModal_{{ $tx->id }}" tabindex="-1" aria-labelledby="processModalLabel_{{ $tx->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header bgc-primary text-white">
                                    <h5 class="modal-title bgc-primary-text" id="processModalLabel_{{ $tx->id }}">Process Payment</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>User Information</h6>
                                            <p><strong>Name:</strong> {{ optional($tx->user)->first_name }} {{ optional($tx->user)->last_name }}</p>
                                            <p><strong>Email:</strong> {{ optional($tx->user)->email ?? 'N/A' }}</p>
                                            <p><strong>Requested Amount:</strong> ${{ number_format($tx->amount, 2) }}</p>
                                        </div>

                                        <div class="col-md-6">
                                            <h6>Requested On</h6>
                                            <p>{{ $tx->created_at->format('d M Y, h:i A') }}</p>
                                        </div>
                                    </div>

                                    @php
                                        $bank = $tx->bank_info;
                                    @endphp

                                    @if($bank)
                                    <div class="bank-card mt-3">
                                        <h6>Bank Information</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Country:</strong> {{ $bank['country'] ?? '-' }}</p>
                                                <p><strong>Bank Name:</strong> {{ $bank['bank_name'] ?? '-' }}</p>
                                                <p><strong>Swift Code:</strong> {{ $bank['swift_code'] ?? '-' }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Bank Address:</strong> {{ $bank['bank_address'] ?? '-' }}</p>
                                                <p><strong>Account Number:</strong> {{ $bank['account_number'] ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="modal-footer">
                                    <form action="{{ route('admin.payout.update') }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        <input type="hidden" name="payout_id" value="{{ $tx->id }}">
                                        <button type="submit" name="action" value="approve" class="btn btn-success">
                                            Approve
                                        </button>
                                        <button type="submit" name="action" value="decline" class="btn btn-danger">
                                            Decline
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="6" class="no-data">No payout history available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
