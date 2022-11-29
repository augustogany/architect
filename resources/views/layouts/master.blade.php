<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
      
        <title>CADBENI | Bienvenido</title>
        <meta name="description" content="Colegio de Arquitectos del Beni">

        <meta property="og:url"           content="{{ url('') }}" />
        <meta property="og:title"         content="CADBENI | Bienvenido" />
        <meta property="og:description"   content="Colegio de Arquitectos del Beni" />
        <meta property="og:image"         content="{{ asset('theme/dist/img/logo.png') }}" />
        <meta name="keywords" content="cadbeni, colegio, arquitecto, beni">
      
        <!-- Favicons -->
        <link rel="shortcut icon" href="{{ asset('theme/dist/img/logo.png') }}" type="image/x-icon">
        <link href="{{ asset('theme/dist/img/logo.png') }}" rel="apple-touch-icon">
      
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
      
        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
      
        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
      
        <!-- =======================================================
        * Template Name: UpConstruction - v1.0.1
        * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->
    </head>
    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="header d-flex align-items-center">
            <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="{{ url('') }}" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('theme/dist/img/logo.png') }}" alt="">
                <h1>CADBENI</h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="{{ url('') }}">Inicio</a></li>
                    <li><a href="{{ url('') }}#alt-services">Acerca de</a></li>
                    <li><a href="{{ url('arquitectos') }}">Afiliados</a></li>
                    <li><a href="{{ url('') }}#projects">Proyectos</a></li>
                    <li class="dropdown"><a href="#"><span>Archivos</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="{{ url('docs/LEY 1373.pdf') }}" target="_blank">LEY 1373</a></li>
                            <li><a href="{{ url('docs/DECRETO REGLAMENTARIO LEY 1373.pdf') }}" target="_blank">DECRETO REGLAMENTARIO LEY 1373</a></li>
                        {{-- <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li> --}}
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('home') }}">
                            @guest
                                Iniciar sesión
                            @else
                                Perfil
                            @endguest
                        </a>
                    </li>
                </ul>
            </nav><!-- .navbar -->

            </div>
        </header><!-- End Header -->

        @yield('content')

        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer">

            <div class="footer-content position-relative">
            <div class="container">
                <div class="row">

                <div class="col-lg-8 col-md-8">
                    <div class="footer-info">
                    <h3>CADBENI</h3>
                    <p>
                        Avenida 6 de agosto #541 - Zona San Antonio <br>
                        Santísima Trinidad, Beni<br><br>
                        <strong>Telefono:</strong> 46-21299<br>
                        <strong>Email:</strong> cadbeni@gmail.com<br>
                    </p>
                    <div class="social-links d-flex mt-3">
                        <a href="https://www.facebook.com/cad.beni/" target="_blank" class="d-flex align-items-center justify-content-center"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><i class="bi bi-linkedin"></i></a>
                    </div>
                    </div>
                </div><!-- End footer info column-->

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Enlaces</h4>
                    <ul>
                        <li><a href="{{ url('') }}">Inicio</a></li>
                        <li><a href="{{ url('') }}#alt-services">Acerca de</a></li>
                        <li><a href="{{ url('arquitectos') }}">Afiliados</a></li>
                        <li><a href="{{ url('') }}#projects">Proyectos</a></li>
                        <li>
                            <a href="{{ url('home') }}">
                                @guest
                                    Iniciar sesión
                                @else
                                    Perfil
                                @endguest
                            </a>
                        </li>
                    </ul>
                </div><!-- End footer links column-->

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Archivos</h4>
                    <ul>
                        <li><a href="{{ url('docs/LEY 1373.pdf') }}" target="_blank">LEY 1373</a></li>
                        <li><a href="{{ url('docs/DECRETO REGLAMENTARIO LEY 1373.pdf') }}" target="_blank">DECRETO REGLAMENTARIO LEY 1373</a></li>
                    </ul>
                </div><!-- End footer links column-->

                {{-- <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Hic solutasetp</h4>
                    <ul>
                    <li><a href="#">Molestiae accusamus iure</a></li>
                    <li><a href="#">Excepturi dignissimos</a></li>
                    <li><a href="#">Suscipit distinctio</a></li>
                    <li><a href="#">Dilecta</a></li>
                    <li><a href="#">Sit quas consectetur</a></li>
                    </ul>
                </div> --}}
                <!-- End footer links column-->

                </div>
            </div>
            </div>

            <div class="footer-legal text-center position-relative">
            <div class="container">
                <div class="copyright">
                &copy; Copyright <strong><span>CADBENI</span></strong>. Todos los derechos reservados
                </div>
                <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/ -->
                Diseñado por <a href="https://ideacreativa.dev" target="_blank">IdeaCreativa</a>
                </div>
            </div>
            </div>

        </footer>
        <!-- End Footer -->

        <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>