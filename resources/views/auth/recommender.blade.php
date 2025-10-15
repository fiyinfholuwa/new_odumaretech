<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OdumareTech - Discover Your Perfect Match</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f8f9fa;
        }

        .quiz-section {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .quiz-card {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
        }

        .quiz-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .quiz-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .quiz-subtitle {
            color: #6b7280;
            font-size: 1.1rem;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #9ca3af;
        }

        .step.active {
            background: #1e40af;
            color: white;
        }

        .step.completed {
            background: #10b981;
            color: white;
        }

        .question {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 2rem;
            text-align: center;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .option-btn {
            padding: 1.2rem 1.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background: white;
            color: #4b5563;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option-btn:hover {
            border-color: #1e40af;
            color: #1e40af;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30,64,175,0.1);
        }

        .option-btn.selected {
            border-color: #1e40af;
            background: #1e40af;
            color: white;
        }

        .hidden {
            display: none;
        }

        /* Recommendations Page Styles */
        .recommendations-section {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .recommendations-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .recommendations-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .course-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .course-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .course-image-placeholder {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
        }

        .course-content {
            padding: 1.5rem;
        }

        .course-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .course-description {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }

        .course-level {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #dbeafe;
            color: #1e40af;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .course-duration {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .course-price {
            color: #059669;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .cta-section {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            text-align: center;
            margin-bottom: 4rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
        }

        .cta-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 2rem;
        }

        .btn-primary-large {
            background: #1e40af;
            color: white;
            padding: 1rem 3rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-primary-large:hover {
            background: #1e3a8a;
        }

        .features-section {
            background: #f9fafb;
            border-radius: 16px;
            padding: 3rem;
            margin-bottom: 3rem;
        }

        .features-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            text-align: center;
            margin-bottom: 2rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .feature-item {
            text-align: center;
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .feature-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .feature-description {
            color: #6b7280;
            font-size: 0.95rem;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Quiz Section -->
    <section class="quiz-section" id="quizPage">
        <div class="quiz-card">
        
            <div class="quiz-header">
                                        <img  style="border-radius:10px; width: 200px;" src="{{ asset('logo.png') }}" alt="">

            
                <h1 class="quiz-title">Discover Your Perfect Match</h1>
                <p class="quiz-subtitle">Take our brief 3-question quiz to receive personalized recommendations tailored to your interests.</p>
            </div>

            <div class="step-indicator">
                <div class="step active" id="step1">1</div>
                <div style="width: 60px; height: 2px; background: #e5e7eb;"></div>
                <div class="step" id="step2">2</div>
                <div style="width: 60px; height: 2px; background: #e5e7eb;"></div>
                <div class="step" id="step3">3</div>
            </div>

            <!-- Question 1 -->
            <div id="question1">
                <h2 class="question">What do you want to learn about?</h2>
                <div class="options-grid" id="categoryOptions">
                    <!-- Categories will be dynamically inserted here -->
                </div>
            </div>

            <!-- Question 2 -->
            <div id="question2" class="hidden">
                <h2 class="question">What do you want to achieve?</h2>
                <div class="options-grid">
                    <button class="option-btn" data-value="job">Learn for a Job</button>
                    <button class="option-btn" data-value="career">Switch Career</button>
                    <button class="option-btn" data-value="skills">Improve Skills</button>
                    <button class="option-btn" data-value="hobby">Personal Hobby</button>
                    <button class="option-btn" data-value="business">Start a Business</button>
                    <button class="option-btn" data-value="freelance">Become a Freelancer</button>
                    <button class="option-btn" data-value="promotion">Get a Promotion</button>
                    <button class="option-btn" data-value="explore">Just Exploring</button>
                </div>
            </div>

            <!-- Question 3 -->
            <div id="question3" class="hidden">
                <h2 class="question">What's your current experience level?</h2>
                <div class="options-grid">
                    <button class="option-btn" data-value="beginner">Complete Beginner</button>
                    <button class="option-btn" data-value="some">Some Experience</button>
                    <button class="option-btn" data-value="intermediate">Intermediate</button>
                    <button class="option-btn" data-value="advanced">Advanced</button>
                </div>
            </div>

            <!-- Results -->
            <div id="results" class="hidden text-center">
                <h2 class="question">🎉 Perfect! We're finding your ideal courses...</h2>
                <p class="quiz-subtitle">Based on your selections, we'll recommend the best learning path for you.</p>
                <button class="btn-primary-large mt-4" id="viewRecommendations">View My Recommendations</button>
            </div>
        </div>
    </section>

    <!-- Recommendations Page -->
    <section class="recommendations-section hidden" id="recommendationsPage">
        <div class="recommendations-header fade-in">
            <h1 class="recommendations-title">We picked courses just for you</h1>
            <p class="quiz-subtitle">Based on your interests and goals, here are the perfect courses to start your journey</p>
        </div>

        <div class="course-grid" id="courseGrid">
            <!-- Courses will be dynamically inserted here -->
        </div>

        <div class="cta-section fade-in">
            <h2 class="cta-title">Ready to start your learning journey?</h2>
            <a style="text-decoration:none;" class="btn btn-primary" href="{{ route('register') }}">Get Started Now</a>
        </div>

        {{-- <div class="features-section fade-in">
            <h2 class="features-title">Discover what's possible</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">📚</div>
                    <h3 class="feature-title">Access beginner-friendly courses</h3>
                    <p class="feature-description">Start learning with courses designed specifically for newcomers</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">⚡</div>
                    <h3 class="feature-title">Gain new technical skills at your own pace</h3>
                    <p class="feature-description">Learn whenever and wherever you want, at a speed that suits you</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">💻</div>
                    <h3 class="feature-title">Code directly in your browser from day 1</h3>
                    <p class="feature-description">No setup required - start coding immediately with our interactive platform</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🌍</div>
                    <h3 class="feature-title">Join a vibrant community</h3>
                    <p class="feature-description">Connect with millions of learners worldwide on the same journey</p>
                </div>
            </div>
        </div> --}}
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // For demo purposes, using sample data
        const coursesFromLaravel =  @json($popular_courses)

        const answers = {};
        let currentQuestion = 1;
        let allCourses = [];
        let categories = [];

        // Process courses and extract unique categories
        function initializeCourses() {
            allCourses = coursesFromLaravel;
            
            // Extract unique categories
            const categoryMap = new Map();
            allCourses.forEach(course => {
                if (course.cat) {
                    categoryMap.set(course.cat.id, {
                        id: course.cat.id,
                        name: course.cat.name,
                        url: course.cat.category_url
                    });
                }
            });
            
            categories = Array.from(categoryMap.values());
            
            // Add "Not Sure Yet" option
            categories.push({id: 'not-sure', name: 'Not Sure Yet', url: 'not-sure'});
            
            // Render category options
            renderCategoryOptions();
        }

        // Render category buttons dynamically
        function renderCategoryOptions() {
            const categoryOptions = document.getElementById('categoryOptions');
            categoryOptions.innerHTML = '';
            
            categories.forEach(category => {
                const button = document.createElement('button');
                button.className = 'option-btn';
                button.setAttribute('data-value', category.url);
                button.setAttribute('data-id', category.id);
                button.textContent = category.name;
                categoryOptions.appendChild(button);
            });
            
            // Attach event listeners to newly created buttons
            attachQuestion1Listeners();
        }

        // Attach event listeners to Question 1 buttons
        function attachQuestion1Listeners() {
            document.querySelectorAll('#question1 .option-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    answers.categoryUrl = this.dataset.value;
                    answers.categoryId = this.dataset.id;
                    
                    document.querySelectorAll('#question1 .option-btn').forEach(b => b.classList.remove('selected'));
                    this.classList.add('selected');
                    
                    setTimeout(() => {
                        document.getElementById('question1').classList.add('hidden');
                        document.getElementById('question2').classList.remove('hidden');
                        document.getElementById('step1').classList.add('completed');
                        document.getElementById('step2').classList.add('active');
                        currentQuestion = 2;
                    }, 300);
                });
            });
        }

        // Handle option selection for Question 2
        document.querySelectorAll('#question2 .option-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                answers.goal = this.dataset.value;
                
                document.querySelectorAll('#question2 .option-btn').forEach(b => b.classList.remove('selected'));
                this.classList.add('selected');
                
                setTimeout(() => {
                    document.getElementById('question2').classList.add('hidden');
                    document.getElementById('question3').classList.remove('hidden');
                    document.getElementById('step2').classList.add('completed');
                    document.getElementById('step3').classList.add('active');
                    currentQuestion = 3;
                }, 300);
            });
        });

        // Handle option selection for Question 3
        document.querySelectorAll('#question3 .option-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                answers.level = this.dataset.value;
                
                document.querySelectorAll('#question3 .option-btn').forEach(b => b.classList.remove('selected'));
                this.classList.add('selected');
                
                setTimeout(() => {
                    document.getElementById('question3').classList.add('hidden');
                    document.getElementById('results').classList.remove('hidden');
                    document.getElementById('step3').classList.add('completed');
                    
                    console.log('User selections:', answers);
                }, 300);
            });
        });

        // Handle View Recommendations button
        document.getElementById('viewRecommendations').addEventListener('click', function() {
            document.getElementById('quizPage').classList.add('hidden');
            
            const recommendationsPage = document.getElementById('recommendationsPage');
            recommendationsPage.classList.remove('hidden');
            
            // Filter courses based on selected category and level
            let filteredCourses = allCourses;
            
            // Filter by category
            if (answers.categoryId && answers.categoryId !== 'not-sure') {
                filteredCourses = filteredCourses.filter(course => 
                    course.cat && course.cat.id == answers.categoryId
                );
            }
            
            // Filter by experience level
            if (answers.level) {
                filteredCourses = filteredCourses.filter(course => {
                    const courseLevel = course.level ? course.level.toLowerCase() : '';
                    
                    if (answers.level === 'beginner') {
                        return courseLevel === 'beginner';
                    } else if (answers.level === 'some') {
                        return courseLevel === 'beginner' || courseLevel === 'intermediate';
                    } else if (answers.level === 'intermediate') {
                        return courseLevel === 'intermediate';
                    } else if (answers.level === 'advanced') {
                        return courseLevel === 'advanced' || courseLevel === 'intermediate';
                    }
                    return true;
                });
            }
            
            // If no courses match, show all courses from selected category or all courses
            if (filteredCourses.length === 0) {
                if (answers.categoryId && answers.categoryId !== 'not-sure') {
                    filteredCourses = allCourses.filter(course => 
                        course.cat && course.cat.id == answers.categoryId
                    );
                } else {
                    filteredCourses = allCourses;
                }
            }
            
            displayCourses(filteredCourses);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        function displayCourses(courses) {
            const courseGrid = document.getElementById('courseGrid');
            courseGrid.innerHTML = '';
            
            const gradients = [
                'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
                'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
                'linear-gradient(135deg, #fa709a 0%, #fee140 100%)',
                'linear-gradient(135deg, #30cfd0 0%, #330867 100%)'
            ];
            
            // Show max 8 courses
            const displayCourses = courses.slice(0, 8);
            
            displayCourses.forEach((course, index) => {
                const courseCard = document.createElement('div');
                courseCard.className = 'course-card fade-in';
                courseCard.style.animationDelay = `${index * 0.1}s`;
                
                // Strip HTML tags from description
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = course.description || '';
                const cleanDescription = tempDiv.textContent || tempDiv.innerText || 'Enhance your skills with this comprehensive course';
                
                // Format price
                
                // Format duration
                const duration = course.duration ? `${course.duration} weeks` : 'Self-paced';
                
                courseCard.innerHTML = `
                    ${course.image ? 
                        `<img src="${course.image}" alt="${course.title}" class="course-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                         <div class="course-image-placeholder" style="display:none; background: ${gradients[index % gradients.length]}">
                            📚
                         </div>` 
                        : 
                        `<div class="course-image-placeholder" style="background: ${gradients[index % gradients.length]}">
                            📚
                         </div>`
                    }
                    <div class="course-content">
                        <h3 class="course-title">${course.title}</h3>
                        <div class="course-meta">
                            <span class="course-level">${course.level || 'All Levels'}</span>
                            <span class="course-duration">⏱️ ${duration}</span>
                        </div>
                        <div class="course-meta" style="border-top: none; padding-top: 0.5rem;">
                            ${course.cat ? `<span style="color: #6b7280; font-size: 0.85rem;">${course.cat.name}</span>` : ''}
                        </div>
                    </div>
                `;
                
                courseGrid.appendChild(courseCard);
            });
            
            // If no courses found, show message
            if (displayCourses.length === 0) {
                courseGrid.innerHTML = `
                    <div style="grid-column: 1/-1; text-align: center; padding: 3rem;">
                        <h3 style="color: #6b7280; margin-bottom: 1rem;">No courses found</h3>
                        <p style="color: #9ca3af;">Try adjusting your preferences or browse all our courses.</p>
                    </div>
                `;
            }
        }

        // Initialize on page load
        initializeCourses();
    </script>
</body>
</html>