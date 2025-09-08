
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
  align-items: center;
  justify-content: center;
" class="section dark-background">
        <div  class="text-center" style="max-width: 800px; margin-top: 150px;  padding: 20px;">
            <span style="background: white; padding: 5px 10px; border-radius: 20px; font-weight: bold; color: #0E2293;">Top Instructors</span>
            <h2 style="margin-top: 20px;">Learn from the Best, Achieve the Best</h2>

            <p style="margin: 15px 0;">
            Discover courses taught by exceptional digital professionals with proven expertise and real-world success. Our instructors aren’t just teachers, they are industry leaders who bring practical insights, cutting-edge strategies, and years of experience to every lesson.
</p>
            
        </div>
    </section>


 <section style="background-color:; padding: 60px 0;" class="why_odumare">
        <div class="container">
            <div class=" mb-5">
                <span class="badge bg-primary fs-5 mb-2">Sell Your Courses </span>

            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h2 style="color: #0E2293;" class="fw-bold">Turn Your Knowledge Into Income</h2>
                    <p style="color: #5A5A5A;" class="">
                        Join thousands of instructors who are already earning by sharing their expertise on our marketplace.</p>
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/EaGakAaLt5g?si=IkxAQ37BMNTWVJEF"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <div class="col-lg-6">
                    <?php
                    $features = [
                        [
                            'icon' => 'fa-dollar-sign',
                            'title' => 'Earn Revenue',
                            'desc' => "Get paid for every course purchase with our competitive revenue sharing model",
                        ],
                        [
                            'icon' => 'fa-bullhorn',
                            'title' => "Grow Your Audience",
                            'desc' => "Reach millions of students worldwide and build your teaching brand",
                        ],
                        [
                            'icon' => 'fa-chalkboard-teacher',
                            'title' => 'Teach Your Way',
                            'desc' => 'Create courses at your own pace with our easy-to-use course builder',
                        ],
                    ];

                    foreach ($features as $feature):
                        ?>
                    <div class="d-flex mb-4 p-3 rounded" style="background-color: #E9ECFF;">
                        <div class="me-3 d-flex align-items-center justify-content-center" >
                            <i style="padding: 10px; background: #4A6CF7; border-radius:100%" class="fa <?=$feature['icon'];?> text-white fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold"><?=$feature['title'];?></h5>
                            <p class="mb-0 text-muted"><?=$feature['desc'];?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <a href="{{ route('sell.course') }}" style="background-color: #0E2293;" class="btn btn-primary border-0">Sell Your Course</a>

                </div>
            </div>
        </div>
    </section>


 @if (count($instructors) > 0)
    <section style="background-color: #FFF3CF; padding: 60px 0;">
        <div class="container">
            <h3 class="mb-4 fw-bold text-center">Top Instructors</h3>
            <div class="row">
                @foreach($instructors as $instructor)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0" style="border-radius: 20px;">
                            <img src="{{ asset($instructor['image']) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $instructor['name'] }}">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="fw-bold mb-1">{{ $instructor['name'] }}</h5>
                                <p class="text-muted mb-2">{{ $instructor['title'] }}</p>
                                <div class="d-flex justify-content-between mt-auto">
                                    <div>
                                        <strong>{{ $instructor['student_count'] }}</strong><br>
                                        <small class="text-muted">Students</small>
                                    </div>
                                    <hr/>
                                    <div>
                                        <strong style="color: green;">${{ $instructor['cumulative_earning'] }}</strong><br>
                                        <small class="text-muted">Earnings</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

        
    @endif
   

</main>

@endsection
