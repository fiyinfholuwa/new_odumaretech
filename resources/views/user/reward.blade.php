@extends('user.app')

@section('content')

<?php
// data.php
$referralStats = [
    'total_referrals' => 20,
    'total_earnings' => 50,
    'min_payout' => 50,
    'available_earnings' => 75,
    'processing_fee' => 0,
];

$referrals = [
    [
        'id' => 'odumaretech338920',
        'name' => 'Alex Johnson',
        'course' => 'Advanced JavaScript',
        'earnings' => 25,
        'status' => 'Completed'
    ]
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
            <h2 class="text-dark mb-2 fw-bold">💰 Referral Rewards</h2>

           
            <!-- Stats Cards -->
            <div class="row mb-4 fade-in-up" style="animation-delay: 0.2s">
                <div class="col-md-6 mb-3">
                    <div class="stats-card bgc-primary p-4 text-white">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-users text-dark"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 opacity-90">Total Referrals</h6>
                                <div class="stats-number bgc-primary-text"><?= $referralStats['total_referrals'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="stats-card bgc-secondary p-4 text-white">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-dollar-sign text-dark"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 opacity-90">Total Earnings</h6>
                                <div class="stats-number  bgc-secondary-text">$<?= $referralStats['total_earnings'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="card border-0 shadow-sm fade-in-up" style="animation-delay: 0.4s; border-radius: 16px;">
                <div class="card-body p-4">

                    <!-- Referral Link Section -->
                    <div class="referral-link-container mb-4">
                        <h5 class="mb-3 fw-bold text-gray-800">
                            <i class="fas fa-link me-2 text-primary"></i>
                            Your Referral Link
                        </h5>
                        <div class="input-group">
                            <input type="text" id="refLink" class="form-control border-0 bg-white" 
                                   value="https://odumaretech.com/ref/odumaretech338916" readonly
                                   style="border-radius: 8px 0 0 8px; font-family: monospace;">
                            <button onclick="copyLink()" class="copy-btn text-white px-4">
                                <i class="fas fa-copy me-2"></i>Copy Link
                            </button>
                        </div>
                    </div>

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
                    <div class="info-card p-4 mb-4">
                        <h6 class="fw-bold text-gray-800 mb-3">
                            <i class="fas fa-info-circle me-2 text-warning"></i>
                            How It Works
                        </h6>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary me-2">1</span>
                                    <small class="text-gray-700">Share your unique referral link with friends</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary me-2">2</span>
                                    <small class="text-gray-700">When they purchase a course, you earn 5% commission</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary me-2">3</span>
                                    <small class="text-gray-700">Request payout once you reach $50 in earnings</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Referrals Table -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-gray-800 mb-0">
                            <i class="fas fa-table me-2 text-primary"></i>
                            Your Referrals
                        </h5>
                        <small class="text-muted"><?= count($referrals) ?> total referrals</small>
                    </div>
                    
                    <div class="table-responsive">
                        <table  id="my-table" class="referrals-table table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Earnings</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($referrals as $ref): ?>
                                    <tr>
                                        <td>
                                            <span class="text-muted small"><?= $ref['id'] ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                     style="width: 32px; height: 32px; font-size: 0.8rem; color: white;">
                                                    <?= strtoupper(substr($ref['name'], 0, 1)) ?>
                                                </div>
                                                <span class="fw-medium"><?= $ref['name'] ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-gray-700"><?= $ref['course'] ?></span>
                                        </td>
                                        <td>
                                            <span class="earnings-highlight">$<?= $ref['earnings'] ?></span>
                                        </td>
                                        <td>
                                            <span class="status-badge bg-success text-white">
                                                <i class="fas fa-check-circle me-1"></i>
                                                <?= $ref['status'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Modal -->
<div class="modal fade" id="payoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header bgc-primary">
                <h5   class="modal-title bgc-primary-text">
                    <i class="fas fa-money-bill-wave me-2"></i>
                    Request Payout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="text-center p-3 bg-light rounded">
                            <h6 class="text-muted mb-1">Available</h6>
                            <h4 class="text-success mb-0">$<?= $referralStats['available_earnings'] ?></h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3 bg-light rounded">
                            <h6 class="text-muted mb-1">Processing Fee</h6>
                            <h4 class="text-warning mb-0">$<?= $referralStats['processing_fee'] ?></h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3 bg-primary text-white rounded">
                            <h6 class="opacity-90 mb-1">Total Payout</h6>
                            <h4 class="mb-0">$<?= $referralStats['available_earnings'] - $referralStats['processing_fee'] ?></h4>
                        </div>
                    </div>
                </div>
                
                <h6 class="mb-3 fw-bold">
                    <i class="fas fa-credit-card me-2 text-primary"></i>
                    Payout Method
                </h6>
                <div class="p-3 border rounded">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" checked name="payoutMethod" id="bankTransfer">
                        <label class="form-check-label fw-medium" for="bankTransfer">
                            <i class="fas fa-university me-2 text-primary"></i>
                            Bank Transfer
                            <small class="text-muted d-block">3–5 business days</small>
                        </label>
                    </div>
                </div>
                <a href="#" class="d-block mt-3 text-primary text-decoration-none">
                    <i class="fas fa-plus-circle me-1"></i>
                    Add other payout method
                </a>
            </div>
            <div class="modal-footer border-0 p-4">
                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-paper-plane me-2"></i>
                    Continue
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function copyLink() {
    var copyText = document.getElementById("refLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
    
    navigator.clipboard.writeText(copyText.value).then(function() {
        // Success feedback
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
        btn.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.background = 'linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%)';
        }, 2000);
    }).catch(function() {
        // Fallback for older browsers
        document.execCommand("copy");
        alert("Link copied: " + copyText.value);
    });
}

// Add smooth animations on page load
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.fade-in-up');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            el.style.transition = 'all 0.6s ease';
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, index * 200);
    });
});
</script>

@endsection