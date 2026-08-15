<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Admin Panel">
    <meta name="author" content="">

    <link href="{{ asset('admin/assets/img/favicon.png') }}" rel="shortcut icon" type="image/png">

    <title>Admin Panel</title>

    <link rel="stylesheet" href="{{ asset('admin/assets/css/main.css') }}" id="stylesheet">
</head>

<body class="dark-mode">

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-inner">
            <div class="spinner"></div>
            <div class="logo">
                <img src="{{ asset('admin/assets/img/logo-icon.svg') }}" alt="img">
            </div>
        </div>
    </div>

    <!-- ==================== HEADER ==================== -->
    <header class="header kleon-default-nav">
        <div class="d-none d-xl-block">
            <div class="header-inner d-flex align-items-center justify-content-around justify-content-xl-between flex-wrap flex-xl-nowrap gap-3 gap-xl-5">

                <div class="header-left-part d-flex align-items-center flex-grow-1 w-100">
                    <div class="header-search w-100">
                        <form class="search-form">
                            <input type="text" name="search" class="keyword form-control w-100" placeholder="Search">
                            <button type="submit" class="btn">
                                <img src="{{ asset('admin/assets/img/svg/search.svg') }}" alt="">
                            </button>
                        </form>
                    </div>
                </div>

                <div class="header-right-part d-flex align-items-center flex-shrink-0">
                    <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">

                        <!-- Dark / Light Switch -->
                        <li class="nav-item nav-color-switch d-flex align-items-center gap-3">
                            <div class="sun">
                                <img src="{{ asset('admin/assets/img/sun.svg') }}" alt="img">
                            </div>
                            <div class="switch">
                                <input type="checkbox" id="colorSwitch" name="defaultMode">
                                <div class="shutter">
                                    <span class="lbl-off"></span>
                                    <span class="lbl-on"></span>
                                    <div class="slider bg-primary"></div>
                                </div>
                            </div>
                            <div class="moon">
                                <img src="{{ asset('admin/assets/img/moon.svg') }}" alt="img">
                            </div>
                        </li>

                        <!-- Notification -->
                        <li class="nav-item nav-notification dropdown">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('admin/assets/img/svg/bell.svg') }}" alt="bell">
                                <div class="badge rounded-circle">0</div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0">
                                <div class="dropdown-wrapper pd-50">
                                    <div class="dropdown-wrapper--title">
                                        <h4 class="d-flex align-items-center justify-content-between">Notifications</h4>
                                    </div>
                                    <ul class="notification-board list-unstyled">
                                        <li class="text-center py-4 text-gray">No new notifications</li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <!-- Admin Profile -->
                        <li class="nav-item nav-author">
                            <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('admin/assets/img/nav_author.jpg') }}" alt="img" width="54" class="rounded-2">
                                <div class="nav-toggler-content">
                                    <h6 class="mb-0">Admin</h6>
                                    <div class="ff-heading fs-14 fw-normal text-gray">Super Admin</div>
                                </div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0 admin-card">
                                <div class="dropdown-wrapper">
                                    <div class="card mb-0">
                                        <div class="card-header p-3 text-center">
                                            <img src="{{ asset('admin/assets/img/nav_author.jpg') }}" alt="img" width="80" class="rounded-circle avatar">
                                            <div class="mt-2">
                                                <h6 class="mb-0 lh-18">Admin</h6>
                                                <div class="fs-14 fw-normal text-gray">Super Admin</div>
                                            </div>
                                        </div>
                                        <div class="card-footer p-3">
                                            <a class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"
                                               href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <!-- Mobile Header -->
        <div class="small-header d-flex align-items-center justify-content-between d-xl-none">
            <div class="logo">
                <a href="{{ url('/admin/home') }}" class="d-flex align-items-center gap-3 flex-shrink-0">
                    <img src="{{ asset('admin/assets/img/logo-icon.svg') }}" alt="logo">
                </a>
            </div>
            <div>
                <button type="button" class="kleon-mobile-menu-opener">
                    <span class="close"><i class="bi bi-arrow-left"></i></span>
                    <span class="open"><i class="bi bi-list"></i></span>
                </button>
            </div>
        </div>
    </header>

    <!-- ==================== SIDEBAR ==================== -->
    <div class="kleon-vertical-nav">
        <div class="logo d-flex align-items-center justify-content-between">
            <a href="{{ url('/admin/home') }}" class="d-flex align-items-center gap-3 flex-shrink-0">
                <img src="{{ asset('admin/assets/img/logo-icon.svg') }}" alt="logo">
                <div class="position-relative flex-shrink-0">
                    <img src="{{ asset('admin/assets/img/logo-text.svg') }}" alt="" class="logo-text">
                    <img src="{{ asset('admin/assets/img/logo-text-white.svg') }}" alt="" class="logo-text-white">
                </div>
            </a>
            <button type="button" class="kleon-vertical-nav-toggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <div class="kleon-navmenu">
            <ul class="main-menu">

                <!-- Dashboard -->
                <li class="menu-item">
                    <a href="{{ url('/admin/home') }}">
                        <span class="nav-icon flex-shrink-0"><i class="bi bi-speedometer2 fs-18"></i></span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <!-- ========== Setting ========== -->
                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Setting</span>
                </li>
                <li class="menu-item menu-item-has-children">
                    <a href="#">
                        <span class="nav-icon flex-shrink-0"><i class="bi bi-gear fs-18"></i></span>
                        <span class="nav-text">Setting</span>
                    </a>
                    <ul class="sub-menu">
                         <li class="menu-item"><a href="/admin/logo">Logo</a></li>
                        <li class="menu-item"><a href="/admin/socialmedia">Social Media Link</a></li>
                        <li class="menu-item"><a href="/admin/footercontact">Footer Contact</a></li>
                        <li class="menu-item"><a href="/admin/carousel">Main Carousel</a></li>
                        <li class="menu-item"><a href="/admin/famous">Famous Discount</a></li>
                        <li class="menu-item"><a href="/admin/about">About Content</a></li>
                        <li class="menu-item"><a href="/admin/blogs">Blog Content</a></li>
                        <li class="menu-item"><a href="/admin/discounts">Discount Content</a></li>
                        <li class="menu-item"><a href="/admin/gallery">Gallery Content</a></li>
                    </ul>
                    <span class="submenu-opener"><i class="bi bi-chevron-right"></i></span>
                </li>

                <!-- ========== Category | Product ========== -->
                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Category | Product</span>
                </li>
                <li class="menu-item menu-item-has-children">
                    <a href="#">
                        <span class="nav-icon flex-shrink-0"><i class="bi bi-box-seam fs-18"></i></span>
                        <span class="nav-text">Category | Product</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('admin.categories.index') }}"> Category </a></li>
                        <li class="menu-item"><a href="{{ route('admin.subcategories.index') }}"> Sub Category </a></li>
                        <li class="menu-item"><a href="{{ route('admin.products.index') }}"> Product</a></li>
                        <li class="menu-item"><a href="{{ route('admin.products.index') }}"> Product Images</a></li>
                    </ul>
                    <span class="submenu-opener"><i class="bi bi-chevron-right"></i></span>
                </li>

                <!-- ========== Order Manage ========== -->
                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Order Manage</span>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/admin/contacts') }}">
                        <span class="nav-icon flex-shrink-0"><i class="bi bi-person-lines-fill fs-18"></i></span>
                        <span class="nav-text">Contacts</span>
                    </a>
                </li>
                <li class="menu-item menu-item-has-children">
                    <a href="#">
                        <span class="nav-icon flex-shrink-0"><i class="bi bi-cart-check fs-18"></i></span>
                        <span class="nav-text">Order</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('admin.orders.index') }}"> order list </a></li>
                        <li class="menu-item"><a href="{{ route('admin.orderitems.index') }}"> order item</a></li>
                    </ul>
                    <span class="submenu-opener"><i class="bi bi-chevron-right"></i></span>
                </li>

            </ul>
        </div>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    @yield('content')

    <!-- ==================== SCRIPTS ==================== -->
    <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/jquery_ui/jquery-ui.1.12.1.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/js/datatables.init.js') }}"></script>
    <script src="{{ asset('admin/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/nicescroll/jquery.nicescroll.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/snippets.js') }}"></script>
    <script src="{{ asset('admin/assets/js/theme.js') }}"></script>

    <!-- Dark / Light Mode Script (localStorage) -->
    <script>
        $(document).ready(function () {
            const savedTheme = localStorage.getItem('theme');

            if (savedTheme === 'light') {
                $('body').removeClass('dark-mode').addClass('bg-light');
                $('#colorSwitch').prop('checked', false);
            } else {
                $('body').addClass('dark-mode').removeClass('bg-light');
                $('#colorSwitch').prop('checked', true);
            }

            $('#colorSwitch').on('change', function () {
                if ($(this).is(':checked')) {
                    $('body').addClass('dark-mode').removeClass('bg-light');
                    localStorage.setItem('theme', 'dark');
                } else {
                    $('body').addClass('bg-light').removeClass('dark-mode');
                    localStorage.setItem('theme', 'light');
                }
            });
        });
    </script>

</body>
</html>
