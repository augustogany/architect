@extends('layouts.master')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero" style="height: 350px">

        <div class="info align-items-center">
            <div class="container mt-5 pt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 data-aos="fade-down">Arquitectos <span>Afiliados al Colegio</span></h2>
                        {{-- <p data-aos="fade-up">El Colegio de Arquitectos del Beni (CAD-BENI.) es una institución que agrupa y representa a sus afiliados a nivel departamental; controla y certifica el ejercicio profesional, generando ámbitos de participación orientado al diseño de políticas públicas de planificación participativa y construcción del hábitat.</p> --}}
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

        <!-- ======= Team Section ======= -->
        <section id="team" class="team section-bg mb-5">
            <div class="container" data-aos="fade-up">
    
                <div class="section-header">
                    <h2>Arquitectos</h2>
                    {{-- <p>Consequatur libero assumenda est voluptatem est quidem illum et officia imilique qui vel architecto accusamus fugit aut qui distinctio</p> --}}
                </div>
    
                <div class="row">
        
                    @forelse (App\Perfil::where('condicion', 1)->get() as $item)
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                            <a href="{{ $item->cv ? url('storage/'.$item->cv) : '#' }}" title="Ver Curriculúm Vitae" target="_blank">
                                <div class="member">
                                    <div class="member-img">
                                        @php
                                            $image = 'theme/dist/img/user-account.png';
                                            if($item->imagen){
                                                $image = asset('storage/'.$item->imagen);
                                            }
                                        @endphp
                                        <img src="{{ $image }}" class="img-fluid" alt="">
                                        {{-- <div class="social">
                                            <a href=""><i class="bi bi-twitter"></i></a>
                                            <a href=""><i class="bi bi-facebook"></i></a>
                                            <a href=""><i class="bi bi-instagram"></i></a>
                                            <a href=""><i class="bi bi-linkedin"></i></a>
                                        </div> --}}
                                    </div>
                                    <div class="member-info">
                                        <h4>{{ $item->nombre }} {{ $item->apaterno }} {{ $item->amaterno }}</h4>
                                        <span>{{ $item->email }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection