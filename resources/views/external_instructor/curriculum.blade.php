



@extends('external_instructor.app')

@section('content')
<div class="row" style="margin:10px">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header bgc-primary">
                <div class="card-title">
                    <h3 class="bgc-primary-text" style="text-align: left;">Set Curriculum ({{ $course->title }})</h3>
                </div>
            </div>
            <div class="card-body">
                @php
                    $existing = json_decode($course->curriculum, true) ?? [];
                @endphp

                <form action="{{ route('in.course.saveCurriculum', $course->id) }}" method="post">
                    @csrf

                    <div id="curriculum-wrapper">
                        @foreach($existing as $index => $item)
                            <div class="outline-item mb-4 border rounded p-3">
                                <div class="form-group">
                                    <label>Outline Title</label>
                                    <input type="text" name="curriculum[{{ $index }}][title]" class="form-control" value="{{ $item['title'] }}" required>
                                </div>

                                <label class="mt-2">Points</label>
                                <div class="points-list">
                                    @foreach($item['points'] as $pIndex => $point)
                                        <div class="point-group mb-3 border-bottom pb-2">
                                            <input type="text" name="curriculum[{{ $index }}][points][{{ $pIndex }}][text]" class="form-control mb-2" value="{{ $point['text'] ?? $point }}" placeholder="Point text" required>
                                            
                                            <input type="hidden" name="curriculum[{{ $index }}][points][{{ $pIndex }}][url]" class="url-hidden" value="{{ $point['url'] ?? '' }}">
                                            <input type="hidden" class="file-id-hidden" value="">
                                            
                                            <div class="file-control">
                                                @if(isset($point['url']) && $point['url'] && !str_starts_with($point['url'], '!#'))
                                                    <div class="file-info">
                                                        <a href="{{ $point['url'] }}" target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fa fa-file"></i> View File
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-warning btn-replace">
                                                            <i class="fa fa-sync"></i> Replace
                                                        </button>
                                                        <button style="display:none" type="button" class="btn btn-sm btn-danger btn-delete">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="file-upload">
                                                        <button type="button" class="btn btn-sm btn-primary btn-upload">
                                                            <i class="fa fa-upload"></i> Upload File
                                                        </button>
                                                        <input type="file" class="file-input" style="display:none;">
                                                        <span class="status-text ms-2"></span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Remove point button -->
                                            <button type="button" class="btn btn-sm btn-danger remove-point mt-2">Remove Point</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary add-point">+ Add Point</button>
                                <button type="button" class="btn btn-sm btn-danger remove-outline float-end">Remove Section</button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-outline-primary my-3" id="add-outline">+ Add Outline Section</button>

                    <div class="card-action">
                        <a href="{{ route('in.course.all') }}" class="btn btn-danger">Go Back</a>
                        <button type="submit" class="btn btn-primary">Save Curriculum</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.file-control {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
}
.status-text { font-size: 0.9em; }
.status-text.uploading { color: #0056b3; font-weight: bold; }
.status-text.success { color: #28a745; }
.status-text.error { color: #dc3545; }
</style>

<script>
let outlineCount = {{ count($existing) }};

// Add outline section
document.getElementById('add-outline').addEventListener('click', function () {
    const wrapper = document.getElementById('curriculum-wrapper');
    const div = document.createElement('div');
    div.classList.add('outline-item', 'mb-4', 'border', 'rounded', 'p-3');
    div.innerHTML = `
        <div class="form-group">
            <label>Outline Title</label>
            <input type="text" name="curriculum[${outlineCount}][title]" class="form-control" required>
        </div>

        <label class="mt-2">Points</label>
        <div class="points-list">
            <div class="point-group mb-3 border-bottom pb-2">
                <input type="text" name="curriculum[${outlineCount}][points][0][text]" class="form-control mb-2" placeholder="Point text" required>
                <input type="hidden" name="curriculum[${outlineCount}][points][0][url]" class="url-hidden">
                <input type="hidden" class="file-id-hidden" value="">
                
                <div class="file-control">
                    <div class="file-upload">
                        <button type="button" class="btn btn-sm btn-primary btn-upload">
                            <i class="fa fa-upload"></i> Upload File
                        </button>
                        <input type="file" class="file-input" style="display:none;">
                        <span class="status-text ms-2"></span>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-danger remove-point mt-2">Remove Point</button>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-secondary add-point">+ Add Point</button>
        <button type="button" class="btn btn-sm btn-danger remove-outline float-end">Remove Section</button>
    `;
    wrapper.appendChild(div);
    outlineCount++;
});

// Handle clicks for add/remove points, outlines, upload/replace/delete
document.addEventListener('click', function (e) {
    // Add point
    if (e.target.classList.contains('add-point') || e.target.parentElement.classList.contains('add-point')) {
        const button = e.target.classList.contains('add-point') ? e.target : e.target.parentElement;
        const pointsList = button.previousElementSibling;
        const pointIndex = pointsList.querySelectorAll('.point-group').length;
        const outlineIndex = Array.from(document.querySelectorAll('.outline-item')).indexOf(button.closest('.outline-item'));
        
        const div = document.createElement('div');
        div.classList.add('point-group', 'mb-3', 'border-bottom', 'pb-2');
        div.innerHTML = `
            <input type="text" name="curriculum[${outlineIndex}][points][${pointIndex}][text]" class="form-control mb-2" placeholder="Point text" required>
            <input type="hidden" name="curriculum[${outlineIndex}][points][${pointIndex}][url]" class="url-hidden">
            <input type="hidden" class="file-id-hidden" value="">
            
            <div class="file-control">
                <div class="file-upload">
                    <button type="button" class="btn btn-sm btn-primary btn-upload">
                        <i class="fa fa-upload"></i> Upload File
                    </button>
                    <input type="file" class="file-input" style="display:none;">
                    <span class="status-text ms-2"></span>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-danger remove-point mt-2">Remove Point</button>
        `;
        pointsList.appendChild(div);
    }

    // Remove outline section
    if (e.target.classList.contains('remove-outline') || e.target.parentElement.classList.contains('remove-outline')) {
        const button = e.target.classList.contains('remove-outline') ? e.target : e.target.parentElement;
        button.closest('.outline-item').remove();
    }

    // Remove individual point
    if (e.target.classList.contains('remove-point') || e.target.parentElement.classList.contains('remove-point')) {
        const button = e.target.classList.contains('remove-point') ? e.target : e.target.parentElement;
        button.closest('.point-group').remove();
    }

    // Upload button clicked
    if (e.target.classList.contains('btn-upload') || e.target.parentElement.classList.contains('btn-upload')) {
        const button = e.target.classList.contains('btn-upload') ? e.target : e.target.parentElement;
        const pointGroup = button.closest('.point-group');
        const fileInput = pointGroup.querySelector('.file-input');
        fileInput.click();
    }

    // Replace button clicked
    if (e.target.classList.contains('btn-replace') || e.target.parentElement.classList.contains('btn-replace')) {
        const button = e.target.classList.contains('btn-replace') ? e.target : e.target.parentElement;
        const pointGroup = button.closest('.point-group');
        const fileInput = pointGroup.querySelector('.file-input') || document.createElement('input');
        fileInput.type = 'file';
        fileInput.style.display = 'none';
        
        fileInput.onchange = function() {
            if (this.files.length > 0) {
                const oldFileId = pointGroup.querySelector('.file-id-hidden').value;
                uploadFile(this.files[0], pointGroup, oldFileId);
            }
        };
        
        pointGroup.appendChild(fileInput);
        fileInput.click();
    }

    // Delete button clicked
    if (e.target.classList.contains('btn-delete') || e.target.parentElement.classList.contains('btn-delete')) {
        if (confirm('Delete this file from Google Drive?')) {
            const button = e.target.classList.contains('btn-delete') ? e.target : e.target.parentElement;
            const pointGroup = button.closest('.point-group');
            const fileId = pointGroup.querySelector('.file-id-hidden').value;
            deleteFile(fileId, pointGroup);
        }
    }
});

// File input change
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('file-input')) {
        const file = e.target.files[0];
        if (file) {
            const pointGroup = e.target.closest('.point-group');
            uploadFile(file, pointGroup);
        }
    }
});

