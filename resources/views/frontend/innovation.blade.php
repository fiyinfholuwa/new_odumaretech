


@extends('frontend.layout.app')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section style="
  height: 40vh;
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
            <h2 style="margin-top: 20px;">Exploring Tomorrow's Innovations</h2>
            <p style="margin: 15px 0;">
                Dive into our cutting-edge research at OdumareTech. Curiosity knows no bounds, and neither do we. Are you passionate about shaping the future? Join us in our pursuit of knowledge.            </p>
        </div>


    </section>


    <section class="faq py-5">
        <div class="container">
            <div class="row mb-4">
                <div style="background-color: #E9ECFF; padding: 10px;" class="col-12">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="faqTabs" role="tablist" style="border-bottom: none;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">Completed</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="running-tab" data-bs-toggle="tab" data-bs-target="#running" type="button" role="tab">Running</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming" type="button" role="tab">Upcoming</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="faqTabContent">
                <?php

                $cards = [
                    [
                        'title' => 'Suicide Model Predictor',
                        'image' => 'frontend/assets/img/image4.png',
                        'status' => 'completed',
                    ],
                    [
                        'title' => 'AI Health Assistant',
                        'image' => 'frontend/assets/img/image5.png',
                        'status' => 'running',
                    ],
                    [
                        'title' => 'Climate Change Analyzer',
                        'image' => 'frontend/assets/img/image6.png',
                        'status' => 'upcoming',
                    ],
                ];
                ?>

                    <!-- All Tab -->
                <div class="tab-pane fade show active" id="all" role="tabpanel">
                    <div class="row">
                        @foreach($innovations as $card)
                            <div class="col-lg-4 mb-4">
                                                    <a href="">

                                <div style="background: #E9ECFF; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 10px; height: 100%; position: relative;">
                                <span style="position: absolute; top: 10px; right: 10px;" class="badge
                                    @if(strtolower($card['status']) === 'completed') bg-success
                                    @elseif(strtolower($card['status']) === 'running') bg-warning text-dark
                                    @elseif(strtolower($card['status']) === 'upcoming') bg-primary
                                    @endif
                                ">
                                    {{ ucfirst($card['status']) }}
                                </span>
                                    <img src="{{ asset($card['image']) }}" alt="{{ $card['name'] }}" class="img-fluid mb-3" style="object-fit: cover;" />
                                    <h4 style="color: #333; font-weight: bold;">{{ $card['name'] }}</h4>
                                </div>
                                                            </a>

                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Completed Tab -->
                <div class="tab-pane fade" id="completed" role="tabpanel">
                    <div class="row">
                        @foreach($innovations as $card)
                            @if(strtolower($card['status']) === 'completed')
                                <div class="col-lg-4 mb-4">
                                                                                    <a href="">

                                    <div style="background: #E9ECFF; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 10px; height: 100%; position: relative;">
                                        <span style="position: absolute; top: 10px; right: 10px;" class="badge bg-success">Completed</span>
                                        <img src="{{ asset($card['image']) }}" alt="{{ $card['title'] }}" class="img-fluid mb-3" style="object-fit: cover;" />
                                        <h4 style="color: #333; font-weight: bold;">{{ $card['title'] }}</h4>
                                    </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Running Tab -->
                <div class="tab-pane fade" id="running" role="tabpanel">
                    <div class="row">
                        @foreach($innovations as $card)
                            @if(strtolower($card['status']) === 'running')
                                <div class="col-lg-4 mb-4">
                                    <div style="background: #E9ECFF; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 10px; height: 100%; position: relative;">
                                        <span style="position: absolute; top: 10px; right: 10px;" class="badge bg-warning text-dark">Running</span>
                                        <img src="{{ asset($card['image']) }}" alt="{{ $card['name'] }}" class="img-fluid mb-3" style="object-fit: cover;" />
                                        <h4 style="color: #333; font-weight: bold;">{{ $card['name'] }}</h4>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Upcoming Tab -->
                <div class="tab-pane fade" id="upcoming" role="tabpanel">
                    <div class="row">
                        @foreach($innovations as $card)
                            @if(strtolower($card['status']) === 'upcoming')
                                <div class="col-lg-4 mb-4">
                                <a>
                                    <div style="background: #E9ECFF; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 10px; height: 100%; position: relative;">
                                        <span style="position: absolute; top: 10px; right: 10px;" class="badge bg-primary">Upcoming</span>
                                        <img src="{{ asset($card['image']) }}" alt="{{ $card['name'] }}" class="img-fluid mb-3" style="object-fit: cover;" />
                                        <h4 style="color: #333; font-weight: bold;">{{ $card['name'] }}</h4>
                                    </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add this styling -->
    <style>
        .nav-tabs .nav-link.active {
            background-color: #0E2293;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
        .nav-tabs .nav-link {
            color: #0E2293;
        }
    </style>

</main>

@endsection
