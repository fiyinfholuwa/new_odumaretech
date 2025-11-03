@extends('admin.app')

@section('content')
<style>
    .curriculum-section {
        background: #f9fafc;
        border: 1px solid #e0e6ed;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .curriculum-section:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .curriculum-title {
        background: linear-gradient(90deg, #001f3f, #003366);
        color: #fff;
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 1.1rem;
        margin-bottom: 15px;
    }

    .curriculum-list {
        list-style: none;
        padding-left: 0;
    }

    .curriculum-list li {
        background: #fff;
        border: 1px solid #e3e8ef;
        border-left: 4px solid #003366;
        border-radius: 6px;
        padding: 10px 15px;
        margin-bottom: 8px;
        transition: all 0.2s ease;
    }

    .curriculum-list li:hover {
        background: #f0f4f9;
    }

    .curriculum-list a {
        color: #007bff;
        text-decoration: none;
        font-size: 0.9rem;
        word-break: break-all;
    }

    .curriculum-list a:hover {
        text-decoration: underline;
    }

    .no-data {
        color: #777;
        font-style: italic;
    }
</style>

<div class="row my-4">
    <div class="col-md-11 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header bgc-primary">
                <div class="card-title">
                    <h3 class="bgc-primary-text mb-0">Curriculum Details – {{ $course->title }}</h3>
                </div>
            </div>
            <div class="card-body">
                @php
                    $existing = json_decode($course->curriculum, true) ?? [];
                @endphp

                @if(count($existing) > 0)
                    @foreach($existing as $index => $item)
                        <div class="curriculum-section">
                            <div class="curriculum-title">
                                <i class="fa fa-list-alt me-2"></i> {{ $item['title'] }}
                            </div>

                            <ul class="curriculum-list">
                                @foreach($item['points'] as $point)
                                    <li>
                                        <strong>{{ $point['text'] ?? $point }}</strong>
                                        @if(!empty($point['url']))
                                            <br>
                                            <a href="{{ $point['url'] }}" target="_blank">
                                                <i class="fa fa-link me-1"></i>{{ $point['url'] }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @else
                    <p class="text-center no-data">No curriculum has been added for this course yet.</p>
                @endif

                <div class="text-center mt-4">
                    <div class="text-center mt-4">
    <a href="{{ url()->previous() }}" class="btn btn-danger px-4">
        <i class="fa fa-arrow-left me-2"></i> Go Back
    </a>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
