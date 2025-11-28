<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    // Knowledge base with questions and answers
    private $knowledgeBase = [
        [
            'keywords' => ['hello', 'hi', 'hey', 'greetings'],
            'response' => 'Hello! Welcome to Markus Learning Platform. How can I assist you with your studies today?'
        ],
        [
            'keywords' => ['course', 'courses', 'class', 'classes'],
            'response' => 'We offer a wide range of courses across various subjects. You can browse our course catalog to find the perfect course for your learning goals. What subject are you interested in?'
        ],
        [
            'keywords' => ['enroll', 'register', 'signup', 'join'],
            'response' => 'To enroll in a course, simply browse our course catalog, select the course you want, and click the "Enroll Now" button. You can start learning immediately after enrollment!'
        ],
        [
            'keywords' => ['certificate', 'certification', 'diploma'],
            'response' => 'Yes! Upon successful completion of a course, you will receive a certificate of completion that you can share on your professional profiles or with employers.'
        ],
        [
            'keywords' => ['price', 'cost', 'fee', 'payment', 'pay'],
            'response' => 'Our course prices vary depending on the subject and duration. Most courses range from $29 to $199. We also offer bundle discounts and occasional promotions!'
        ],
        [
            'keywords' => ['duration', 'how long', 'time', 'length'],
            'response' => 'Course durations vary based on the subject and depth of content. Most courses take between 4-12 weeks to complete, with flexible, self-paced learning options.'
        ],
        [
            'keywords' => ['instructor', 'teacher', 'tutor', 'mentor'],
            'response' => 'All our instructors are industry experts with years of experience in their respective fields. They are dedicated to providing high-quality education and support throughout your learning journey.'
        ],
        [
            'keywords' => ['support', 'help', 'assist', 'problem'],
            'response' => 'We offer 24/7 student support through chat, email, and our community forums. If you need immediate assistance, you can also reach out to your course instructor directly.'
        ],
        [
            'keywords' => ['refund', 'money back', 'return'],
            'response' => 'We offer a 30-day money-back guarantee on all courses. If you are not satisfied with your purchase, you can request a full refund within 30 days of enrollment.'
        ],
        [
            'keywords' => ['assignment', 'homework', 'project', 'task'],
            'response' => 'Each course includes assignments, quizzes, and projects designed to reinforce your learning. You will receive feedback from instructors to help you improve and master the material.'
        ],
        [
            'keywords' => ['progress', 'track', 'status', 'completion'],
            'response' => 'You can track your learning progress on your dashboard. It shows completed lessons, quiz scores, assignments, and your overall course completion percentage.'
        ],
        [
            'keywords' => ['video', 'lecture', 'lesson', 'material'],
            'response' => 'Our courses include high-quality video lectures, downloadable resources, interactive quizzes, and hands-on projects to ensure comprehensive learning.'
        ],
        [
            'keywords' => ['access', 'lifetime', 'expire'],
            'response' => 'Once you enroll in a course, you get lifetime access to all course materials, including any future updates. Learn at your own pace without time pressure!'
        ],
        [
            'keywords' => ['prerequisite', 'requirement', 'need', 'before'],
            'response' => 'Prerequisites vary by course. Most beginner courses have no requirements, while advanced courses may require prior knowledge. Check the course description for specific prerequisites.'
        ],
        [
            'keywords' => ['mobile', 'app', 'phone', 'tablet'],
            'response' => 'Yes! Our platform is fully mobile-responsive. You can access your courses on any device - smartphone, tablet, or computer - and continue learning on the go.'
        ]
    ];

    // Fallback responses for unmatched queries
    private $fallbackResponses = [
        "That's an interesting question! Could you provide more details so I can better assist you?",
        "I'm here to help with your learning journey. Could you rephrase your question or be more specific?",
        "I want to make sure I understand correctly. Can you tell me more about what you're looking for?",
        "That's a great question! While I may not have a specific answer, our support team can definitely help you. Would you like me to connect you with them?",
        "I'm still learning! Could you try asking in a different way? I'm here to help with courses, enrollment, certificates, and more.",
        "I'd love to help you with that! Can you provide more context about your question?",
        "Interesting! While I don't have specific information on that, I can help you with course-related questions, enrollment, pricing, and support.",
        "That's something I'm not sure about yet, but I'm here to assist with your learning needs. What would you like to know about our courses?"
    ];

    public function index()
    {
        // Get or initialize chat messages from session
        $chat_messages = Session::get('chat_messages', [
            [
                'message' => 'Hello! I\'m Markus, your learning assistant. How can I help you today?',
                'is_ai' => true,
                'time' => now()->format('g:i A')
            ]
        ]);

        return view('chat.index', compact('chat_messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $userMessage = $request->input('message');
        
        // Get existing messages from session
        $chat_messages = Session::get('chat_messages', []);
        
        // Add user message
        $chat_messages[] = [
            'message' => $userMessage,
            'is_ai' => false,
            'time' => now()->format('g:i A')
        ];

        // Get AI response
        $aiResponse = $this->getAIResponse($userMessage);
        
        // Add AI message
        $chat_messages[] = [
            'message' => $aiResponse,
            'is_ai' => true,
            'time' => now()->format('g:i A')
        ];

        // Save to session
        Session::put('chat_messages', $chat_messages);

        return response()->json([
            'success' => true,
            'response' => $aiResponse,
            'time' => now()->format('g:i A')
        ]);
    }

    private function getAIResponse($message)
    {
        $message = strtolower(trim($message));
        
        // Calculate match scores for each knowledge base entry
        $bestMatch = null;
        $highestScore = 0;
        
        foreach ($this->knowledgeBase as $entry) {
            $score = $this->calculateMatchScore($message, $entry['keywords']);
            
            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $entry['response'];
            }
        }

        // If we found a good match (threshold: 0.3), return it
        if ($highestScore > 0.3) {
            return $bestMatch;
        }

        // Otherwise, return a random fallback response
        return $this->fallbackResponses[array_rand($this->fallbackResponses)];
    }

    private function calculateMatchScore($message, $keywords)
    {
        $score = 0;
        $messageWords = explode(' ', $message);
        
        foreach ($keywords as $keyword) {
            // Exact keyword match
            if (strpos($message, $keyword) !== false) {
                $score += 1;
            }
            
            // Partial word match
            foreach ($messageWords as $word) {
                $word = preg_replace('/[^a-z0-9]/', '', $word);
                if (strlen($word) > 3 && strpos($keyword, $word) !== false) {
                    $score += 0.5;
                } elseif (strlen($word) > 3 && strpos($word, $keyword) !== false) {
                    $score += 0.5;
                }
            }
        }
        
        // Normalize score based on number of keywords
        return $score / max(count($keywords), 1);
    }

    public function clearChat()
    {
        Session::forget('chat_messages');
        
        return response()->json([
            'success' => true,
            'message' => 'Chat history cleared'
        ]);
    }
}