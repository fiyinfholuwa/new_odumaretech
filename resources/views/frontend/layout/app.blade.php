<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Odumaretech</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- {{--    <link href="assets/img/favicon.png" rel="icon">--}}
    {{--    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">--}} -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{asset('frontend/assets/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/home.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{route('home')}}" class="logo d-flex align-items-center me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img style="border-radius:10px;" src="https://odumaretech.com/frontend/img/img/logo.png" alt="">
            <!-- <h1 class="sitename">GP</h1>
            <span>.</span> -->
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{route('home')}}" class="active">Home<br></a></li>
                <li><a href="{{route('courses')}}">Courses</a></li>
                <li><a href="{{route('marketplace')}}">MarketPlace</a></li>
                <li><a href="{{route('blog')}}">Blog</a></li>
                <li><a href="{{route('about')}}">About</a></li>
                <li><a href="{{route('contact')}}">Contact Us</a></li>
                <li><a href="{{route('career')}}">Career</a></li>

                <!-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">Deep Dropdown 1</a></li>
                                <li><a href="#">Deep Dropdown 2</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Dropdown 2</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>
                    </ul>
                </li> -->
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>


            @auth
            
            <a  class="btn-getstarted" href="{{route('redirect')}}">Dashboard</a>

        <a style='background-color:  #0E2293; border:none' class="btn-getstarted" href="{{route('logout')}}">Logout</a>
                @else

<a  class="btn-getstarted" href="{{route('login')}}">Login</a>

        <a style='background-color:  #0E2293; border:none' class="btn-getstarted" href="{{route('register')}}">Register</a>
            @endauth
        

    </div>
</header>



@yield('content')

<footer id="footer" class="footer dark-background">

    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 col-md-6 footer-about">

                    <a href="{{route('home')}}" class="logo d-flex align-items-center">
                        <img style="border-radius:10px;" src="https://odumaretech.com/frontend/img/img/logo.png" alt="">
                    </a>
                    <div class="footer-contact pt-3">
                        <p class="mt-3"><strong>Phone:</strong> <span>+447784927399</span></p>
                        <p><strong>Email:</strong> <span>contact@odumaretech.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Company</h4>
                    <ul>
                        <li> <a href="{{route('innovation')}}"> Research and Innovation</a></li>
                        <li> <a href="{{route('masterclass')}}">Masterclass</a></li>
{{--                        <li><a href="#"> Services</a></li>--}}
                        <li> <a href="{{route('corporate_training')}}"> Corporate Trainings</a></li>
                        <li> <a href="#">Support Us</a></li>
                        <li> <a href="{{route('hire_grad')}}">Hire our Grad</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Pages</h4>
                    <ul>
                        <li><a href="{{route('courses')}}">Courses</a></li>
                        <li> <a href="{{route('about')}}">About</a></li>
                        <li> <a href="{{route('contact')}}">Contact Us</a></li>
                        <li> <a href="{{route('career')}}"> Join Us</a></li>
                        <li> <a href="{{route('faq')}}"> FAQs</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-12 footer-links">
                    <h4>Policies</h4>
                    <ul>
                        <li> <a href="{{route('terms')}}"> Term of Use</a></li>
                        <li> <a href="{{route('privacy')}}"> Privacy Policy</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container text-center">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">OdumareTech</strong> <span>All Rights Reserved</span></p>
            <div class="credits">

            </div>
        </div>
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
{{--<div id="preloader"></div>--}}

<!-- Vendor JS Files -->
<script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>

<!-- Main JS File -->
<script src="{{asset('frontend/assets/js/main.js')}}"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" >

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>


 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
      Toastify({ text: "{{ Session::get('message') }}", duration: 3000,
            style: { background: "linear-gradient(to right, #00b09b, #96c93d)" }
    }).showToast();
    break;

    case 'success':
      Toastify({ text: "{{ Session::get('message') }}", duration: 3000,
        style: { background: "linear-gradient(to right, #00b09b, #96c93d)" }
    }).showToast();
    break;

    case 'warning':
      Toastify({ text: "{{ Session::get('message') }}", duration: 3000,
            style: { background: "linear-gradient(to right, #00b09b, #96c93d)" }
    }).showToast();
    break;

    case 'error':
      Toastify({ text: "{{ Session::get('message') }}", duration: 3000,
            style: { background: "linear-gradient(to right, #ff0000, #ff0000)" }
    }).showToast();
    break;
 }
 @endif
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/64a3f86294cf5d49dc617131/1h4g84h8o';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- 
BULLETPROOF MODAL SYSTEM
Add this to your existing page - it's designed to work with any existing CSS
-->

