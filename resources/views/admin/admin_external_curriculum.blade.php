@extends('admin.app')

@section('content')
<style>
/* Main Styles */
.curriculum-section {
    margin-bottom: 30px;
    padding: 20px;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.08);
}

.curriculum-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 3px solid #3498db;
}

.curriculum-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.curriculum-list li {
    padding: 12px 0;
    border-bottom: 1px solid #ecf0f1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}

.curriculum-list li:last-child {
    border-bottom: none;
}

.curriculum-list li strong {
    color: #34495e;
    font-size: 1rem;
}

/* Sidebar */
.curriculum-sidebar {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 600px;
    overflow-y: auto;
    border-right: 1px solid #e0e0e0;
    padding-right: 10px;
}

.curriculum-sidebar li {
    padding: 10px 8px;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 0.95rem;
    border-radius: 5px;
}

.curriculum-sidebar li:hover,
.curriculum-sidebar li.active {
    background: #3498db;
    color: white;
}

/* Button Styles */
.btn-preview {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.btn-preview:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.btn-preview i {
    margin-right: 5px;
}

/* Security Notice */
.security-notice {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    padding: 12px 20px;
    border-radius: 6px;
    text-align: center;
    font-weight: 600;
    margin-bottom: 15px;
    box-shadow: 0 2px 8px rgba(245, 87, 108, 0.3);
}

/* Preview Container */
.preview-container {
    width: 100%;
    margin-top: 15px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height 0.4s ease, opacity 0.3s ease, padding 0.4s ease;
}

.preview-container.show {
    max-height: 800px;
    opacity: 1;
    padding: 20px;
}

/* Iframe Wrapper */
.iframe-wrapper {
    position: relative;
    width: 100%;
    height: 600px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    overflow: auto;
    background: #fafafa;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.iframe-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
    background: transparent;
    pointer-events: none;
}

.iframe-preview {
    width: 100%;
    height: 100%;
    min-height: 600px;
    border: none;
    display: block;
}

/* Watermarks */
.corner-watermark {
    position: fixed;
    font-size: 0.85rem;
    color: rgba(0, 0, 0, 0.4);
    font-weight: 700;
    pointer-events: none;
    z-index: 999;
    background: rgba(255, 255, 255, 0.85);
    padding: 6px 12px;
    border-radius: 6px;
    user-select: none;
    backdrop-filter: blur(5px);
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.corner-watermark.top-left {
    top: 20px;
    left: 20px;
}

.corner-watermark.top-right {
    top: 20px;
    right: 20px;
}

/* Card Enhancements */
.card {
    border: none;
    border-radius: 10px;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
    padding: 20px;
}

.card-body {
    padding: 30px;
}

/* Responsive */
@media (max-width: 768px) {
    .curriculum-list li {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .iframe-wrapper {
        height: 400px;
    }
    
    .iframe-preview {
        min-height: 400px;
    }
    
    .curriculum-sidebar {
        max-height: 300px;
    }
}
</style>

@php
function getDriveFileId($url) {
    preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $url, $matches);
    return $matches[1] ?? null;
}
@endphp

<div class="row my-4">
    <div class="col-md-11 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header bgc-primary">
                <h3 class="bgc-primary-text mb-0">
                    <i class="fa fa-book"></i> Curriculum Details – {{ $course->title }}
                </h3>
            </div>
            <div class="card-body">
                @php $existing = json_decode($course->curriculum,true) ?? []; @endphp

                @if(count($existing))
                    @foreach($existing as $index => $item)
                        <div class="curriculum-section">
                            <div class="curriculum-title">
                                <i class="fa fa-folder-open"></i> {{ $item['title'] }}
                            </div>

                            @php
                                $pdfPoints = collect($item['points'])->filter(fn($p) => !empty($p['url']));
                            @endphp

                            @if($pdfPoints->count())
                                <div class="row">
                                    <div class="col-md-3">
                                        <ul class="curriculum-sidebar">
                                            @foreach($pdfPoints as $pointIndex => $point)
                                                <li data-target="preview-{{ $index }}-{{ $pointIndex }}">
                                                    {{ $point['text'] ?? $point }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-9">
                                        <ul class="curriculum-list">
                                            @foreach($item['points'] as $pointIndex => $point)
                                                <li>
                                                    <strong>
                                                        <i class="fa fa-check-circle" style="color: #27ae60; margin-right: 8px;"></i>
                                                        {{ $point['text'] ?? $point }}
                                                    </strong>
                                                    @if(!empty($point['url']))
                                                        @php
                                                            $fileId = getDriveFileId($point['url']);
                                                            $uniqueId = "preview-{$index}-{$pointIndex}";
                                                        @endphp
                                                        @if($fileId)
                                                            <button class="btn-preview" onclick="togglePreview('{{ $uniqueId }}', this)">
                                                                <i class="fa fa-eye"></i> <span>View Content</span>
                                                            </button>

                                                            <div id="{{ $uniqueId }}" class="preview-container">
                                                                <div class="security-notice">
                                                                    🔒 View Only – Protected Content – No Downloads Allowed
                                                                </div>
                                                                <div class="iframe-wrapper" oncontextmenu="return false;">
                                                                    <div class="corner-watermark top-left">🔒 VIEW ONLY</div>
                                                                    <div class="corner-watermark top-right">PROTECTED</div>
                                                                    <iframe class="iframe-preview"
                                                                            data-src="https://drive.google.com/file/d/{{ $fileId }}/preview"
                                                                            allow="autoplay"
                                                                            sandbox="allow-scripts allow-same-origin">
                                                                    </iframe>
                                                                    <div class="iframe-overlay"></div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <ul class="curriculum-list">
                                    @foreach($item['points'] as $pointIndex => $point)
                                        <li>
                                            <strong>
                                                <i class="fa fa-check-circle" style="color: #27ae60; margin-right: 8px;"></i>
                                                {{ $point['text'] ?? $point }}
                                            </strong>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="fa fa-inbox" style="font-size: 4rem; color: #bdc3c7;"></i>
                        <p class="mt-3" style="color: #7f8c8d; font-size: 1.1rem;">No curriculum added yet.</p>
                    </div>
                @endif

                <a href="{{ url()->previous() }}" class="btn btn-danger mt-4">
                    <i class="fa fa-arrow-left"></i> Go Back
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Prevent right-click on iframe wrapper
document.addEventListener('contextmenu', e => {
    if(e.target.closest('.iframe-wrapper')) {
        e.preventDefault();
        return false;
    }
});

// Prevent common keyboard shortcuts
document.addEventListener('keydown', e => {
    if(document.querySelector('.preview-container.show')) {
        if(e.ctrlKey && (e.key === 's' || e.key === 'p' || e.key === 'S' || e.key === 'P')) {
            e.preventDefault();
            alert('⚠️ This action is disabled for content protection.');
            return false;
        }
        if(e.key === 'F12') { e.preventDefault(); return false; }
        if(e.ctrlKey && e.shiftKey && e.key === 'I') { e.preventDefault(); return false; }
    }
});

// Prevent iframe pop-out attempts
document.addEventListener('click', e => {
    if(e.target.closest('.iframe-preview')) {
        e.preventDefault();
        e.stopPropagation();
        return false;
    }
});

function togglePreview(id, btn) {
    const container = document.getElementById(id);
    const iframe = container.querySelector('iframe');
    const text = btn.querySelector('span');
    const icon = btn.querySelector('i');

    if(container.classList.contains('show')) {
        container.classList.remove('show');
        text.textContent = 'View Content';
        icon.className = 'fa fa-eye';
    } else {
        container.classList.add('show');
        text.textContent = 'Hide Content';
        icon.className = 'fa fa-eye-slash';
        
        if(!iframe.src || iframe.src === '') {
            iframe.src = iframe.getAttribute('data-src');
        }
    }
}

// Highlight side navigation
document.querySelectorAll('.curriculum-sidebar li').forEach(li => {
    li.addEventListener('click', () => {
        const targetId = li.getAttribute('data-target');
        const target = document.getElementById(targetId);
        if(target) target.scrollIntoView({ behavior: 'smooth' });
    });
});

window.addEventListener('scroll', () => {
    document.querySelectorAll('.curriculum-sidebar li').forEach(li => {
        const targetId = li.getAttribute('data-target');
        const target = document.getElementById(targetId);
        if(target) {
            const rect = target.getBoundingClientRect();
            if(rect.top >= 0 && rect.top < window.innerHeight / 2) {
                li.classList.add('active');
            } else {
                li.classList.remove('active');
            }
        }
    });
});

// Additional security: Monitor and prevent iframe manipulation
setInterval(() => {
    document.querySelectorAll('.iframe-preview').forEach(iframe => {
        if(iframe.src && !iframe.hasAttribute('data-protected')) {
            iframe.setAttribute('data-protected', 'true');
            if(!iframe.hasAttribute('sandbox')) {
                iframe.setAttribute('sandbox', 'allow-scripts allow-same-origin');
            }
        }
    });
}, 1000);
</script>
@endsection
