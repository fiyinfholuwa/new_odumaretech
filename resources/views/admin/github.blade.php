@extends('admin.app')

@section('content')

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row" style="margin:10px">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bgc-primary d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0 bgc-primary-text">GitHub Link Management</h5>
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#githubModal">
                    <i class="fa fa-plus me-1"></i> {{ $github_link ? 'Update Link' : 'Add Link' }}
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-hover align-middle">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>GitHub URL</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                @if($github_link)
                                    <a href="{{ $github_link->link }}" target="_blank">{{ $github_link->link }}</a>
                                @else
                                    <span class="text-muted">No GitHub Link Found</span>
                                @endif
                            </td>
                            <td>
                                @if($github_link)
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('{{ $github_link->link }}')">
                                        <i class="fas fa-copy"></i> Copy
                                    </button>
                                @else
                                    <span class="text-muted">---</span>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- GitHub Modal -->
<div class="modal fade" id="githubModal" tabindex="-1" aria-labelledby="githubModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('github.link.add') }}" method="post">
            @csrf
            <div class="modal-content shadow">
                <div class="modal-header bgc-primary text-white">
                    <h4 class="modal-title bgc-primary-text" id="githubModalLabel">
                        {{ $github_link ? 'Update GitHub Link' : 'Add GitHub Link' }}
                    </h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if($github_link)
                        <input type="hidden" name="id" value="{{ $github_link->id }}">
                    @endif
                    <div class="mb-3">
                        <label for="githubLink" class="form-label">GitHub Link</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" 
                               id="githubLink" name="link" 
                               value="{{ $github_link->link ?? '' }}" 
                               placeholder="Enter GitHub Link" required>
                        @error('link') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        {{ $github_link ? 'Update Link' : 'Add Link' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Copy function -->
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: 'GitHub link copied to clipboard.',
                timer: 2000,
                showConfirmButton: false
            });
        });
    }
</script>

@endsection
