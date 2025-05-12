
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
  align-items: center;
  justify-content: center;
" class="section dark-background">
        <div  class="text-center" style="max-width: 800px; margin-top: 150px;  padding: 20px;">
            <h2 style="margin-top: 20px;">Privacy Policy</h2>

        </div>
    </section>

    <section style="background-color: #f7f7f7; padding: 50px 20px;">
        <div class="container">

            <div class="mb-5">
                <h4 style="color: #0E2293;">Information Collection</h4>
                <p>OdumareTech collects limited personal information, such as your name, email address, and educational background, when you sign up for our services. Additionally, we may gather non-personal information such as usage statistics and cookies to enhance our services.</p>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">Data Usage</h4>
                <p>At OdumareTech, we solely use your personal information for the purpose of delivering and improving our educational services. We do not sell, rent, or share your personal data with third parties without your explicit consent, except when required by law.</p>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">Data Security</h4>
                <p>We employ industry-standard security measures to safeguard your personal information from unauthorized access, alteration, or disclosure. However, please note that no method of data transmission over the internet or electronic storage is 100% secure.</p>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">Children's Policy</h4>
                <p>OdumareTech's services are not intended for children under the age of 12. We do not knowingly collect personal information from children without parental consent. Parents or legal guardians are required to provide strict guidance for their child's participation. If personal information is inadvertently collected, we will promptly delete it. We encourage parents to actively engage in and supervise their child's online activities on our platform.</p>
            </div>
        </div>
    </section>






</main>

@endsection
