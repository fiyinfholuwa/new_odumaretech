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
        <div class="text-center" style="max-width: 800px; margin-top: 150px; padding: 20px;">
            <h2 style="margin-top: 20px;">Terms of Use</h2>
        </div>
    </section>

    <!-- Terms Section -->
    <section style="background-color: #f7f7f7; padding: 50px 20px;">
        <div class="container">

            <div class="mb-5">
                <h4 style="color: #0E2293;">1. About OdumareTech</h4>
                <p>OdumareTech is an educational technology platform that provides online learning resources, digital courses, training programs, and other educational content for students, teachers, and general users.</p>
                <p>Our services are paid, and access may require a valid subscription, enrollment fee, or one-time payment.</p>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">2. Eligibility</h4>
                <p>To use OdumareTech, you must:</p>
                <ul style="list-style-type: disc; padding-left: 20px;">
                    <li>Be at least 16 years old (or have parental consent if younger).</li>
                    <li>Provide accurate, truthful, and complete registration details.</li>
                    <li>Agree to comply with all applicable laws and any other region you access the Platform from.</li>
                </ul>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">3. User Accounts</h4>
                <ul style="list-style-type: disc; padding-left: 20px;">
                    <li>You may need to create an account to access certain features.</li>
                    <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
                    <li>Notify OdumareTech immediately of any unauthorized use of your account.</li>
                    <li>We reserve the right to suspend or terminate accounts that violate these Terms.</li>
                </ul>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">4. Payments and Subscriptions</h4>
                <ul style="list-style-type: disc; padding-left: 20px;">
                    <li>All fees must be paid in accordance with the pricing and payment terms shown at the time of purchase.</li>
                    <li>Payments are non-refundable unless otherwise stated or required by law.</li>
                    <li>We may change our fees at any time, but changes will not affect existing subscriptions until renewal.</li>
                </ul>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">5. User Data and Privacy</h4>
                <p>We collect and process user information such as name, email address, phone number, and educational background in accordance with our Privacy Policy.</p>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">6. Intellectual Property</h4>
                <p>All content on the Platform including courses, videos, graphics, software, and logos is owned by OdumareTech or its licensors and is protected under copyright and intellectual property laws.</p>
                <p>Users may not reproduce, distribute, sell, or publicly display any content without our prior written consent.</p>
                <p>You retain ownership of any content you upload (such as comments or assignments), but you grant OdumareTech a non-exclusive, worldwide license to use it for platform operation and improvement.</p>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">7. Acceptable Use</h4>
                <p>You agree not to:</p>
                <ul style="list-style-type: disc; padding-left: 20px;">
                    <li>Use the Platform for illegal or fraudulent purposes.</li>
                    <li>Post or share harmful, abusive, or misleading content.</li>
                    <li>Interfere with the operation or security of the Platform.</li>
                    <li>Attempt to gain unauthorized access to our systems or data.</li>
                </ul>
                <p>Violation of this section may result in account suspension or termination.</p>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">8. Disclaimers</h4>
                <p>OdumareTech provides content “as is” without warranties of any kind, whether express or implied.</p>
                <p>We do not guarantee that the Platform will be uninterrupted, error-free, or suitable for every user’s learning goals.</p>
                <p>Users are responsible for evaluating the accuracy and usefulness of all information provided.</p>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">9. Limitation of Liability</h4>
                <p>To the maximum extent permitted by law, OdumareTech and its affiliates will not be liable for any indirect, incidental, or consequential damages arising from your use of the Platform, including loss of data, income, or reputation.</p>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">10. Termination</h4>
                <p>We reserve the right to suspend or terminate your account or access to the Platform at our discretion, especially if you violate these Terms or engage in misuse.</p>
                <p>You may terminate your account at any time by contacting our support team.</p>
            </div>

            <div class="mb-5">
                <h4 style="color: #0E2293;">11. Changes to These Terms</h4>
                <p>We may update these Terms occasionally. Continued use of the Platform after updates means you accept the revised Terms.</p>
                <p>We encourage users to review this page regularly.</p>
            </div>

        </div>
    </section>

</main>
@endsection
