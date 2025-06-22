@extends('instructor.app')

@section('content')
<style>
    .chat-wrapper {
        max-width: 1000px;
        margin: 0 ;
        padding: 30px 20px;
        display: flex;
        flex-direction: column;
        height: 60vh;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .chat-box {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .chat-message {
        max-width: 75%;
        padding: 15px 20px;
        border-radius: 15px;
        line-height: 1.6;
        font-size: 1rem;
        position: relative;
        word-wrap: break-word;
    }

    .chat-message.user {
        align-self: flex-end;
        background-color: #667eea;
        color: #fff;
        border-bottom-right-radius: 0;
    }

    .chat-message.admin {
        align-self: flex-start;
        background-color: #f1f5f9;
        color: #333;
        border-bottom-left-radius: 0;
    }

    .chat-input-wrapper {
        display: flex;
        padding: 15px;
        border-top: 1px solid #e2e8f0;
        background-color: #f8f9fa;
    }

    .chat-input {
        flex: 1;
        padding: 10px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 1rem;
        outline: none;
    }

    .chat-send-btn {
        margin-left: 15px;
        background: #667eea;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .chat-send-btn:hover {
        background: #5a67d8;
    }
</style>

<div class="chat-wrapper">
<h4>Chat With Admin</h4>
    <div class="chat-box" id="chatBox">
        @foreach($chats as $chat)
            <div class="chat-message user">
                {{ $chat->instructor_message }}
            </div>
            @if($chat->admin_message)
                <div class="chat-message admin">
                    {{ $chat->admin_message }}
                </div>
            @endif
        @endforeach
    </div>

    <form action="{{ route('instructor.chat.add') }}" method="POST" class="chat-input-wrapper" id="chatForm">
        @csrf
        <input 
            type="text" 
            name="message" 
            class="chat-input" 
            placeholder="Type your message here..." 
            required
        >
        <button type="submit" class="chat-send-btn">Send</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const chatBox = document.getElementById('chatBox');
        chatBox.scrollTop = chatBox.scrollHeight;

        const chatForm = document.getElementById('chatForm');
        chatForm.addEventListener('submit', () => {
            setTimeout(() => {
                chatBox.scrollTop = chatBox.scrollHeight;
            }, 100);
        });
    });
</script>

@endsection
