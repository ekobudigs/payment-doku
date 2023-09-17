@extends('web.layouts.master')

@section('content')
<!-- Hero Section -->
<section class="hero-1 bg-primary" id="home">
    <div class="bg-overlay overflow-hidden bg-transparent">
        <div class="hero-1-bg"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="hero-wrapper text-white-50 text-center">
                    <h5 class="text-white-50 home-small-title">Awesome Design</h5>
                    <h1 class="hero-1-title display-4 text-white mb-4">We love make things amazing and simple</h1>

                    <p class="mb-4">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                    </p>

                    @if (!auth('web')->check())
                    <div class="pt-2">
                        <a href="{{ route('web.auth.login.index') }}" class="btn btn-primary mr-2">
                            Masuk
                        </a>
                        <a href="{{ route('web.auth.register.index') }}" class="btn btn-info">
                            Daftar <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        </a>
                    </div>
                    @endif

                    <div class="home-img mt-5">
                        <img src="{{ asset('assets/web/images/home-img.png') }}" alt="Homepage Banner"
                            class="img-fluid mx-auto d-block" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Hero Section -->

<!-- About Section -->
<section class="section" id="about" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-5 text-center">
                    <h3 class="mb-3">A digital web design studio creating modern & engaging online</h3>
                    <p class="text-muted">
                        If several languages coalesce, the grammar of the resulting language is more simple and regular
                        than that of the individual languages new common will be more regular than the existing If
                        several is more
                        simple and regular than that of the individual languages new common will be more regular than
                        the existing
                    </p>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="p-4 text-center">
                    <div class="icons-xl mb-3">
                        <i class="uim uim-ruler"></i>
                    </div>

                    <h5>Web Designing</h5>
                    <p class="text-muted">If several languages coalesce, the grammar of the resulting language is more
                        regular than that of the individual</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="p-4 text-center">
                    <div class="icons-xl mb-3">
                        <i class="uim uim-repeat"></i>
                    </div>

                    <h5>Programming</h5>
                    <p class="text-muted">To achieve this, it would be necessary to have uniform more common several
                        languages coalesce</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="p-4 text-center">
                    <div class="icons-xl mb-3">
                        <i class="uim uim-airplay"></i>
                    </div>

                    <h5>Software Development</h5>
                    <p class="text-muted">For science, music, sport, etc, Europe uses the same vocabulary only differ in
                        their pronunciation.</p>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- End About Section -->

<!-- Features Section -->
<section class="section bg-light" id="features" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="title mb-5 text-center">
                    <p class="text-muted text-uppercase fw-normal mb-2">Features</p>
                    <h3 class="mb-3">Key features of the product</h3>
                    <div class="title-icon position-relative">
                        <div class="position-relative">
                            <i class="uim uim-arrow-circle-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row align-items-center">
            <div class="col-lg-5 order-lg-1 order-2">
                <div class="mt-lg-0 mt-4">
                    <h4>Improve your Marketing business</h4>
                    <p class="text-muted mt-3">If several languages coalesce, the grammar of the resulting language is
                        more regular.</p>

                    <div>
                        <p class="text-muted mb-2">
                            <span class="uim-icon-info mr-2 align-middle"><i
                                    class="uim uim-check-circle"></i></span>Donec vitae sapien ut
                        </p>
                        <p class="text-muted mb-2">
                            <span class="uim-icon-info mr-2 align-middle"><i class="uim uim-check-circle"></i></span>In
                            enim justo, rhoncus imperdiet
                        </p>
                        <p class="text-muted">
                            <span class="uim-icon-info mr-2 align-middle"><i
                                    class="uim uim-check-circle"></i></span>Maecenas nec odio et
                        </p>
                    </div>
                    <div class="mt-4">
                        <a class="text-primary" href="#">Learn more..</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ml-lg-auto col-sm-8 order-lg-2 order-1">
                <div>
                    <img class="img-fluid d-block mx-auto" src="{{ asset('assets/web/images/features/img-1.jpg') }}"
                        alt="" />
                </div>
            </div>
        </div>
        <!-- end row -->

        <hr class="my-5" />

        <div class="row align-items-center">
            <div class="col-lg-6 col-sm-8">
                <div class="features-img mt-4">
                    <img class="img-fluid d-block img-thumbnail mx-auto"
                        src="{{ asset('assets/web/images/features/img-2.jpg') }}" alt="" />
                </div>
            </div>

            <div class="col-lg-5 ml-lg-auto">
                <div class="mt-lg-4 mt-5">
                    <h4>Improve your Marketing performance</h4>
                    <p class="text-muted mb-2 mt-3">It will be as simple as in fact, it will be Occidental. To an
                        English person, it will seem like simplified</p>
                    <p class="text-muted">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur
                        velit</p>
                    <div class="mt-4">
                        <a class="text-primary" href="#">Learn more..</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- End Features Section -->

