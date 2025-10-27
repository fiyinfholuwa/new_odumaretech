
@extends('admin.app')

@section('page', 'Admin Dashboard')
@section('content')
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Content</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
        <style>
            .stat-card {
                border-radius: 15px;
                padding: 25px;
                height: 150px;
                border: none;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .stat-card-blue { background: #E9ECFF }
            .stat-card-purple { background: #E9ECFF}
            .stat-card-dark { background: #E9ECFF }
            .stat-card-yellow { background: #FFF3CF }
            .stat-card-orange { background: #FFF3CF }
            .stat-card-pink { background: #FFF3CF }

            /*.stat-card-blue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }*/
            /*.stat-card-purple { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }*/
            /*.stat-card-dark { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }*/
            /*.stat-card-yellow { background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); color: #333; }*/
            /*.stat-card-orange { background: linear-gradient(135deg, #fdbb2d 0%, #22c1c3 100%); color: white; }*/
            /*.stat-card-pink { background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); color: #333; }*/

            .stat-icon {
                font-size: 2rem;
                margin-right: 20px;
                padding: 15px;
                border-radius: 10px;
                background: rgba(255, 255, 255, 0.2);
            }

            .stat-number {
                font-size: 2.5rem;
                font-weight: bold;
                margin: 0;
            }

            .stat-label {
                font-size: 1rem;
                opacity: 0.9;
                margin: 0;
            }

            .section-card {
                background: white;
                border-radius: 15px;
                padding: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border: none;

                height: 100%;
            }

            .section-title {
                font-size: 1.1rem;
                font-weight: 600;
                margin-bottom: 15px;
                color: #333;
            }

            .list-item {
                padding: 10px 0;
                border-bottom: 1px solid #f0f0f0;
                display: flex;
                justify-content: between;
                align-items: center;
            }

            .list-item:last-child {
                border-bottom: none;
            }

            .chart-container {
                position: relative;
                height: 300px;
            }

            .welcome-title {
                font-size: 2rem;
                font-weight: bold;
                color: #333;
                margin-bottom: 30px;
            }

            .calendar-container {
                background: white;
                border-radius: 15px;
                padding: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .calendar-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .calendar-grid {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                gap: 5px;
                text-align: center;
            }

            .calendar-day {
                padding: 8px;
                border-radius: 5px;
                cursor: pointer;
            }

            .calendar-day:hover {
                background: #f8f9fa;
            }

            .calendar-day.active {
                background: #007bff;
                color: white;
            }

            .calendar-day.other-month {
                color: #ccc;
            }

            .revenue-trend {
                color: #28a745;
                font-size: 0.9rem;
            }
        </style>
    </head>
    <body>

    <?php

    
    $stats = [
        'students' =>  $users ,
        'instructors' =>  $instructors ,
        'courses' => $courses ,
        'total_revenue' => 120482,
        'revenue_growth' => 12,
        'testimonials' => $testimonial ,
        'master_class' => 23
    ];

    
    
    
    
    
    ?>

    <div class="container-fluid p-4">
        <!-- Welcome Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="welcome-title">Welcome 👋</h1>
            </div>
        </div>

        <!-- Stats Cards Row 1 -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card stat-card stat-card-blue">
                    <div class="row">
                        <div class="col-4">
                            <div style="background-color: #0E2293" class="stat-icon">
                                <i  class="fas fa-user-graduate text-white"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div>
                                <p class="stat-label text-muted">Students</p>

                                <p class="stat-number"><?php echo $stats['students']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stat-card stat-card-purple">
                    <div class="row">
                        <div class="col-4">
                            <div style="background-color: #0E2293" class="stat-icon">
                                <i class="fas fa-chalkboard-teacher text-white"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div>
                                <p class="stat-label text-muted">Instructors</p>
                                <p class="stat-number"><?php echo $stats['instructors']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stat-card stat-card-dark">
                    <div class="row">
                        <div class="col-4">
                            <div style="background-color: #0E2293" class="stat-icon">
                                <i class="fas fa-book text-white"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div>
                                <p class="stat-label text-muted">Courses</p>
                                <p class="stat-number"><?php echo $stats['courses']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Row 2 -->
        <div style="display:none;" class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card stat-card stat-card-yellow">
                    <div class="row">
                        <div class="col-4">
                            <div style="background-color: #FFC000;" class="stat-icon">
                                <i class="fas fa-dollar-sign text-white"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div>
                                <p class="stat-label">Total Revenue </p>
                                <p class="stat-number">$<?php echo number_format($stats['total_revenue']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stat-card stat-card-orange">
                    <div class="row">
                        <div  class="col-4">
                            <div style="background-color: #FFC000;" class="stat-icon">
                                <i class="fas fa-comments text-white"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div>
                                <p class="stat-label text-muted">Testimonials</p>
                                <p class="stat-number"><?php echo number_format($stats['testimonials']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stat-card stat-card-pink">
                    <div class="row">
                        <div class="col-4">
                            <div style="background-color: #FFC000;" class="stat-icon">
                                <i class="fas fa-star text-white"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div>
                                <p class="stat-label text-muted">Master Class</p>
                                <p class="stat-number"><?php echo $stats['master_class']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Sections Row -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card section-card">
                    <div class="section-title">
                        <i class="fas fa-play-circle me-2"></i>Recent Masterclass
                    </div>
                    <hr/>
                    <?php foreach($recent_masterclass as $class): ?>
                    <div class="list-item">
                        <div>
                            <div class="fw-semibold"><?php echo $class['title']; ?></div>
<small class="text-muted">
    <?php
        $time = strtotime($class['date']);
        $diff = time() - $time;

        if ($diff < 60)
            echo $diff . " seconds ago";
        elseif ($diff < 3600)
            echo floor($diff / 60) . " minutes ago";
        elseif ($diff < 86400)
            echo floor($diff / 3600) . " hours ago";
        elseif ($diff < 604800)
            echo floor($diff / 86400) . " days ago";
        else
            echo date('M d, Y', $time);
    ?>
</small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card section-card">
                    <div class="section-title">
                        <i class="fas fa-lightbulb me-2"></i>Innovations
                    </div>
                    <hr/>

                    <?php foreach($innovations as $innovation): ?>
                    <div class="list-item">
                        <div>
                            <div class="fw-semibold"><?php echo $innovation['name']; ?></div>
<?php
$status = strtolower($innovation['status']);

$style = match ($status) {
    'upcoming' => 'background-color:#cce5ff; color:#004085;',   // soft blue
    'running' => 'background-color:#fff3cd; color:#856404;',    // soft yellow/orange
    'completed' => 'background-color:#d4edda; color:#155724;',  // soft green
    default => 'background-color:#e2e3e5; color:#383d41;',       // neutral gray
};
?>

<small style="padding:4px 10px; border-radius:12px; font-weight:500; <?= $style ?>">
    <?= ucfirst($status) ?>
</small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card section-card">
                    <div class="section-title">
                        <i class="fas fa-blog me-2"></i>Blogs
                    </div>
                    <hr/>

                    <?php foreach($blogs as $blog): ?>
                    <div class="list-item">
                        <div>
                            <div class="fw-semibold"><?php echo $blog['name']; ?></div>
                            <small class="text-muted"><?php echo date('M d, Y', strtotime($blog['created_at'])); ?></small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <button class="btn btn-sm btn-outline-secondary" onclick="previousMonth()">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <h6 class="mb-0" id="calendarMonth">June 2025</h6>
                        <button class="btn btn-sm btn-outline-secondary" onclick="nextMonth()">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="calendar-grid" id="calendarGrid">
                        <!-- Calendar will be generated by JavaScript -->
                    </div>
                </div>
            </div>

        </div>

        <!-- Charts and Calendar Row -->
<div class="row {{ Auth::user()->user_type !== 'admin' ? 'd-none' : '' }}">
            <div class="col-md-6 mb-3">
                <div class="card section-card">
                    <div class="section-title">
                        <i class="fas fa-chart-bar me-2"></i>Top Purchased Course
                    </div>
                    <div class="chart-container">
                        <canvas id="purchaseChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card section-card">
                    <div class="section-title">
                        <i class="fas fa-chart-line me-2"></i>Revenue
                    </div>
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Chart data from PHP
        const courseData = <?php echo json_encode($course_purchases); ?>;
        const revenueData = <?php echo json_encode($monthly_revenue); ?>;

        // Purchase Chart
        const purchaseCtx = document.getElementById('purchaseChart').getContext('2d');
        new Chart(purchaseCtx, {
            type: 'bar',
            data: {
                labels: courseData.map(item => item.title),
                datasets: [{
                    data: courseData.map(item => item.student_count),
                    backgroundColor: [
                        '#4facfe',
                        '#fdbb2d',
                        '#43e97b',
                        '#fa709a',
                        '#667eea'
                    ],
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revenueData.map(item => item.month),
                datasets: [{
                    data: revenueData.map(item => item.revenue),
                    borderColor: '#fdbb2d',
                    backgroundColor: 'rgba(253, 187, 45, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointBackgroundColor: '#fdbb2d',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + (value/1000) + 'k';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Calendar functionality
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();

        const months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        const daysOfWeek = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];

        function generateCalendar(month, year) {
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const today = new Date();

            document.getElementById('calendarMonth').textContent = months[month] + ' ' + year;

            let calendarHTML = '';

            // Days of week headers
            daysOfWeek.forEach(day => {
                calendarHTML += `<div class="calendar-day fw-bold text-muted">${day}</div>`;
            });

            // Empty cells for days before month starts
            for (let i = 0; i < firstDay; i++) {
                const prevMonthDay = new Date(year, month, 0 - (firstDay - 1 - i)).getDate();
                calendarHTML += `<div class="calendar-day other-month">${prevMonthDay}</div>`;
            }

            // Days of current month
            for (let day = 1; day <= daysInMonth; day++) {
                const isToday = (day === today.getDate() && month === today.getMonth() && year === today.getFullYear());
                const activeClass = isToday ? 'active' : '';
                calendarHTML += `<div class="calendar-day ${activeClass}">${day}</div>`;
            }

            // Fill remaining cells
            const totalCells = Math.ceil((firstDay + daysInMonth) / 7) * 7;
            const remainingCells = totalCells - (firstDay + daysInMonth);
            for (let day = 1; day <= remainingCells; day++) {
                calendarHTML += `<div class="calendar-day other-month">${day}</div>`;
            }

            document.getElementById('calendarGrid').innerHTML = calendarHTML;
        }

        function previousMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar(currentMonth, currentYear);
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar(currentMonth, currentYear);
        }

        // Initialize calendar
        generateCalendar(currentMonth, currentYear);
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>    <!-- [ Main Content ] end -->
@endsection
