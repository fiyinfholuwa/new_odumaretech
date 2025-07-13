@extends('user.app')

@section('content')
<div class="container py-5">
    <style>
        .floating-actions {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .floating-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .floating-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }
        
        .floating-btn i {
            font-size: 1.5rem;
        }
        
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-back:hover {
            background-color: #5a6268;
            color: white;
        }
        
        .btn-ask {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }
        
        .btn-ask:hover {
            background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
            color: white;
        }

        .category-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .category-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { transform: translateX(-100%) translateY(-100%) rotate(0deg); }
            50% { transform: translateX(-50%) translateY(-50%) rotate(180deg); }
        }

        .category-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .category-description {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .filter-tabs {
            background: white;
            border-radius: 15px;
            padding: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #e9ecef;
        }

        .filter-btn {
            background: transparent;
            border: 2px solid #e9ecef;
            color: #6c757d;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-right: 1rem;
            margin-bottom: 0.5rem;
        }

        .filter-btn:hover {
            border-color: #0d6efd;
            color: #0d6efd;
            transform: translateY(-1px);
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
            border-color: #0d6efd;
            color: white;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }

        .questions-grid {
            display: grid;
            gap: 1.5rem;
        }

        .question-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            position: relative;
        }

        .question-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #0d6efd;
        }

        .question-status {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-solved {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }

        .status-unsolved {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            color: white;
        }

        .question-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
            padding-right: 5rem;
            line-height: 1.4;
        }

        .question-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .question-title a:hover {
            color: #0d6efd;
        }

        .question-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .meta-item i {
            color: #0d6efd;
        }

        .question-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f8f9fa;
        }

        .author-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .author-info {
            flex: 1;
        }

        .author-name {
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
            font-size: 0.9rem;
        }

        .author-date {
            color: #6c757d;
            font-size: 0.8rem;
            margin: 0;
        }

        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card.total {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stat-card.solved {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }

        .stat-card.unsolved {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            color: white;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            border: 2px dashed #dee2e6;
            margin: 2rem 0;
        }

        .empty-state i {
            font-size: 4rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            color: #495057;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 0;
        }

        .search-bar {
            position: relative;
            margin-bottom: 2rem;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }

        .search-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.1rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 2rem;
        }

        .breadcrumb-item a {
            color: #0d6efd;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .floating-actions {
                bottom: 20px;
                right: 20px;
            }
            
            .floating-btn {
                width: 50px;
                height: 50px;
            }
            
            .floating-btn i {
                font-size: 1.2rem;
            }
            
            .category-header {
                padding: 2rem 1rem;
            }
            
            .category-title {
                font-size: 1.8rem;
            }
            
            .stats-summary {
                grid-template-columns: 1fr;
            }
            
            .question-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .filter-btn {
                margin-right: 0.5rem;
            }
        }
    </style>

    <!-- Breadcrumb Navigation -->
    <nav class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#!">Community</a></li>
            <li class="breadcrumb-item active">Question & Anwser</li>
        </ol>
    </nav>

    <!-- Category Header -->
        <h3 class="">{{ $category ?? 'All Questions' }}</h3>
        <p class="category-description">Find answers, share knowledge, and connect with the community</p>


    <!-- Search Bar -->
    <div class="search-bar">
        <i class="bi bi-search search-icon"></i>
        <input type="text" class="search-input" placeholder="Search questions..." id="searchInput">
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <button class="filter-btn active" data-filter="all">
            <i class="bi bi-list-ul me-1"></i>
            All Questions
        </button>
        <button class="filter-btn" data-filter="solved">
            <i class="bi bi-check-circle me-1"></i>
            Solved
        </button>
        <button class="filter-btn" data-filter="unsolved">
            <i class="bi bi-question-circle me-1"></i>
            Unsolved
        </button>
    </div>

    <!-- Questions Grid -->
    <div class="questions-grid">
        @forelse($questions ?? [] as $question)
                            <a href="{{ route('question.show', $question['id']) }}">

            <div class="question-card" data-status="{{ $question['status'] ?? 'unsolved' }}">
                <div class="question-status status-{{ $question['status'] ?? 'unsolved' }}">
                    {{ $question['status'] ?? 'Unsolved' }}
                </div>
                
                <h3 class="question-title">
                        {{ $question['title'] }}
                </h3>
                
                <div class="question-meta">
                    <div class="meta-item">
                        <i class="bi bi-eye"></i>
                        <span>{{ $question['views'] ?? 0 }} views</span>
                    </div>
                    <div class="meta-item">
                        <i class="bi bi-chat-dots"></i>
                        <span>{{ $question['replies_count'] ?? 0 }} replies</span>
                    </div>
                    <div class="meta-item">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span>{{ $question['helpful_count'] ?? 0 }} helpful</span>
                    </div>
                </div>
                
                <div class="question-author">
                    <div class="author-avatar">
                        {{ strtoupper(substr($question['author']['name'] ?? 'U', 0, 1)) }}
                    </div>
                    <div class="author-info">
                        <div class="author-name">{{ $question['author']['name'] ?? 'Anonymous' }}</div>
                        <div class="author-date">{{ \Carbon\Carbon::parse($question['created_at'])->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
                                </a>

        @empty
            <div class="empty-state">
                <i class="bi bi-chat-square-text"></i>
                <h4>No questions found</h4>
                <p>Be the first to ask a question in this category!</p>
            </div>
        @endforelse
    </div>

    <!-- Floating Action Buttons -->
    <div class="floating-actions">
        
        <button class="floating-btn btn-ask" data-bs-toggle="modal" data-bs-target="#askModal" title="Ask Question">
            <i class="fa fa-plus"></i>
        </button>
    </div>

    <!-- Ask Question Modal -->
    <div class="modal fade" id="askModal" tabindex="-1" aria-labelledby="askModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
<form id="askQuestionForm" class="modal-content" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="askModalLabel">
                        <i class="bi bi-question-circle me-2"></i>
                        Ask a Question
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Question Title</label>
                        <input type="text" name="title" class="form-control" placeholder="What's your question?" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Question Details</label>
                        <textarea name="content" class="form-control" rows="5" placeholder="Describe your question in detail..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Optional Attachment</label>
                        <input type="file" name="attachment" class="form-control" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx">
                        <div class="form-text">Supported formats: JPG, PNG, GIF, PDF, DOC, DOCX</div>
                    </div>
                </div>
                <div class="modal-footer">
                   <button type="submit" class="btn btn-primary" id="askSubmitBtn">
    <i class="bi bi-send me-1"></i>
    Post Question
</button>
<button type="button" class="btn btn-primary d-none" id="askProcessingBtn" disabled>
    <i class="fas fa-spinner fa-spin me-1"></i> Processing...
</button>

                </div>
            </form>
        </div>
    </div>

    <script>
        // Filter functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                const cards = document.querySelectorAll('.question-card');
                
                cards.forEach(card => {
                    if (filter === 'all' || card.dataset.status === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.question-card');
            
            cards.forEach(card => {
                const title = card.querySelector('.question-title a').textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
<!-- Font Awesome (for spinner) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
document.addEventListener('DOMContentLoaded', function () {
    const askForm = document.getElementById('askQuestionForm');
    const askSubmitBtn = document.getElementById('askSubmitBtn');
    const askProcessingBtn = document.getElementById('askProcessingBtn');

    askForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Show spinner, hide normal button
        askSubmitBtn.classList.add('d-none');
        askProcessingBtn.classList.remove('d-none');

        const formData = new FormData(askForm);

        fetch("{{ route('question.store') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => {
            askSubmitBtn.classList.remove('d-none');
            askProcessingBtn.classList.add('d-none');

            if (!response.ok) {
                return response.json().then(data => Promise.reject(data.errors));
            }
            return response.json();
        })
        .then(data => {
            // Success: Close modal and notify
            bootstrap.Modal.getInstance(document.getElementById('askModal')).hide();
            askForm.reset();

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: data.message || 'Question submitted!',
            }).then(() => {
                window.location.reload(); // Optional
            });
        })
        .catch(errors => {
            askSubmitBtn.classList.remove('d-none');
            askProcessingBtn.classList.add('d-none');
            
            let errorMsg = Object.values(errors).flat().join('\n');
            Swal.fire('Error', errorMsg, 'error');
        });
    });
});
</script>

</div>
@endsection