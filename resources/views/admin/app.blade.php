
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->


<!-- Mirrored from ableproadmin.com/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Mar 2024 18:19:58 GMT -->
<head>
    <title>OdumareTech - Admin Dashboard</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
          content="Able Pro is trending dashboard template made using Bootstrap 5 design framework. Able Pro is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords"
          content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="Phoenixcoded">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{asset('https://odumaretech.com/frontend/img/img/logo.png')}}" type="image/x-icon"> <!-- [Font] Family -->
    <link rel="stylesheet" href="{{asset('backend/assets/fonts/inter/inter.css')}}" id="main-font-link"/>
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{asset('backend/assets/fonts/tabler-icons.min.css')}}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{asset('backend/assets/fonts/feather.css')}}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{asset('backend/assets/fonts/fontawesome.css')}}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{asset('backend/assets/fonts/material.css')}}">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}" id="main-style-link">
    <link rel="stylesheet" href="{{asset('backend/assets/css/style-preset.css')}}">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-14K1GBX9FG"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLR4zYJ5iENBO06fYlB8kEzZ55niPy5XKpQ+cl4zp2"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>


    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-14K1GBX9FG');
    </script>
    <!-- WiserNotify -->
    <script>
        !(function () {
            if (window.t4hto4) console.log('WiserNotify pixel installed multiple time in this page');
            else {
                window.t4hto4 = !0;
                var t = document,
                    e = window,
                    n = function () {
                        var e = t.createElement('script');
                        (e.type = 'text/javascript'),
                            (e.async = !0),
                            (e.src = '../../pt.wisernotify.com/pixel6d4c.js?ti=1jclj6jkfc4hhry'),
                            document.body.appendChild(e);
                    };
                'complete' === t.readyState ? n() : window.attachEvent ? e.attachEvent('onload', n) : e.addEventListener('load', n, !1);
            }
        })();
    </script>
    <!-- Microsoft clarity -->
    <script type="text/javascript">
        (function (c, l, a, r, i, t, y) {
            c[a] =
                c[a] ||
                function () {
                    (c[a].q = c[a].q || []).push(arguments);
                };
            t = l.createElement(r);
            t.async = 1;
            t.src = 'https://www.clarity.ms/tag/' + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, 'clarity', 'script', 'gkn6wuhrtb');
    </script>

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast=""
      data-pc-theme="light">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{route('admin.dashboard')}}" class="b-brand text-primary">
                <img  style="border-radius:10px; width: 200px;" src="https://odumaretech.com/frontend/img/img/logo.png" alt="">

                <!-- ========   Change your logo from here   ============ -->
{{--                <img style="height: 60px" src="{{asset('backend/logo.svg')}}" class="img-fluid" alt="logo">--}}
                {{--                <span class="badge bg-light-success rounded-pill ms-2 theme-version">v9.0</span>--}}
            </a>
        </div>
        <div class="navbar-content">
            <div class="card pc-user-card">
            </div>

            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>

                <li class="pc-item">
                    <a href="{{route('admin.dashboard')}}" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-home"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-tag"></i></span>
                        <span class="pc-mtext">Course Category</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{route('category.view')}}">Manage Course Category</a></li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-tag"></i></span>
                        <span class="pc-mtext">Manage Course Cohort</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{route('cohort.view')}}">Manage Cohort</a></li>
{{--                        <li class="pc-item"><a class="pc-link" href="{{route('cohort_m.view')}}">Manage Cohort Price</a></li>--}}
                    </ul>
                </li>

{{--                <li class="pc-item pc-hasmenu">--}}
{{--                    <a href="#!" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="fas fa-sticky-note"></i></span>--}}
{{--                        <span class="pc-mtext">Manage Courses</span>--}}
{{--                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>--}}
{{--                    </a>--}}
{{--                    <ul class="pc-submenu">--}}
{{--                        <li class="pc-item"><a class="pc-link" href="{{route('course.view')}}">Add Course</a></li>--}}
{{--                        <li class="pc-item"><a class="pc-link" href="{{route('course.all')}}">All Courses</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-quote-left"></i></span>
                        <span class="pc-mtext">Testimonials</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{route('testimonial.view')}}">Add Testimonial</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{route('testimonial.all')}}">All Testimonials</a></li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="fa fa-podcast"></i></span>
                        <span class="pc-mtext">Manage Master Class</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{route('masterclass.link')}}">Manage Master Class Link</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{route('masterclass.all')}}">MasterClass Attendees</a></li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="fa fa-users"></i></span>
                        <span class="pc-mtext">Manage Innovations</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{route('innovation.view')}}">Add Innovation</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{route('innovation.all')}}">All Innovations</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{route('innovation.apply.view')}}">All Innovation Collaborators</a></li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="fa fa-blog"></i></span>
                        <span class="pc-mtext">Manage Blog</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{route('blog.view')}}">Add Post</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{route('blog.all')}}">All Posts</a></li>
                    </ul>
                </li>

