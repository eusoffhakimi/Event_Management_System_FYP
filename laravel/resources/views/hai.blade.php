<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Event Management System - UiTM Campus Jasin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('WeBuild/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('WeBuild/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('WeBuild/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('WeBuild/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('WeBuild/assets/css/follow.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: WeBuild
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/free-bootstrap-coming-soon-template-countdwon/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container-fluid d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="{{ url('/') }}"><span>ES</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        {{-- <a href="index.html"><img src="{{ asset('WeBuild/assets/img/logo.png') }}" alt="" class="img-fluid"></a> --}}
      </div>

      <div class="contact-link float-right">
        <a href="#contact" class="scrollto">Contact Us</a>
        @if (Route::has('login'))
            @auth
                @if(auth()->user()->user_type == 0)
                    <a href="{{ route('SJoinEvent.index') }}" class="scrollto">Dashboard</a>
                @else
                    <a href="{{ route('CMyEventPage.index') }}" class="scrollto">Dashboard</a>
                @endif
                {{-- <a href="{{ url('/dashboard') }}" class="scrollto">Dashboard</a> --}}
            @else
                <a href="{{ route('login') }}" class="scrollto">Log In</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="scrollto">Register</a>
                @endif
            @endauth
        @endif
      </div>

    </div>
  </header><!-- End #header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <h1>Event System</h1>
      <h2>The Website Development is for Final Year Project</h2>
      <p><span class="typed" data-typed-items="Designer, Developer, Student, Hensem"></span></p>
      <div class="countdown" data-count="2024/8/2" data-template="%d days %h:%m:%s"></div>

      {{-- <form action="forms/notify.php" method="post" role="form" class="php-email-form">
        <div class="row no-gutters">
          <div class="col-md-6 form-group pr-md-1">
            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
          </div>
          <div class="col-md-6 form-group pl-md-1">
            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
          </div>
        </div>

        <div class="my-3">
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your notification request was sent. Thank you!</div>
        </div>
        <div class="text-center"><button type="submit">Get notified!</button></div>
      </form> --}}
      <div class="text-center" style="background-color: #4f92af; border: 0; padding: 10px 24px;">
        <a href="https://t.me/+GaxO_aNWVR00OWNl" style="color: #fff; text-decoration: none;">Get notified!</a>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact Me</h2>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <address>Jalan Lembah Kesang 1/1-2, Kampung Seri Mendapat, 77300 Merlimau, Melaka</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+60122104494">012-210 4494</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:eusoffhakimi2@gmail.com">eusoffhakimi2@gmail.com</a></p>
            </div>
          </div>

        </div>

        {{-- <div class="form">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col-md form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div> --}}

      </div>
    </section><!-- End Contact Us Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>WeBuild</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-coming-soon-template-countdwon/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End #footer -->

  <!-- Vendor JS Files -->
  <script src="{{ asset('WeBuild/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('WeBuild/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('WeBuild/assets/vendor/typed.js/typed.umd.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('WeBuild/assets/js/main.js') }}"></script>

</body>

</html>
