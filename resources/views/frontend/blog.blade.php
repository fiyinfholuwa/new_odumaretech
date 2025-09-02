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
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
    " class="section dark-background">

        <div style="max-width: 700px; margin-bottom: 20px; margin-top: 100px;">
            <h2 class="mt-4">Dive into our Blog Posts</h2>
            <p class="my-3">
                Thoughtfully curated by experts to seamlessly guide your learning experience. Read and learn with confidence.
            </p>
        </div>

        <div class="container my-5" style="max-width: 900px;">
    <div class="card shadow-sm p-4 rounded-3 bg-light border-0">
        <form method="GET" class="row g-3 align-items-center justify-content-center">
            
            <!-- Search Input -->
            <div class="col-12 col-md-8">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-primary text-white border-0 rounded-start-3">
                        🔍
                    </span>
                    <input name="keyword" type="text"
                           class="form-control border-0 shadow-sm"
                           placeholder="Search by title or description..."
                           value="{{ request('keyword') }}">
                </div>
            </div>

            <!-- Search Button -->
            <div class="col-6 col-md-auto">
                <button type="submit" class="btn btn-primary btn-lg shadow-sm px-4 rounded-3">
                    Search
                </button>
            </div>

            <!-- Clear Button (only if searching) -->
            @if(request('keyword'))
                <div class="col-6 col-md-auto">
                    <a href="{{ route('blog') }}" class="btn btn-outline-secondary btn-lg shadow-sm px-4 rounded-3">
                        Clear
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

    </section>

    <!-- Blog Posts Section -->
    <section class="popular-section py-5">
        <div class="container popular">
           
            @if(request('keyword'))
                <div class="text-center mb-4">
                    <h5 class="fw-semibold">
                        Found {{ $blogs->total() }} result{{ $blogs->total() !== 1 ? 's' : '' }} for
                        "<span class="text-primary">{{ request('keyword') }}</span>"
                    </h5>
                </div>
            @endif

            <div class="row g-4">
                @forelse($blogs as $index => $course)
                    @php
                        $colors = ['#E9ECFF'];
                        $bgColor = $colors[$index % count($colors)];
                        $words = explode(' ', strip_tags($course['desc']));
                        $shortDesc = implode(' ', array_slice($words, 0, 50));
                    @endphp

                    <div class="col-lg-4 col-md-6">
                        <div class="p-3 shadow-sm rounded-4 position-relative d-flex flex-column h-100"
                             style="background-color: {{ $bgColor }};">
                            <div class="course-image position-relative overflow-hidden rounded-3">
                                <img src="{{ $course['image'] }}" alt="Course Image"
                                     class="img-fluid w-100" style="height: 200px; object-fit: cover;">
                            </div>

                            <div class="flex-grow-1 mt-3">
                                <p class="text-muted" style="font-size: 0.95rem;">
                                    {{ $shortDesc }}{{ count($words) > 50 ? '...' : '' }}
                                </p>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <a href="{{ $course['link'] }}" target="_blank"
                                   class="btn btn-primary btn-sm fw-bold"
                                   style="background-color: #0E2293;">Read More</a>

                                <div class="social-icons d-flex gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($course['link']) }}"
                                       target="_blank" class="social-icon">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode($course['link']) }}"
                                       target="_blank" class="social-icon">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($course['link']) }}"
                                       target="_blank" class="social-icon">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info py-4 px-3 rounded-3">
                            @if(request('keyword'))
                                <p>No blog posts found for "<strong>{{ request('keyword') }}</strong>".</p>
                            @else
                                <p>No blog posts available yet. Please check back later.</p>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
{{ $blogs->links('frontend.paginate') }}
            </div>
        </div>

        <style>
            .course-card {
                min-height: 450px;
                display: flex;
                flex-direction: column;
            }

            .course-image img {
                transition: transform 0.3s ease;
            }

            .course-image:hover img {
                transform: scale(1.05);
            }

            .social-icons {
                display: flex;
                gap: 8px;
            }

            .social-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 32px;
                height: 32px;
                background: white;
                color: #041845;
                font-size: 14px;
                border-radius: 50%;
                text-decoration: none;
                transition: background 0.3s, color 0.3s;
            }

            .social-icon:hover {
                background: #041845;
                color: white;
            }
        </style>

        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </section>

</main>
@endsection
