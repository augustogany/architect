@extends('layouts.master')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero">

        <div class="info d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 data-aos="fade-down">Colegio de Arquitectos <span>del Beni</span></h2>
                <p data-aos="fade-up">El Colegio de Arquitectos del Beni (CAD-BENI.) es una institución que agrupa y representa a sus afiliados a nivel departamental; controla y certifica el ejercicio profesional, generando ámbitos de participación orientado al diseño de políticas públicas de planificación participativa y construcción del hábitat.</p>
                <a data-aos="fade-up" data-aos-delay="200" href="#alt-services" class="btn-get-started">Iniciar ahora</a>
            </div>
            </div>
        </div>
        </div>

        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item active" style="background-image: url(assets/img/hero-carousel/hero-carousel-1.jpg)"></div>
        <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/hero-carousel-2.jpg)"></div>
        <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/hero-carousel-3.jpg)"></div>
        <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/hero-carousel-4.jpg)"></div>
        <div class="carousel-item" style="background-image: url(assets/img/hero-carousel/hero-carousel-5.jpg)"></div>

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        </div>

    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= Alt Services Section ======= -->
        <section id="alt-services" class="alt-services">
            <div class="container" data-aos="fade-up">

                <div class="row justify-content-around gy-4">
                    <div class="col-lg-6 img-bg" style="background-image: url(assets/img/logo-alt.jpeg);" data-aos="zoom-in" data-aos-delay="100"></div>

                    <div class="col-lg-6 d-flex flex-column justify-content-center">
                        <h3>Quienes somos?</h3>
                        <p>El Colegio de Arquitectos del Beni (CAD-BENI.) es una institución que agrupa y representa a sus afiliados a nivel departamental; controla y certifica el ejercicio profesional, generando ámbitos de participación orientado al diseño de políticas públicas de planificación participativa y construcción del hábitat, a través del control social que le corresponde desarrollar como organización social de los profesionales del ramo.
                            Asimismo, posibilita el perfeccionamiento profesional especializado, otorgando servicios y protección a sus asociados.
                        </p>

                        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="100" style="margin-top: 15px">
                            <i class="bi bi-easel flex-shrink-0"></i>
                            <div>
                                <h4><a href="" class="stretched-link">Misión</a></h4>
                                <p>Es una institución que agrupa y representa a sus afiliados en el territorio nacional; controla y certifica el ejercicio profesional, generando ámbitos de participación orientado al diseño de políticas públicas de planificación participativa y construcción del hábitat, a través del control social que le corresponde desarrollar como organización social de los profesionales del ramo. <br> Asimismo, posibilita el perfeccionamiento profesional especializado, otorgando servicios y protección a sus asociados.</p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-patch-check flex-shrink-0"></i>
                        <div>
                            <h4><a href="" class="stretched-link">Visión</a></h4>
                            <p>Lideriza la gestión de políticas públicas en el ámbito de su competencia, fortaleciendo el ejercicio profesional del Arquitecto con equidad, transparencia, solidaridad y respaldo legal, en un escenario autónomo con compromiso social, en el marco intercultural de la organización del Estado. <br> Servir a la sociedad civil e instituciones del Estado por medio del correcto ejercicio profesional de la Arquitectura. <br> Contribuir a la fiscalización del ejercicio profesional</p>
                        </div>
                        </div><!-- End Icon Box -->

                    </div>
                </div>

            </div>
        </section><!-- End Alt Services Section -->

        <!-- ======= Constructions Section ======= -->
        {{-- <section id="constructions" class="constructions">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                <h2>Construcciones</h2>
                <p>Nulla dolorum nulla nesciunt rerum facere sed ut inventore quam porro nihil id ratione ea sunt quis dolorem dolore earum</p>
                </div>

                <div class="row gy-4">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-item">
                    <div class="row">
                        <div class="col-xl-5">
                        <div class="card-bg" style="background-image: url(assets/img/constructions-1.jpg);"></div>
                        </div>
                        <div class="col-xl-7 d-flex align-items-center">
                        <div class="card-body">
                            <h4 class="card-title">Eligendi omnis sunt veritatis.</h4>
                            <p>Fuga in dolorum et iste et culpa. Commodi possimus nesciunt modi voluptatem placeat deleniti adipisci. Cum delectus doloribus non veritatis. Officia temporibus illo magnam. Dolor eos et.</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-item">
                    <div class="row">
                        <div class="col-xl-5">
                        <div class="card-bg" style="background-image: url(assets/img/constructions-2.jpg);"></div>
                        </div>
                        <div class="col-xl-7 d-flex align-items-center">
                        <div class="card-body">
                            <h4 class="card-title">Possimus ut sed velit assumenda</h4>
                            <p>Sunt deserunt maiores voluptatem autem est rerum perferendis rerum blanditiis. Est laboriosam qui iste numquam laboriosam voluptatem architecto. Est laudantium sunt at quas aut hic. Eum dignissimos.</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-item">
                    <div class="row">
                        <div class="col-xl-5">
                        <div class="card-bg" style="background-image: url(assets/img/constructions-3.jpg);"></div>
                        </div>
                        <div class="col-xl-7 d-flex align-items-center">
                        <div class="card-body">
                            <h4 class="card-title">Error beatae dolor inventore aut</h4>
                            <p>Dicta porro nobis. Velit cum in. Nesciunt dignissimos enim molestiae facilis numquam quae quaerat ipsam omnis. Neque debitis ipsum at architecto officia laboriosam odit. Ut sunt temporibus nulla culpa.</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-item">
                    <div class="row">
                        <div class="col-xl-5">
                        <div class="card-bg" style="background-image: url(assets/img/constructions-4.jpg);"></div>
                        </div>
                        <div class="col-xl-7 d-flex align-items-center">
                        <div class="card-body">
                            <h4 class="card-title">Expedita voluptas ut ut nesciunt</h4>
                            <p>Aut est quidem doloremque voluptatem magnam quis excepturi vero quia. Eum eos doloremque architecto illo at beatae dolore. Fugiat suscipit et sint ratione dolores. Aut aliquid ea dolores libero nobis.</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div><!-- End Card Item -->

                </div>

            </div>
        </section> --}}
        <!-- End Constructions Section -->

        <!-- ======= Services Section ======= -->
        {{-- <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                <h2>Servicios</h2>
                <p>Voluptatem quibusdam ut ullam perferendis repellat non ut consequuntur est eveniet deleniti fignissimos eos quam</p>
                </div>

                <div class="row gy-4">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item  position-relative">
                    <div class="icon">
                        <i class="fa-solid fa-mountain-city"></i>
                    </div>
                    <h3>Nesciunt Mete</h3>
                    <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
                    <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="fa-solid fa-arrow-up-from-ground-water"></i>
                    </div>
                    <h3>Eosle Commodi</h3>
                    <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
                    <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="fa-solid fa-compass-drafting"></i>
                    </div>
                    <h3>Ledo Markt</h3>
                    <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
                    <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="fa-solid fa-trowel-bricks"></i>
                    </div>
                    <h3>Asperiores Commodit</h3>
                    <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
                    <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="fa-solid fa-helmet-safety"></i>
                    </div>
                    <h3>Velit Doloremque</h3>
                    <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
                    <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="fa-solid fa-arrow-up-from-ground-water"></i>
                    </div>
                    <h3>Dolori Architecto</h3>
                    <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
                    <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->

                </div>

            </div>
        </section> --}}
        <!-- End Services Section -->

        <!-- ======= Features Section ======= -->
        {{-- <section id="features" class="features section-bg">
            <div class="container" data-aos="fade-up">

                <ul class="nav nav-tabs row  g-2 d-flex">

                <li class="nav-item col-3">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                    <h4>Modisit</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item col-3">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                    <h4>Praesenti</h4>
                    </a><!-- End tab nav item -->

                <li class="nav-item col-3">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                    <h4>Explica</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item col-3">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                    <h4>Nostrum</h4>
                    </a>
                </li><!-- End tab nav item -->

                </ul>

                <div class="tab-content">

                <div class="tab-pane active show" id="tab-1">
                    <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                        <h3>Voluptatem dignissimos provident</h3>
                        <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                        </p>
                        <ul>
                        <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                        <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                        <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                        <img src="assets/img/features-1.jpg" alt="" class="img-fluid">
                    </div>
                    </div>
                </div><!-- End tab content item -->

                <div class="tab-pane" id="tab-2">
                    <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                        <h3>Neque exercitationem debitis</h3>
                        <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                        </p>
                        <ul>
                        <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                        <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                        <li><i class="bi bi-check2-all"></i> Provident mollitia neque rerum asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</li>
                        <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="assets/img/features-2.jpg" alt="" class="img-fluid">
                    </div>
                    </div>
                </div><!-- End tab content item -->

                <div class="tab-pane" id="tab-3">
                    <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                        <h3>Voluptatibus commodi accusamu</h3>
                        <ul>
                        <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                        <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                        <li><i class="bi bi-check2-all"></i> Provident mollitia neque rerum asperiores dolores quos qui a. Ipsum neque dolor voluptate nisi sed.</li>
                        </ul>
                        <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                        </p>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="assets/img/features-3.jpg" alt="" class="img-fluid">
                    </div>
                    </div>
                </div><!-- End tab content item -->

                <div class="tab-pane" id="tab-4">
                    <div class="row">
                    <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                        <h3>Omnis fugiat ea explicabo sunt</h3>
                        <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                        </p>
                        <ul>
                        <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                        <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                        <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 text-center">
                        <img src="assets/img/features-4.jpg" alt="" class="img-fluid">
                    </div>
                    </div>
                </div><!-- End tab content item -->

                </div>

            </div>
        </section> --}}
        <!-- End Features Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients mt-5">
            {{-- <div class="section-header">
                <h2>Our Customers</h2>
                <p>Architecto nobis eos vel nam quidem vitae temporibus voluptates qui hic deserunt iusto omnis nam voluptas asperiores sequi tenetur dolores incidunt enim voluptatem magnam cumque fuga.</p>
            </div> --}}
            <div class="container" data-aos="zoom-out">
                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="assets/img/clients/client-1.jpeg" class="img-fluid" alt="img"></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-2.jpeg" class="img-fluid" alt="img"></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-3.jpeg" class="img-fluid" alt="img"></div>
                        {{-- <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt="img"></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt="img"></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt="img"></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt="img"></div>
                        <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt="img"></div> --}}
                    </div>
                </div>
            </div>
        </section>
        <!-- End Clients Section -->

        <!-- ======= Our Projects Section ======= -->
        <section id="projects" class="projects">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                <h2>Proyectos</h2>
                {{-- <p>Consequatur libero assumenda est voluptatem est quidem illum et officia imilique qui vel architecto accusamus fugit aut qui distinctio</p> --}}
                </div>

                <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">

                <ul class="portfolio-flters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">Todos</li>
                    @foreach (App\Galeria::where('deleted_at', NULL)->groupBy('tipo')->get() as $item)
                    <li data-filter=".filter-{{ str_replace(' ', '-', $item->tipo) }}">{{ $item->tipo }}</li>
                    @endforeach
                </ul><!-- End Projects Filters -->

                <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    @foreach (App\Galeria::where('deleted_at', NULL)->get() as $item)
                        @if ($item->archivo)
                            @php
                                $imagen = asset('storage/'.$item->archivo);
                                $small_imagen = asset('storage/'.str_replace('.', '_medium.', $item->archivo));
                            @endphp
                            <div class="col-lg-4 col-md-6 portfolio-item filter-{{ str_replace(' ', '-', $item->tipo) }}">
                                <div class="portfolio-content h-100">
                                    <img src="{{ $small_imagen }}" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <h4>{{ $item->titulo }}</h4>
                                        <p>{{ $item->detalles }}</p>
                                        <a href="{{ $imagen }}" title="{{ $item->titulo }}" data-gallery="portfolio-gallery-remodeling" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                        {{-- <a href="project-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a> --}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div><!-- End Projects Container -->

                </div>

            </div>
        </section><!-- End Our Projects Section -->

        <!-- ======= Testimonials Section ======= -->
        {{-- <section id="testimonials" class="testimonials section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                <h2>Clientes</h2>
                <p>Quam sed id excepturi ccusantium dolorem ut quis dolores nisi llum nostrum enim velit qui ut et autem uia reprehenderit sunt deleniti</p>
                </div>

                <div class="slides-2 swiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                    <div class="testimonial-wrap">
                        <div class="testimonial-item">
                        <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                        <h3>Saul Goodman</h3>
                        <h4>Ceo &amp; Founder</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                        </div>
                    </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                    <div class="testimonial-wrap">
                        <div class="testimonial-item">
                        <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                        <h3>Sara Wilsson</h3>
                        <h4>Designer</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                        </div>
                    </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                    <div class="testimonial-wrap">
                        <div class="testimonial-item">
                        <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                        <h3>Jena Karlis</h3>
                        <h4>Store Owner</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                        </div>
                    </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                    <div class="testimonial-wrap">
                        <div class="testimonial-item">
                        <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                        <h3>Matt Brandon</h3>
                        <h4>Freelancer</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                        </div>
                    </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                    <div class="testimonial-wrap">
                        <div class="testimonial-item">
                        <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                        <h3>John Larson</h3>
                        <h4>Entrepreneur</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                        </div>
                    </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
                </div>

            </div>
        </section> --}}
        <!-- End Testimonials Section -->

        <!-- ======= Recent Blog Posts Section ======= -->
        {{-- <section id="recent-blog-posts" class="recent-blog-posts">
            <div class="container" data-aos="fade-up">
                <div class=" section-header">
                    <h2>Blog de noticias</h2>
                    <p>In commodi voluptatem excepturi quaerat nihil error autem voluptate ut et officia consequuntu</p>
                </div>

                <div class="row gy-5">

                    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="post-item position-relative h-100">

                        <div class="post-img position-relative overflow-hidden">
                        <img src="assets/img/blog/blog-1.jpg" class="img-fluid" alt="">
                        <span class="post-date">December 12</span>
                        </div>

                        <div class="post-content d-flex flex-column">

                        <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis</h3>

                        <div class="meta d-flex align-items-center">
                            <div class="d-flex align-items-center">
                            <i class="bi bi-person"></i> <span class="ps-2">Julia Parker</span>
                            </div>
                            <span class="px-3 text-black-50">/</span>
                            <div class="d-flex align-items-center">
                            <i class="bi bi-folder2"></i> <span class="ps-2">Politics</span>
                            </div>
                        </div>

                        <hr>

                        <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                    </div><!-- End post item -->

                    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="post-item position-relative h-100">

                        <div class="post-img position-relative overflow-hidden">
                        <img src="assets/img/blog/blog-2.jpg" class="img-fluid" alt="">
                        <span class="post-date">July 17</span>
                        </div>

                        <div class="post-content d-flex flex-column">

                        <h3 class="post-title">Et repellendus molestiae qui est sed omnis</h3>

                        <div class="meta d-flex align-items-center">
                            <div class="d-flex align-items-center">
                            <i class="bi bi-person"></i> <span class="ps-2">Mario Douglas</span>
                            </div>
                            <span class="px-3 text-black-50">/</span>
                            <div class="d-flex align-items-center">
                            <i class="bi bi-folder2"></i> <span class="ps-2">Sports</span>
                            </div>
                        </div>

                        <hr>

                        <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                    </div><!-- End post item -->

                    <div class="col-xl-4 col-md-6">
                    <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="300">

                        <div class="post-img position-relative overflow-hidden">
                        <img src="assets/img/blog/blog-3.jpg" class="img-fluid" alt="">
                        <span class="post-date">September 05</span>
                        </div>

                        <div class="post-content d-flex flex-column">

                        <h3 class="post-title">Quia assumenda est et veritati tirana ploder</h3>

                        <div class="meta d-flex align-items-center">
                            <div class="d-flex align-items-center">
                            <i class="bi bi-person"></i> <span class="ps-2">Lisa Hunter</span>
                            </div>
                            <span class="px-3 text-black-50">/</span>
                            <div class="d-flex align-items-center">
                            <i class="bi bi-folder2"></i> <span class="ps-2">Economics</span>
                            </div>
                        </div>

                        <hr>

                        <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                    </div><!-- End post item -->

                </div>

            </div>
        </section> --}}
        <!-- End Recent Blog Posts Section -->

        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2 style="font-size: 25px">ARQUITECTURA, ATRIBUACION DE ARQUITECTOS</h2>
            </div>
        </div>

    
    </main><!-- End #main -->
@endsection