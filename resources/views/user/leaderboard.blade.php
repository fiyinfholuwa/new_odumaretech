@extends('user.app')

@section('content')

<?php
// Enhanced leaderboard data with more comprehensive information
$userStats = [
    'overall_rank' => 15,
    'total_points' => 2847,
    'courses_completed' => 12,
    'streak_days' => 23
];

$achievements = [
    [
        'title' => 'Monthly Course Completion',
        'rank' => 42,
        'color' => 'primary',
        'icon' => 'graduation-cap',
        'total_participants' => 1250,
        'points' => 85,
        'change' => '+3',
        'trend' => 'up'
    ],
    [
        'title' => 'Discussion Contributors',
        'rank' => 21,
        'color' => 'warning',
        'icon' => 'comments',
        'total_participants' => 890,
        'points' => 142,
        'change' => '-2',
        'trend' => 'down'
    ],
    [
        'title' => 'Weekly Quiz Masters',
        'rank' => 8,
        'color' => 'success',
        'icon' => 'brain',
        'total_participants' => 567,
        'points' => 203,
        'change' => '+5',
        'trend' => 'up'
    ],
    [
        'title' => 'Project Completion Rate',
        'rank' => 33,
        'color' => 'info',
        'icon' => 'code',
        'total_participants' => 734,
        'points' => 67,
        'change' => '0',
        'trend' => 'stable'
    ]
];

$topPerformers = [
    ['name' => 'Sarah Johnson', 'points' => 3245, 'avatar' => 'SJ', 'rank' => 1],
    ['name' => 'Mike Chen', 'points' => 3102, 'avatar' => 'MC', 'rank' => 2],
    ['name' => 'Alex Rivera', 'points' => 2956, 'avatar' => 'AR', 'rank' => 3],
    ['name' => 'You', 'points' => 2847, 'avatar' => 'Y', 'rank' => 4, 'current_user' => true],
    ['name' => 'Emma Davis', 'points' => 2734, 'avatar' => 'ED', 'rank' => 5]
];
?>

