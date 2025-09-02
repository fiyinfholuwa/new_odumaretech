@extends('frontend.layout.app')

@section('content')
<main class="main">

    {{-- Hero Section --}}
    <style>
        @keyframes animateBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .course-card {
            background-color: #E9ECFF;
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px;
            border-radius: 8px;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .course-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
        }
        .course-title {
            font-size: 1rem;
            font-weight: 600;
            flex-grow: 1;
        }
        .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
        .course-footer {
            margin-top: auto;
        }
    </style>

    {{-- Search + Filter Section --}}
    <section style="
        height: 40vh;
        background: linear-gradient(45deg, #041845, #0a3d62, #041845);
        background-size: 400% 400%;
        animation: animateBackground 10s ease infinite;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 0;
    " class="section dark-background">
        <div class="container text-white">
            <form method="GET" action="{{ route('course_list') }}">
    <div class="row mb-4 g-3 align-items-center">
        {{-- Filter --}}
        <div class="col-md-3">
            <select name="filter" class="form-select form-select-lg" style="background-color: #E9ECFF;">
                <option value="">Filter</option>
                <option value="free" {{ request('filter') == 'free' ? 'selected' : '' }}>Free Courses</option>
                <option value="paid" {{ request('filter') == 'paid' ? 'selected' : '' }}>Paid Courses</option>
                <option value="beginner" {{ request('filter') == 'beginner' ? 'selected' : '' }}>Beginner Level</option>
            </select>
        </div>

        {{-- Sort --}}
        <div class="col-md-3">
            <select name="sort" class="form-select form-select-lg" style="background-color: #E9ECFF;">
                <option value="trending" {{ request('sort') == 'trending' ? 'selected' : '' }}>Trending</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                <option value="top_rated" {{ request('sort') == 'top_rated' ? 'selected' : '' }}>Top Rated</option>
            </select>
        </div>

        {{-- Search --}}
        <div class="col-md-6 d-flex">
            <input name="search" value="{{ request('search') }}" type="text"
                class="form-control form-control-lg me-2" placeholder="Enter keyword..."
                style="background-color: #E9ECFF;" />
            <button type="submit" class="btn btn-light btn-lg" style="background-color: #E9ECFF;">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>

            <div>
                @if(request('q'))
    <h5 class="text-light">
        {{ $courses->count() }} results found for 
        <span class="fw-bold">“{{ request('q') }}”</span>
    </h5>
@endif

            </div>
        </div>
    </section>

    {{-- Courses Section --}}
    <section class="py-5">
        <div class="container">
            <div class="row">
                @forelse($courses as $index => $course)
                    @php $amount_info = getUserLocalCurrencyConversion($course->price); @endphp
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex">
                        <a href="{{ route('course_external_detail', $course->course_url) }}" 
                           style="text-decoration: none; color: inherit;" class="w-100">
                            <div class="course-card w-100 shadow-sm">
                                <img src="{{ asset($course->image) }}" class="img-fluid mb-2"
                                    style="height: 160px; object-fit: cover; border-radius: 5px;" />

                                <div class="course-meta">
                                    <span style="background-color: #F5F5F5; padding: 4px 8px; border-radius: 4px;">
                                        {{ optional($course->cat)->name }}
                                    </span>
                                    <strong>{{ $amount_info['currency_symbol'] }} {{ $amount_info['converted_amount'] }}</strong>
                                </div>

                                <div class="course-title mt-2">
                                    {{ \Illuminate\Support\Str::limit($course->title, 60) }}
                                </div>

                                <div class="row align-items-center mt-3 course-footer">
                                    <div class="col-2">
                                        <img src="{{ asset(optional($course->instructor_name)->image) }}" 
                                             style="height: 30px; width: 30px; border-radius: 50%;" />
                                    </div>
                                    <div class="col-5 ps-0">
                                        <small class="text-muted">Course By</small><br/>
                                        <strong>{{ optional($course->instructor_name)->name }}</strong>
                                    </div>
                                    <div class="col-5 text-end">
                                        <small class="text-muted">{{ $course->student_count }} Students</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">No courses found matching your criteria.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
{{ $courses->links('frontend.paginate') }}
            </div>
        </div>
    </section>

</main>
@endsection
