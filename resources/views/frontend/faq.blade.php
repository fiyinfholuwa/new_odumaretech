
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
            <h2 style="margin-top: 20px;">Frequently Asked Questions</h2>
            <p style="margin: 15px 0;">
                We know you’ve got some questions
            </p>
        </div>


    </section>

    <?php
    $faqs = [
        [
            'question' => 'What is OdumareTech?',
            'answer' => 'OdumareTech is a tech platform that focuses on practical, hands-on learning. Through real-world projects and industry collaboration, we prepare students for their first professional role, equipping them with practical expertise and confidence.'
        ],
        [
            'question' => 'How do I enroll in a course?',
            'answer' => 'To enroll, simply visit our course page, choose a program, and follow the registration instructions.'
        ],
        [
            'question' => 'Are the programs certified?',
            'answer' => 'Yes, upon completion you will receive an industry-recognized certificate.'
        ],
        [
            'question' => 'Can I learn at my own pace?',
            'answer' => 'Absolutely! Our programs are designed to be flexible so you can learn on your schedule.'
        ],
        [
            'question' => 'Is there support available during my learning?',
            'answer' => 'Yes, we provide mentorship and support throughout your learning journey to help you succeed.'
        ],
    ];
    ?>
    <section class="faq py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion" id="faqAccordion">
                        <?php foreach($faqs as $index => $faq): ?>
                        <div class="accordion-item mb-3 shadow-sm" style="border-radius: 12px; overflow: hidden; background: #fff;">
                            <h2 class="accordion-header" id="heading<?= $index ?>">
                                <button class="accordion-button collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                                    <span><?= $faq['question'] ?></span>
                                    <span class="icon-toggle ms-auto">+</span>
                                </button>
                            </h2>
                            <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                        <?= $faq['answer'] ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.custom-accordion-button');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('.icon-toggle');

                    // Small timeout to wait for class change
                    setTimeout(() => {
                        if (this.classList.contains('collapsed')) {
                            icon.textContent = '+';
                        } else {
                            icon.textContent = '-';
                        }
                    }, 150);
                });
            });
        });
    </script>


</main>

@endsection
