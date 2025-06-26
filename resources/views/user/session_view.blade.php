


@extends('user.app')

@section('content')
<style>
.modern-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
}

.modern-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    border-color: #3b82f6;
}

.modern-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.modern-card:hover::before {
    opacity: 1;
}

.icon-container {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    transition: transform 0.3s ease;
}

.modern-card:hover .icon-container {
    transform: scale(1.1);
}

.modern-btn {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    color: white;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    font-size: 14px;
}

.modern-btn:hover {
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    color: white;
    text-decoration: none;
}

.modern-btn i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.modern-btn:hover i {
    transform: translateX(2px);
}

.page-header-modern {
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e5e7eb;
}

.page-title-modern {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
}

.page-subtitle {
    color: #6b7280;
    font-size: 1.1rem;
}

.course-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 8px;
    line-height: 1.4;
}

.course-meta {
    color: #6b7280;
    font-size: 0.9rem;
    margin-bottom: 20px;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    background: #dcfce7;
    color: #166534;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    margin-bottom: 16px;
}

.status-dot {
    width: 6px;
    height: 6px;
    background: #22c55e;
    border-radius: 50%;
    margin-right: 6px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: #f9fafb;
    border-radius: 16px;
    margin: 40px 0;
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #e5e7eb, #d1d5db);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 12px;
}

.empty-text {
    color: #6b7280;
    font-size: 1rem;
    max-width: 400px;
    margin: 0 auto 32px;
    line-height: 1.6;
}

.card-animation {
    animation: fadeInUp 0.6s ease-out;
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

.count-badge {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    color: #1e40af;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    display: inline-block;
}
</style>

<div class="page-inner">
    <!-- Modern Header -->
    <div class="page-header-modern">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="page-title-modern">All Sessions
</h1>
            </div>
            <div>
                <span class="count-badge">
                    {{ count($fetch_user_details) }} Course{{ count($fetch_user_details) !== 1 ? 's' : '' }}
                </span>
            </div>
        </div>
    </div>

    @if(count($fetch_user_details) > 0)
        <div class="row">
            @foreach($fetch_user_details as $index => $detail)
                <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
                    <div class="modern-card card-animation" style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="p-4">
                            <!-- Icon and Status -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="icon-container">
                                    <i class="fas fa-users text-white" style="font-size: 24px;"></i>
                                </div>
                                <div class="status-badge">
                                    <div class="status-dot"></div>
                                    Active
                                </div>
                            </div>

                            <!-- Course Info -->
                            <h3 class="course-title">{{ $detail->course_name->title }}</h3>
                            <p class="course-meta">Course session</p>

                            <!-- Action Button -->
                            <a href="{{ route('session.all', ['id' => $detail->course_id, 'co' => $detail->cohort_id]) }}" 
                               class="modern-btn">
                                View Sessions
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-bell-slash text-muted" style="font-size: 32px;"></i>
            </div>
            <h3 class="empty-title">No Session  Yet</h3>
            <p class="empty-text">
                You don't have any course session at the moment. 
                Check back later for updates from your courses.
            </p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <a href="#" class="modern-btn">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Refresh
                </a>
                <a href="#" class="btn btn-outline-primary">
                    Browse Courses
                </a>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add staggered animation to cards
    const cards = document.querySelectorAll('.card-animation');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
        }, index * 100);
    });
});
</script>
@endsection