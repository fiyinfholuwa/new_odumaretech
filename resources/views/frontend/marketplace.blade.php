
@extends('frontend.layout.app')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section style="
  height: 70vh;
  background: linear-gradient(45deg, #041845, #0a3d62, #041845);
  background-size: 400% 400%;
  animation: animateBackground 10s ease infinite;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
" class="section dark-background">
        <div  class="text-center" style="max-width: 800px; margin-top: 150px;  padding: 20px;">
            <h2 style="margin-top: 180px; font-size:50px;">Coming Soon
            </h2>

                  

            <?php
            $stats = [
                ['count' => 0, 'label' => 'Courses Available', 'suffix' => '+'],
                ['count' => 0, 'label' => 'Expert Instructors', 'suffix' => '+'],
                ['count' => 0, 'label' => 'Students Worldwide', 'suffix' => 'M+'],
                ['count' => 0, 'label' => 'Instructor Earnings', 'prefix' => '$', 'suffix' => 'M+']
            ];
            ?>
            <div style="margin-top: 50px; margin-bottom: 40px;" class="row">
                <?php foreach ($stats as $index => $stat): ?>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4 d-flex">
                    <div class="text-center p-4 shadow rounded flex-fill" style="background-color: white; min-height: 150px;">
                        <h3 class="text-primary fw-bold counter"
                            data-target="<?= $stat['count'] ?>"
                            data-prefix="<?= $stat['prefix'] ?? '' ?>"
                            data-suffix="<?= $stat['suffix'] ?? '' ?>">
                            0
                        </h3>
                        <p class="mb-0 text-muted"><?= $stat['label'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const counters = document.querySelectorAll('.counter');
                    const duration = 2000; // 2 seconds for all counters

                    counters.forEach(counter => {
                        const target = +counter.getAttribute('data-target');
                        const prefix = counter.getAttribute('data-prefix') || '';
                        const suffix = counter.getAttribute('data-suffix') || '';
                        const start = 0;
                        const frameRate = 60;
                        const totalFrames = Math.round((duration / 1000) * frameRate);
                        let frame = 0;

                        const counterInterval = setInterval(() => {
                            frame++;
                            const progress = frame / totalFrames;
                            const current = Math.round(target * progress);
                            counter.innerText = prefix + formatNumber(current) + suffix;

                            if (frame === totalFrames) {
                                clearInterval(counterInterval);
                                counter.innerText = prefix + formatNumber(target) + suffix;
                            }
                        }, 1000 / frameRate);
                    });

                    function formatNumber(num) {
                        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                });
            </script>

        </div>

    </section>



   


</main>

@endsection