// AJAX uploadFile and deleteFile functions remain the same as your original code

// AJAX Upload Function
function uploadFile(file, pointGroup, oldFileId = null) {
    const formData = new FormData();
    formData.append('file', file);
    if (oldFileId) formData.append('fileId', oldFileId);

    const statusText = pointGroup.querySelector('.status-text');
    const fileControl = pointGroup.querySelector('.file-control');
    
    // Show spinner
    fileControl.innerHTML = `
        <div class="text-center">
            <i class="fa fa-spinner fa-spin fa-2x text-primary"></i>
            <p class="mt-2">Uploading...</p>
        </div>
    `;

    const url = oldFileId ? '{{ route("drive.replaceFile") }}' : '{{ route("drive.uploadFile") }}';

    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Store URL and File ID in hidden inputs
            pointGroup.querySelector('.url-hidden').value = data.publicLink;
            pointGroup.querySelector('.file-id-hidden').value = data.fileId;

            // Replace upload UI with file info UI
            fileControl.innerHTML = `
                <div class="file-info">
                    <a href="${data.publicLink}" target="_blank" class="btn btn-sm btn-info">
                        <i class="fa fa-file"></i> View File
                    </a>
                    <button type="button" class="btn btn-sm btn-warning btn-replace">
                        <i class="fa fa-sync"></i> Replace
                    </button>
                    <button style="display:none;" type="button" class="btn btn-sm btn-danger btn-delete">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                    <span class="text-success ms-2"><i class="fa fa-check"></i> ${data.fileName}</span>
                </div>
                <input type="file" class="file-input" style="display:none;">
            `;
        } else {
            fileControl.innerHTML = `
                <div class="file-upload">
                    <button type="button" class="btn btn-sm btn-primary btn-upload">
                        <i class="fa fa-upload"></i> Upload File
                    </button>
                    <input type="file" class="file-input" style="display:none;">
                    <span class="status-text error ms-2"><i class="fa fa-times"></i> Failed: ${data.message}</span>
                </div>
            `;
        }
    })
    .catch(error => {
        fileControl.innerHTML = `
            <div class="file-upload">
                <button type="button" class="btn btn-sm btn-primary btn-upload">
                    <i class="fa fa-upload"></i> Upload File
                </button>
                <input type="file" class="file-input" style="display:none;">
                <span class="status-text error ms-2"><i class="fa fa-times"></i> Error: ${error.message}</span>
            </div>
        `;
    });
}

// AJAX Delete Function
function deleteFile(fileId, pointGroup) {
    const fileControl = pointGroup.querySelector('.file-control');
    
    // Show spinner
    fileControl.innerHTML = `
        <div class="text-center">
            <i class="fa fa-spinner fa-spin fa-2x text-danger"></i>
            <p class="mt-2">Deleting...</p>
        </div>
    `;

    fetch('{{ route("drive.deleteFile") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ fileId: fileId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear hidden inputs
            pointGroup.querySelector('.url-hidden').value = '';
            pointGroup.querySelector('.file-id-hidden').value = '';

            // Replace file info UI with upload UI
            fileControl.innerHTML = `
                <div class="file-upload">
                    <button type="button" class="btn btn-sm btn-primary btn-upload">
                        <i class="fa fa-upload"></i> Upload File
                    </button>
                    <input type="file" class="file-input" style="display:none;">
                    <span class="status-text success ms-2"><i class="fa fa-check"></i> Deleted</span>
                </div>
            `;
        } else {
            alert('Failed to delete: ' + data.message);
            // Restore previous state
            location.reload();
        }
    })
    .catch(error => {
        alert('Error: ' + error.message);
        location.reload();
    });
}
</script>
@endsection
