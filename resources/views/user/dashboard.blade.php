@extends('user.app')

@section('content')
              <?php
// Demo data for dashboard
$user_data = [
    'name' => 'Sarah',
    'active_courses' => 20,
    'completed_courses' => 10,
    'live_sessions' => 24,
    'resources' => 1204,
    'assignments' => 23,
    'submitted_assignments' => 4,
    'grade' => 75,
    'hours_spent' => [
        'Mon' => 16,
        'Tue' => 10,
        'Wed' => 18,
        'Thur' => 12,
        'Fri' => 14,
        'Sat' => 16,
        'Sun' => 8
    ],
    'recent_courses' => [
        ['name' => 'Web Development (Frontend)', 'progress' => 54],
        ['name' => 'Web Development (Frontend)', 'progress' => 54]
    ],
    'resources_list' => [
        ['name' => 'Web Development for Teens (Front End) view resources', 'type' => 'View'],
        ['name' => 'Web Development for Teens (Front End) view resources', 'type' => 'View']
    ]
];

// Demo chat data
$chat_messages = [
    [
        'id' => 1,
        'sender' => 'Markus',
        'message' => "Hello there! I'm Markus, your AI assistant. I'm here to help with a wide range of tasks - whether you need information, creative writing, coding help, or just someone to chat with.",
        'time' => '02:10 PM',
        'is_ai' => true
    ],
    [
        'id' => 2,
        'sender' => 'You',
        'message' => 'Hello!',
        'time' => '02:10 PM',
        'is_ai' => false
    ]
];
?>

    <style>
        :root {
            --primary-color: #E9ECFF;
            --secondary-color: #f8fafc;
            --accent-color: #fbbf24;
            --success-color: #10b981;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .dashboard-container {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .welcome-section {
            margin-bottom: 2rem;
        }

        .welcome-title {
            font-size: 1.875rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0;
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .stats-card.primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
        }

        .stats-card.secondary {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
        }

        .stats-card.accent {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .stats-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .stats-value {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 0.875rem;
            font-weight: 500;
            opacity: 0.9;
        }

        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .chart-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
        }

        .progress-item {
            margin-bottom: 1.5rem;
        }

        .progress-item:last-child {
            margin-bottom: 0;
        }

        .progress-label {
            display: flex;
            justify-content: between;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .progress {
            height: 8px;
            border-radius: 4px;
            background-color: #f3f4f6;
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--accent-color) 100%);
            border-radius: 4px;
        }

        .calendar-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.25rem;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .calendar-day:hover {
            background-color: #f3f4f6;
        }

        .calendar-day.active {
            background-color: var(--primary-color);
            color: white;
        }

        .calendar-day.header {
            font-weight: 600;
            color: var(--text-secondary);
            cursor: default;
        }

        .calendar-day.header:hover {
            background-color: transparent;
        }

        .performance-gauge {
            width: 200px;
            height: 200px;
            position: relative;
            margin: 0 auto;
        }

        .gauge-bg {
            fill: none;
            stroke: #e5e7eb;
            stroke-width: 12;
        }

        .gauge-fill {
            fill: none;
            stroke: url(#gaugeGradient);
            stroke-width: 12;
            stroke-linecap: round;
            transition: stroke-dasharray 0.3s ease;
        }

        .gauge-text {
            text-anchor: middle;
            font-size: 2rem;
            font-weight: 700;
            fill: var(--text-primary);
        }

        .gauge-label {
            text-anchor: middle;
            font-size: 0.875rem;
            fill: var(--text-secondary);
        }

        .chart-bars {
            display: flex;
            align-items: end;
            justify-content: space-between;
            height: 200px;
            margin-bottom: 1rem;
        }

        .chart-bar {
            background: linear-gradient(to top, var(--primary-color), var(--accent-color));
            border-radius: 4px 4px 0 0;
            width: 32px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .chart-bar:hover {
            opacity: 0.8;
            transform: translateY(-2px);
        }

        .chart-labels {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .resource-item {
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            margin-bottom: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s;
        }

        .resource-item:hover {
            border-color: var(--primary-color);
            background-color: #f8fafc;
        }

        .resource-item:last-child {
            margin-bottom: 0;
        }

        .resource-name {
            font-size: 0.875rem;
            color: var(--text-primary);
        }

        .resource-action {
            color: var(--primary-color);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
        }

        /* Chat Styles */
        .chat-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 350px;
            height: 500px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .chat-container.active {
            transform: translateY(0);
        }

        .chat-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #7c3aed 100%);
            color: white;
            padding: 1rem;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-title {
            font-weight: 600;
            margin: 0;
        }

        .chat-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-messages {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
            max-height: 350px;
        }

        .message {
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .message.user {
            flex-direction: row-reverse;
        }

        .message-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        .message-avatar.ai {
            background: linear-gradient(135deg, var(--primary-color) 0%, #7c3aed 100%);
            color: white;
        }

        .message-avatar.user {
            background: var(--accent-color);
            color: white;
        }

        .message-content {
            background: #f3f4f6;
            padding: 0.75rem;
            border-radius: 12px;
            max-width: 70%;
            font-size: 0.875rem;
            line-height: 1.4;
        }

        .message.user .message-content {
            background: var(--primary-color);
            color: white;
        }

        .message-time {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }

        .chat-input {
            padding: 1rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            gap: 0.75rem;
        }

        .chat-input input {
            flex: 1;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            outline: none;
        }

        .chat-input input:focus {
            border-color: var(--primary-color);
        }

        .chat-send {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .chat-send:hover {
            background: #4338ca;
        }

        .chat-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #7c3aed 100%);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
            transition: all 0.3s ease;
            z-index: 999;
        }

        .chat-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.6);
        }

        .chat-footer {
            text-align: center;
            padding: 0.5rem;
            font-size: 0.75rem;
            color: var(--text-secondary);
            border-top: 1px solid var(--border-color);
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }
            
            .chat-container {
                width: calc(100vw - 40px);
                right: 20px;
                left: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1 class="welcome-title">Welcome <?php echo $user_data['name']; ?> 👋</h1>
        </div>

        <!-- Stats Cards Row -->
        <div class="row mb-4">
            <div class="col-lg-4 col-md-6 mb-3">
                <div  style="background:#E9ECFF;" class="stats-card primary">
                    <div class="stats-icon">
                        <i style="background:#0E2293;padding:20px;border-radius:5px;" class="fas fa-book-open"></i>
                    </div>
                    <div class="stats-value  text-dark"><?php echo $user_data['active_courses']; ?></div>
                    <div class="stats-label text-dark">Active Course(s)</div>
                </div>
            </div>
            <div  class="col-lg-4 col-md-6 mb-3">
                <div style="background:#E9ECFF;" class="stats-card secondary">
                    <div class="stats-icon">
                        <i style="background:#0E2293;padding:20px;border-radius:5px;" class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stats-value text-dark"><?php echo $user_data['completed_courses']; ?></div>
                    <div class="stats-label text-dark">Completed Course(s)</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div style="background:#E9ECFF;" class="stats-card accent">
                    <div class="stats-icon">
                        <i style="background:#0E2293;padding:20px;border-radius:5px;" class="fas fa-users"></i>
                    </div>
                    <div class="stats-value text-dark"><?php echo $user_data['live_sessions']; ?></div>
                    <div class="stats-label text-dark">Live Sessions</div>
                </div>
            </div>
            
        </div>

        <!-- Second Row Stats -->
        <div class="row mb-4">

        <div class="col-lg-4 col-md-6 mb-3">
                <div style="background:#FFF3CF;" class="stats-card">
                    <div  class="stats-icon">
                        <i style="background:#FFC000;padding:20px;border-radius:5px;" class="fas fa-folder"></i>
                    </div>
                    <div class="stats-value text-muted"><?php echo number_format($user_data['resources']); ?></div>
                    <div class="stats-label text-dark">Resources</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div style="background:#FFF3CF;" class="stats-card accent">
                    <div class="stats-icon">
                        <i style="background:#FFC000;padding:20px;border-radius:5px;" class="fas fa-tasks"></i>
                    </div>
                    <div class="stats-value text-muted"><?php echo $user_data['assignments']; ?></div>
                    <div class="stats-label text-dark">All Assignments</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div style="background:#FFF3CF;" class="stats-card accent">
                    <div class="stats-icon">
                        <i style="background:#FFC000;padding:20px;border-radius:5px;" class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="stats-value text-muted"><?php echo $user_data['submitted_assignments']; ?></div>
                    <div class="stats-label text-dark">Submitted Assignment</div>
                </div>
            </div>
        </div>

        <!-- Charts and Content Row -->
        <div class="row">
            <!-- Recent Courses -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="chart-container">
                    <div class="chart-title">
                        <i class="fas fa-clock me-2"></i>Recent Enrolled Course
                    </div>
                    <?php foreach($user_data['recent_courses'] as $course): ?>
                    <div class="progress-item">
                        <div class="progress-label">
                            <span><?php echo $course['name']; ?></span>
                            <span><?php echo $course['progress']; ?>%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $course['progress']; ?>%"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Resources -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="chart-container">
                    <div class="chart-title">
                        <i class="fas fa-folder me-2"></i>Your Resources
                    </div>
                    <?php foreach($user_data['resources_list'] as $resource): ?>
                    <div class="resource-item">
                        <div class="resource-name"><?php echo $resource['name']; ?></div>
                        <a href="#" class="resource-action"><?php echo $resource['type']; ?></a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Calendar -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <span class="fw-bold">June 2025</span>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="calendar-grid">
                        <div class="calendar-day header">Su</div>
                        <div class="calendar-day header">Mo</div>
                        <div class="calendar-day header">Tu</div>
                        <div class="calendar-day header">We</div>
                        <div class="calendar-day header">Th</div>
                        <div class="calendar-day header">Fr</div>
                        <div class="calendar-day header">Sa</div>
                        <?php for($i = 1; $i <= 30; $i++): ?>
                        <div class="calendar-day <?php echo $i == 9 ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            
        </div>

        <!-- Hours Spent Chart -->
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="chart-container">
                    <div class="chart-title">
                        <i class="fas fa-clock me-2"></i>Hours Spent
                    </div>
                    <div class="chart-bars">
                        <?php foreach($user_data['hours_spent'] as $day => $hours): ?>
                        <div class="chart-bar" style="height: <?php echo ($hours / 20) * 100; ?>%" 
                             title="<?php echo $day . ': ' . $hours . ' hours'; ?>"></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="chart-labels">
                        <?php foreach(array_keys($user_data['hours_spent']) as $day): ?>
                        <span><?php echo $day; ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Performance -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="chart-container text-center">
                    <div class="chart-title">
                        <i class="fas fa-chart-line me-2"></i>Performance
                    </div>
                    <div class="performance-gauge">
                        <svg width="200" height="200">
                            <defs>
                                <linearGradient id="gaugeGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" style="stop-color:#f59e0b;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#d97706;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <circle cx="100" cy="100" r="80" class="gauge-bg"></circle>
                            <circle cx="100" cy="100" r="80" class="gauge-fill" 
                                    style="stroke-dasharray: <?php echo ($user_data['grade'] / 100) * 502; ?> 502; 
                                           transform: rotate(-90deg); transform-origin: 100px 100px;"></circle>
                            <text x="100" y="95" class="gauge-text"><?php echo $user_data['grade']; ?></text>
                            <text x="100" y="115" class="gauge-label">Grade</text>
                        </svg>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-warning">Assignment Submission Performance</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Toggle Button -->
    <button class="chat-toggle" onclick="toggleChat()">
        <i class="fas fa-comments"></i>
    </button>

    <!-- Chat Container -->
    <div class="chat-container" id="chatContainer">
        <div class="chat-header">
            <h5 class="chat-title">Chat with AI</h5>
            <button class="chat-close" onclick="toggleChat()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="chat-messages" id="chatMessages">
            <?php foreach($chat_messages as $message): ?>
            <div class="message <?php echo $message['is_ai'] ? 'ai' : 'user'; ?>">
                <div class="message-avatar <?php echo $message['is_ai'] ? 'ai' : 'user'; ?>">
                    <?php echo $message['is_ai'] ? 'M' : 'U'; ?>
                </div>
                <div>
                    <div class="message-content">
                        <?php echo $message['message']; ?>
                    </div>
                    <div class="message-time"><?php echo $message['time']; ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="chat-input">
            <input type="text" id="messageInput" placeholder="Write a message..." 
                   onkeypress="handleKeyPress(event)">
            <button class="chat-send" onclick="sendMessage()">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
        
        <div class="chat-footer">
            Powered by Odumaretech
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        let chatOpen = false;
        let messageCounter = <?php echo count($chat_messages); ?>;

        // AI responses for demo
        const aiResponses = [
            "I'd be happy to help you with that! What specific topic would you like to learn more about?",
            "That's a great question! Let me provide you with some insights on that topic.",
            "I understand what you're looking for. Here's what I can tell you about that.",
            "Excellent! I can definitely help you with your studies. What subject are you working on?",
            "That's an interesting point. Let me break that down for you step by step.",
            "I'm here to support your learning journey. What would you like to explore today?",
            "Great question! This is actually a fundamental concept in that area of study.",
            "I can see you're really engaged with your learning. Let me help clarify that for you."
        ];

        function toggleChat() {
            const chatContainer = document.getElementById('chatContainer');
            const chatToggle = document.querySelector('.chat-toggle');
            
            chatOpen = !chatOpen;
            
            if (chatOpen) {
                chatContainer.classList.add('active');
                chatToggle.style.display = 'none';
                document.getElementById('messageInput').focus();
            } else {
                chatContainer.classList.remove('active');
                chatToggle.style.display = 'flex';
            }
        }

        function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();
            
            if (message === '') return;
            
            // Add user message
            addMessage(message, false);
            input.value = '';
            
            // Simulate AI typing and response
            setTimeout(() => {
                const aiResponse = aiResponses[Math.floor(Math.random() * aiResponses.length)];
                addMessage(aiResponse, true);
            }, 1000 + Math.random() * 2000);
        }

        function addMessage(text, isAI) {
            const messagesContainer = document.getElementById('chatMessages');
            const currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${isAI ? 'ai' : 'user'}`;
            
            messageDiv.innerHTML = `
                <div class="message-avatar ${isAI ? 'ai' : 'user'}">
                    ${isAI ? 'M' : 'U'}
                </div>
                <div>
                    <div class="message-content">
                        ${text}
                    </div>
                    <div class="message-time">${currentTime}</div>
                </div>
            `;
            
            messagesContainer.appendChild(messageDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
            messageCounter++;
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        }

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to chart bars
            const chartBars = document.querySelectorAll('.chart-bar');
            chartBars.forEach(bar => {
                bar.addEventListener('mouseenter', function() {
                    this.style.opacity = '0.8';
                });
                bar.addEventListener('mouseleave', function() {
                    this.style.opacity = '1';
                });
            });

            // Add click handlers to calendar days
            const calendarDays = document.querySelectorAll('.calendar-day:not(.header)');
            calendarDays.forEach(day => {
                day.addEventListener('click', function() {
                    calendarDays.forEach(d => d.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });

        // Auto-scroll chat to bottom when opened
        function scrollChatToBottom() {
            const chatMessages = document.getElementById('chatMessages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Call scroll function when chat is opened
        const originalToggleChat = toggleChat;
        toggleChat = function() {
            originalToggleChat();
            if (chatOpen) {
                setTimeout(scrollChatToBottom, 100);
            }
        };

        // Add some interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stats cards on load
            const statsCards = document.querySelectorAll('.stats-card');
            statsCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Add pulse animation to chat toggle
            const chatToggle = document.querySelector('.chat-toggle');
            setInterval(() => {
                if (!chatOpen) {
                    chatToggle.style.animation = 'pulse 2s';
                    setTimeout(() => {
                        chatToggle.style.animation = '';
                    }, 2000);
                }
            }, 10000);
        });

        // Add CSS animation for pulse effect
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.1); }
                100% { transform: scale(1); }
            }
            
            .typing-indicator {
                display: flex;
                align-items: center;
                gap: 4px;
                padding: 0.75rem;
                color: var(--text-secondary);
                font-size: 0.875rem;
            }
            
            .typing-dots {
                display: flex;
                gap: 2px;
            }
            
            .typing-dot {
                width: 4px;
                height: 4px;
                border-radius: 50%;
                background-color: var(--text-secondary);
                animation: typing 1.4s infinite;
            }
            
            .typing-dot:nth-child(2) {
                animation-delay: 0.2s;
            }
            
            .typing-dot:nth-child(3) {
                animation-delay: 0.4s;
            }
            
            @keyframes typing {
                0%, 60%, 100% { opacity: 0.3; }
                30% { opacity: 1; }
            }
        `;
        document.head.appendChild(style);

        // Enhanced sendMessage function with typing indicator
        function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();
            
            if (message === '') return;
            
            // Add user message
            addMessage(message, false);
            input.value = '';
            
            // Show typing indicator
            showTypingIndicator();
            
            // Simulate AI typing and response
            setTimeout(() => {
                hideTypingIndicator();
                const aiResponse = aiResponses[Math.floor(Math.random() * aiResponses.length)];
                addMessage(aiResponse, true);
            }, 1000 + Math.random() * 2000);
        }

        function showTypingIndicator() {
            const messagesContainer = document.getElementById('chatMessages');
            const typingDiv = document.createElement('div');
            typingDiv.className = 'message ai';
            typingDiv.id = 'typingIndicator';
            
            typingDiv.innerHTML = `
                <div class="message-avatar ai">M</div>
                <div class="typing-indicator">
                    <span>Markus is typing</span>
                    <div class="typing-dots">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            `;
            
            messagesContainer.appendChild(typingDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function hideTypingIndicator() {
            const typingIndicator = document.getElementById('typingIndicator');
            if (typingIndicator) {
                typingIndicator.remove();
            }
        }
    </script>

@endsection
