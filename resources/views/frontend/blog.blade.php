
@extends('frontend.layout.app')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section style="
  height: 60vh;
  background: linear-gradient(45deg, #041845, #0a3d62, #041845);
  background-size: 400% 400%;
  animation: animateBackground 10s ease infinite;
  color: #fff;
  display: flex;
  flex-direction: column; /* Stack items vertically */
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 20px;
" class="section dark-background">

        <div style="max-width: 700px; margin-bottom: 20px; margin-top: 100px;">
            <h2 style="margin-top: 20px;">Dive into our Blog Posts</h2>
            <p style="margin: 15px 0;">
                Thoughtfully curated by experts to seamlessly guide your learning experience. Read and learn with confidence.
            </p>
        </div>

        <div class="blog-form-section">
            <div class="blog-form-group">
                <input type="text" placeholder="Enter Keyword">
                <select>
                    <option>Select Category</option>
                </select>
                <button>Search Blog</button>
            </div>
        </div>

    </section>


    <section class="popular-section py-5">
        <div class="container popular">
            <div class="section-header text-center mb-5">
                <!-- You can add a heading or description here if you want -->
            </div>
            <div class="course-list row g-4">
                <?php
                $courses = [
                    [
                        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSLTTbwYtmozuV9DOL8N0iYvU-37x2fm1TVA&s',
                        'category' => 'Web Development',
                        'title' => 'Frontend Development',
                        'description' => 'This immersive program covers front-end development, equipping you with the skills needed to create stunning and interactive websites and web applications.',
                    ],
                    [
                        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSLTTbwYtmozuV9DOL8N0iYvU-37x2fm1TVA&s',
                        'category' => 'Data Science',
                        'title' => 'Data Analytics',
                        'description' => 'Learn how to work with data, analyze patterns, and make decisions using real-world datasets and powerful tools like Python and SQL.',
                    ],
                    [
                        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSLTTbwYtmozuV9DOL8N0iYvU-37x2fm1TVA&s',
                        'category' => 'Cybersecurity',
                        'title' => 'Ethical Hacking',
                        'description' => 'Master the skills needed to protect systems and networks from cyber attacks with hands-on ethical hacking training.',
                    ],
                    [
                        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSLTTbwYtmozuV9DOL8N0iYvU-37x2fm1TVA&s',
                        'category' => 'Cybersecurity',
                        'title' => 'Network Security',
                        'description' => 'Understand the foundations of securing enterprise-level networks and protecting digital assets.',
                    ],[
                        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSLTTbwYtmozuV9DOL8N0iYvU-37x2fm1TVA&s',
                        'category' => 'Cybersecurity',
                        'title' => 'Network Security',
                        'description' => 'Understand the foundations of securing enterprise-level networks and protecting digital assets.',
                    ],[
                        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSLTTbwYtmozuV9DOL8N0iYvU-37x2fm1TVA&s',
                        'category' => 'Cybersecurity',
                        'title' => 'Network Security',
                        'description' => 'Understand the foundations of securing enterprise-level networks and protecting digital assets.',
                    ],
                ];

                $colors = ['#E9ECFF'];

                foreach ($courses as $index => $course) {
                    $colorIndex = floor($index / 2) % count($colors);
                    $bgColor = $colors[$colorIndex];
                    ?>
                <div class="col-lg-4 col-md-6">
                    <div style="background-color: <?php echo $bgColor; ?>;" class="course-card p-3 shadow-sm rounded-4 position-relative d-flex flex-column">
                        <div class="course-image position-relative overflow-hidden rounded-3">
                            <img src="<?php echo $course['image']; ?>" alt="Course Image" class="img-fluid w-100">
                            <div class="course-title-overlay-top-left">
                                    <?php echo $course['title']; ?>
                            </div>
                        </div>
                        <div class="flex-grow-1 mt-3">
                            <p class="text-muted"><?php echo $course['description']; ?></p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <a href="#" class="btn btn-primary fw-bold btn-sm">Read More</a>
                            <div class="social-icons d-flex gap-2">
                                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <style>
            .course-card {
                min-height: 450px; /* Adjust the card height here */
                display: flex;
                flex-direction: column;
            }

            .course-image {
                position: relative;
            }

            .course-title-overlay-top-left {
                position: absolute;
                top: 10px;
                left: 10px;
                background: rgba(4, 24, 69, 0.8);
                color: #fff;
                padding:  12px;
                border-radius: 5px;
                font-weight: bold;
                font-size: 0.95rem;
            }

            .social-icons {
                display: flex;
                gap: 8px;
            }

            .social-icon {
                display: inline-flex;
                align-items: center;
                width: 32px;
                height: 32px;
                background: white;
                color: #041845;
                font-size: 14px;
                text-decoration: none;
                padding: 10px;
                transition: background 0.3s, color 0.3s;
            }

            .social-icon:hover {
                background: #041845;
                color: white;
            }
        </style>

        <!-- Load Font Awesome for the icons -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    </section>


</main>

@endsection