<!-- STEP 1: Add this CSS (uses !important to override conflicts) -->
<style>
/* Bulletproof Modal System - Uses !important to override existing styles */
.bfmodal-overlay {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    background: rgba(0, 0, 0, 0.8) !important;
    display: none !important;
    align-items: center !important;
    justify-content: center !important;
    z-index: 999999 !important;
    padding: 20px !important;
    box-sizing: border-box !important;
    backdrop-filter: blur(3px) !important;
    -webkit-backdrop-filter: blur(3px) !important;
}

.bfmodal-overlay.bfmodal-show {
    display: flex !important;
    animation: bfmodalFadeIn 0.3s ease !important;
}

.bfmodal-container {
    background: #ffffff !important;
    border-radius: 12px !important;
    width: 100% !important;
    max-width: 480px !important;
    max-height: 90vh !important;
    overflow-y: auto !important;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3) !important;
    position: relative !important;
    margin: auto !important;
    animation: bfmodalSlideUp 0.3s ease !important;
}

.bfmodal-header {
    padding: 25px 25px 20px 25px !important;
    text-align: center !important;
    border-bottom: 1px solid #f0f0f0 !important;
    position: relative !important;
}

.bfmodal-close {
    position: absolute !important;
    top: 15px !important;
    right: 20px !important;
    background: none !important;
    border: none !important;
    font-size: 28px !important;
    color: #999 !important;
    cursor: pointer !important;
    padding: 5px !important;
    line-height: 1 !important;
    width: 35px !important;
    height: 35px !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.2s ease !important;
}

.bfmodal-close:hover {
    background: #f5f5f5 !important;
    color: #333 !important;
}

.bfmodal-icon {
    width: 70px !important;
    height: 70px !important;
    border-radius: 50% !important;
    margin: 0 auto 20px auto !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 32px !important;
    color: white !important;
}

.bfmodal-cookies .bfmodal-icon {
    background: linear-gradient(135deg, #ff6b6b, #ee5a52) !important;
}

.bfmodal-recommender .bfmodal-icon {
    background: linear-gradient(135deg, #4ecdc4, #44a08d) !important;
}

.bfmodal-masterclass .bfmodal-icon {
    background: linear-gradient(135deg, #feca57, #ff9ff3) !important;
}

.bfmodal-title {
    font-size: 24px !important;
    font-weight: 700 !important;
    color: #333 !important;
    margin: 0 0 8px 0 !important;
    line-height: 1.3 !important;
}

.bfmodal-subtitle {
    font-size: 14px !important;
    color: #666 !important;
    margin: 0 !important;
    line-height: 1.4 !important;
}

.bfmodal-body {
    padding: 25px !important;
    color: #555 !important;
    font-size: 15px !important;
    line-height: 1.6 !important;
}

.bfmodal-body p {
    margin: 0 0 15px 0 !important;
}

.bfmodal-body p:last-of-type {
    margin-bottom: 20px !important;
}

.bfmodal-features {
    list-style: none !important;
    padding: 0 !important;
    margin: 20px 0 !important;
}

.bfmodal-features li {
    padding: 8px 0 8px 25px !important;
    position: relative !important;
    font-size: 14px !important;
}

.bfmodal-features li::before {
    content: "✓" !important;
    position: absolute !important;
    left: 0 !important;
    top: 8px !important;
    color: #4ecdc4 !important;
    font-weight: bold !important;
    font-size: 16px !important;
}

.bfmodal-buttons {
    display: flex !important;
    gap: 12px !important;
    flex-wrap: wrap !important;
    margin-top: 25px !important;
}

.bfmodal-btn {
    flex: 1 !important;
    min-width: 120px !important;
    padding: 12px 20px !important;
    border: none !important;
    border-radius: 25px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
    text-align: center !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-sizing: border-box !important;
}

.bfmodal-btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2) !important;
    color: white !important;
}

.bfmodal-btn-primary:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4) !important;
}

