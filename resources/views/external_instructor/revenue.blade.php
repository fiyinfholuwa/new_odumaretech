@extends('external_instructor.app')

@section('content')

<?php

// data.php
$referralStats = [
    'total_referrals' => $reward_count,
    'total_earnings' => $balance,
    'min_payout' => 50,
    'available_earnings' => $balance,
    'processing_fee' => 20,
];


?>

<style>
.referral-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 200px;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}

.referral-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50%" cy="0%" r="100%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><rect width="100" height="20" fill="url(%23a)"/></svg>');
    opacity: 0.3;
}

.stats-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.2);
}

.stats-number {
    font-size: 2.5rem;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.referral-link-container {
    background: #f8fafc;
    border: 2px dashed #e2e8f0;
    border-radius: 12px;
    padding: 1.5rem;
    transition: all 0.3s ease;
}

.referral-link-container:hover {
    border-color: #667eea;
    background: #f1f5f9;
}

.copy-btn {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    border: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.copy-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px -3px rgba(0, 0, 0, 0.2);
}

.payout-alert {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    border-radius: 12px;
    color: white;
    box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
}

.payout-btn {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.payout-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
}

.info-card {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border: none;
    border-radius: 12px;
    border-left: 4px solid #f59e0b;
}

.referrals-table {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.referrals-table thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.referrals-table thead th {
    border: none;
    color: black;
    font-weight: 600;
    padding: 1rem;
}

.referrals-table tbody tr {
    transition: all 0.3s ease;
}

.referrals-table tbody tr:hover {
    background-color: #f8fafc;
    transform: scale(1.01);
}

.referrals-table tbody td {
    padding: 1rem;
    border: none;
    border-bottom: 1px solid #e2e8f0;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.modal-content {
    border-radius: 16px;
    border: none;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

.modal-header {
    {{-- background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); --}}
    color: white;
    border-radius: 16px 16px 0 0;
    border: none;
}

.modal-title {
    font-weight: 600;
}

.btn-close {
    filter: brightness(0) invert(1);
}

.earnings-highlight {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    display: inline-block;
}

.icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.6s ease forwards;
}

.pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}
</style>

<div class="container-fluid px-4 ">
    <div class="row ">
        <div class="col-12 col-xl-12">
            <h2 class="text-dark mb-2 fw-bold">My Revenue</h2>


            <!-- Stats Cards -->
            <div class="row mb-4 fade-in-up" style="animation-delay: 0.2s">
                <div class="col-md-6 mb-3">
                    <div class="stats-card bgc-primary p-4 text-white">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-book text-dark"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 opacity-90">Total Course(s) Sold</h6>
                                <div class="stats-number bgc-primary-text"><?= Auth::user()->student_count ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="stats-card bgc-secondary p-4 text-white">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3" style="width: 50px; height: 50px;">
{{--                                <i class="fas fa-dollar-sign text-dark"></i>--}}
                            </div>
                            <div>
                                <h6 class="mb-1 opacity-90">Total Earnings</h6>
<div class="stats-number bgc-secondary-text">
    $<?= number_format($referralStats['total_earnings'], 2) ?>
</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="card border-0 shadow-sm fade-in-up" style="animation-delay: 0.4s; border-radius: 16px;">
                <div class="card-body p-4">

                    
                    <!-- Script -->
                    <script>
                        function copyLink() {
                            const refInput = document.getElementById('refLink');
                            refInput.select();
                            refInput.setSelectionRange(0, 99999); // mobile support
                            navigator.clipboard.writeText(refInput.value).then(() => {
                                const toastEl = document.getElementById('copyToast');
                                const toast = new bootstrap.Toast(toastEl);
                                toast.show();
                            });
                        }
                    </script>

                    <!-- Payout Alert -->
                    <?php if ($referralStats['total_earnings'] >= $referralStats['min_payout']): ?>
                        <div class="payout-alert p-4 mb-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-1 fw-bold">🎉 Ready for Payout!</h6>
                                <p class="text-white mb-0 opacity-90">You've reached the minimum payout threshold</p>
                            </div>
                            <button class="payout-btn px-4 py-2 pulse" data-bs-toggle="modal" data-bs-target="#payoutModal">
                                <i class="fas fa-money-bill-wave me-2"></i>Request Payout
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- How It Works -->
                    
                    <!-- Referrals Table -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-gray-800 mb-0">
                            <i class="fas fa-table me-2 text-primary"></i>
                            Earning History
                        </h5>
                        {{-- <small class="text-muted"><?= count($rewards) ?> total referrals</small> --}}
                    </div>

                    <div class="table-responsive">
                        <table id="my-table" class="referrals-table table table-hover mb-0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Course</th>
            <th>Earnings</th>
            <th>Message</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rewards as $entry)
            <tr>
                {{-- Referred User Name --}}
                <td>
                    <div class="d-flex align-items-center">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                             style="width: 32px; height: 32px; font-size: 0.8rem; color: white;">
                            {{ strtoupper(substr($entry->referredUser->name ?? 'N', 0, 1)) }}
                        </div>
                        <span class="fw-medium">{{ $entry->referredUser->name ?? 'N/A' }}</span>
                    </div>
                </td>

                {{-- Course --}}
                <td>{{ $entry->course->title ?? 'N/A' }}</td>

                {{-- Earnings --}}
                <td>
                    <span class="earnings-highlight text-white fw-bold">
                        ${{ number_format($entry->bonus_amount, 2) }}
                    </span>
                </td>

                {{-- Message --}}
                <td>{{ $entry->message }}</td>

                {{-- Date --}}
                <td>{{ $entry->created_at->format('M d, Y') }}</td>

                {{-- Status --}}
                <td>
                    <span class="status-badge {{ $entry->bonus_amount > 0 ? 'bg-success' : 'bg-danger' }} text-white">
                        <i class="fas {{ $entry->bonus_amount > 0 ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                        {{ $entry->bonus_amount > 0 ? 'Credited' : 'Pending' }}
                    </span>
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
</div>

