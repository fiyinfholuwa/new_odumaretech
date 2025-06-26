@extends('user.app')

@section('content')
<div class="page-inner">
    <!-- Modern Header Section -->
    <div class="page-header">
						<h4 class="page-title">All Resources</h4>
						
					</div>
				
    <!-- Resources Grid -->
    <div class="row g-4">
        @if(count($fetch_user_details) > 0)
            @foreach($fetch_user_details as $detail)
                <div  class="col-sm-6 col-lg-4 col-xl-3">
                    <div style="background:#FFF3CF;" class="resource-card h-100">
                        <!-- Card Image Header -->
                        <div class="card-image-header">
                            @if(optional($detail->course_name)->image)
                                <img src="{{asset( optional($detail->course_name)->image)}}" 
                                     alt="Course Image" 
                                     class="course-image">
                            @else
                                <div class="default-image-placeholder">
                                    <i class="fas fa-book-open"></i>
                                </div>
                            @endif
                            <div class="overlay-gradient"></div>
                        </div>
                        
                        <!-- Card Content -->
                        <div class="card-content">
                            <div class="course-info mb-3">
                                <h5 class="course-title">{{ optional($detail->course_name)->title ?? 'Course Resources' }}</h5>
                                <span class="cohort-badge">Cohort {{ optional($detail->cohort_name)->name }}</span>
                            </div>
                            
                            <div class="resource-stats mb-4">
                                <div class="stat-item">
                                    <i class="fas fa-file-alt text-primary"></i>
                                    {{-- <span>Materials Available</span> --}}
                                </div>
                            </div>
                            
                            <div class="card-actions">
                                <a style="background:#FFC000;" href="{{route('resource.detail', ['id' => $detail->course_id, 'co' => $detail->cohort_id])}}" 
                                   class="btn btn-modern btn-primary w-100">
                                    <i class="fas fa-arrow-right me-2"></i>
                                    View Resources
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Empty State -->
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h4 class="empty-state-title">No Resources Available</h4>
                    <p class="empty-state-text">Your learning resources will appear here once they're uploaded by your instructors.</p>
                    <div class="empty-state-action">
                        <button class="btn btn-outline-primary" onclick="location.reload()">
                            <i class="fas fa-refresh me-2"></i>
                            Refresh Page
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
/* Modern Color Palette */
:root {
    --primary-cream: #FFF3CF;
    --primary-lavender: #E9ECFF;
    --accent-gold: #F4D03F;
    --accent-purple: #8E44AD;
    --text-dark: #2C3E50;
    --text-muted: #7F8C8D;
    --white: #FFFFFF;
    --shadow-light: rgba(0, 0, 0, 0.08);
    --shadow-medium: rgba(0, 0, 0, 0.15);
}

/* Page Header Styling */


.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.header-decoration .icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--accent-purple), #9B59B6);
    box-shadow: 0 4px 16px rgba(142, 68, 173, 0.3);
}

/* Resource Card Styling */
.resource-card {
    background: var(--white);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px var(--shadow-light);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(233, 236, 255, 0.3);
    position: relative;
}

.resource-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px var(--shadow-medium);
}

.card-image-header {
    height: 180px;
    position: relative;
    background: linear-gradient(135deg, var(--primary-cream) 0%, var(--primary-lavender) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.course-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.resource-card:hover .course-image {
    transform: scale(1.05);
}

.default-image-placeholder {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--accent-gold), #F39C12);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 4px 16px rgba(244, 208, 63, 0.3);
}

.overlay-gradient {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 50%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.1), transparent);
}

.card-content {
    padding: 1.5rem;
}

.course-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    line-height: 1.4;
}

.cohort-badge {
    background: linear-gradient(135deg, var(--primary-lavender), var(--primary-cream));
    color: var(--text-dark);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    border: 1px solid rgba(233, 236, 255, 0.5);
}

.resource-stats {
    padding: 1rem 0;
    border-top: 1px solid #F8F9FA;
    border-bottom: 1px solid #F8F9FA;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-muted);
    font-size: 0.9rem;
}

.stat-item i {
    width: 16px;
    text-align: center;
}

/* Modern Button Styling */
.btn-modern {
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    position: relative;
    overflow: hidden;
}

.btn-modern::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn-modern:hover::before {
    width: 300px;
    height: 300px;
}

.btn-primary.btn-modern {
    background: linear-gradient(135deg, var(--accent-purple), #9B59B6);
    color: white;
    box-shadow: 0 4px 16px rgba(142, 68, 173, 0.3);
}

.btn-primary.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(142, 68, 173, 0.4);
    color: white;
}

/* Empty State Styling */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: linear-gradient(135deg, var(--primary-cream) 0%, var(--primary-lavender) 100%);
    border-radius: 20px;
    border: 2px dashed rgba(142, 68, 173, 0.2);
}

.empty-state-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 2rem;
    background: linear-gradient(135deg, var(--accent-gold), #F39C12);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
    box-shadow: 0 8px 32px rgba(244, 208, 63, 0.3);
}

.empty-state-title {
    color: var(--text-dark);
    font-weight: 600;
    margin-bottom: 1rem;
}

.empty-state-text {
    color: var(--text-muted);
    margin-bottom: 2rem;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.btn-outline-primary {
    border: 2px solid var(--accent-purple);
    color: var(--accent-purple);
    background: transparent;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: var(--accent-purple);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(142, 68, 173, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        padding: 1.5rem;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .header-decoration {
        display: none;
    }
    
    .card-content {
        padding: 1rem;
    }
    
    .empty-state {
        padding: 2rem 1rem;
    }
    
    .empty-state-icon {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }
}

/* Animation for cards on load */
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

.resource-card {
    animation: fadeInUp 0.6s ease forwards;
}

.resource-card:nth-child(2) { animation-delay: 0.1s; }
.resource-card:nth-child(3) { animation-delay: 0.2s; }
.resource-card:nth-child(4) { animation-delay: 0.3s; }
</style>
@endsection