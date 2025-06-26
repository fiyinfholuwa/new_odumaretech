@extends('user.app')

@section('content')

<?php
$achievements = [
    [
        'title' => 'First Course Completed',
        'description' => 'Completed your first course',
        'earned' => true,
        'date' => '12/10/2023',
        'color' => 'primary',
        'icon' => 'graduation-cap',
        'points' => 100
    ],
    [
        'title' => 'Coding Expert',
        'description' => 'Completed 5 programming courses',
        'earned' => true,
        'date' => '12/10/2023',
        'color' => 'warning',
        'icon' => 'code',
        'points' => 500
    ],
    [
        'title' => 'Persistent Learner',
        'description' => 'Logged in for 30 consecutive days',
        'earned' => false,
        'progress' => 54,
        'color' => 'primary',
        'icon' => 'calendar-check',
        'points' => 300,
        'current' => 16,
        'target' => 30
    ],
    [
        'title' => 'Knowledge Seeker',
        'description' => 'Complete 10 different courses',
        'earned' => false,
        'progress' => 30,
        'color' => 'info',
        'icon' => 'book',
        'points' => 750,
        'current' => 3,
        'target' => 10
    ],
    [
        'title' => 'Speed Demon',
        'description' => 'Complete a course in under 24 hours',
        'earned' => false,
        'progress' => 0,
        'color' => 'danger',
        'icon' => 'lightning-bolt',
        'points' => 200,
        'current' => 0,
        'target' => 1
    ]
];

$totalEarned = count(array_filter($achievements, fn($a) => $a['earned']));
$totalPoints = array_sum(array_column(array_filter($achievements, fn($a) => $a['earned']), 'points'));
?>

<style>
.badges-header {
    background: linear-gradient(135deg, #667eea 0%, #FFC000 100%);
    border-radius: 20px;
    position: relative;
    overflow: hidden;
    margin-bottom: 2rem;
}

.badges-header::before {
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
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.25);
}

.achievement-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
    position: relative;
    overflow: hidden;
}

.achievement-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--accent-color);
    transition: width 0.3s ease;
}

.achievement-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px -4px rgba(0, 0, 0, 0.15);
}

.achievement-card:hover::before {
    width: 6px;
}

.achievement-card.earned {
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    border-color: #10b981;
}

.achievement-card.earned::before {
    background: #10b981;
}

.achievement-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1rem;
    position: relative;
    transition: all 0.3s ease;
}

.achievement-icon.earned {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    animation: pulse-green 2s infinite;
}

.achievement-icon.locked {
    background: #f1f5f9;
    color: #64748b;
}

.achievement-icon::after {
    content: '';
    position: absolute;
    top: -5px;
    right: -5px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #10b981;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    color: white;
    font-weight: bold;
}

.achievement-icon.earned::after {
    content: '✓';
}

.achievement-icon.locked::after {
    content: '🔒';
    background: #64748b;
    font-size: 0.6rem;
}

.progress-container {
    background: #f1f5f9;
    border-radius: 10px;
    padding: 0.5rem;
    margin-top: 1rem;
}

.progress-bar-custom {
    height: 8px;
    border-radius: 6px;
    background: #e2e8f0;
    overflow: hidden;
    position: relative;
}

.progress-fill {
    height: 100%;
    border-radius: 6px;
    transition: width 1s ease;
    position: relative;
    overflow: hidden;
}

.progress-fill::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-image: linear-gradient(45deg, rgba(255,255,255,.2) 25%, transparent 25%, transparent 50%, rgba(255,255,255,.2) 50%, rgba(255,255,255,.2) 75%, transparent 75%, transparent);
    background-size: 1rem 1rem;
    animation: progress-animation 1s linear infinite;
}

.earned-badge {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
}

.points-badge {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    position: absolute;
    top: 1rem;
    right: 1rem;
}

