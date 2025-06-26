@extends('user.app')

@section('content')
<div class="page-inner">
    <!-- Header with Back Button -->
    <div class="page-header mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <button onclick="goBack()" class="btn btn-back me-3">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <div>
                    <h2 class="page-title text-dark fw-bold mb-1">{{ $course_title->title }}</h2>
                </div>
            </div>
            <div class="header-stats">
                <div class="stat-badge">
                    <i class="fas fa-file-alt me-2"></i>
                    {{ count($resources) }} Resources
                </div>
            </div>
        </div>
    </div>

    <!-- Resources Content -->
    <div class="resources-container">
        <div class="resources-grid">
            @php $i = 1; @endphp
            @foreach($resources as $resource)
                @php
                    $filePath = $resource->image ?? $resource->file ?? $resource->path;
                    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                    $fileUrl = asset($filePath);
                    
                    // Determine file type and icon
                    $fileType = 'document';
                    $fileIcon = 'fas fa-file';
                    
                    if (in_array($fileExtension, ['pdf'])) {
                        $fileType = 'pdf';
                        $fileIcon = 'fas fa-file-pdf';
                    } elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
                        $fileType = 'image';
                        $fileIcon = 'fas fa-image';
                    } elseif (in_array($fileExtension, ['doc', 'docx'])) {
                        $fileType = 'document';
                        $fileIcon = 'fas fa-file-word';
                    } elseif (in_array($fileExtension, ['xls', 'xlsx'])) {
                        $fileType = 'spreadsheet';
                        $fileIcon = 'fas fa-file-excel';
                    } elseif (in_array($fileExtension, ['ppt', 'pptx'])) {
                        $fileType = 'presentation';
                        $fileIcon = 'fas fa-file-powerpoint';
                    } elseif (in_array($fileExtension, ['mp4', 'avi', 'mov', 'wmv'])) {
                        $fileType = 'video';
                        $fileIcon = 'fas fa-file-video';
                    } elseif (in_array($fileExtension, ['mp3', 'wav', 'ogg'])) {
                        $fileType = 'audio';
                        $fileIcon = 'fas fa-file-audio';
                    }
                @endphp
                
                <div class="resource-item" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="resource-card">
                        <div class="resource-header">
                            <div class="resource-icon {{ $fileType }}-icon">
                                <i class="{{ $fileIcon }}"></i>
                            </div>
                            <div class="resource-number">{{ $i++ }}</div>
                        </div>
                        
                        <div class="resource-content">
                            <h5 class="resource-title">{{ $resource->title }}</h5>
                            <p class="resource-meta">
                                <i class="fas fa-calendar me-2"></i>
                                Added {{ \Carbon\Carbon::parse($resource->created_at)->diffForHumans() }}
                            </p>
                            <div class="file-info">
                                <span class="file-type-badge">{{ strtoupper($fileExtension) }}</span>
                                @if(file_exists(public_path($filePath)))
                                    <span class="file-size">{{ formatBytes(filesize(public_path($filePath))) }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="resource-actions">
                            <button class="btn btn-view" data-bs-toggle="modal" data-bs-target="#viewerModal{{ $resource->id }}">
                                <i class="fas fa-eye me-2"></i>
                                View Resource
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Modal with Proper File Display -->
                <div class="modal fade resource-modal" id="viewerModal{{ $resource->id }}" tabindex="-1" aria-labelledby="viewerModalLabel{{ $resource->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="modal-title me-3">{{ $resource->title }}</h5>
                                    <span class="resource-badge">Protected Content</span>
                                    <span class="file-type-badge ms-2">{{ strtoupper($fileExtension) }}</span>
                                </div>
                                <div class="modal-actions">
                                    <button type="button" class="btn btn-light btn-sm me-2" onclick="toggleFullscreen('viewerModal{{ $resource->id }}')">
                                        <i class="fas fa-expand"></i>
                                    </button>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="modal-body position-relative overflow-auto" style="height: calc(100vh - 120px);">
    <!-- Protection overlay -->
    <div class="protection-overlay" oncontextmenu="return false;" onselectstart="return false;" ondragstart="return false;"></div>

    <!-- File viewer based on type -->
    <div class="file-viewer p-3" id="viewer{{ $resource->id }}">
        @if($fileType === 'pdf')
            <iframe 
                src="{{ $fileUrl }}#toolbar=0&navpanes=0&scrollbar=1&view=FitH&zoom=100" 
                class="file-frame"
                allowfullscreen
                onload="setupFileProtection(this)"
                style="width: 100%; height: 100vh; border: none;"
            ></iframe>
        @elseif($fileType === 'image')
            <div class="image-viewer text-center">
                <img src="{{ $fileUrl }}" alt="{{ $resource->title }}" class="protected-image img-fluid" style="max-height: 80vh;" />
            </div>
        @elseif(in_array($fileType, ['video']))
            <video class="video-viewer w-100" controls controlsList="nodownload" oncontextmenu="return false;" style="max-height: 80vh;">
                <source src="{{ $fileUrl }}" type="video/{{ $fileExtension }}">
                Your browser does not support the video tag.
            </video>
        @elseif($fileType === 'audio')
            <div class="audio-viewer">
                <audio controls controlsList="nodownload" class="w-100">
                    <source src="{{ $fileUrl }}" type="audio/{{ $fileExtension }}">
                    Your browser does not support the audio element.
                </audio>
            </div>
        @else
            <div class="document-viewer text-center">
                <div class="document-placeholder">
                    <i class="{{ $fileIcon }} fa-4x mb-3"></i>
                    <h4>{{ $resource->title }}</h4>
                    <p class="text-muted">This file type cannot be previewed online.</p>
                    <p class="text-muted">File type: {{ strtoupper($fileExtension) }}</p>

                    @if(in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                        <button class="btn btn-primary" onclick="openInGoogleViewer('{{ $fileUrl }}', '{{ $resource->id }}')">
                            <i class="fas fa-external-link-alt me-2"></i>
                            Open in Viewer
                        </button>
                        <div id="google-viewer-{{ $resource->id }}" class="google-viewer mt-3" style="display: none;">
                            <iframe src="" class="file-frame" style="width: 100%; height: 80vh; border: none;"></iframe>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if(count($resources) == 0)
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h4 class="empty-state-title">No Resources Available</h4>
                <p class="empty-state-text">Resources for this course haven't been uploaded yet.</p>
                <button onclick="goBack()" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Go Back
                </button>
            </div>
        @endif
    </div>
</div>

@php
function formatBytes($size, $precision = 2) {
    $base = log($size, 1024);
    $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}
@endphp

<style>


.btn-back {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--white);
    border: 2px solid var(--accent-purple);
    color: var(--accent-purple);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 16px rgba(142, 68, 173, 0.2);
}

.btn-back:hover {
    background: var(--accent-purple);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(142, 68, 173, 0.3);
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-dark);
}