<!-- Clients Section -->
<section class="section mt-5" id="clients" data-aos="fade-up">
    <div class="container">
        <div class="row align-items-center pb-5">
            <div class="col-lg-4 col-md-4">
                <div class="icons-lg mb-4">
                    <i class="uim uim-comment-message"></i>
                </div>
                <h3 class="mb-2">2,200<sup>+</sup></h3>
                <h3 class="mb-4">Satisfied Clients</h3>
                <p class="text-muted mb-sm-0 pb-sm-0 mb-5 pb-4">If several languages coalesce, the grammar of the
                    resulting language is more simple and regular than that of the individual</p>
            </div>

            <div class="col-lg-8 col-md-8">
                <div class="client-slider">
                    <div>
                        <div class="bg-light rounded p-4">
                            <p class="text-muted mb-4">" It will be as simple as Occidental; in fact, it will be
                                Occidental. To an English person, it will seem like simplified, If several languages of
                                the resulting language"</p>
                            <div class="pt-3">
                                <div class="d-inline-block">
                                    <h5 class="font-16 mb-1">James Vazquez</h5>
                                    <span class="text-muted">- Peyso User</span>
                                </div>
                                <div class="text-muted d-inline-block float-right">
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-light rounded p-4">
                            <p class="text-muted mb-4">" To achieve this, it would be necessary to have uniform grammar,
                                pronunciation and more common words. If several languages of the resulting language."
                            </p>

                            <div class="pt-3">
                                <div class="d-inline-block">
                                    <h5 class="font-16 mb-1">Clara Searcy</h5>
                                    <span class="text-muted">- Peyso User</span>
                                </div>
                                <div class="text-muted d-inline-block float-right">
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-light rounded p-4">
                            <p class="text-muted mb-4">
                                " If several It will be as simple as Occidental; it will be Occidental. To an English
                                person, it will seem like simplified, If several languages of the resulting language "
                            </p>
                            <div class="pt-3">
                                <div class="d-inline-block">
                                    <h5 class="font-16 mb-1">Alfredo Williams</h5>
                                    <span class="text-muted">- Peyso User</span>
                                </div>
                                <div class="text-muted d-inline-block float-right">
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <!-- start brand logo -->
        <div class="row mt-5">
            <div class="col-lg-3 col-sm-3">
                <div class="client-images">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('assets/web/images/clients/1.png') }}"
                        alt="client-img" />
                </div>
            </div>
            <div class="col-lg-3 col-sm-3">
                <div class="client-images">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('assets/web/images/clients/3.png') }}"
                        alt="client-img" />
                </div>
            </div>
            <div class="col-lg-3 col-sm-3">
                <div class="client-images">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('assets/web/images/clients/4.png') }}"
                        alt="client-img" />
                </div>
            </div>
            <div class="col-lg-3 col-sm-3">
                <div class="client-images">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('assets/web/images/clients/6.png') }}"
                        alt="client-img" />
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- End Clients Section -->