<style>
.leaderboard-header {
    background: linear-gradient(135deg, #667eea 0%, #FFC000 100%);
    border-radius: 20px;
    position: relative;
    overflow: hidden;
    margin-bottom: 2rem;
}

.leaderboard-header::before {
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
    height: 100%;
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

.rank-badge {
    background: linear-gradient(135deg, var(--rank-color-1), var(--rank-color-2));
    color: white;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    position: relative;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.rank-badge.top-3 {
    animation: pulse-gold 2s infinite;
}

.rank-badge::after {
    content: '';
    position: absolute;
    top: -2px;
    right: -2px;
    bottom: -2px;
    left: -2px;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
    border-radius: 50%;
    z-index: -1;
}

.achievement-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    margin-right: 1rem;
    color: white;
    background: var(--accent-color);
}

.trend-indicator {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.trend-up {
    background: #dcfce7;
    color: #166534;
}

.trend-down {
    background: #fee2e2;
    color: #991b1b;
}

.trend-stable {
    background: #f1f5f9;
    color: #475569;
}

.top-performers-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.performer-item {
    padding: 1rem;
    border-bottom: 1px solid #f1f5f9;
    transition: all 0.3s ease;
    position: relative;
}

.performer-item:hover {
    background: #f8fafc;
    transform: translateX(5px);
}

.performer-item:last-child {
    border-bottom: none;
}

.performer-item.current-user {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-left: 4px solid #f59e0b;
}

.performer-item.current-user:hover {
    background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%);
}

.performer-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: white;
    margin-right: 1rem;
}

.performer-rank {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    margin-right: 1rem;
}

.rank-1 { background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); }
.rank-2 { background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%); }
.rank-3 { background: linear-gradient(135deg, #fb7185 0%, #e11d48 100%); }
.rank-other { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }

.points-display {
    color: #10b981;
    font-weight: 600;
}

@keyframes pulse-gold {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(251, 191, 36, 0.7);
    }
    50% {
        box-shadow: 0 0 0 10px rgba(251, 191, 36, 0);
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

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.medal-icon {
    font-size: 1.8rem;
    margin-right: 0.5rem;
}

.progress-ring {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    background: conic-gradient(var(--accent-color) 0deg, var(--accent-color) calc(var(--progress) * 3.6deg), #e2e8f0 calc(var(--progress) * 3.6deg));
}

.progress-ring::before {
    content: '';
    position: absolute;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: white;
}

.progress-text {
    position: relative;
    z-index: 1;
    font-weight: 700;
    font-size: 0.9rem;
}
</style>

<div class="container-fluid px-4 py-3">
    <div class="row">
        <div class="col-12 col-xl-12">
            
            <!-- Header Section -->
            <div class="leaderboard-header p-4 fade-in-up">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="text-white mb-2 fw-bold">
                            <i class="fas fa-trophy me-2"></i>
                            Leaderboard
                        </h2>
                        <p class="text-white mb-0 opacity-90">See how you rank against other learners</p>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="text-center">
                            <div class="rank-badge rank-other" style="--rank-color-1: #667eea; --rank-color-2: #764ba2;">
                                #<?= $userStats['overall_rank'] ?>
                            </div>
                            <div class="mt-2">
                                <small class="text-white opacity-90">Your Overall Rank</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-lg-3 col-6">
                        <div class="stats-card">
                            <div class="h4 text-white mb-1"><?= number_format($userStats['total_points']) ?></div>
                            <div class="text-white opacity-90 small">Total Points</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stats-card">
                            <div class="h4 text-white mb-1"><?= $userStats['courses_completed'] ?></div>
                            <div class="text-white opacity-90 small">Courses</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stats-card">
                            <div class="h4 text-white mb-1"><?= $userStats['streak_days'] ?></div>
                            <div class="text-white opacity-90 small">Day Streak</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="stats-card">
                            <div class="h4 text-white mb-1">#<?= $userStats['overall_rank'] ?></div>
                            <div class="text-white opacity-90 small">Global Rank</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <!-- Achievement Rankings -->
                    <div class="section-title fade-in-up" style="animation-delay: 0.2s">
                        <i class="fas fa-medal medal-icon text-warning"></i>
                        Category Rankings
                    </div>

                    <?php foreach ($achievements as $index => $achievement): ?>
                        <div class="achievement-card fade-in-up" 
                             style="--accent-color: var(--bs-<?= $achievement['color'] ?>); animation-delay: <?= ($index + 1) * 0.1 ?>s">
                            
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="achievement-icon" style="background: var(--bs-<?= $achievement['color'] ?>)">
                                        <i class="fas fa-<?= $achievement['icon'] ?>"></i>
                                    </div>
                                    
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fw-bold text-<?= $achievement['color'] ?>">
                                            <?= htmlspecialchars($achievement['title']) ?>
                                        </h5>
                                        <div class="d-flex align-items-center gap-3">
                                            <small class="text-muted">
                                                <i class="fas fa-users me-1"></i>
                                                <?= number_format($achievement['total_participants']) ?> participants
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-star me-1"></i>
                                                <?= $achievement['points'] ?> points
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-end">
                                    <div class="rank-badge <?= $achievement['rank'] <= 3 ? 'top-3' : '' ?>" 
                                         style="--rank-color-1: var(--bs-<?= $achievement['color'] ?>); --rank-color-2: var(--bs-<?= $achievement['color'] ?>);">
                                        #<?= $achievement['rank'] ?>
                                    </div>
                                    
                                    <div class="mt-2">
                                        <?php if ($achievement['trend'] === 'up'): ?>
                                            <span class="trend-indicator trend-up">
                                                <i class="fas fa-arrow-up"></i>
                                                <?= $achievement['change'] ?>
                                            </span>
                                        <?php elseif ($achievement['trend'] === 'down'): ?>
                                            <span class="trend-indicator trend-down">
                                                <i class="fas fa-arrow-down"></i>
                                                <?= $achievement['change'] ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="trend-indicator trend-stable">
                                                <i class="fas fa-minus"></i>
                                                <?= $achievement['change'] ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-lg-4">
                    <!-- Top Performers -->
                    <div class="section-title fade-in-up" style="animation-delay: 0.4s">
                        <i class="fas fa-crown medal-icon text-warning"></i>
                        Top Performers
                    </div>
                    
                    <div class="top-performers-card fade-in-up" style="animation-delay: 0.5s">
                        <?php foreach ($topPerformers as $performer): ?>
                            <div class="performer-item <?= isset($performer['current_user']) ? 'current-user' : '' ?>">
                                <div class="d-flex align-items-center">
                                    <div class="performer-rank rank-<?= $performer['rank'] <= 3 ? $performer['rank'] : 'other' ?>">
                                        <?= $performer['rank'] ?>
                                    </div>
                                    
                                    <div class="performer-avatar" style="background: <?= isset($performer['current_user']) ? '#f59e0b' : '#' . substr(md5($performer['name']), 0, 6) ?>">
                                        <?= $performer['avatar'] ?>
                                    </div>
                                    
                                    <div class="flex-grow-1">
                                        <div class="fw-bold <?= isset($performer['current_user']) ? 'text-warning' : '' ?>">
                                            <?= htmlspecialchars($performer['name']) ?>
                                            <?php if (isset($performer['current_user'])): ?>
                                                <i class="fas fa-star text-warning ms-1"></i>
                                            <?php endif; ?>
                                        </div>
                                        <div class="points-display">
                                            <?= number_format($performer['points']) ?> points
                                        </div>
                                    </div>
                                    
                                    <?php if ($performer['rank'] <= 3): ?>
                                        <div class="medal-icon">
                                            <?php if ($performer['rank'] == 1): ?>
                                                🥇
                                            <?php elseif ($performer['rank'] == 2): ?>
                                                🥈
                                            <?php else: ?>
                                                🥉
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
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
        }, index * 100);
    });

    // Add click interactions to achievement cards
    const achievementCards = document.querySelectorAll('.achievement-card');
    achievementCards.forEach(card => {
        card.addEventListener('click', function() {
            // Add click animation
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'translateY(-3px)';
            }, 100);
        });
    });

    // Animate rank badges on hover
    const rankBadges = document.querySelectorAll('.rank-badge');
    rankBadges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });

    // Add periodic pulse to top-3 ranks
    setInterval(() => {
        const topRanks = document.querySelectorAll('.rank-badge.top-3');
        topRanks.forEach(rank => {
            rank.style.animation = 'none';
            setTimeout(() => {
                rank.style.animation = 'pulse-gold 2s infinite';
            }, 10);
        });
    }, 10000);
});
</script>

@endsection