<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="">
      <meta name="keywords" content="">
      <meta name="description" content="">
      <title>@yield('title')</title>
      <!-- Loading Bootstrap -->
      <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
      <!-- Loading Template CSS -->
      <link rel="stylesheet" href="https://6597-2-132-47-181.ngrok-free.app/admin/plugins/fontawesome-free/css/all.min.css">
      <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/css/bootstrap-icons.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="../../css2?family=Nunito:wght@400;600;700;800&family=Open+Sans:ital@0;1&display=swap" rel="stylesheet">
      <!-- Font Favicon -->
      <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png')}}">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   </head>
   <body>
      <!-- begin header -->
      <header>
         <nav class="navbar navbar-expand-lg sticky_nav navbar-fixed-tops">
            <div class="container">
               <!-- begin logo -->
               <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('frontend/images/sc_logo.png')}}" class="img-fluid " alt=""></a>
               <!-- end logo -->
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"><i class="bi bi-list"></i></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarScroll">
                  <!-- begin navbar-nav -->
                  <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll justify-content-center">
                     <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ url('about') }}">About</a></li>
                     <li class="nav-item"><a class="nav-link" href="/#service">Services</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ url('members') }}">Members</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ url('membership') }}">Plan</a></li>
                     <li class="nav-item"><a class="nav-link" href="/#faq">Faq's</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ url('contact') }}">Contact</a></li>
                  </ul>
                  <div class="col-md-2 text-end">
                     <a href="#"><button type="button" class="btn btn-primary dating_btn">Download App</button></a>
                  </div>
               </div>
            </div>
         </nav>
      </header>
      <!-- end header -->
      <main>
@yield('content')
    <!--begin footer -->
    <div class="footer">
      <!--begin container -->
      <div class="container">
          <!--begin row -->
          <div class="row align-items-center ">
              <!--begin col-md-7 -->
              <div class="col-md-7">
                  <p class="white mb-0 fs-14">© 2024 <span class="template-name">Single & Curious</span>. Designed by <a
                          href="" target="_blank" class="text-decoration-none white ">DipanshuTech</a></p>
              </div>
              <!--end col-md-7 -->
              <!--begin col-md-5 -->
              <div class="col-md-5">
                  <!--begin footer_social -->
                  <ul class="footer_social mb-0">
                      <li class="white fs-14">Follw us:</li>
                      <li><a href="#" class="twitter"><i class="bi bi-twitter"></i></a></li>
                      <li><a href="#" class="instagram"><i class="bi bi-instagram"></i></a></li>
                      <li><a href="#" class="whatsapp"><i class="bi bi-whatsapp"></i></a></li>
                      <li><a class="white fs-14 footer_links" href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                      <li class="white">|</li>
                      <li><a class="white fs-14 footer_links" href="{{url('terms-and-conditions')}}">Terms and Conditions</a></li>
                  </ul>
                  <!--end footer_social -->
              </div>
              <!--end col-md-5 -->
          </div>
          <!--end row -->
      </div>
      <!--end container -->
  </div>
  <!--end footer -->
</main>
      <!-- Load JS here for greater good =============================-->
      <script src="{{ asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
      <script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
      <script src="{{ asset('frontend/js/jquery.scrollTo-min.js')}}"></script>
     
      <script src="{{ asset('frontend/js/wow.js')}}"></script>
      <script src="{{ asset('frontend/js/plugins.js')}}"></script>
      <script src="{{ asset('frontend/js/custom.js')}}"></script>
   </body>
</html>