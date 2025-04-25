<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <title>Pickify</title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{asset ('css/bootstrap.css')}}" />

    <!--including font-awesome icons-->
    <script src="https://kit.fontawesome.com/8a4d226d96.js" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />

    <!-- responsive style -->
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet" />

    <!--Toastr Link, you should also add script tag in the footer-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>
    <!-- header section strats -->
    <header class="header_section">
        <nav class="custom_nav-container ">

            <div class="" id="navbarSupportedContent">

                <a class="logo-link " href="{{url('/')}}">
                    <img src="{{asset('/images/pickify_logo.png')}}" alt="" height="67px">
                </a>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/shop')}}">
                            Shop
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/why_us')}}">
                            Why Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/testimonial')}}">
                            Testimonial
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/contact_us')}}">Contact Us</a>
                    </li>

                    <li class="nav-item" id="mobile-search-bar">
                        <div id="searchBar">
                            <form action="{{ url('search_product') }}" method="GET" style="margin-bottom: -1px;">
                                <input type="search" name="search" id= "searchInput" placeholder="Search your items"
                                    value="{{ request('search') }}">
                                <span id="clearBtn" class="clearBtn">&times;</span>
                                <button id="btn" class="search_button" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </li>

                </ul>

            </div>

            <div class="login_shopping d-flex">
                @if (Route::has('login'))

                @auth

                <div class="d-flex flex-column position-relative gap-3" style="bottom: 15.5px; gap: 8px;">
                    <a href="{{url('mycart')}}" class="cart" style="padding-right: 3.5rem;">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span style="margin: 0 5px">
                            Cart
                        </span>
                        <span class="cart-count badge badge-danger"
                            style="background: #222222; margin-top: 3px; position: relative; top: -1.5px; color: white; font-size: 14px;">{{$count}}</span>
                    </a>

                    <a href="{{url('myorders')}}">My Orders</a>
                </div>
                <div class="list-inline-item logout" style="position: relative; top: -7.5px; padding-right: 9px;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger"
                            style="background: #dfd696; color: black;">Logout</button>
                    </form>
                </div>

                <div class="hamburger-and-login">
                    <i class=" mobile-nav-toggle fa-solid fa-bars"></i>
                </div>

                @else

                <div class="hamburger-and-login">
                    <i class=" mobile-nav-toggle fa-solid fa-bars"></i>
                </div>

                <a href="{{url('/login')}}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                        Login
                    </span>
                </a>

                <a href="{{url('/register')}}">
                    <i class="fa fa-vcard" aria-hidden="true"></i>
                    <span>
                        Register
                    </span>
                </a>
                @endauth
                @endif
            </div>
        </nav>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.querySelector('.mobile-nav-toggle');
        const navMenu = document.querySelector('.navbar-nav');
        const searchBar = document.querySelector('#searchBar');

        toggleButton.addEventListener('click', () => {
        navMenu.classList.toggle('show');
         });
        });
    </script>

    <script>
    const searchInput = document.getElementById('searchInput');
    const clearBtn = document.getElementById('clearBtn');

    function toggleClearButton() {
        clearBtn.style.display = searchInput.value ? 'inline-block' : 'none';
    }

    searchInput.addEventListener('input', toggleClearButton);
    window.addEventListener('DOMContentLoaded', toggleClearButton);

    clearBtn.addEventListener('click', function () {
        searchInput.value = '';
        toggleClearButton();
        searchInput.focus();
    });
    </script>