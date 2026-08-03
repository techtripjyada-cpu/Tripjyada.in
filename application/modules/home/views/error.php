<main class="main">
  <div class="page-banner overlay">
    <picture class="media media-bg">
      <img src="<?= base_url() ?>assets/images/banner/page-banner.jpg" width="1920" height="620" loading="lazy" alt="404 Error Banner">
    </picture>
    <div class="page-banner-content">
      <div class="container text-center">
        <h1 class="heading text-60 fw-700" data-aos="fade-up">404 Error</h1>
        <ul class="breadcrumb list-unstyled" data-aos="fade-up" data-aos-delay="100">
          <li><a href="<?= site_url() ?>" class="text text-18 no-underline">Home</a></li>
          <li><div class="svg-wrapper icon-12"><svg viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.08929 5.40903C7.24552 5.5653 7.33328 5.77723 7.33328 5.9982C7.33328 6.21917 7.24552 6.43109 7.08929 6.58736L2.37512 11.3015C2.29825 11.3811 2.2063 11.4446 2.10463 11.4883C2.00296 11.532 1.89361 11.5549 1.78296 11.5559C1.67231 11.5569 1.56258 11.5358 1.46016 11.4939C1.35775 11.452 1.2647 11.3901 1.18646 11.3119C1.10822 11.2336 1.04634 11.1406 1.00444 11.0382C0.962537 10.9357 0.941453 10.826 0.942414 10.7154C0.943376 10.6047 0.966364 10.4954 1.01004 10.3937C1.05371 10.292 1.1172 10.2001 1.19679 10.1232L5.32179 5.9982L1.19679 1.8732C1.04499 1.71603 0.960996 1.50553 0.962894 1.28703C0.964793 1.06853 1.05243 0.859522 1.20694 0.705015C1.36145 0.550508 1.57046 0.462868 1.78896 0.460969C2.00745 0.45907 2.21795 0.543066 2.37512 0.694864L7.08929 5.40903Z" fill="currentColor"/></svg></div></li>
          <li><span class="text text-18 no-underline active">404 Error</span></li>
        </ul>
      </div>
    </div>
  </div>
  <section class="error_section text-center mouse_move mt-3">
    <div class="container">
      <div class="error_image decoration_wrap text-center">
        <img src="<?= base_url("assets/img/error/404.png") ?>" alt="404 Error" loading="lazy">
      </div>
      <div class="error_content">
        <h2>Page not found</h2>
        <p>
          The requested URL does not exist on this server;<span class="d-md-block"> Please verify the web address and contact the administrator if you believe it's an error. </span>
        </p>
        <a href="<?= site_url() ?>" class="bd-btn-link btn_primary">
          <span class="bd-button-content-wrapper">
            <span class="bd-button-icon">
              <i class="fa-light fa-arrow-right-long"></i>
            </span>
            <span class="pd-animation-flip">
              <span class="bd-btn-anim-wrapp">
                <a href="<?= site_url('') ?>" class="theme_button color1">Go Back To Home</a>

              </span>
            </span>
          </span>
        </a>
      </div>
    </div>
  </section>
</main>