<div class="modal fade" id="payoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('user.payout.request') }}" method="POST">
            @csrf
            <div class="modal-header bgc-primary">
                <h5 class="modal-title bgc-primary-text">
                    <i class="fas fa-money-bill-wave me-2"></i> Request Payout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                {{-- ✅ Earnings Summary --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="text-center p-3 bg-light rounded">
                            <h6 class="text-muted mb-1">Available</h6>
                            <h4 class="text-success mb-0">${{ $referralStats['available_earnings'] }}</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3 bg-light rounded">
                            <h6 class="text-muted mb-1">Processing Fee</h6>
                            <h4 class="text-warning mb-0">$0.00</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3 bg-primary text-white rounded">
                            <h6 class="opacity-90 mb-1">Total Payout</h6>
                            <h4 class="mb-0 text-white">${{ $referralStats['available_earnings'] - $referralStats['processing_fee'] }}</h4>
                        </div>
                    </div>
                </div>

@php
        $bankInfo = json_decode(Auth::user()->bank_info, true) ?? [];

@endphp
                {{-- ✅ Bank Info Section --}}
                @if(!empty($bankInfo))
                    <div class="p-3 border rounded mb-3 bg-light">
                        <h6 class="fw-bold mb-2">
                            <i class="fas fa-university text-primary me-2"></i>Your Bank Details
                        </h6>
                        <p class="mb-1"><strong>Bank:</strong> {{ $bankInfo['bank_name'] ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Account:</strong> {{ $bankInfo['account_number'] ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>SWIFT:</strong> {{ $bankInfo['swift_code'] ?? 'N/A' }}</p>
                        <p class="mb-3"><strong>Country:</strong> {{ $bankInfo['country'] ?? 'N/A' }}</p>

                        <a href="{{ route('user.password.view') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-edit me-1"></i> Update Bank Info
                        </a>
                    </div>

                    {{-- ✅ Amount Field --}}
                    <div class="form-group mb-3">
    <label for="amount">Enter Amount to Withdraw</label>
    <input type="number" step="0.01" min="1" max="{{ $referralStats['available_earnings'] }}" 
           class="form-control" name="amount" id="amount" placeholder="Enter amount (USD)" required>
    <small id="amountError" class="text-danger d-none"></small>
</div>

                @else
                    {{-- ❌ No Bank Info Saved --}}
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-circle"></i> You must set your bank details before requesting payout.
                    </div>
                    <a href="{{ route('user.password.view') }}" class="btn btn-primary w-100">
                        <i class="fas fa-university me-1"></i> Set Bank Information
                    </a>
                @endif

            </div>

            {{-- ✅ Footer (Disable if no bank info) --}}
            <div class="modal-footer border-0 p-4">
                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                @if(!empty($bankInfo))
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-paper-plane me-2"></i> Request Payout
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const amountInput = document.getElementById("amount");
    const amountError = document.getElementById("amountError");
    const submitBtn = document.querySelector("#payoutModal button[type='submit']");
    const maxAmount = parseFloat("{{ $referralStats['available_earnings'] - $referralStats['processing_fee'] }}");

    if (amountInput) {
        amountInput.addEventListener("input", function () {
            let entered = parseFloat(this.value);

            if (isNaN(entered) || entered < 1) {
                amountError.textContent = "Amount must be at least $1.";
                amountError.classList.remove("d-none");
                submitBtn.disabled = true;
            } 
            else if (entered > maxAmount) {
                amountError.textContent = "You cannot request more than $" + maxAmount.toFixed(2) + ".";
                amountError.classList.remove("d-none");
                submitBtn.disabled = true;
            } 
            else {
                amountError.classList.add("d-none");
                submitBtn.disabled = false;
            }
        });
    }
});
</script>

@endsection