.filter-tabs {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.filter-tab {
    padding: 0.5rem 1rem;
    border: 2px solid #e2e8f0;
    background: white;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.filter-tab.active {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.filter-tab:hover {
    border-color: #667eea;
    background: #f8fafc;
}

.filter-tab.active:hover {
    background: #5a67d8;
}

@keyframes pulse-green {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    }
    50% {
        box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
    }
}

@keyframes progress-animation {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 1rem 0;
    }
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

.achievement-grid {
    display: grid;
    gap: 1.5rem;
}

@media (min-width: 768px) {
    .achievement-grid {
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    }
}

.empty-state {
    text-align: center;
    padding: 3rem;
    color: #64748b;
}

.trophy-icon {
    font-size: 3rem;
    color: #fbbf24;
    margin-bottom: 1rem;
}
</style>

<div class="container-fluid px-4 py-3">
    <div class="row ">
        <div class="col-12 col-xl-12">
            
            <!-- Header Section -->
            <div class="badges-header p-4 fade-in-up">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="text-white mb-2 fw-bold">
                            <i class="fas fa-trophy me-2"></i>
                            My Achievements
                        </h2>
                        <p class="text-white mb-0 opacity-90">Track your learning journey and unlock rewards</p>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="stats-card">
                                    <div class="h3 text-white mb-1"><?= $totalEarned ?></div>
                                    <div class="text-white opacity-90 small">Badges Earned</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-card">
                                    <div class="h3 text-white mb-1"><?= $totalPoints ?></div>
                                    <div class="text-white opacity-90 small">Total Points</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="filter-tabs fade-in-up" style="animation-delay: 0.2s">
                <div class="filter-tab active" data-filter="all">
                    <i class="fas fa-th-large me-2"></i>All Badges
                </div>
                <div class="filter-tab" data-filter="earned">
                    <i class="fas fa-check-circle me-2"></i>Earned
                </div>
                <div class="filter-tab" data-filter="progress">
                    <i class="fas fa-clock me-2"></i>In Progress
                </div>
                <div class="filter-tab" data-filter="locked">
                    <i class="fas fa-lock me-2"></i>Locked
                </div>
            </div>

            <!-- Achievements Grid -->
            <div class="achievement-grid fade-in-up" style="animation-delay: 0.4s" id="achievementGrid">
                <?php foreach ($achievements as $index => $achievement): ?>
                    <div class="achievement-card <?= $achievement['earned'] ? 'earned' : 'locked' ?>" 
                         data-category="<?= $achievement['earned'] ? 'earned' : ($achievement['progress'] > 0 ? 'progress' : 'locked') ?>"
                         style="--accent-color: var(--bs-<?= $achievement['color'] ?>); animation-delay: <?= $index * 0.1 ?>s">
                        
                        <div class="points-badge">
                            <i class="fas fa-star me-1"></i>
                            <?= $achievement['points'] ?> pts
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="achievement-icon <?= $achievement['earned'] ? 'earned' : 'locked' ?>" 
                                 style="background-color: <?= $achievement['earned'] ? '' : 'var(--bs-' . $achievement['color'] . '-bg-subtle)' ?>; 
                                        color: <?= $achievement['earned'] ? '' : 'var(--bs-' . $achievement['color'] . ')' ?>">
                                <i class="fas fa-<?= $achievement['icon'] ?>"></i>
                            </div>
                            
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-2 fw-bold text-<?= $achievement['color'] ?>">
                                    <?= $achievement['title'] ?>
                                </h5>
                                <p class="text-gray-600 mb-2"><?= $achievement['description'] ?></p>
                                
                                <?php if ($achievement['earned']): ?>
                                    <div class="earned-badge">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Earned on <?= $achievement['date'] ?></span>
                                    </div>
                                <?php else: ?>
                                    <div class="progress-container">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <small class="text-muted fw-medium">Progress</small>
                                            <small class="text-<?= $achievement['color'] ?> fw-bold">
                                                <?= isset($achievement['current']) ? $achievement['current'] . '/' . $achievement['target'] : $achievement['progress'] . '%' ?>
                                            </small>
                                        </div>
                                        <div class="progress-bar-custom">
                                            <div class="progress-fill bg-<?= $achievement['color'] ?>" 
                                                 style="width: <?= $achievement['progress'] ?>%"></div>
                                        </div>
                                        <?php if (isset($achievement['current'])): ?>
                                            <small class="text-muted mt-1 d-block">
                                                <?= $achievement['target'] - $achievement['current'] ?> more to unlock
                                            </small>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Empty State -->
            <div class="empty-state d-none" id="emptyState">
                <div class="trophy-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h4 class="mb-2">No badges found</h4>
                <p>Try selecting a different filter to see your achievements.</p>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
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

    // Filter functionality
    const filterTabs = document.querySelectorAll('.filter-tab');
    const achievementCards = document.querySelectorAll('.achievement-card');
    const emptyState = document.getElementById('emptyState');
    const achievementGrid = document.getElementById('achievementGrid');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Update active tab
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            let visibleCount = 0;

            // Filter achievements
            achievementCards.forEach(card => {
                const category = card.dataset.category;
                const shouldShow = filter === 'all' || category === filter;
                
                if (shouldShow) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeInUp 0.6s ease forwards';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide empty state
            if (visibleCount === 0) {
                achievementGrid.style.display = 'none';
                emptyState.classList.remove('d-none');
            } else {
                achievementGrid.style.display = 'grid';
                emptyState.classList.add('d-none');
            }
        });
    });

    // Animate progress bars on scroll
    const progressBars = document.querySelectorAll('.progress-fill');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressBar = entry.target;
                const width = progressBar.style.width;
                progressBar.style.width = '0%';
                setTimeout(() => {
                    progressBar.style.width = width;
                }, 100);
            }
        });
    });

    progressBars.forEach(bar => observer.observe(bar));

    // Add hover effects for achievement cards
    achievementCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>

@endsection