.stat-badge {
    background: var(--white);
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    color: var(--text-dark);
    box-shadow: 0 4px 16px var(--shadow-light);
    border: 1px solid rgba(233, 236, 255, 0.3);
}

/* Resources Grid */
.resources-container {
    margin-top: 2rem;
}

.resources-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
}

.resource-item {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.6s ease forwards;
}

.resource-card {
    background: var(--white);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px var(--shadow-light);
    border: 1px solid rgba(233, 236, 255, 0.3);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.resource-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--accent-gold), var(--accent-purple));
}

.resource-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px var(--shadow-medium);
}

.resource-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.resource-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-cream), var(--primary-lavender));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--accent-purple);
    border: 2px solid rgba(142, 68, 173, 0.1);
}

/* File type specific icons */
.pdf-icon { color: var(--danger) !important; }
.image-icon { color: var(--success) !important; }
.document-icon { color: var(--info) !important; }
.video-icon { color: var(--warning) !important; }
.audio-icon { color: var(--accent-purple) !important; }

.resource-number {
    width: 35px;
    height: 35px;
    background: var(--accent-purple);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
}

.resource-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    line-height: 1.4;
}

.resource-meta {
    color: var(--text-muted);
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.file-info {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.file-type-badge {
    background: var(--accent-purple);
    color: var(--white);
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
}

.file-size {
    background: var(--primary-lavender);
    color: var(--text-dark);
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.7rem;
    font-weight: 500;
}

.btn-view {
    background: linear-gradient(135deg, var(--accent-purple), #9B59B6);
    color: var(--white);
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(142, 68, 173, 0.3);
    width: 100%;
}

.btn-view:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(142, 68, 173, 0.4);
    color: var(--white);
}

/* Enhanced Modal Styling */
.resource-modal .modal-content {
    border-radius: 0;
    border: none;
    box-shadow: none;
}

.resource-modal .modal-header {
    background: linear-gradient(135deg, var(--primary-cream), var(--primary-lavender));
    border-bottom: 1px solid rgba(233, 236, 255, 0.3);
    padding: 1.5rem 2rem;
}

.resource-badge {
    background: var(--accent-purple);
    color: var(--white);
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.modal-actions {
    display: flex;
    align-items: center;
}

/* File Viewers */
.file-viewer {
    position: relative;
    width: 100%;
    height: 100%;
}

.file-frame {
    width: 100%;
    height: 100%;
    border: none;
    pointer-events: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.image-viewer {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    background: #f8f9fa;
}

.protected-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    pointer-events: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.video-viewer {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.audio-viewer {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 2rem;
    background: linear-gradient(135deg, var(--primary-cream), var(--primary-lavender));
}

.document-viewer {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    background: linear-gradient(135deg, var(--primary-cream), var(--primary-lavender));
}

.document-placeholder {
    text-align: center;
    padding: 2rem;
}

.document-placeholder i {
    color: var(--accent-purple);
    margin-bottom: 1rem;
}

.google-viewer {
    width: 100%;
    height: calc(100% - 60px);
    margin-top: 1rem;
}

/* Download Protection Overlay */
.protection-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 10;
    background: transparent;
    cursor: not-allowed;
}

/* Empty State */
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
}

/* Animations */
@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .resources-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .page-header {
        padding: 1.5rem;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .resource-card {
        padding: 1.5rem;
    }
    
    .header-stats {
        display: none;
    }
}

/* Security Styles */
iframe, img, video, audio {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.modal-body {
    overflow: hidden;
}

.resource-modal {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>

<script>
// Enhanced Security and Navigation Functions
document.addEventListener('DOMContentLoaded', function() {
    // Disable right-click globally
    document.addEventListener('contextmenu', event => event.preventDefault());
    
    // Disable text selection
    document.addEventListener('selectstart', event => event.preventDefault());
    
    // Disable drag and drop
    document.addEventListener('dragstart', event => event.preventDefault());
    
    // Disable keyboard shortcuts for saving/printing
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey && (e.key === 's' || e.key === 'p' || e.key === 'a')) || e.key === 'F12') {
            e.preventDefault();
            return false;
        }
    });
    
    // Disable developer tools detection
    let devtools = { open: false };
    setInterval(() => {
        if (window.outerHeight - window.innerHeight > 160 || window.outerWidth - window.innerWidth > 160) {
            if (!devtools.open) {
                devtools.open = true;
                console.clear();
                console.log('%cAccess Denied', 'color: red; font-size: 50px; font-weight: bold;');
            }
        } else {
            devtools.open = false;
        }
    }, 500);
});

// Navigation function
function goBack() {
    if (document.referrer && document.referrer.indexOf(window.location.hostname) !== -1) {
        window.history.back();
    } else {
        window.location.href = "{{ url()->previous() }}";
    }
}

// Fullscreen toggle
function toggleFullscreen(modalId) {
    const modal = document.getElementById(modalId);
    if (!document.fullscreenElement) {
        modal.requestFullscreen().catch(err => {
            console.log(`Error attempting to enable fullscreen: ${err.message}`);
        });
    } else {
        document.exitFullscreen();
    }
}

// Setup file protection
function setupFileProtection(iframe) {
    try {
        // Additional iframe protections
        iframe.contentDocument.addEventListener('contextmenu', e => e.preventDefault());
        iframe.contentDocument.addEventListener('selectstart', e => e.preventDefault());
        iframe.contentDocument.addEventListener('dragstart', e => e.preventDefault());
        iframe.contentDocument.body.style.overflow = 'hidden';
    } catch (e) {
        console.log('Cross-origin iframe - additional protections may be limited');
    }
}

// Google Docs Viewer for office documents
function openInGoogleViewer(fileUrl, resourceId) {
    const viewer = document.getElementById(`google-viewer-${resourceId}`);
    const iframe = viewer.querySelector('iframe');
    
    // Use Google Docs Viewer
    iframe.src = `https://docs.google.com/viewer?url=${encodeURIComponent(fileUrl)}&embedded=true`;
    viewer.style.display = 'block';
}

// Prevent modal from being closed by ESC key when viewing protected content
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.querySelector('.resource-modal.show')) {
        // Optional: prevent ESC closing
        // e.preventDefault();
    }
});

// Add warning when user tries to leave page
window.addEventListener('beforeunload', function(e) {
    const openModal = document.querySelector('.resource-modal.show');
    if (openModal) {
        e.preventDefault();
        e.returnValue = '';
        return '';
    }
});

// Monitor for print attempts
window.addEventListener('beforeprint', function(e) {
    alert('Printing is not allowed for protected content.');
    e.preventDefault();
    return false;
});

// Clear console periodically
setInterval(() => {
    console.clear();
}, 2000);

// Handle modal shown event
document.addEventListener('shown.bs.modal', function(e) {
    if (e.target.classList.contains('resource-modal')) {
        // Focus protection when modal opens
        const modal = e.target;
        const protectionOverlay = modal.querySelector('.protection-overlay');
        if (protectionOverlay) {
            protectionOverlay.focus();
        }
    }
});
</script>
@endsection