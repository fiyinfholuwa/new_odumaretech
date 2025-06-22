@extends('instructor.app')

@section('content')
<style>
    .chat-container {
        max-width: 1200px;
        margin: 0 ;
        padding: 20px;
    }
    
    .chat-header {
        color: white;
        padding: 25px;
        border-radius: 20px 20px 0 0;
        position: relative;
        overflow: hidden;
    }
    
    .chat-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        
    }
    
    @keyframes slide {
        0% { transform: translate(-50%, -50%); }
        100% { transform: translate(-30%, -30%); }
    }
    
    .chat-header h2 {
        margin: 0;
        font-size: 2rem;
        font-weight: 600;
        position: relative;
        color:white;
        z-index: 1;
    }
    
    .chat-main {
        background: white;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .chat-tabs {
        display: flex;
        background: #f8f9ff;
        border-bottom: 2px solid #e1e8ff;
    }
    
    .chat-tab {
        flex: 1;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        font-weight: 600;
        color: #6c757d;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .chat-tab:hover {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }
    
    .chat-tab.active {
        background: #667eea;
        color: white;
    }
    
    .chat-tab.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 4px;
        background: #4c63d2;
    }
    
    .tab-content {
        display: none;
        padding: 30px;
        animation: fadeIn 0.3s ease;
    }
    
    .tab-content.active {
        display: block;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .modern-form-group {
        margin-bottom: 25px;
    }
    
    .modern-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #2d3748;
        font-size: 0.95rem;
    }
    
    .modern-textarea {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        resize: vertical;
        min-height: 120px;
        font-family: inherit;
    }
    
    .modern-textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .modern-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
    }
    
    .modern-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }
    
    .modern-btn:active {
        transform: translateY(0);
    }
    
    .chat-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .chat-table th {
        background: linear-gradient(135deg, #f8f9ff 0%, #e1e8ff 100%);
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: #2d3748;
        border-bottom: 2px solid #667eea;
    }
    
    .chat-table td {
        padding: 15px;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: top;
    }
    
    .chat-table tr:hover {
        background: #f8f9ff;
    }
    
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-pending {
        background: #fef3cd;
        color: #856404;
    }
    
    .status-replied {
        background: #d4edda;
        color: #155724;
    }
    
    .action-btn {
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    
    .btn-view {
        background: #28a745;
        color: white;
    }
    
    .btn-view:hover {
        background: #218838;
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }
    
    .message-preview {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        backdrop-filter: blur(5px);
    }
    
    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        max-width: 600px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .modal-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2d3748;
    }
    
    .close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #6c757d;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .close-btn:hover {
        background: #f8f9fa;
        color: #495057;
    }
    
    .message-display {
        background: #f8f9ff;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid #667eea;
        font-size: 1rem;
        line-height: 1.6;
        color: #2d3748;
    }
    
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-right: 10px;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        z-index: 1001;
        transform: translateX(400px);
        transition: transform 0.3s ease;
    }
    
    .notification.show {
        transform: translateX(0);
    }
    
    .notification.success {
        background: linear-gradient(135deg, #28a745, #20c997);
    }
    
    .notification.error {
        background: linear-gradient(135deg, #dc3545, #e83e8c);
    }
</style>

<div class="chat-container">
    <div  class="chat-header bg-secondary">
        <h2> Instructor Chat System</h2>
    </div>
    
    <div class="chat-main">
        <div class="chat-tabs">
            <div class="chat-tab active" data-tab="send">
                📝 Send Message
            </div>
            <div class="chat-tab" data-tab="history">
                📋 Chat History
            </div>
        </div>
        
        <!-- Send Message Tab -->
        <div class="tab-content active" id="send-tab">
            <form action="{{route('instructor.chat.add')}}" method="post" enctype="multipart/form-data" id="messageForm">
                @csrf
                <div class="modern-form-group">
                    <label class="modern-label" for="message">✍️ Your Message</label>
                    <textarea 
                        class="modern-textarea" 
                        name="message" 
                        id="message"
                        placeholder="Type your message here... We'll get back to you as soon as possible!"
                        required
                    ></textarea>
                </div>
                
                <button type="submit" class="modern-btn" id="sendBtn">
                    Send Message
                </button>
            </form>
        </div>
        
        <!-- Chat History Tab -->
        <div class="tab-content" id="history-tab">
            <div class="table-responsive">
                <table class="chat-table">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Your Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($chats as $chat)
                        <tr>
                            <td><strong>{{$i++}}</strong></td>
                            <td>
                                <div class="message-preview" title="{{$chat->instructor_message}}">
                                    {{Str::limit($chat->instructor_message, 50)}}
                                </div>
                            </td>
                            <td>
                                @if($chat->admin_message == NULL)
                                    <span class="status-badge status-pending">
                                        <span class="loading-spinner"></span>
                                        Pending Response
                                    </span>
                                @else
                                    <span class="status-badge status-replied">
                                        ✅ Replied
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($chat->admin_message == NULL)
                                    <span class="status-badge status-pending">Please wait...</span>
                                @else
                                    <a href="#" class="action-btn btn-view" onclick="showMessage({{$chat->id}}, `{{addslashes($chat->admin_message)}}`, `{{addslashes($chat->instructor_message)}}`)">
                                        👁️ View Reply
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Message Modal -->
<div class="modal-overlay" id="messageModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">💬 Message Details</h3>
            <button class="close-btn" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div style="margin-bottom: 20px;">
                <label class="modern-label">📤 Your Message:</label>
                <div class="message-display" id="originalMessage"></div>
            </div>
            <div>
                <label class="modern-label">📥 Admin Response:</label>
                <div class="message-display" id="responseMessage"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabs = document.querySelectorAll('.chat-tab');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.dataset.tab;
            
            // Remove active class from all tabs and contents
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(tc => tc.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding content
            this.classList.add('active');
            document.getElementById(targetTab + '-tab').classList.add('active');
        });
    });
    
    // Form submission with enhanced UX
    const messageForm = document.getElementById('messageForm');
    const sendBtn = document.getElementById('sendBtn');
    
    messageForm.addEventListener('submit', function(e) {
        sendBtn.innerHTML = '<span class="loading-spinner"></span>Sending...';
        sendBtn.disabled = true;
        
        // Show notification
        showNotification('Message is being sent...', 'success');
    });
    
    // Auto-refresh functionality for pending messages
    setInterval(function() {
        const pendingElements = document.querySelectorAll('.status-pending');
        if (pendingElements.length > 0) {
            // You can add AJAX call here to check for updates
            console.log('Checking for message updates...');
        }
    }, 30000); // Check every 30 seconds
});

function showMessage(chatId, adminMessage, instructorMessage) {
    document.getElementById('originalMessage').innerHTML = instructorMessage;
    document.getElementById('responseMessage').innerHTML = adminMessage;
    document.getElementById('messageModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('messageModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => notification.classList.add('show'), 100);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Close modal when clicking outside
document.getElementById('messageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Escape key to close modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>

@endsection