{{--                <li class="pc-item pc-hasmenu">--}}
{{--                    <a href="#!" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="fa fa-user"></i></span>--}}
{{--                        <span class="pc-mtext">Manage Accounts</span>--}}
{{--                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>--}}
{{--                    </a>--}}
{{--                    <ul class="pc-submenu">--}}
{{--                        <li class="pc-item"><a class="pc-link" href="{{route('admin.user.view')}}">Add User</a></li>--}}
{{--                        <li class="pc-item"><a class="pc-link" href="{{route('student.all')}}">All Users</a></li>--}}
{{--                        <li class="pc-item"><a class="pc-link" href="{{route('instructor.all')}}">All Instructors</a></li>--}}
{{--                        <li class="pc-item"><a class="pc-link" href="{{route('applied.view')}}">Manage Applied Students</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                <li class="pc-item">
                    <a href="{{route('company.all')}}" class="pc-link">
                        <span class="pc-micon"><i class="fa fa-school"></i></span>
                        <span class="pc-mtext">Corporate Training </span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="{{route('github.link')}}" class="pc-link">
                        <span class="pc-micon"><i class="fab fa-github"></i></span>
                        <span class="pc-mtext">Manage Github</span>
                    </a>
                </li>

{{--                <li class="pc-item">--}}
{{--                    <a href="{{route('meeting.link')}}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="fa fa-link"></i></span>--}}
{{--                        <span class="pc-mtext">Manage Meeting Link</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="pc-item">--}}
{{--                    <a href="{{route('record.link')}}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="fas fa-microphone"></i></span>--}}
{{--                        <span class="pc-mtext">Manage Record Sessions</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="pc-item">--}}
{{--                    <a href="{{route('admin.chat.all')}}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="fa fa-comments"></i></span>--}}
{{--                        <span class="pc-mtext">Instructor Chats</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li class="pc-item">
                    <a href="{{route('instructor.application.all')}}" class="pc-link">
                        <span class="pc-micon"><i class="fa fa-users"></i></span>
                        <span class="pc-mtext">Instructor Applications</span>
                    </a>
                </li>

                <li class="pc-item">
{{--                    <a href="{{route('transaction.all')}}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="fas fa-exchange-alt"></i></span>--}}
{{--                        <span class="pc-mtext">All Transactions</span>--}}
{{--                    </a>--}}
                </li>

{{--                <li class="pc-item">--}}
{{--                    <a href="{{route('coupon.view')}}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="fas fa-gift"></i></span>--}}
{{--                        <span class="pc-mtext">Manage Coupons</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li class="pc-item">
                    <a href="{{route('contact.all')}}" class="pc-link">
                        <span class="pc-micon"><i class="fa fa-envelope"></i></span>
                        <span class="pc-mtext">Messages</span>
                    </a>
                </li>

{{--                <li class="pc-item">--}}
{{--                    <a href="{{route('platform.configure')}}" class="pc-link">--}}
{{--                        <span class="pc-micon"><i class="fa fa-cog"></i></span>--}}
{{--                        <span class="pc-mtext">Platform Configuration</span>--}}
{{--                    </a>--}}
{{--                </li>--}}



            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
<header class="pc-header">
    <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>

            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">

                <li class="dropdown pc-h-item">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <svg class="pc-icon">
                            <use xlink:href="#custom-setting-2"></use>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <a href="" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span>My Account</span>
                        </a>

                        <a href="{{route('logout')}}" class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>

                <li class="dropdown pc-h-item">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <svg class="pc-icon">
                            <use xlink:href="#custom-notification"></use>
                        </svg>
                        <span
                            class="badge bg-success pc-h-badge">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0"> All Notifications <span
                                    class="badge bg-success pc-h-badge">0</span>
                            </h5>
                            <a href="#!" class="btn btn-link btn-sm"></a>
                        </div>
                        <div class="dropdown-body text-wrap header-notification-scroll position-relative"
                             style="max-height: calc(100vh - 215px)">
                            <p class="text-span">You have <span
                                    class="badge bg-danger">0</span> new Application(s) alert
                            </p>

                                    <a href="">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <i style="font-size: 20px;"
                                                           class="ph-duotone ph-note-pencil"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        {{--                                                        <span class="float-end text-sm text-muted">1 hour ago</span>--}}
                                                        <h5 class="text-body mb-2">hello</h5>
                                                        <p>i just applied for a new application, please respond
                                                            promptly, thank you.</p>
                                                        <p>u</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                <div class="mt-4 mb-3">
                                    <a class="btn btn-danger text-white" href="">Show all
                                        applications</a>

                                </div>

                            <br/>
                            <br/>


                        </div>

                    </div>
                </li>
                <li class="dropdown pc-h-item header-user-profile">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        data-bs-auto-close="outside"
                        aria-expanded="false"
                    >
                        <img src="{{asset('backend/assets/images/user/avatar-2.jpg')}}" alt="user-image"
                             class="user-avtar"/>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">@yield('page')</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h4 style="margin: 20px 1px;" class="mb-0">@yield('title')</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

        <!-- [Page Specific JS] start -->
        <script src="{{asset('backend/assets/js/plugins/apexcharts.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/pages/dashboard-default.js')}}"></script>
        <!-- [Page Specific JS] end -->
        <!-- Required Js -->
        <script src="{{asset('backend/assets/js/plugins/popper.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/plugins/simplebar.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/plugins/bootstrap.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/fonts/custom-font.js')}}"></script>
        <script src="{{asset('backend/assets/js/pcoded.js')}}"></script>
        <script src="{{asset('backend/assets/js/plugins/feather.min.js')}}"></script>


        <script>layout_change('light');</script>


        <script>layout_theme_contrast_change('false');</script>


        <script>change_box_container('false');</script>


        <script>layout_caption_change('true');</script>


        <script>layout_rtl_change('false');</script>


        <script>preset_change("preset-1");</script>

</body>
<!-- [Body] end -->

<!-- Include iziToast CSS & JS if not already included -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

<!-- Modal CSS -->
<style>
    .action_modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .action_modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .action_modal {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 32px;
        max-width: 400px;
        width: 90%;
        box-shadow:
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            0 0 0 1px rgba(255, 255, 255, 0.3);
        transform: scale(0.9) translateY(20px);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        text-align: center;
        position: relative;
    }

    .action_modal-overlay.active .action_modal {
        transform: scale(1) translateY(0);
    }

    .action_modal-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .action_modal-icon.success {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .action_modal-icon.error {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .action_modal-icon.info {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }

    .action_modal-icon.warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .action_modal-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 12px;
        color: #1f2937;
    }

    .action_modal-message {
        font-size: 16px;
        color: #6b7280;
        margin-bottom: 24px;
        line-height: 1.5;
    }

    .action_modal-btn {
        padding: 12px 28px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
    }

    .action_modal-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    }
</style>

<!-- Modal HTML -->
<div class="action_modal-overlay" id="clipboardModal" onclick="closeClipboardModal(event)">
    <div class="action_modal" onclick="event.stopPropagation()">
        <div class="action_modal-icon" id="modalIcon">
            <span id="modalIconText"><i class="fa fa-info-circle text-white"></i></span>
        </div>
        <h3 class="action_modal-title" id="modalTitle">Notice</h3>
        <p class="action_modal-message" id="modalMessage">This is a message.</p>
        <button class="action_modal-btn" onclick="closeClipboardModal()">Ok</button>
    </div>
</div>

<!-- Modal JS -->
<script>
    function showSessionModal(type, message) {
        const overlay = document.getElementById('clipboardModal');
        const icon = document.getElementById('modalIcon');
        const iconText = document.getElementById('modalIconText');
        const title = document.getElementById('modalTitle');
        const msg = document.getElementById('modalMessage');

        // Reset classes to allow proper icon color
        icon.className = 'action_modal-icon';

        if (type === 'success') {
            icon.classList.add('success');
            iconText.innerHTML = '<i class="fa fa-check-circle text-white"></i>';
            title.textContent = 'Success!';
        } else if (type === 'info') {
            icon.classList.add('info');
            iconText.innerHTML = '<i class="fa fa-info-circle text-white"></i>';
            title.textContent = 'Info';
        } else if (type === 'warning') {
            icon.classList.add('warning');
            iconText.innerHTML = '<i class="fa fa-exclamation-triangle text-white"></i>';
            title.textContent = 'Warning';
        } else if (type === 'error') {
            icon.classList.add('error');
            iconText.innerHTML = '<i class="fa fa-times-circle text-white"></i>';
            title.textContent = 'Error';
        } else {
            icon.classList.add('info');
            iconText.innerHTML = '<i class="fa fa-info-circle text-white"></i>';
            title.textContent = 'Notice';
        }

        msg.textContent = message;
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeClipboardModal(event) {
        if (event && event.target !== event.currentTarget) return;

        const overlay = document.getElementById('clipboardModal');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Close modal on Escape key press
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeClipboardModal();
        }
    });

    @if(Session::has('message'))
    // Get Laravel flash message type and message
    const type = "{{ Session::get('alert-type', 'info') }}";
    const message = "{{ Session::get('message') }}";

    // Show modal on page load
    showSessionModal(type, message);

    // Clear session keys so it won't show again
    {{ Session::forget('message') }}
    {{ Session::forget('alert-type') }}
    @endif
</script>


<script>
    $(document).ready(function () {
        var table = $('#my-table').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            responsive: true // optional but recommended for responsive tables
        });

        // Adjust columns and redraw table after initialization
        table.columns.adjust().draw();
    });
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script> var editor = new FroalaEditor('#myTextarea'); </script>


<script>
    ClassicEditor
        .create(document.querySelector('#myTextarea'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#myTextarea2'))
        .catch(error => {
            console.error(error);
        });
</script>

<style>
    /* Custom styles to enlarge the editor */
    .ck-editor__editable_inline {
        min-height: 200px;
        width: 100%;
    }
</style>


<!-- Mirrored from ableproadmin.com/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Mar 2024 18:20:32 GMT -->
</html>
