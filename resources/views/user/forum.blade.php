@extends('user.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">
                        <i class="bi bi-chat-dots-fill text-primary me-2"></i>
                        Community Forum
                    </h2>
                    <p class="text-muted mb-0">Connect, discuss, and learn together</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    {{-- <span class="badge bg-light text-dark px-3 py-2">
                        <i class="bi bi-people-fill me-1"></i>
                        1,234 Active Members
                    </span> --}}
                </div>
            </div>

            @php
                $categories = ['All Threads', 'Course Discussion', 'Technical Support', 'General Discussion'];
            @endphp

            <!-- Category Tabs -->
            <ul class="nav nav-pills nav-fill bg-light rounded-3 p-1 mb-4">
                @foreach ($categories as $cat)
                    <li class="nav-item">
                        <a class="nav-link rounded-2 category-tab {{ $loop->first ? 'active' : '' }}"
                           href="#"
                           data-category="{{ $cat }}">
                            @if($cat == 'Course Discussion')
                                <i class="bi bi-book me-1"></i>
                            @elseif($cat == 'Technical Support')
                                <i class="bi bi-tools me-1"></i>
                            @elseif($cat == 'General Discussion')
                                <i class="bi bi-chat-dots me-1"></i>
                            @else
                                <i class="bi bi-globe me-1"></i>
                            @endif
                            {{ $cat }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <!-- Search & Create -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="flex-grow-1 me-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search threads...">
                    </div>
                </div>
                <button style="background:#0E2293;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createThreadModal">Create Thread</button>
            </div>

            <!-- Threads -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush" id="threadList">
                        @foreach ($threads as $index => $thread)
                            <div class="list-group-item border-0 p-4 hover-bg-light position-relative thread-item {{ $index >= 2 ? 'd-none' : '' }}"
                                 data-category="{{ $thread['category'] }}"
                                 data-title="{{ strtolower($thread['title']) }}"
                                 data-content="{{ strtolower($thread['content']) }}">
                                
                                @php
                                    $colors = ['#dc3545', '#ffc107', '#28a745', '#6366f1', '#0d6efd'];
                                    $color = $colors[$loop->index % count($colors)];
                                @endphp

                                <div class="d-flex gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle shadow-sm d-flex align-items-center justify-content-center text-white fw-bold" 
                                             style="width: 48px; height: 48px; background-color: {{ $color }};">
                                            {{ strtoupper(substr(optional($thread['user'])->name ?? 'U', 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="fw-bold mb-1 text-dark">{{ $thread['title'] }}</h6>
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <span class="badge text-white" style="background-color: {{ $color }};">{{ $thread['category'] }}</span>
                                                    <span class="text-muted small"><i class="bi bi-person-circle me-1"></i>{{ optional($thread['user'])->name }}</span>
                                                    <span class="text-muted small">
                                                        <i class="bi bi-clock me-1"></i>{{ $thread['created_at']->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </div>

                                           @if (Auth::user()->id === $thread->user_id)
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="#" class="dropdown-item text-danger" onclick="confirmDelete({{ $thread->id }})">
                                                                <i class="badge bg-danger fa fa-trash me-2"></i>
                                                                Delete Thread
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <!-- Hidden Delete Form -->
                                                <form id="delete-thread-form-{{ $thread->id }}" method="POST" action="{{ route('threads.destroy', $thread->id) }}" style="display: none;">
                                                    @csrf
                                                </form>
                                            @endif

                                        </div>
                                        <p class="text-muted mb-3 lh-base">{{ $thread['content'] }}</p>
                                        <div class="d-flex align-items-center gap-4">
                                            <div class="d-flex align-items-center text-muted"><i class="fa fa-comments me-1"></i><span class="fw-medium">{{ $thread['reply_count'] }}</span><span class="small ms-1">replies</span></div>
                                            <div class="d-flex align-items-center text-muted"><i class="fa fa-eye me-1"></i><span class="fw-medium">{{ $thread['views'] }}</span><span class="small ms-1">views</span></div>
                                            <div class="ms-auto"><a href="{{ route('threads.show',  $thread->id) }}" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fa fa-reply me-1"></i>Reply</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Load More -->
                <div class="card-footer bg-white border-0 text-center py-3">
                    <button id="loadMoreBtn" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-arrow-down-circle me-2"></i>
                        Load More Threads
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<!-- Create Thread Modal -->
<div class="modal fade" id="createThreadModal" tabindex="-1" aria-labelledby="createThreadLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="createThreadForm" class="modal-content" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Create New Thread</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Thread Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter title">
                    <span class="text-danger small error-title"></span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Select a Category</label>
                    <select name="category" class="form-select">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger small error-category"></span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Thread Content</label>
                    <textarea name="content" class="form-control" rows="4" placeholder="Write something..."></textarea>
                    <span class="text-danger small error-content"></span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Details (optional)</label>
                    <input type="file" name="attachment" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-plus me-1"></i> Create Thread
                </button>
                <button type="button" class="btn btn-primary d-none" id="processingBtn" disabled>
                    <i class="fas fa-spinner fa-spin me-1"></i> Processing...
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Styles -->
<style>
.hover-bg-light:hover {
    background-color: #f8f9fa !important;
    transition: background-color 0.2s ease;
}
.nav-pills .nav-link.active {
    background-color: #E9ECFF !important;
    color: #0E2293 !important;
}
.nav-pills .nav-link {
    color: #6c757d;
    font-weight: 500;
}
.nav-pills .nav-link:hover {
    color: #6366f1;
}
.list-group-item {
    transition: all 0.2s ease;
}
.list-group-item:hover {
    transform: translateX(2px);
}
</style>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    const categoryTabs = document.querySelectorAll('.category-tab');
    const threadItems = document.querySelectorAll('.thread-item');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const searchInput = document.getElementById('searchInput');
    let visibleCount = 10;
    let currentCategory = 'All Threads';
    let currentSearch = '';

    function filterThreads(category = currentCategory, searchTerm = currentSearch) {
        currentCategory = category;
        currentSearch = searchTerm;
        
        let shown = 0;
        threadItems.forEach(item => {
            const matchesCategory = category === 'All Threads' || item.dataset.category === category;
            const matchesSearch = searchTerm === '' || 
                                item.dataset.title.includes(searchTerm.toLowerCase()) || 
                                item.dataset.content.includes(searchTerm.toLowerCase());
            
            if (matchesCategory && matchesSearch) {
                if (shown < visibleCount) {
                    item.classList.remove('d-none');
                } else {
                    item.classList.add('d-none');
                }
                shown++;
            } else {
                item.classList.add('d-none');
            }
        });

        const hiddenCount = Array.from(threadItems).filter(item => {
            const matchesCategory = category === 'All Threads' || item.dataset.category === category;
            const matchesSearch = searchTerm === '' || 
                                item.dataset.title.includes(searchTerm.toLowerCase()) || 
                                item.dataset.content.includes(searchTerm.toLowerCase());
            return matchesCategory && matchesSearch && item.classList.contains('d-none');
        }).length;

        loadMoreBtn.style.display = hiddenCount > 0 ? 'block' : 'none';
    }

    categoryTabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();
            categoryTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            visibleCount = 2;
            filterThreads(this.dataset.category, currentSearch);
        });
    });

    searchInput.addEventListener('input', function() {
        visibleCount = 2;
        filterThreads(currentCategory, this.value);
    });

    loadMoreBtn.addEventListener('click', function () {
        let shown = 0;
        threadItems.forEach(item => {
            const matchesCategory = currentCategory === 'All Threads' || item.dataset.category === currentCategory;
            const matchesSearch = currentSearch === '' || 
                                item.dataset.title.includes(currentSearch.toLowerCase()) || 
                                item.dataset.content.includes(currentSearch.toLowerCase());
            
            if (matchesCategory && matchesSearch && item.classList.contains('d-none') && shown < 2) {
                item.classList.remove('d-none');
                shown++;
            }
        });

        const hiddenCount = Array.from(threadItems).filter(item => {
            const matchesCategory = currentCategory === 'All Threads' || item.dataset.category === currentCategory;
            const matchesSearch = currentSearch === '' || 
                                item.dataset.title.includes(currentSearch.toLowerCase()) || 
                                item.dataset.content.includes(currentSearch.toLowerCase());
            return matchesCategory && matchesSearch && item.classList.contains('d-none');
        }).length;

        if (hiddenCount <= 0) {
            loadMoreBtn.style.display = 'none';
        }
    });

    // Init on load
    filterThreads('All Threads');
});
</script>

<!-- Font Awesome (for spinner icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const threadForm = document.getElementById('createThreadForm');
    const submitBtn = document.getElementById('submitBtn');
    const processingBtn = document.getElementById('processingBtn');

    threadForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Toggle buttons
        submitBtn.classList.add('d-none');
        processingBtn.classList.remove('d-none');

        // Clear error messages
        threadForm.querySelectorAll('span.text-danger').forEach(el => el.textContent = '');

        const formData = new FormData(threadForm);

        fetch("{{ route('threads.store') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => {
            submitBtn.classList.remove('d-none');
            processingBtn.classList.add('d-none');

            if (response.status === 422) {
                return response.json().then(data => Promise.reject(data.errors));
            }
            return response.json();
        })
        .then(data => {
            // ✅ Hide the modal
            bootstrap.Modal.getInstance(document.getElementById('createThreadModal')).hide();

            // ✅ Show SweetAlert
            Swal.fire({
                title: 'Success!',
                text: data.message || 'Thread created successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.reload();
            });
        })
        .catch(errors => {
            submitBtn.classList.remove('d-none');
            processingBtn.classList.add('d-none');

            // Show inline validation errors
            if (errors.title) {
                document.querySelector('.error-title').textContent = errors.title[0];
            }
            if (errors.category) {
                document.querySelector('.error-category').textContent = errors.category[0];
            }
            if (errors.content) {
                document.querySelector('.error-content').textContent = errors.content[0];
            }
        });
    });
});
</script>

<script>
    function confirmDelete(threadId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will delete the thread and all its replies!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-thread-form-' + threadId).submit();
            }
        });
    }
</script>