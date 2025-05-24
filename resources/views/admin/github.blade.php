@extends('admin.app')

@section('content')

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- SweetAlert2 for fancy alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="row" style="margin:10px">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title"><h4 class="text-white">Manage GitHub Link</h4> </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('github.link.add') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="githubLink">GitHub Link</label>
                            <input type="text" class="form-control" id="githubLink"
                                   value="{{ $github_link->link ?? '' }}" name="link" required placeholder="Enter GitHub Link">
                            <small style="color:red; font-weight:500">
                                @error('link') {{ $message }} @enderror
                            </small>
                            @if($github_link)
                                <input type="hidden" name="id" value="{{ $github_link->id }}" />
                            @endif
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success">
                                {{ $github_link ? 'Update Link' : 'Add GitHub Link' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h4 class="card-title text-white">Check GitHub Link</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>GitHub URL</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i = 1; @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            @if($github_link)
                                                <a href="{{ $github_link->link }}" target="_blank">{{ $github_link->link }}</a>
                                            @else
                                                No GitHub Link Found
                                            @endif
                                        </td>
                                        <td>
                                            @if($github_link)
                                                <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('{{ $github_link->link }}')">
                                                    <i class="fas fa-copy"></i> Copy
                                                </button>
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
        </div>

    </div>



    <!-- Copy to clipboard with SweetAlert2 -->
    <!-- Add this CSS to your existing stylesheet -->
    <style>
        .action_modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .action_modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .action_modal {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 32px;
            max-width: 400px;
            width: 90%;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            transform: scale(0.9) translateY(20px);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            text-align: center;
            position: relative;
        }

        .action_modal-overlay.active .action_modal {
            transform: scale(1) translateY(0);
        }

        .action_modal-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .action_modal-icon.success {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .action_modal-icon.error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .action_modal-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1f2937;
        }

        .action_modal-message {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .action_modal-btn {
            padding: 12px 28px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .action_modal-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }
    </style>

    <!-- Add this HTML to your page -->
    <div class="action_modal-overlay" id="clipboardModal" onclick="closeClipboardModal(event)">
        <div class="action_modal" onclick="event.stopPropagation()">
            <div class="action_modal-icon" id="modalIcon">
                <span id="modalIconText">✅</span>
            </div>
            <h3 class="action_modal-title" id="modalTitle">Success!</h3>
            <p class="action_modal-message" id="modalMessage">GitHub link copied to clipboard!</p>
            <button class="action_modal-btn" onclick="closeClipboardModal()">
                Ok
            </button>
        </div>
    </div>

    <script>
        function showClipboardModal(isSuccess = true) {
            const overlay = document.getElementById('clipboardModal');
            const icon = document.getElementById('modalIcon');
            const iconText = document.getElementById('modalIconText');
            const title = document.getElementById('modalTitle');
            const message = document.getElementById('modalMessage');

            if (isSuccess) {
                icon.className = 'action_modal-icon success';
                // Use innerHTML to render the font awesome icon
                iconText.innerHTML = '<i class="fa fa-check-circle text-white"></i>';
                title.textContent = 'Success!';
                message.textContent = 'GitHub link copied to clipboard!';
            } else {
                icon.className = 'action_modal-icon error';
                // For error, you can use a unicode X or a fontawesome icon
                iconText.innerHTML = '<i class="fa fa-times-circle"></i>';
                title.textContent = 'Error';
                message.textContent = 'Failed to copy link to clipboard.';
            }

            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeClipboardModal(event) {
            if (event && event.target !== event.currentTarget) return;

            const overlay = document.getElementById('clipboardModal');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Updated copyToClipboard function
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                showClipboardModal(true);
            }).catch(() => {
                showClipboardModal(false);
            });
        }

        // Close with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeClipboardModal();
            }
        });
    </script>

@endsection