<!-- CTA Section -->
<section class="bg-primary py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-9">
                <div class="text-white-50">
                    <h3 class="text-white">Build your dream website today</h3>
                    <p class="fs-6 mb-0">If several languages coalesce, the grammar of the resulting</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mt-md-0 text-md-right mt-4">
                    <a class="btn btn-info" href="#">Get Started</a>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- End CTA Section -->

<!-- Pricing Section -->
<section class="section bg-light" id="pricing" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="title mb-5 text-center">
                    <p class="text-muted text-uppercase fw-normal mb-2">Plan</p>
                    <h3 class="mb-3">Our Pricing</h3>
                    <div class="title-icon position-relative">
                        <div class="position-relative">
                            <i class="uim uim-arrow-circle-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row pb-4">
            <div class="col-lg-4 col-md-6">
                <div class="card plan-box p-2 text-center">
                    <div class="card-body">
                        <div class="icons-xl pt-4">
                            <i class="uim uim-box"></i>
                        </div>
                        <h4 class="mt-4">Economy</h4>

                        <div class="plan-features text-muted mt-5">
                            <p>Storage : <span class="text-info fw-semibold">10 GB</span></p>
                            <p>Bandwidth : <span class="text-info fw-semibold">500 GB</span></p>
                            <p>Domain : <span class="text-info fw-semibold">No</span></p>
                            <p>Support : <span class="text-info fw-semibold">No</span></p>
                        </div>

                        <div class="mt-5">
                            <h3>
                                <sup><small>$</small></sup>19 / <span class="font-16 text-muted">Month</span>
                            </h3>
                            <div class="mt-4 mb-4">
                                <a class="btn btn-info btn-block" href="#">Join now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card plan-box p-2 text-center">
                    <div class="card-body">
                        <div>
                            <div class="icons-xl pt-4">
                                <i class="uim uim-rocket"></i>
                            </div>
                            <h4 class="mt-4">Premium</h4>

                            <div class="plan-features text-muted mt-5">
                                <p>Storage : <span class="text-info fw-semibold">20 GB</span></p>
                                <p>Bandwidth : <span class="text-info fw-semibold">800 GB</span></p>
                                <p>Domain : <span class="text-info fw-semibold">Yes</span></p>
                                <p>Support : <span class="text-info fw-semibold">Yes</span></p>
                            </div>

                            <div class="mt-5">
                                <h3>
                                    <sup><small>$</small></sup>29 / <span class="font-16 text-muted">Month</span>
                                </h3>
                                <div class="mt-4 mb-4">
                                    <a class="btn btn-info btn-block" href="#">Join now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card plan-box p-2 text-center">
                    <div class="card-body">
                        <div>
                            <div class="icons-xl pt-4">
                                <i class="uim uim-user-md"></i>
                            </div>
                            <h4 class="mt-4">Developer</h4>

                            <div class="plan-features text-muted mt-5">
                                <p>Storage : <span class="text-info fw-semibold">30 GB</span></p>
                                <p>Bandwidth : <span class="text-info fw-semibold">Unlimited</span></p>
                                <p>Domain : <span class="text-info fw-semibold">Yes</span></p>
                                <p>Support : <span class="text-info fw-semibold">Yes</span></p>
                            </div>

                            <div class="mt-5">
                                <h3>
                                    <sup><small>$</small></sup>39 / <span class="font-16 text-muted">Month</span>
                                </h3>
                                <div class="mt-4 mb-4">
                                    <a class="btn btn-info btn-block" href="#">Join now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end plans row -->

        <!-- start faq -->
        <div class="row pb-4">
            <div class="col-lg-6 col-md-6">
                <div class="d-flex mt-5">
                    <div class="mr-3">
                        <div class="avatar-title rounded-circle bg-soft-primary avatar-md text-primary">
                            <i class="fa-solid fa-question"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="font-18 mt-1">What is Lorem Ipsum ?</h5>
                        <p class="text-muted">If several languages coalesce, the grammar of the resulting language is
                            more simple and regular than that of the individual</p>
                    </div>
                </div>

                <div class="d-flex mt-4">
                    <div class="mr-3">
                        <div class="avatar-title rounded-circle bg-soft-primary avatar-md text-primary">
                            <i class="fa-solid fa-question"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="font-18 mt-1">Why do we use it ?</h5>
                        <p class="text-muted">For science, music, sport, etc, Europe uses the same vocabulary. The
                            languages only differ in their grammar, their pronunciation and their most common words.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="mt-sm-5 d-flex mt-4">
                    <div class="mr-3">
                        <div class="avatar-title rounded-circle bg-soft-primary avatar-md text-primary">
                            <i class="fa-solid fa-question"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="font-18 mt-1">Where does it come from ?</h5>
                        <p class="text-muted">To achieve this, it would be necessary to have uniform grammar,
                            pronunciation and more common words.</p>
                    </div>
                </div>

                <div class="d-flex mt-4">
                    <div class="mr-3">
                        <div class="avatar-title rounded-circle bg-soft-primary avatar-md text-primary">
                            <i class="fa-solid fa-question"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="font-18 mt-1">Where can I get some ?</h5>
                        <p class="text-muted">It will be as simple as in fact, it will be Occidental. To it will seem
                            like simplified English as a skeptical</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end faq row -->
    </div>
    <!-- end container -->
