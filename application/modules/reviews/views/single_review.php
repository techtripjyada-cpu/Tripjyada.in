<?php
$rev = $reviews->result();
?>
<section id="breadcrumbs" class="page_breadcrumbs ds parallax section_padding_65 table_section table_section_md">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="cornered-heading"><?= mb_strimwidth(@$rev[0]->r_title, 0, 40, "..."); ?>
                </h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= site_url() ?>">Home</a>
                    </li>
                    <li class="active">Complaints & Reviews</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Page Section - End 
================================================== -->


<div class="our-service-page feature-content-section" style="min-height: 50vh; background-image:url('<?= base_url() ?>assets/images/location/location-background.png'); background-size: cover; background-repeat: no-repeat; background-position: center;padding-top:15px;padding-bottom:15px;">
    <div ng-app="reviewsApp" ng-controller="reviewsctrl">
        <?php $this->load->view('reviews/reviewmodal') ?>
        <!-- Review Starts -->
        <br />
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3 mb-4 text-left wow fadeInUp">

                    <button type="button" class="btn float-left btn-xs" style="background:#f4854a;color:white;border:none;width:100%;font-size:100%;font-weight:bold;" data-toggle="modal" data-target="#rvwmdl">Write a Review <i class="fas fa-pen"></i></button>
                </div>
            </div>
            <div class="row">
                <?php
                if ($reviews->num_rows() == 0) {
                    echo "No reviews yet...";
                } else {
                    foreach ($rev as $r) {
                        $pdate = explode(" ", $r->posted_date);
                        $pdate = $pdate[0];
                        $size = explode("@", $r->email);
                        $size = strlen($size[0]) - 4;
                        $lem = substr($r->email, -12);
                        $fem = substr($r->email, 0, 4);
                        $st = '';
                        for ($i = 0; $i < $size; $i++) {
                            $st .= "*";
                        }

                        $em = $fem . $st . $lem;
                ?>
                        <div class="col-md-6 col-lg-6 offset-lg-3 wow fadeInUp">
                            <div class="single-content d-flex" itemprop="review" itemscope itemtype="https://schema.org/Review">
                                <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/LocalBusiness">
                                    <meta itemprop="name" content="<?= $company3 ?>" />
                                </div>
                                <div class="content-text">
                                    <span class="float-left">
                                        <strong itemprop="author" itemscope itemtype="https://schema.org/Person">
                                            <span itemprop="name" style="color:white;background-color:black;padding:5px;border-radius:5px;"><?= $r->name ?></span>
                                        </strong>
                                    </span>
                                    <span style="float: right;">
                                        <span>
                                            <?php for ($i = 0; $i < $r->stars; $i++) { ?>
                                                <i class="text-warning fa fa-star"></i>
                                            <?php } ?>
                                        </span>
                                        <span style="color:black;" class="float-right star-saver blink mr-2">
                                            <b itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                                <span itemprop="ratingValue"><?= $r->stars ?></span> stars
                                            </b>
                                        </span>
                                    </span>
                                    <br>
                                    <h4 style="font-weight: bold;color:black;margin-top: 5px;">
                                        <q itemprop="name"><?= $r->r_title ?></q>
                                    </h4>
                                    <p style="color:black;"><?= mb_strimwidth($r->r_desc, 0, 150, "..."); ?></p>
                                    <p style="color:black;">
                                        <small style="font-weight: bold;color:black"><?= $em ?></small>
                                        <small class="float-right" itemprop="datePublished" content="<?= $pdate ?>" style="color:#fab504"><?= $r->posted_date ?></small>
                                    </p>
                                    <?php if (@$r->r_img) { ?>
                                        <div class="content-icon">
                                            <a target="_blank" href="<?= base_url('assets/uploads/reviewimg/') . $r->r_img ?>" alt="<?= $r->name ?> review <?= $company3 ?>">
                                                <img class="img4 img-fluid" src="<?= base_url('assets/uploads/reviewimg/thumb/') . $r->r_img ?>" alt="<?= $r->name ?> review <?= $company3 ?>" loading="lazy">
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <div style="padding-top: 20px; color:black;">
                                        <b style="font-weight:bold;"> Reply from <?= $company3 ?></b><br>
                                        <?php
                                        if ($r->stars == "5") {
                                            $reply = "Thank you, <b>" . ucfirst($r->name) . "</b>, for your exceptional review. Your valuable feedback is a blessing to our business.";
                                        } else if ($r->stars == "4") {
                                            $reply = "Hello <b>" . ucfirst($r->name) . "</b>, Thank you for giving our business a 4-star review. We appreciate your feedback, and we'll strive to enhance our services to better serve you in the future.";
                                        } else if ($r->stars == "3") {
                                            $reply = "Hi <b>" . ucfirst($r->name) . "</b>, our team is dedicated to improving and aiming for a higher rating from you. We appreciate your valuable review and thank you for taking the time to share your thoughts with us!";
                                        } else if ($r->stars == "2") {
                                            $reply = "Hello <b>" . ucfirst($r->name) . "</b>, your 2-star review challenges us to enhance our services. We value your feedback, and it serves as a valuable guide to identify and address areas for improvement. Thank you, " . $r->name . ".";
                                        } else if ($r->stars == "1") {
                                            $reply = "Apologies, <b>" . ucfirst($r->name) . "</b>, for the unfortunate experience you encountered, resulting in a 1-star rating. We take this matter seriously and will thoroughly investigate to implement appropriate solutions. Please send us your service bill to our support email at $email. Thank you for bringing this to our attention.";
                                        }
                                        ?>
                                        <p style='text-align: right'><?= @$reply ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php }
                } ?>
                <div class="col-lg-6">
                    <?php echo $this->load->view('contacts/quoteform.php') ?>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

<script>
    function showStar(str) {
        window.location.assign("<?= site_url('customer-feedback?star=') ?>" + str);
    }
</script>
