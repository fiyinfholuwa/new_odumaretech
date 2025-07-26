@extends('user.app')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        
        .btn-reply {
            background-color: #0d6efd;
            color: white;
        }
        
        .btn-reply:hover {
            background-color: #0b5ed7;
            color: white;
        }

        .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
            border: 3px solid #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .thread-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #dee2e6;
        }

        .thread-title {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .thread-stats {
            display: flex;
            gap: 2rem;
            margin-bottom: 1.5rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .stat-item i {
            color: #0d6efd;
        }

        .thread-content {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .reply-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .reply-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .user-details h6 {
            margin: 0;
            color: #2c3e50;
            font-weight: 600;
        }

        .user-details small {
            color: #6c757d;
        }

        .helpful-btn {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .helpful-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
            color: white;
        }

        .attachment-link {
            color: #0d6efd;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .attachment-link:hover {
            background: #e9ecef;
            color: #0b5ed7;
        }

        .no-replies {
            text-align: center;
            padding: 3rem;
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border-radius: 12px;
            border: 1px solid #e1bee7;
        }

        .no-replies i {
            font-size: 3rem;
            color: #9c27b0;
            margin-bottom: 1rem;
        }

        .replies-section {
            margin-top: 3rem;
        }

        .replies-title {
            color: #2c3e50;
            margin-bottom: 2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .replies-title i {
            color: #0d6efd;
        }

        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            color: white;
            border-radius: 15px 15px 0 0;
            border-bottom: none;
        }

        .modal-title {
            font-weight: 600;
        }

        .btn-close {
            filter: invert(1);
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .modal-footer {
            border-top: none;
            padding-top: 0;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
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
            
            .thread-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .container {
                padding: 1rem;
            }
        }
    </style>



    <!-- Breadcrumb Navigation -->
    <nav class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('forum') }}">Question and Answers</a></li>
            <li class="breadcrumb-item active">{{ $thread['title'] }}</li>
        </ol>
    </nav>

    <!-- Thread Header -->
    <div class="thread-header">
    <h2 class="thread-title">{{ $thread['title'] }}</h2>

    <div class="thread-stats d-flex align-items-center flex-wrap gap-2">
        <div class="stat-item">
            <i class="bi bi-eye"></i>
            <span>{{ $thread['views'] }} Views</span>
        </div>

        <div class="stat-item">
            <i class="bi bi-chat-dots"></i>
            <span>{{ $thread['reply_count'] }} Replies</span>
        </div>

        <!-- ✅ Show category badge -->
        @if($thread->category === 'solved')
            <span class="badge bg-success">Solved</span>
        @else
            <span class="badge bg-warning text-white">Unsolved</span>
        @endif

        <!-- ✅ Show button only if owner & category is unsolved -->
        @if(Auth::check() && Auth::id() === $thread->user_id && $thread->category === 'unsolved')
            <button type="button" class="btn btn-success btn-sm ms-3" data-bs-toggle="modal" data-bs-target="#markSolvedModal">
                Mark as Solved
            </button>
        @endif
    </div>

    <div class="user-info mt-3">
        <div class="avatar">
            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
        </div>

        <div class="user-details">
            <h6>{{ Auth::user()->name ?? 'Anonymous' }}</h6>
            <small>{{ \Carbon\Carbon::parse($thread['created_at'])->format('d M Y h:i A') }}</small>
        </div>
    </div>
</div>


<div class="modal fade" id="markSolvedModal" tabindex="-1" aria-labelledby="markSolvedModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('question.solved', $thread->id) }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title text-white" id="markSolvedModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you are satisfied with the answers?  
                <strong>This action will mark your question as solved.</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Yes, Mark as Solved</button>
            </div>
        </form>
    </div>
</div>

    </div>

    <!-- Thread Content -->
    <div class="thread-content">
        <p class="mb-3">{{ $thread['content'] }}</p>

        @if (!empty($thread['attachment_path']))
            <a href="{{ asset($thread['attachment_path']) }}" class="attachment-link">
                <i class="bi bi-paperclip"></i>
                Download Attachment
            </a>
        @endif
    </div>

    <!-- Replies Section -->
    <div class="replies-section">
        <h4 class="replies-title">
            <i class="bi bi-chat-left-text"></i>
            Replies
        </h4>

        @forelse ($question_replies as $reply)
            <div class="reply-card">
                <div class="user-info">
                    <div class="avatar">{{ strtoupper(substr($reply['user']['name'] ?? 'U', 0, 1)) }}</div>
                    <div class="user-details">
                        <h6>{{ $reply['user']['name'] ?? 'Unknown' }}</h6>
                        <small>{{ \Carbon\Carbon::parse($reply['created_at'])->diffForHumans() }}</small>
                    </div>
                </div>
                
                <p class="mb-3">{{ $reply['content'] }}</p>

                @if (!empty($reply['attachment_path']))
                    <div class="mb-3">
                        <a href="{{ asset($reply['attachment_path']) }}" target="_blank" class="attachment-link">
                            <i class="bi bi-paperclip"></i>
                            View Attachment
                        </a>
                    </div>
                @endif

               <button 
    class="helpful-btn btn btn-sm btn-outline-secondary" 
    data-id="{{ $reply['id'] }}"
    data-url="{{ url('/question/replies/' . $reply['id'] . '/helpful') }}"
>
    <i class="bi bi-hand-thumbs-up me-1"></i>
    Helpful (<span class="helpful-count text-white">{{ $reply['helpful_count'] ?? 0 }}</span>)
</button>


            </div>
        @empty
            <div class="no-replies">
                <i class="bi bi-chat-square-text"></i>
                <h5>No replies yet</h5>
                <p class="text-muted mb-0">Be the first to respond to this Quesstion!</p>
            </div>
        @endforelse
    </div>

    <!-- Floating Action Buttons -->
    <div class="floating-actions">
        <button class="floating-btn btn btn-danger"
        onclick="window.location.href='{{ route('q.a') }}'"
        title="Go Back">
    <i class="fa fa-arrow-left"></i>
</button>

        <button class="floating-btn btn-reply" data-bs-toggle="modal" data-bs-target="#replyModal" title="Reply to Thread">
            <i class="fa fa-reply"></i>
        </button>
    </div>

    <!-- Enhanced Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="replyForm" class="modal-content" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="thread_id" value="{{ $thread['id'] }}">
    <div style="background:#FFF3CF;" class="modal-header">
        <h5 class="modal-title" id="replyModalLabel">
            <i class="fa fa-reply me-2"></i> Reply to Question
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div class="mb-4">
            <label class="form-label fw-bold">Your Reply</label>
            <textarea name="content" class="form-control" rows="5" placeholder="Share your thoughts..." required></textarea>
            <small class="text-danger error-content"></small>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Optional Attachment</label>
            <input type="file" name="attachment" class="form-control" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button id="submitReplyBtn" type="submit" class="btn btn-primary">
            <span class="default-text">
                <i class="bi bi-send me-1"></i> Submit Reply
            </span>
            <span class="processing-text d-none">
                <i class="fa fa-spinner fa-spin me-2"></i> Processing...
            </span>
        </button>
    </div>
</form>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const replyForm = document.getElementById('replyForm');
    const submitBtn = document.getElementById('submitReplyBtn');
    const defaultText = submitBtn.querySelector('.default-text');
    const processingText = submitBtn.querySelector('.processing-text');

    replyForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Reset errors
        document.querySelector('.error-content').textContent = '';

        // Toggle button state
        defaultText.classList.add('d-none');
        processingText.classList.remove('d-none');
        submitBtn.disabled = true;

        const formData = new FormData(replyForm);
        const threadId = formData.get('thread_id');

        fetch(`/question/${threadId}/reply`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: formData
        })
        .then(response => {
            if (response.status === 422) {
                return response.json().then(data => Promise.reject(data.errors));
            }
            return response.json();
        })
        .then(data => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('replyModal'));
    modal.hide();
            // Success: Show alert, hide modal, reload
            Swal.fire({
                title: 'Success!',
                text: data.message || 'Reply posted successfully.',
                icon: 'success'
            }).then(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('replyModal'));
                modal.hide();
                window.location.reload();
            });
        })
        .catch(errors => {
            // Validation errors
            if (errors.content) {
                document.querySelector('.error-content').textContent = errors.content[0];
            }
        })
        .finally(() => {
            // Reset button
            defaultText.classList.remove('d-none');
            processingText.classList.add('d-none');
            submitBtn.disabled = false;
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.helpful-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            const url = this.dataset.url;
            const countSpan = this.querySelector('.helpful-count');
            const originalCount = parseInt(countSpan.textContent);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                countSpan.textContent = data.helpful_count ?? originalCount;
                btn.classList.add('text-white');
                btn.disabled = true;
            })
            .catch(err => {
                console.error('Helpful AJAX failed:', err);
            });
        });
    });
});
</script>


@endsection