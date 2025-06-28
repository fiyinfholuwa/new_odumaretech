@extends('instructor.app')

@section('content')
            
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OdumareTech Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        .welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card.blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .stat-card.orange {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        
        .stat-card.green {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        
        .stat-card.yellow {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }
        
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .course-item {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: between;
            align-items: center;
            transition: background-color 0.3s ease;
        }
        
        .course-item:hover {
            background: #e9ecef;
        }
        
        .btn-view {
            background: #667eea;
            color: white;
            border: none;
            padding: 0.25rem 0.75rem;
            border-radius: 5px;
            font-size: 0.8rem;
        }
        
        .btn-view:hover {
            background: #5a6fd8;
            color: white;
        }
        
        .calendar-container {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            gap: 0.5rem;
        }
        
        .calendar-day {
            padding: 0.5rem;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .calendar-day:hover {
            background: #e9ecef;
        }
        
        .calendar-day.active {
            background: #667eea;
            color: white;
        }
        
        .calendar-day.other-month {
            color: #6c757d;
        }
        
        .notifications-panel {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }
        
        .notification-item {
            padding: 1rem;
            border-left: 4px solid #667eea;
            background: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        
        .notification-item:last-child {
            margin-bottom: 0;
        }
        
        .notification-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .notification-desc {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        
        .notification-time {
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Welcome Section -->
        <div style="margin-bottom:30px;">
            <h2 class="mb-0">Welcome Abayomi Bello 👋</h2>
        </div>
        
        <div class="row">
            <!-- Main Dashboard Content -->
            <div class="col-lg-12">
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div style="background:#E9ECFF;"  class="stat-card blue">
                            <div class="stat-icon">
                                <i style="background:#0E2293;padding:20px;border-radius:5px;"  class="fas fa-users"></i>
                            </div>
                            <div class="stat-number text-dark" id="studentsCount">20</div>
                            <div class="stat-label text-muted">Students</div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div style="background:#E9ECFF;" class="stat-card orange">
                            <div class="stat-icon">
                                <i style="background:#0E2293;padding:20px;border-radius:5px;"  class="fas fa-tasks"></i>
                            </div>
                            <div class="stat-number text-dark" id="assignmentsCount">10</div>
                            <div class="stat-label text-muted">Assignments</div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div style="background:#E9ECFF;" class="stat-card green">
                            <div class="stat-icon">
                                <i style="background:#0E2293;padding:20px;border-radius:5px;" class="fas fa-book"></i>
                            </div>
                            <div class="stat-number text-dark" id="coursesCount">24</div>
                            <div class="stat-label text-muted">Courses</div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div style="background:#FFF3CF;"  class="stat-card blue">
                            <div class="stat-icon">
                                <i style="background:#FFC000;padding:20px;border-radius:5px;"  class="fas fa-users"></i>
                            </div>
                            <div class="stat-number text-dark" id="slidesCount">20</div>
                            <div class="stat-label text-muted">Students</div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div style="background:#FFF3CF;" class="stat-card orange">
                            <div class="stat-icon">
                                <i style="background:#FFC000;padding:20px;border-radius:5px;"  class="fas fa-tasks"></i>
                            </div>
                            <div class="stat-number text-dark" id="projectsCount">10</div>
                            <div class="stat-label text-muted">Assignments</div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div style="background:#FFF3CF;" class="stat-card green">
                            <div class="stat-icon">
                                <i style="background:#FFC000;padding:20px;border-radius:5px;"  class="fas fa-book"></i>
                            </div>
                            <div class="stat-number text-dark" id="coursesCount">24</div>
                            <div class="stat-label text-muted">Courses</div>
                        </div>
                    </div>
                    <div style="display:none;" class="col-md-3 mb-3">
                        <div class="stat-card yellow">
                            <div class="stat-icon">
                                <i class="fas fa-video"></i>
                            </div>
                            <div class="stat-number" id="liveSessionsCount">1,204</div>
                            <div class="stat-label">Live Sessions</div>
                        </div>
                    </div>
                </div>
                

               
                <!-- Recent Courses and Slides -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="chart-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Recent Created Course</h5>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                            <div id="recentCourses">
                                <!-- Will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chart-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Slides</h5>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                            <div id="recentSlides">
                                <!-- Will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="calendar-container">
                            <div class="calendar-header">
                                <button class="btn btn-sm btn-outline-primary" onclick="changeMonth(-1)">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <h6 class="mb-0" id="currentMonth">June 2025</h6>
                                <button class="btn btn-sm btn-outline-primary" onclick="changeMonth(1)">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                            <div class="calendar-grid" id="calendarGrid">
                                <!-- Calendar will be generated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="chart-container">
                            <h5 class="mb-3">Hours Spent</h5>
                            <canvas id="hoursChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="chart-container">
                            <h5 class="mb-3">Student Engagement</h5>
                            <canvas id="engagementChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
           
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Dashboard data
        let dashboardData = {
            students: 20,
            assignments: 10,
            courses: 24,
            liveSessions: 1204,
            slides: 23,
            projects: 23,
            recentCourses: [
                { name: "Web Development (Frontend)", type: "Frontend" },
                { name: "Web Development (Frontend)", type: "Frontend" },
                { name: "Web Development (Frontend)", type: "Frontend" }
            ],
            recentSlides: [
                { name: "Web Development for Teens (Front End)", type: "view resources" },
                { name: "Web Development for Teens (Front End)", type: "view resources" }
            ],
            notifications: [
                {
                    title: "New Assignment Due",
                    description: "Complete 'Introduction to React' quiz by Friday.",
                    time: "Join 'Advanced JavaScript Patterns' tomorrow at 2 PM."
                },
                {
                    title: "Upcoming Live Session",
                    description: "Join 'Advanced JavaScript Patterns' tomorrow at 2 PM.",
                    time: "2 hours ago"
                }
            ]
        };

        // Current date
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();

        // Initialize dashboard
        function initializeDashboard() {
            loadDashboardData();
            generateCalendar();
            initializeCharts();
        }

        // Load dashboard data via AJAX (simulated)
        function loadDashboardData() {
            // In a real application, this would be an AJAX call to a PHP script
            // For demo purposes, we'll use the local data
            updateDashboardStats();
            loadRecentCourses();
            loadRecentSlides();
        }

        // Update dashboard statistics
        function updateDashboardStats() {
            document.getElementById('studentsCount').textContent = dashboardData.students;
            document.getElementById('assignmentsCount').textContent = dashboardData.assignments;
            document.getElementById('coursesCount').textContent = dashboardData.courses;
            document.getElementById('liveSessionsCount').textContent = dashboardData.liveSessions.toLocaleString();
            document.getElementById('slidesCount').textContent = dashboardData.slides;
            document.getElementById('projectsCount').textContent = dashboardData.projects;
        }

        // Load recent courses
        function loadRecentCourses() {
            const container = document.getElementById('recentCourses');
            container.innerHTML = '';
            
            dashboardData.recentCourses.forEach(course => {
                const courseItem = document.createElement('div');
                courseItem.className = 'course-item';
                courseItem.innerHTML = `
                    <div>
                        <div class="fw-bold">${course.name}</div>
                        <small class="text-muted">${course.type}</small>
                    </div>
                `;
                container.appendChild(courseItem);
            });
        }

        // Load recent slides
        function loadRecentSlides() {
            const container = document.getElementById('recentSlides');
            container.innerHTML = '';
            
            dashboardData.recentSlides.forEach(slide => {
                const slideItem = document.createElement('div');
                slideItem.className = 'course-item';
                slideItem.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div>
                            <div class="fw-bold">${slide.name}</div>
                            <small class="text-muted">${slide.type}</small>
                        </div>
                        <button class="btn-view">View</button>
                    </div>
                `;
                container.appendChild(slideItem);
            });
        }

        // Load notifications
        function loadNotifications() {
            const container = document.getElementById('notificationsList');
            container.innerHTML = '';
            
            dashboardData.notifications.forEach(notification => {
                const notificationItem = document.createElement('div');
                notificationItem.className = 'notification-item';
                notificationItem.innerHTML = `
                    <div class="notification-title">${notification.title}</div>
                    <div class="notification-desc">${notification.description}</div>
                    <div class="notification-time">${notification.time}</div>
                `;
                container.appendChild(notificationItem);
            });
        }

        // Generate calendar
        function generateCalendar() {
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            
            document.getElementById('currentMonth').textContent = `${monthNames[currentMonth]} ${currentYear}`;
            
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            
            const calendarGrid = document.getElementById('calendarGrid');
            calendarGrid.innerHTML = '';
            
            // Add day headers
            const dayHeaders = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
            dayHeaders.forEach(day => {
                const dayHeader = document.createElement('div');
                dayHeader.className = 'calendar-day fw-bold';
                dayHeader.textContent = day;
                calendarGrid.appendChild(dayHeader);
            });
            
            // Add empty cells for days before the first day of the month
            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'calendar-day other-month';
                calendarGrid.appendChild(emptyDay);
            }
            
            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
                dayElement.textContent = day;
                
                // Highlight current day
                if (day === currentDate.getDate() && currentMonth === new Date().getMonth() && currentYear === new Date().getFullYear()) {
                    dayElement.classList.add('active');
                }
                
                calendarGrid.appendChild(dayElement);
            }
        }

        // Change month
        function changeMonth(direction) {
            currentMonth += direction;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            } else if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar();
        }

        // Initialize charts
        function initializeCharts() {
            // Hours Spent Chart
            const hoursCtx = document.getElementById('hoursChart').getContext('2d');
            new Chart(hoursCtx, {
                type: 'bar',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Hours',
                        data: [8, 6, 12, 8, 10, 12, 4],
                        backgroundColor: [
                            '#ffc107', '#ffc107', '#ffc107', '#ffc107', 
                            '#ffc107', '#ffc107', '#ffc107'
                        ],
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 24,
                            ticks: {
                                callback: function(value) {
                                    return value + 'hr';
                                }
                            }
                        }
                    }
                }
            });

            // Student Engagement Chart
            const engagementCtx = document.getElementById('engagementChart').getContext('2d');
            new Chart(engagementCtx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [
                        {
                            label: 'Live Sessions',
                            data: [65, 45, 80, 65, 70, 85, 60],
                            borderColor: '#17a2b8',
                            backgroundColor: 'rgba(23, 162, 184, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Recorded Sessions',
                            data: [55, 35, 70, 55, 60, 75, 50],
                            borderColor: '#ffc107',
                            backgroundColor: 'rgba(255, 193, 7, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Assignment Submission',
                            data: [75, 55, 90, 75, 80, 95, 70],
                            borderColor: '#28a745',
                            backgroundColor: 'rgba(40, 167, 69, 0.1)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 280
                        }
                    }
                }
            });
        }

        // Simulate real-time data updates
        function updateRealTimeData() {
            // Simulate random updates to dashboard data
            dashboardData.students += Math.floor(Math.random() * 3) - 1;
            dashboardData.assignments += Math.floor(Math.random() * 2);
            dashboardData.liveSessions += Math.floor(Math.random() * 10);
            
            // Ensure minimum values
            dashboardData.students = Math.max(15, dashboardData.students);
            dashboardData.assignments = Math.max(8, dashboardData.assignments);
            dashboardData.liveSessions = Math.max(1200, dashboardData.liveSessions);
            
            updateDashboardStats();
        }

        // Initialize dashboard when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initializeDashboard();
            
            // Update data every 30 seconds
            setInterval(updateRealTimeData, 30000);
        });

        // PHP Integration Functions (for when you implement backend)
        function fetchDashboardData() {
            fetch('dashboard_api.php?action=get_stats')
                .then(response => response.json())
                .then(data => {
                    dashboardData = data;
                    updateDashboardStats();
                    loadRecentCourses();
                    loadRecentSlides();
                })
                .catch(error => console.error('Error fetching dashboard data:', error));
        }

        function updateCourseStatus(courseId, status) {
            fetch('dashboard_api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'update_course_status',
                    course_id: courseId,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadRecentCourses();
                }
            })
            .catch(error => console.error('Error updating course status:', error));
        }
    </script>
</body>
</html>
@endsection