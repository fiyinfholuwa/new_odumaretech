
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
            <h2 style="margin-top: 20px;">Terms of Use</h2>

        </div>
    </section>

    <section style="background-color: #f7f7f7; padding: 50px 20px;">
        <div class="container">

            <div class="mb-5">
                <h4 style="color: #0E2293;">Courses Eligible</h4>
                <p>Utiva Study Loan is currently available for the following learning programs:</p>
                <ul style="list-style-type: disc; padding-left: 20px;">
                    <li>Data School: Data Analytics Bootcamp</li>
                    <li>Agile HR Fellowship</li>
                    <li>Big Data with Python program</li>
                    <li>Product School</li>
                    <li>Design School</li>
                </ul>
                <p><strong>Note:</strong> If you are learning with Utiva as a beneficiary of a scholarship, the USL is not available to you. You are expected to make full payment on enrollment.</p>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">Student Eligibility</h4>
                <ul style="list-style-type: disc; padding-left: 20px;">
                    <li>Nigerian (17 - 35 years old)</li>
                    <li>Secured admission into any Utiva School</li>
                    <li>Have a low-income job of any sort</li>
                </ul>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">Due Diligence</h4>
                <p>This contract is backed up with Legal Documents.</p>
                <ul style="list-style-type: disc; padding-left: 20px;">
                    <li>You are granting the USL committee the access to reach out to your organization/employer and confirm your employment status.</li>
                    <li>Your enrollment is finalized <strong>ONLY</strong> if your application is successful.</li>
                </ul>
            </div>
        </div>
    </section>


</main>

@endsection
