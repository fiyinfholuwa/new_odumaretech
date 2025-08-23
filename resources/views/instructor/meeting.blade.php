@extends('instructor.app')

@section('content')

<div class="row" style="margin:10px">
    <div class="col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bgc-primary text-white">
                <h4 class="card-title mb-0 bgc-primary-text">View Meeting Links</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Course Name</th>
                                <th>Meeting Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($meetings as $index => $meeting)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ optional($meeting->course_name)->title }}</td>
                                <td>
                                    <input type="text" id="text-input-{{ $index }}" class="form-control text-input" readonly value="{{ $meeting ? $meeting->link : 'No link provided' }}">
                                </td>
                                <td>
                                    <button class="btn btn-primary copy-button" data-index="{{ $index }}">
                                        Copy Link <i class="fa fa-copy"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Modal -->
<div class="action_modal-overlay" id="clipboardModal" onclick="closeClipboardModal(event)">
    <div class="action_modal" onclick="event.stopPropagation()">
        <div class="action_modal-icon success" id="modalIcon">
            <span id="modalIconText"><i class="fa fa-check-circle text-white"></i></span>
        </div>
        <h3 class="action_modal-title" id="modalTitle">Success!</h3>
        <p class="action_modal-message" id="modalMessage">Meeting link copied to clipboard!</p>
        <button class="action_modal-btn" onclick="closeClipboardModal()">Ok</button>
    </div>
</div>

<!-- Modal CSS -->
<style>
    .action_modal-overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease-in-out;
    }
    .action_modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    .action_modal {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 32px;
        max-width: 400px;
        width: 90%;
        text-align: center;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
        transform: scale(0.9) translateY(20px);
        transition: all 0.4s ease-in-out;
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
    }
    .action_modal-icon.success {
        background: linear-gradient(135deg, #10b981, #059669);
    }
    .action_modal-title {
        font-size: 22px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 12px;
    }
    .action_modal-message {
        font-size: 16px;
        color: #6b7280;
        margin-bottom: 24px;
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
        transition: all 0.3s ease;
    }
    .action_modal-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    }
</style>

<!-- Clipboard Script -->
<script>
    function showClipboardModal() {
        const overlay = document.getElementById('clipboardModal');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeClipboardModal(event) {
        if (event && event.target !== event.currentTarget) return;
        document.getElementById('clipboardModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') closeClipboardModal();
    });

    // Attach event to all copy buttons
    document.querySelectorAll(".copy-button").forEach(button => {
        button.addEventListener("click", () => {
            const index = button.getAttribute("data-index");
            const text = document.getElementById("text-input-" + index).value;

            navigator.clipboard.writeText(text).then(() => {
                showClipboardModal();
            }).catch(() => {
                alert("Failed to copy. Please try manually.");
            });
        });
    });
</script>

@endsection
