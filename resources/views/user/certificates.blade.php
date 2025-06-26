@extends('user.app')

@section('content')
<?php
$certificates = [
    [
        'title' => 'Introduction to React',
        'status' => 'Issued',
        'date_issued' => '11/20/2023',
        'progress' => 100,
        'action' => 'Download',
        'category' => 'Frontend Development'
    ],
    [
        'title' => 'Getting Started with HTML',
        'status' => 'In Progress',
        'date_issued' => null,
        'progress' => 54,
        'action' => 'Continue',
        'category' => 'Web Development'
    ],
    [
        'title' => 'JavaScript Fundamentals',
        'status' => 'Issued',
        'date_issued' => '10/15/2023',
        'progress' => 100,
        'action' => 'Download',
        'category' => 'Programming'
    ],
    [
        'title' => 'CSS Advanced Techniques',
        'status' => 'In Progress',
        'date_issued' => null,
        'progress' => 78,
        'action' => 'Continue',
        'category' => 'Frontend Development'
    ]
];
?>

<style>
.certificates-header {
    {{-- background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); --}}
    color: white;
    padding: 2rem 0;
    border-radius: 15px;
}

.certificate-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: none;
    overflow: hidden;
}

.certificate-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}

.certificate-table {
    margin: 0;
    border: none;
}

.certificate-table thead th {
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    border: none;
    font-weight: 600;
    color: #495057;
    padding: 1rem;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.certificate-table tbody td {
    padding: 1.2rem 1rem;
    border: none;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
}

.certificate-table tbody tr:last-child td {
    border-bottom: none;
}

.certificate-title {
    font-weight: 600;
    color: #2d3748;
    font-size: 1.1rem;
    margin-bottom: 0.25rem;
}

.certificate-category {
    font-size: 0.85rem;
    color: #718096;
    background: #f7fafc;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    display: inline-block;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-weight: 500;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.status-issued {
    background: linear-gradient(45deg, #48bb78, #38a169);
    color: white;
}

.status-progress {
    background: linear-gradient(45deg, #4299e1, #3182ce);
    color: white;
}

.progress-container {
    margin-top: 0.5rem;
}

.custom-progress {
    height: 8px;
    background: #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
}

.custom-progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #4299e1, #3182ce);
    border-radius: 10px;
    transition: width 0.6s ease;
    position: relative;
}

.custom-progress-bar::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.progress-text {
    font-size: 0.8rem;
    font-weight: 600;
    color: #4299e1;
    margin-top: 0.25rem;
}

.action-btn {
    padding: 0.6rem 1.5rem;
    border-radius: 25px;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
}

.btn-download {
    background: linear-gradient(45deg, #48bb78, #38a169);
    color: white;
}

.btn-download:hover {
    background: linear-gradient(45deg, #38a169, #2f855a);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(72, 187, 120, 0.4);
    color: white;
}

.btn-continue {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
    color: white;
}

.btn-continue:hover {
    background: linear-gradient(45deg, #dd6b20, #c05621);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(237, 137, 54, 0.4);
    color: white;
}

.stats-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    text-align: center;
    border: none;
}

.stats-number {
    font-size: 2rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.stats-label {
    color: #718096;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.icon {
    width: 18px;
    height: 18px;
}

@media (max-width: 768px) {
    .certificate-table {
        font-size: 0.9rem;
    }
    
    .certificate-title {
        font-size: 1rem;
    }
    
    .action-btn {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
}
</style>

<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="certificates-header">
        <div class="container">
            <h2 class="mb-3">
                
                My Certificates
            </h2>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="container mb-4">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <div class="stats-number text-success">
                        <?php echo count(array_filter($certificates, fn($cert) => $cert['status'] === 'Issued')); ?>
                    </div>
                    <div class="stats-label">Completed</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <div class="stats-number text-primary">
                        <?php echo count(array_filter($certificates, fn($cert) => $cert['status'] === 'In Progress')); ?>
                    </div>
                    <div class="stats-label">In Progress</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <div class="stats-number text-info">
                        <?php echo count($certificates); ?>
                    </div>
                    <div class="stats-label">Total Courses</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <div class="stats-number text-warning">
                        <?php 
                        $totalProgress = array_sum(array_column($certificates, 'progress'));
                        echo round($totalProgress / count($certificates)); 
                        ?>%
                    </div>
                    <div class="stats-label">Avg Progress</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Certificates Table -->
    <div class="container">
        <div style="padding:20px;" class="certificate-card">
            <div class="table-responsive">
                <table id="my-table" class="table certificate-table">
                    <thead>
                        <tr>
                            <th width="5%">S/N</th>
                            <th width="35%">Certificate</th>
                            <th width="25%">Status</th>
                            <th width="15%">Date Issued</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($certificates as $index => $cert): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold text-muted"><?= $index + 1 ?>.</div>
                                </td>
                                <td>
                                    <div class="certificate-title"><?= htmlspecialchars($cert['title']) ?></div>
                                    <div class="certificate-category"><?= htmlspecialchars($cert['category']) ?></div>
                                </td>
                                <td>
                                    <?php if ($cert['status'] === 'Issued'): ?>
                                        <span class="status-badge status-issued">
                                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Completed
                                        </span>
                                    <?php else: ?>
                                        <span class="status-badge status-progress">
                                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            In Progress
                                        </span>
                                        <div class="progress-container">
                                            <div class="custom-progress">
                                                <div class="custom-progress-bar" style="width: <?= $cert['progress'] ?>%;"></div>
                                            </div>
                                            <div class="progress-text"><?= $cert['progress'] ?>% Complete</div>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($cert['date_issued']): ?>
                                        <div class="fw-semibold text-dark"><?= $cert['date_issued'] ?></div>
                                    <?php else: ?>
                                        <span class="text-muted">--</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($cert['status'] === 'Issued'): ?>
                                        <button class="action-btn btn-download">
                                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                            Download
                                        </button>
                                    <?php else: ?>
                                        <button class="action-btn btn-continue">
                                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                            Continue
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection