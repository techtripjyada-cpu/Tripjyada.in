<main class="main">
  <div class="page-banner overlay">
    <picture class="media media-bg">
      <img src="<?= base_url() ?>assets/images/banner/page-banner.jpg" width="1920" height="620" loading="lazy" alt="Why Choose Us Banner">
    </picture>
    <div class="page-banner-content">
      <div class="container text-center">
        <h1 class="heading text-60 fw-700" data-aos="fade-up">Why Choose Us</h1>
        <ul class="breadcrumb list-unstyled" data-aos="fade-up" data-aos-delay="100">
          <li><a href="<?= site_url() ?>" class="text text-18 no-underline">Home</a></li>
          <li><div class="svg-wrapper icon-12"><svg viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.08929 5.40903C7.24552 5.5653 7.33328 5.77723 7.33328 5.9982C7.33328 6.21917 7.24552 6.43109 7.08929 6.58736L2.37512 11.3015C2.29825 11.3811 2.2063 11.4446 2.10463 11.4883C2.00296 11.532 1.89361 11.5549 1.78296 11.5559C1.67231 11.5569 1.56258 11.5358 1.46016 11.4939C1.35775 11.452 1.2647 11.3901 1.18646 11.3119C1.10822 11.2336 1.04634 11.1406 1.00444 11.0382C0.962537 10.9357 0.941453 10.826 0.942414 10.7154C0.943376 10.6047 0.966364 10.4954 1.01004 10.3937C1.05371 10.292 1.1172 10.2001 1.19679 10.1232L5.32179 5.9982L1.19679 1.8732C1.04499 1.71603 0.960996 1.50553 0.962894 1.28703C0.964793 1.06853 1.05243 0.859522 1.20694 0.705015C1.36145 0.550508 1.57046 0.462868 1.78896 0.460969C2.00745 0.45907 2.21795 0.543066 2.37512 0.694864L7.08929 5.40903Z" fill="currentColor"/></svg></div></li>
          <li><span class="text text-18 no-underline active">Why Choose Us</span></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="about-area py-120">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
            <?php $this->load->view('contacts/quoteform.php') ?>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-right wow fadeInUp" data-wow-delay=".25s">
            <div class="site-heading mb-3">
              <h2 class="site-title">Why Choose <?= $company3 ?>?</h2>
            </div>
            <p class="about-text"><?= $company3 ?> are well-established companies providing packing and moving services in Patna. From our vast years of experience, we cater for our clients' packing and moving services and guarantee the safety of your valued items.
            </p>
            <p class="about-text">Our experienced packers and movers utilize quality packing materials, proper packaging and handling methods and clean and properly equipped vehicles to afford our clients a deserving and smooth move. Whether you are packing and moving to a new house within the same community, or to the next town, we offer timely, efficient and cost-effective services.
            </p>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="about-content">
            <div class="row g-3">
              <div class="col-lg-12">
                <h3>Benefits of Choosing <?= $company3 ?></h3>
              </div>
              <div class="col-md-6">
                <div class="about-item">
                  <div class="icon">
                    <img src="<?= base_url() ?>assets/img/icon/team.svg" alt="" loading="lazy">
                  </div>
                  <div class="content">
                    <h6>Professional Expertise</h6>
                    <p>Our team includes experienced packers and movers who have been in the field for several years now.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="about-item">
                  <div class="icon">
                    <img src="<?= base_url() ?>assets/img/icon/package.svg" alt="" loading="lazy">
                  </div>
                  <div class="content">
                    <h6>High-Quality Packing Materials</h6>
                    <p>It works great when you add your normal packing materials with more durable and secure ones so that your item gets more protection.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="about-item">
                  <div class="icon">
                    <img src="<?= base_url() ?>assets/img/icon/delivery.svg" alt="" loading="lazy">
                  </div>
                  <div class="content">
                    <h6>Timely Delivery</h6>
                    <p>Timely pickups and drops hence giving a comfortable moving experience.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="about-item">
                  <div class="icon">
                    <img src="<?= base_url() ?>assets/img/icon/money.svg" alt="" loading="lazy">
                  </div>
                  <div class="content">
                    <h6>Affordable Pricing</h6>
                    <p>Solutions that are cheap but do not affect the quality of service.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="about-item">
                  <div class="icon">
                    <img src="<?= base_url() ?>assets/img/icon/pickup.svg" alt="" loading="lazy">
                  </div>
                  <div class="content">
                    <h6>Comprehensive Services</h6>
                    <p>All manner of moving services, from packing, loading, transporting and even unpacking.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="about-item">
                  <div class="icon">
                    <img src="<?= base_url() ?>assets/img/icon/certified.svg" alt="" loading="lazy">
                  </div>
                  <div class="content">
                    <h6>Safe Transportation</h6>
                    <p>Clean cars for safe and secure ride to and from:
                      Goods.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>