<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bienvenido a GymSystem</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  {{-- Icon --}}
  <link rel="icon" href="{{ asset("assets/icon/GymSystem.png") }}">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset("assets/arsha/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
  <link href="{{ asset("assets/arsha/vendor/icofont/icofont.min.css") }}" rel="stylesheet">
  <link href="{{ asset("assets/arsha/vendor/boxicons/css/boxicons.min.css") }}" rel="stylesheet">
  <link href="{{ asset("assets/arsha/vendor/remixicon/remixicon.css") }}" rel="stylesheet">
  <link href="{{ asset("assets/arsha/vendor/venobox/venobox.css") }}" rel="stylesheet">
  <link href="{{ asset("assets/arsha/vendor/owl.carousel/assets/owl.carousel.min.css") }}" rel="stylesheet">
  <link href="{{ asset("assets/arsha/vendor/aos/aos.css") }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset("assets/arsha/css/style.css") }}" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("assets/admin-lte/plugins/fontawesome-free/css/all.min.css") }}">

  <!-- =======================================================
  * Template Name: Arsha - v2.2.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="#">GymSystem</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.html">Home</a></li>
          <li><a href="#about">Nosotros</a></li>
          <li><a href="#services">Servicios</a></li>
          <li><a href="#portfolio">Echa un vistazo</a></li>
          <li><a href="#contact">Contacto</a></li>

        </ul>
      </nav><!-- .nav-menu -->
      <a href="{{ route('register') }}" class="get-started-btn">Registrarse</a>
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
          data-aos="fade-up" data-aos-delay="200">
          <h1>Bienvenido a GymSystem</h1>
          <h2>Un sistema donde podrás administrar tu gimnasio de la mejor manera</h2>
          <div class="d-lg-flex">
            @if (Route::has('login'))
            @auth
            @if (Auth::user()->can('usuarios.index'))
            <a href="{{ route('usuarios.panel') }}" class="get-started-btn">Panel</a>
            @else
            <a href="{{ route('gimnasios.administrar') }}" class="get-started-btn">Ingresar</a>
            @endif
            @else
            <a href="{{ route('login') }}" class="get-started-btn">Iniciar sesión</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="get-started-btn">Registrarse</a>
            @endif
            @endauth
            @endif
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Acerca de nosotros</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
              Somos un equipo cuyo objetivo es brindarte las mejores soluciones a tus problemas
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Soporte técnico en todo momento</li>
              <li><i class="ri-check-double-line"></i> Soluciones inmediatas a cada problema</li>
              <li><i class="ri-check-double-line"></i> Funcionalidades innovadoras para mejorar tu productividad</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              Vimos la necesidad que tienen las personas como vos para poder administrar de una mejor manera sus
              gimnasios, y por ello desarrollamos GymSystem.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Servicios</h2>
          <p>GymSystem te brinda millones de funcionalidades orientadas a la administración de tus gimnasios y clientes.
            Además, vas a poder controlar los pagos de sus cuotas y tener un contacto constante con ellos.</p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-dumbbell"></i></div>
              <h4><a href="">Administra tus gimnasios</a></h4>
              <p>Agrega, modifica y controla todo lo relacionado con tu gimnasio</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
            data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-users"></i></div>
              <h4><a href="">Administra tus clientes</a></h4>
              <p>Agrega y controla todo lo relacionado con tus clientes</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
            data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-chart-area"></i></div>
              <h4><a href="">Gráficos</a></h4>
              <p>Vé gráficos relacionados con el acceso de tus clientes a tus gimnasios y a sus especialidades</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
            data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-cash-register"></i></div>
              <h4><a href="">Controla las cuotas</a></h4>
              <p>Controla los pagos de tus clientes y obtiene resúmenes de tus ganancias</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content">
              <h3><strong>¿Cómo acceder a nuestros servicios?</strong></h3>
              <p>
                Hacer uso de todas las funcionalidades de GymSystem es tan fácil como:
              </p>
            </div>

            <div class="accordion-list">
              <ul>
                <li>
                  <a data-toggle="collapse" class="collapse" href="#accordion-list-1"><span>01</span> Registrate <i
                      class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-1" class="collapse show" data-parent=".accordion-list">
                    <p>
                      Registrate en el sitio para formar parte de nuestra comunidad.
                    </p>
                  </div>
                </li>

                <li>
                  <a data-toggle="collapse" href="#accordion-list-2" class="collapsed"><span>02</span> Selecciona un
                    método de pago <i class="bx bx-chevron-down icon-show"></i><i
                      class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-2" class="collapse" data-parent=".accordion-list">
                    <p>
                      Selecciona un método de pago y adquirí nuestros servicios mensualemente. También ofrecemos códigos
                      de descuento a los que podes acceder contactándote con nosotros previamente.
                    </p>
                  </div>
                </li>

                <li>
                  <a data-toggle="collapse" href="#accordion-list-3" class="collapsed"><span>03</span> Listo, a
                    disfrutar <i class="bx bx-chevron-down icon-show"></i><i
                      class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-3" class="collapse" data-parent=".accordion-list">
                    <p>
                      Agregá tus gimnasios y comenzá a administrarlos con GymSystem.
                    </p>
                  </div>
                </li>

              </ul>
            </div>

          </div>

          <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
            style='background-image: url("assets/img/why-us.png");' data-aos="zoom-in" data-aos-delay="150"></div>
        </div>

      </div>
    </section><!-- End Why Us Section -->


    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Echa un vistazo</h2>
          <p>Echa un vistazo a todos los servicios que GymSystem tiene para vos</p>
        </div>



        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">


          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 2</h4>
              <p>Card</p>
              <a href="assets/img/portfolio/portfolio-4.jpg" data-gall="portfolioGallery" class="venobox preview-link"
                title="Card 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>


          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 1</h4>
              <p>Card</p>
              <a href="assets/img/portfolio/portfolio-7.jpg" data-gall="portfolioGallery" class="venobox preview-link"
                title="Card 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 3</h4>
              <p>Card</p>
              <a href="assets/img/portfolio/portfolio-8.jpg" data-gall="portfolioGallery" class="venobox preview-link"
                title="Card 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>


        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Precios</h2>
          <p>Estos son los precios mensuales de nuestros servicios. También ofrecemos códigos de descuentos para vos</p>
        </div>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="box featured">
              <h3>Plan básico</h3>
              <h4><sup>$</sup>1000<span>por mes</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> Administración de gimnasios</li>
                <li><i class="bx bx-check"></i> Administración de clientes</li>
                <li><i class="bx bx-check"></i> Administración de cuotas de clientes</li>
                <li><i class="bx bx-check"></i> Contacto con los clientes vía WhatsApp y correo</li>
                <li><i class="bx bx-check"></i> Reportes parametrizados para cada gimnasio</li>
                <li><i class="bx bx-check"></i> Gráficos para cada gimnasio</li>
              </ul>
              <center>
                <a href="{{ route('register') }}" class="buy-btn">¡Lo quiero!</a>
              </center>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">

          </div>

        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contacto</h2>
          <p>Estamos a tu disposición, asi que ante cualquier duda contactate con nosotros para mayor información y una
            atención especializada.</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Ubicación:</h4>
                <p>Oberá, Misiones, Argentina</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>gymsystemcorreos@gmail.com</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Teléfono:</h4>
                <p>3755 264077</p>
              </div>

              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56630.982921397845!2d-55.15893001367969!3d-27.4867993746876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f8f54706b1b501%3A0x2a4796c88edb4c9!2sOber%C3%A1%2C%20Misiones!5e0!3m2!1ses!2sar!4v1596296753913!5m2!1ses!2sar"
                frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>


          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Tu Nombre</label>
                  <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4"
                    data-msg="Su nombre debe tener como mínimo 4 caracteres" />
                  <div class="validate"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Tu Email</label>
                  <input type="email" class="form-control" name="email" id="email" data-rule="email"
                    data-msg="Ingrese un email válido" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Asunto</label>
                <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:6"
                  data-msg="El asunto debe tener como mínimo 6 caracteres" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <label for="name">Mensaje</label>
                <textarea class="form-control" name="message" rows="10" data-rule="required"
                  data-msg="El campo mensaje no puede quedar vacío"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Cargando</div>
                <div class="error-message">Hubo un error al enviar el email</div>
                <div class="sent-message">Tu mensaje ha sido enviado, te responderemos pronto!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>GymSystem</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        </a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset("assets/arsha/vendor/jquery/jquery.min.js") }}"></script>
  <script src="{{ asset("assets/arsha/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
  <script src="{{ asset("assets/arsha/vendor/jquery.easing/jquery.easing.min.js") }}"></script>
  <script src="{{ asset("assets/arsha/vendor/php-email-form/validate.js") }}"></script>
  <script src="{{ asset("assets/arsha/vendor/waypoints/jquery.waypoints.min.js") }}"></script>
  <script src="{{ asset("assets/arsha/vendor/isotope-layout/isotope.pkgd.min.js") }}"></script>
  <script src="{{ asset("assets/arsha/vendor/venobox/venobox.min.js") }}"></script>
  <script src="{{ asset("assets/arsha/vendor/owl.carousel/owl.carousel.min.js") }}"></script>
  <script src="{{ asset("assets/arsha/vendor/aos/aos.js") }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset("assets/arsha/js/main.js") }}"></script>

  @include('theme.admin-lte.scripts')
</body>

</html>