</section>
<!-- End Pricing Section -->

<!-- Contact Section -->
<section class="section" id="contact" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="title mb-5 text-center">
                    <p class="text-muted text-uppercase fw-normal mb-2">Contact</p>
                    <h3 class="mb-3">Have any Questions ?</h3>
                    <div class="title-icon position-relative">
                        <div class="position-relative">
                            <i class="uim uim-arrow-circle-down"></i>
                        </div>
                    </div>
                </div>

                <form name="myForm" href="javascript: void(0);" method="post" onsubmit="return validateForm()">
                    <p id="error-msg"></p>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control" id="name" name="name" type="text"
                                    placeholder="Enter your name..." />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email address</label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter your email..." />
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="mb-3">
                        <label class="form-label" for="subject">Subject</label>
                        <input class="form-control" id="subject" name="subject" type="text"
                            placeholder="Enter Subject..." />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="comments">Message</label>
                        <textarea class="form-control" id="comments" name="comments" rows="3"
                            placeholder="Enter your message..."></textarea>
                    </div>

                    <div class="text-right">
                        <input class="submitBnt btn btn-primary" id="submit" name="send" type="submit"
                            value="Send message" />

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Section -->

<!-- Footer Section -->
<footer class="footer bg-dark text-white-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <a class="d-block mb-3" href="#">
                    <img src="{{ asset('assets/web/images/logo-light.png') }}" alt="" height="20" />
                </a>
                <p>Bootstrap 5 Landing Page Template</p>
            </div>

            <div class="col-lg-2 col-sm-6">
                <div class="mt-lg-0 mt-4">
                    <h5 class="font-18 mb-4 text-white">Links</h5>
                    <ul class="list-unstyled footer-list-menu">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Contact us</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="mt-lg-0 mt-4">
                    <h5 class="font-18 mb-4 text-white">Resources</h5>
                    <ul class="list-unstyled footer-list-menu">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="mt-lg-0 mt-4">
                    <h5 class="font-18 mb-4 text-white">Social</h5>
                    <ul class="list-inline social-icons-list">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</footer>
<!-- End Footer Section -->

<!-- Footer-alt Section -->
<section class="footer-alt py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-white-50 text-center">
                    <p class="mb-0">2020 © Peyso. Create by Themesdesign</p>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- End Footer-alt Section -->
@endsection