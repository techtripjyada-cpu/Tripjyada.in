<main class="main">
    <div class="page-banner overlay">
      <picture class="media media-bg">
        <img src="<?= base_url() ?>assets/images/banner/page-banner.jpg" width="1920" height="620" loading="lazy" alt="Reviews Banner">
      </picture>
      <div class="page-banner-content">
        <div class="container text-center">
          <h1 class="heading text-60 fw-700" data-aos="fade-up">Our Reviews</h1>
          <ul class="breadcrumb list-unstyled" data-aos="fade-up" data-aos-delay="100">
            <li><a href="<?= site_url() ?>" class="text text-18 no-underline">Home</a></li>
            <li><div class="svg-wrapper icon-12"><svg viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.08929 5.40903C7.24552 5.5653 7.33328 5.77723 7.33328 5.9982C7.33328 6.21917 7.24552 6.43109 7.08929 6.58736L2.37512 11.3015C2.29825 11.3811 2.2063 11.4446 2.10463 11.4883C2.00296 11.532 1.89361 11.5549 1.78296 11.5559C1.67231 11.5569 1.56258 11.5358 1.46016 11.4939C1.35775 11.452 1.2647 11.3901 1.18646 11.3119C1.10822 11.2336 1.04634 11.1406 1.00444 11.0382C0.962537 10.9357 0.941453 10.826 0.942414 10.7154C0.943376 10.6047 0.966364 10.4954 1.01004 10.3937C1.05371 10.292 1.1172 10.2001 1.19679 10.1232L5.32179 5.9982L1.19679 1.8732C1.04499 1.71603 0.960996 1.50553 0.962894 1.28703C0.964793 1.06853 1.05243 0.859522 1.20694 0.705015C1.36145 0.550508 1.57046 0.462868 1.78896 0.460969C2.00745 0.45907 2.21795 0.543066 2.37512 0.694864L7.08929 5.40903Z" fill="currentColor"/></svg></div></li>
            <li><span class="text text-18 no-underline active">Reviews</span></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="our-service-page feature-content-section" style="min-height: 50vh; background-image: url('assets/images/location/location-background.png'); background-size: cover; background-repeat: no-repeat; background-position: center; padding-top: 15px; padding-bottom: 15px;">
        <div ng-app="reviewsApp" ng-controller="reviewsctrl">
            <?php $this->load->view('reviews/reviewmodal') ?>
            <br />
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 offset-sm-3 mb-4 text-left fade-in">
                        <button type="button" class="btn write-review-btn" data-bs-toggle="modal" data-bs-target="#rvwmdl">
                            Write a Review <i class="fas fa-pen"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if ($reviews->num_rows() == 0) {
                        echo "<p class='no-reviews-text'>No reviews yet...</p>";
                    } else {
                        foreach ($reviews->result() as $r) {
                            $pdate = explode(" ", $r->posted_date)[0];
                            $size = strlen(explode("@", $r->email)[0]) - 4;
                            $lem = substr($r->email, -12);
                            $fem = substr($r->email, 0, 4);
                            $st = str_repeat("*", $size);
                            $em = $fem . $st . $lem;
                    ?>
                            <div class="col-lg-6 col-md-6 fade-in">
                                <div class="single-review" itemprop="review" itemscope itemtype="https://schema.org/Review">
                                    <meta itemprop="name" content="<?= $r->r_title ?>" />
                                    <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/LocalBusiness">
                                        <meta itemprop="name" content="<?= $company3 ?>" />
                                    </div>
                                    <?php if (@$r->r_img) { ?>
                                        <div class="review-icon">
                                            <img class="review-img" src="<?= base_url('assets/uploads/reviewimg/thumb/') . $r->r_img ?>" alt="<?= $r->name ?> review <?= $company3 ?>" loading="lazy">
                                        </div>
                                    <?php } ?>
                                    <div class="review-content">
                                        <p class="review-author">
                                            By <span class="author-name" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                                <span itemprop="name"><?= $r->name ?></span>
                                            </span>
                                            <span class="review-date" itemprop="datePublished" content="<?= $pdate ?>"> (<?= $r->posted_date ?>)</span>
                                        </p>
                                        <div class="review-rating">
                                            <?php for ($i = 0; $i < $r->stars; $i++) { ?>
                                                <i class="text-warning fa fa-star"></i>
                                            <?php } ?>
                                            <span class="rating-value" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                                <span itemprop="ratingValue"><?= $r->stars ?></span> stars
                                            </span>
                                        </div>
                                        <h4 class="review-title"><q itemprop="name"><?= $r->r_title ?></q></h4>
                                        <p class="review-body" itemprop="reviewBody"><?=$r->r_desc?></p>
                                        <p class="review-email"><small><?= $em ?></small></p>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                    <div class="col-lg-12">
                        <div class="pagination">
                            <?php echo $this->pagination->create_links() ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>

</main>
