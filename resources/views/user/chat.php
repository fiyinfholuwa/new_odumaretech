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
