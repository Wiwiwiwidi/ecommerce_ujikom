@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>E Store - eCommerce HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="eCommerce HTML Template Free Download" name="keywords">
    <meta content="eCommerce HTML Template Free Download" name="description">

    <!-- Favicon -->
    <link href="{{asset('ecommerce/img/favicon.ico')}}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Slick Slider CSS -->
    <link href="{{asset('ecommerce/lib/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('ecommerce/lib/slick/slick-theme.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('ecommerce/css/style.css')}}" rel="stylesheet">
</head>
    <body>
        <!-- Top bar Start -->
        <div class="top-bar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <i class="fa fa-envelope"></i>
                      TOKBOOK@gmail.com
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-phone-alt"></i>
                        +012-345-6789
                    </div>
                </div>
            </div>
        </div>
        <!-- Top bar End -->
     
        <!-- Nav Bar Start -->
        <div class="nav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="/home" class="nav-item nav-link active">Home</a>
                            <a href="/kategori" class="nav-item nav-link">All Kategori</a>
                            <a href="/my-produk" class="nav-item nav-link">Products</a>
                            <a href="/keranjang" class="nav-item nav-link">Cart</a>
                    </div>
                           
                            @guest
                            <a href="{{ route('login') }}" class="nav-item nav-link">{{ __('Login') }}  </a>
                                @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-item nav-link">{{ __('Register') }}</a>
                                @endif
                            @else
                                   
                        <div class="navbar-nav ml-auto">
                            <div class="nav-item dropdown">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @auth
                                {{auth()->user()->name}}
                                @endguest
                            </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="/profile" class="dropdown-item">My Account</a>
                                <a href="/my-history" class="dropdown-item">Riwayat Pesanan</a>
                                <form method="POST" action="{{ __('/logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </li>
                            <!--  -->
                            @endguest
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->      
           
        <!-- Bottom Bar Start -->
        <div class="bottom-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="{{asset('ecommerce/index.html')}}">
                                <img src="{{asset('ecommerce/img/logo.png')}}" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="search">
                        <form method="GET" action="{{ route('search') }}" enctype="multipart/form-data">
                            {{-- Add a name attribute to the input field --}}
                            <input type="text" id="search" name="search" placeholder="Search">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form> 
                    </div>
                    </div>
                    <div class="col-md-3">
                        <div class="user">
                            <a href="/wishlist" class="btn wishlist">
                                <i class="fa fa-heart"></i>
                            </a>
                            
                            <a href="/keranjang" class="btn cart">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Bar End -->       
           

        <!-- Featured Product Start -->
        <div class="featured-product product">
       @yield('content')
       </div>
        </div>
        <!-- Featured Product End -->   

         <!-- Footer Start -->
         <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Get in Touch</h2>
                            <div class="contact-info">
                                <p><i class="fa fa-map-marker"></i>123 E Store, Los Angeles, USA</p>
                                <p><i class="fa fa-envelope"></i>email@example.com</p>
                                <p><i class="fa fa-phone"></i>+123-456-7890</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Follow Us</h2>
                            <div class="contact-info">
                                <div class="social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                    <a href=""><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Company Info</h2>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms & Condition</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Purchase Info</h2>
                            <ul>
                                <li><a href="#">Pyament Policy</a></li>
                                <li><a href="#">Shipping Policy</a></li>
                                <li><a href="#">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="row payment align-items-center">
                    <div class="col-md-6">
                        <div class="payment-method">
                            <h2>We Accept:</h2>
                            <img src="{{asset('ecommerce/img/payment-method.png')}}" alt="Payment Method" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-security">
                            <h2>Secured By:</h2>
                            <img src="{{asset('ecommerce/img/godaddy.svg')}}" alt="Payment Security" />
                            <img src="{{asset('ecommerce/img/norton.svg')}}" alt="Payment Security" />
                            <img src="{{asset('ecommerce/img/ssl.svg')}}" alt="Payment Security" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Footer Bottom Start -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 copyright">
                        <p>Copyright &copy; <a href="#">Your Site Name</a>. All Rights Reserved</p>
                    </div>

                    <div class="col-md-6 template-by">
						<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->					
                        <p>Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->       
       <!-- Back to Top -->
       <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
           <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('ecommerce/lib/easing/easing.min.js')}}"></script>
        <script src="{{asset('ecommerce/lib/slick/slick.min.js')}}"></script>
        
        <!-- Template Javascript -->
        <script src="{{asset('ecommerce/js/main.js')}}"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        @if(session('status'))
        <script>
         swal("{{ session('status') }}");
         </script>
         @endif

         @yield('scripts')
    </body>
</html>