.bfmodal-btn-secondary {
    background: white !important;
    color: #666 !important;
    border: 2px solid #ddd !important;
}

.bfmodal-btn-secondary:hover {
    background: #f8f9fa !important;
    border-color: #bbb !important;
    color: #333 !important;
}

.bfmodal-progress {
    position: absolute !important;
    bottom: 15px !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    display: flex !important;
    gap: 8px !important;
}

.bfmodal-progress-dot {
    width: 8px !important;
    height: 8px !important;
    border-radius: 50% !important;
    background: #ddd !important;
    transition: background 0.3s ease !important;
}

.bfmodal-progress-dot.active {
    background: #667eea !important;
}

@keyframes bfmodalFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes bfmodalSlideUp {
    from { 
        transform: translateY(30px) scale(0.95);
        opacity: 0;
    }
    to { 
        transform: translateY(0) scale(1);
        opacity: 1;
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .bfmodal-container {
        max-width: 95vw !important;
        margin: 10px !important;
    }
    
    .bfmodal-header {
        padding: 20px 20px 15px 20px !important;
    }
    
    .bfmodal-body {
        padding: 20px !important;
    }
    
    .bfmodal-title {
        font-size: 20px !important;
    }
    
    .bfmodal-icon {
        width: 60px !important;
        height: 60px !important;
        font-size: 28px !important;
    }
    
    .bfmodal-buttons {
        flex-direction: column !important;
    }
    
    .bfmodal-btn {
        min-width: auto !important;
    }
}

@media (max-width: 480px) {
    .bfmodal-overlay {
        padding: 10px !important;
    }
    
    .bfmodal-container {
        max-height: 95vh !important;
    }
}
</style>

<!-- STEP 2: Add these modal HTML structures before closing </body> -->

<!-- Cookies Modal -->
<div class="bfmodal-overlay bfmodal-cookies" id="bfCookiesModal">
    <div class="bfmodal-container">
        <div class="bfmodal-header">
            <button class="bfmodal-close" onclick="BFModal.close('bfCookiesModal')">&times;</button>
            <div class="bfmodal-icon">🍪</div>
            <h2 class="bfmodal-title">Cookie Preferences</h2>
            <p class="bfmodal-subtitle">We respect your privacy</p>
        </div>
        <div class="bfmodal-body">
            <p>We use cookies to enhance your browsing experience, serve personalized content, and analyze our traffic. By clicking "Accept All", you consent to our use of cookies.</p>
            
            <ul class="bfmodal-features">
                <li>Essential cookies for site functionality</li>
                <li>Analytics to improve user experience</li>
                <li>Personalization for better content</li>
            </ul>

            <div class="bfmodal-buttons">
                <button class="bfmodal-btn bfmodal-btn-secondary" onclick="BFModal.handleCookies('reject')">Reject</button>
                <button class="bfmodal-btn bfmodal-btn-primary" onclick="BFModal.handleCookies('accept')">Accept All</button>
            </div>
        </div>
        <div class="bfmodal-progress">
            <div class="bfmodal-progress-dot active"></div>
            <div class="bfmodal-progress-dot"></div>
            <div class="bfmodal-progress-dot"></div>
        </div>
    </div>
</div>

<!-- Course Recommender Modal -->
<div class="bfmodal-overlay bfmodal-recommender" id="bfRecommenderModal">
    <div class="bfmodal-container">
        <div class="bfmodal-header">
            <button class="bfmodal-close" onclick="BFModal.close('bfRecommenderModal')">&times;</button>
            <div class="bfmodal-icon">🎯</div>
            <h2 class="bfmodal-title">Personalized Course Recommendations</h2>
            <p class="bfmodal-subtitle">Discover courses tailored just for you</p>
        </div>
        <div class="bfmodal-body">
            <p>Let our AI-powered recommendation engine suggest the perfect courses based on your interests, skill level, and career goals.</p>
            
            <ul class="bfmodal-features">
                <li>AI-powered personalization</li>
                <li>Career-focused recommendations</li>
                <li>Skill-based matching</li>
                <li>Industry trend insights</li>
            </ul>

            <div class="bfmodal-buttons">
                <button class="bfmodal-btn bfmodal-btn-secondary" onclick="BFModal.handleRecommender('skip')">Maybe Later</button>
                <button class="bfmodal-btn bfmodal-btn-primary" onclick="BFModal.handleRecommender('accept')">Get Recommendations</button>
            </div>
        </div>
        <div class="bfmodal-progress">
            <div class="bfmodal-progress-dot"></div>
            <div class="bfmodal-progress-dot active"></div>
            <div class="bfmodal-progress-dot"></div>
        </div>
    </div>
</div>

<!-- Master Class Modal -->
<div class="bfmodal-overlay bfmodal-masterclass" id="bfMasterclassModal">
    <div class="bfmodal-container">
        <div class="bfmodal-header">
            <button class="bfmodal-close" onclick="BFModal.close('bfMasterclassModal')">&times;</button>
            <div class="bfmodal-icon">🎓</div>
            <h2 class="bfmodal-title">Exclusive Master Class</h2>
            <p class="bfmodal-subtitle">Limited time offer</p>
        </div>
        <div class="bfmodal-body">
            <p><strong>Join our exclusive Master Class series!</strong></p>
            <p>Learn from industry experts and take your skills to the next level. This premium content is designed for serious learners who want to achieve mastery.</p>
            
            <ul class="bfmodal-features">
                <li>Expert-led sessions</li>
                <li>Interactive workshops</li>
                <li>Certification included</li>
                <li>Lifetime access</li>
            </ul>

            <div class="bfmodal-buttons">
                <button class="bfmodal-btn bfmodal-btn-secondary" onclick="BFModal.handleMasterclass('cancel')">Not Now</button>
                <a href="{{ route('masterclass') }}" class="bfmodal-btn bfmodal-btn-primary" onclick="BFModal.handleMasterclass('go')">Join Master Class</a>
            </div>
        </div>
        <div class="bfmodal-progress">
            <div class="bfmodal-progress-dot"></div>
            <div class="bfmodal-progress-dot"></div>
            <div class="bfmodal-progress-dot active"></div>
        </div>
    </div>
</div>

<!-- STEP 3: Add this JavaScript before closing </body> -->
<script>
// Bulletproof Modal System
window.BFModal = (function() {
    'use strict';
    
    let modalQueue = [];
    let currentModalIndex = 0;
    let isInitialized = false;

    // Utility functions
    function log(message, data) {
        console.log('[BFModal]', message, data || '');
    }

    function checkStorage() {
        try {
            const cookiesShown = localStorage.getItem('bf_cookies_shown') === 'true';
            const recommenderShown = localStorage.getItem('bf_recommender_shown') === 'true';
            
            log('Storage check:', { cookiesShown, recommenderShown });
            return { cookiesShown, recommenderShown };
        } catch (e) {
            log('LocalStorage not available, using session data');
            return { cookiesShown: false, recommenderShown: false };
        }
    }

    function setStorage(key, value) {
        try {
            localStorage.setItem(key, value);
        } catch (e) {
            log('Cannot save to localStorage:', key);
        }
    }

    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) {
            log('Modal not found:', modalId);
            return false;
        }
        
        // Hide all other modals first
        const allModals = document.querySelectorAll('.bfmodal-overlay');
        allModals.forEach(m => m.classList.remove('bfmodal-show'));
        
        // Show target modal
        modal.classList.add('bfmodal-show');
        
        // Prevent body scrolling
        document.body.style.overflow = 'hidden';
        
        log('Showing modal:', modalId);
        return true;
    }

    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('bfmodal-show');
            
            // Restore body scrolling if no modals are open
            const visibleModals = document.querySelectorAll('.bfmodal-overlay.bfmodal-show');
            if (visibleModals.length === 0) {
                document.body.style.overflow = '';
            }
            
            log('Hiding modal:', modalId);
        }
    }

    function showNextModal() {
        if (currentModalIndex < modalQueue.length) {
            const modalId = modalQueue[currentModalIndex];
            showModal(modalId);
        } else {
            log('All modals completed');
        }
    }

    function closeAndNext(modalId) {
        hideModal(modalId);
        currentModalIndex++;
        
        // Small delay for smooth transition
        setTimeout(() => {
            showNextModal();
        }, 200);
    }

    // Public API
    return {
        init: function() {
            if (isInitialized) {
                log('Already initialized');
                return;
            }

            const { cookiesShown, recommenderShown } = checkStorage();
            
            // Build modal queue
            modalQueue = [];
            
            if (!cookiesShown) {
                modalQueue.push('bfCookiesModal');
            }
            
            if (!recommenderShown) {
                modalQueue.push('bfRecommenderModal');
            }
            
            // Always add masterclass
            modalQueue.push('bfMasterclassModal');

            log('Modal queue built:', modalQueue);

            // Start sequence if we have modals to show
            if (modalQueue.length > 0) {
                currentModalIndex = 0;
                setTimeout(() => {
                    showNextModal();
                }, 800); // Small delay after page load
            }

            // Event listeners
            this.setupEventListeners();
            isInitialized = true;
            
            log('Modal system initialized');
        },

        setupEventListeners: function() {
            // ESC key handler
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    const activeModal = document.querySelector('.bfmodal-overlay.bfmodal-show');
                    if (activeModal) {
                        this.close(activeModal.id);
                    }
                }
            });

            // Click outside handler
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('bfmodal-overlay')) {
                    this.close(e.target.id);
                }
            });
        },

        close: function(modalId) {
            log('Close requested for:', modalId);
            closeAndNext(modalId);
        },

        handleCookies: function(action) {
            log('Cookies action:', action);
            setStorage('bf_cookies_shown', 'true');
            
            if (action === 'accept') {
                log('Cookies accepted - you can add analytics code here');
                // Add your analytics initialization code here
            }
            
            this.close('bfCookiesModal');
        },

        handleRecommender: function(action) {
            log('Recommender action:', action);
            setStorage('bf_recommender_shown', 'true');
            
            if (action === 'accept') {
                log('Redirect to recommendations - add your URL here');
                 window.location.href = 'https://ai-advise.streamlit.app/';
            }
            
            this.close('bfRecommenderModal');
        },

        handleMasterclass: function(action) {
            log('Masterclass action:', action);
            
            if (action === 'go') {
                log('Redirecting to masterclass');
            }
            
            this.close('bfMasterclassModal');
        },

        // Debug functions
        reset: function() {
            try {
                localStorage.removeItem('bf_cookies_shown');
                localStorage.removeItem('bf_recommender_shown');
                log('Storage reset - refresh page to see all modals again');
            } catch (e) {
                log('Cannot reset storage');
            }
        },

        show: function(modalId) {
            showModal(modalId);
        }
    };
})();

// Auto-initialize when DOM is ready
(function() {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            BFModal.init();
        });
    } else {
        BFModal.init();
    }
})();

// Expose reset function for debugging
window.resetBFModals = function() {
    BFModal.reset();
};
</script>
</body>

</html>
