<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/teskkp.jpg') }}">
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type= "text/css" href="{{ asset('css/style.css') }}">
      <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/wa.min.css') }}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


    <title>@yield('judul')</title>
</head>

<body>

<header id="header" class="fixed-top d-flex align-items-center mb-3">
    <div class="container d-flex align-items-center">
    <img src="{{ asset('img/teskkp.jpg') }}" alt="logo loka" width="40px" class="px-2">
    <h1 class="logo me-auto ml-2"><a href="">LPSPL Sorong</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

    <nav id="navbar" class="navbar">
      <ul>
        <li><a href="#" class="active"></a></li>
        <li><a href="#" class="active"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>

        <li><a href="#"></a></li>
        <li><a href="http://timurbersinar.com/index.html" class="getstarted" target="_blank">Kenali Kami</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header>


@yield('isi')

<footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
  
          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>LPSPL Sorong</h3>
              <p>
               Jl. KPR PAM No 10, Klawuyuk <br>
                Sorong Timur, Kota Soroong, Papua Barat<br><br>
                <strong>Phone/Fax:</strong> (0951)328496<br>
                <strong>Email:</strong> lpspl.sorong@kkp.go.id / lpspl.sorong@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="https://twitter.com/lpsplsorong" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="https://www.facebook.com/lpsplsorong.kkp" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/lpsplsorong/?hl=id" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="https://www.youtube.com/channel/UCHdeNKhQBFftzC2GZKiAu8A" class="linkedin"><i class="bx bxl-youtube"></i></a>
              </div>
            </div>
          </div>
  
  
          <div class="col-lg-4 col-md-6 footer-links">
          <h5>Jadwal Pelayanan :</h5>
           <h5>Senin-Kamis</h5>
           <p>Jam : 08.00 - 16.00 WIT</p>
           <br>
           <h5><span>Jumat</span></h5>
           <p>Jam : 08.00 - 16.30 WIT</p>
           <h5>Hari Libur Tutup</h5>
          </div>
  
          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>#Bersinar</h4>
            <p>LPSPL Sorong Bersih, Integritas & Terarah</p>
  
            <div class="d-grid gap-2 col-12 ml-n3">
              <a href="https://api.whatsapp.com/send?phone=+628114874148&text=Halo%20Pengaduan%20LPSPL%20Sorong%2C%20Saya%20ingin%20menyampaikan" class="btn btn-success" target="_blank">
                <i class="bi bi-whatsapp"></i> Pengaduan LPSPL Sorong</button></a>
  
              <a href="https://api.whatsapp.com/send?phone=+6281341745454&text=Halo%20Admin%20Pelayanan%20LPSPL%20Sorong" class="btn btn-success mt-2" target="_blank">
                <i class="bi bi-whatsapp"></i> Pelayanan LPSPL Sorong</button></a>
            </div> 
        </div>
      </div>
    </div>
  
    <div class="container">
     
      <div class="credits text-left">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/sailor-free-bootstrap-theme/ -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
        
        <small><a href="https://bootstrapmade.com/">BootstrapMade</a> </small>

      </div>
    </div>
  </footer><!-- End Footer -->
  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  
  <!-- Vendor JS Files -->
  <script src={{ asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") }}></script>
  {{-- <script src={{ asset("assets/vendor/glightbox/js/glightbox.min.js") }}></script>
  <script src={{ asset("assets/vendor/isotope-layout/isotope.pkgd.min.js") }}></script>
  <script src={{ asset("assets/vendor/php-email-form/validate.js") }}></script>
  <script src={{ asset("assets/vendor/swiper/swiper-bundle.min.js") }}></script>
  <script src={{ asset("assets/vendor/waypoints/noframework.waypoints.js") }}></script> --}}
  
  {{-- <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script> --}}
  {{-- <script src="assets/vendor/php-email-form/validate.js"></script> --}}
  {{-- <script src="assets/vendor/swiper/swiper-bundle.min.js"></script> --}}
  {{-- <script src="assets/vendor/waypoints/noframework.waypoints.js"></script> --}}
  {{-- <script src="assets/wa.js"></script> --}}
  
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
  </body>
  
  </html>