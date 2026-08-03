<?php
$this->load->database();
$schemaData = [];
$query = $this->db->get('blog');
foreach ($query->result() as $b):
    $titleUrlEncoded = rtrim(str_replace("--", "-", urlencode(str_replace(" ", "-", str_replace(",", " ", $b->title)))), "-");
    $link = strtolower(site_url('blog/read/' . $titleUrlEncoded . '/' . $b->b_id));
    $img  = $b->image ? base_url("assets/uploads/blog/{$b->image}") : base_url('assets/img/blog/bs-3.jpg');
    $schemaData[] = [
        "@context"  => "https://schema.org",
        "@type"     => "BlogPosting",
        "headline"  => $b->title,
        "image"     => $img,
        "datePublished" => $b->date,
        "author"    => ["@type" => "Person", "name" => "Tripjyada"],
        "publisher" => [
            "@type" => "Organization",
            "name"  => "Tripjyada",
            "logo"  => ["@type" => "ImageObject", "url" => base_url('assets/img/logo/logo.png')]
        ],
        "description" => implode(' ', array_slice(explode(' ', strip_tags($b->description)), 0, 20)) . '...'
    ];
endforeach;
$posts = $query->result();
?>
<main class="main">

    <!-- Page Banner -->
    <div class="page-banner overlay">
      <picture class="media media-bg">
        <img src="<?= base_url() ?>assets/images/banner/page-banner.jpg" width="1920" height="620" loading="lazy" alt="Blog Banner">
      </picture>
      <div class="page-banner-content">
        <div class="container text-center">
          <h1 class="heading text-60 fw-700" data-aos="fade-up">Our Blog</h1>
          <ul class="breadcrumb list-unstyled" data-aos="fade-up" data-aos-delay="100">
            <li><a href="<?= site_url() ?>" class="text text-18 no-underline">Home</a></li>
            <li>
              <div class="svg-wrapper icon-12">
                <svg viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M7.08929 5.40903C7.24552 5.5653 7.33328 5.77723 7.33328 5.9982C7.33328 6.21917 7.24552 6.43109 7.08929 6.58736L2.37512 11.3015C2.29825 11.3811 2.2063 11.4446 2.10463 11.4883C2.00296 11.532 1.89361 11.5549 1.78296 11.5559C1.67231 11.5569 1.56258 11.5358 1.46016 11.4939C1.35775 11.452 1.2647 11.3901 1.18646 11.3119C1.10822 11.2336 1.04634 11.1406 1.00444 11.0382C0.962537 10.9357 0.941453 10.826 0.942414 10.7154C0.943376 10.6047 0.966364 10.4954 1.01004 10.3937C1.05371 10.292 1.1172 10.2001 1.19679 10.1232L5.32179 5.9982L1.19679 1.8732C1.04499 1.71603 0.960996 1.50553 0.962894 1.28703C0.964793 1.06853 1.05243 0.859522 1.20694 0.705015C1.36145 0.550508 1.57046 0.462868 1.78896 0.460969C2.00745 0.45907 2.21795 0.543066 2.37512 0.694864L7.08929 5.40903Z" fill="currentColor"/>
                </svg>
              </div>
            </li>
            <li><span class="text text-18 no-underline active">Blog</span></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="blog-area py-120">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center" data-aos="fade-up">
                        <span class="site-title-tagline">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                            </svg>
                            Our Blog
                        </span>
                        <h2 class="site-title">Travel Tips &amp; <span>Stories</span></h2>
                        <div class="heading-divider"></div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <?php
                $this->db->get('blog'); // already fetched above; re-run for loop
                $query2 = $this->db->get('blog');
                foreach ($query2->result() as $b):
                    $titleUrlEncoded = rtrim(str_replace("--", "-", urlencode(str_replace(" ", "-", str_replace(",", " ", $b->title)))), "-");
                    $link = strtolower(site_url('blog/read/' . $titleUrlEncoded . '/' . $b->b_id));
                    $img  = $b->image ? base_url("assets/uploads/blog/{$b->image}") : base_url('assets/img/blog/bs-3.jpg');

                    try {
                        $date  = DateTime::createFromFormat('d/m/Y', $b->date);
                        if (!$date) throw new Exception();
                        $day   = $date->format('d');
                        $month = $date->format('M');
                    } catch (Exception $e) {
                        $day = '--'; $month = '--';
                    }

                    $excerpt = implode(' ', array_slice(explode(' ', strip_tags($b->description)), 0, 18)) . '…';
                ?>
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="blog-item">
                        <div class="blog-item-img">
                            <img src="<?= $img ?>" alt="<?= htmlspecialchars($b->title) ?>" loading="lazy">
                            <div class="blog-date">
                                <strong><?= $day ?></strong>
                                <span><?= $month ?></span>
                            </div>
                        </div>
                        <div class="blog-item-info">
                            <div class="blog-item-meta">
                                <ul>
                                    <li><a href="<?= $link ?>"><i class="far fa-user-circle"></i> By Tripjyada</a></li>
                                    <li><a href="<?= $link ?>"><i class="far fa-eye"></i> <?= (int)$b->views ?> Views</a></li>
                                </ul>
                            </div>
                            <h4 class="blog-title"><a href="<?= $link ?>"><?= htmlspecialchars($b->title) ?></a></h4>
                            <p><?= $excerpt ?></p>
                            <a class="theme-btn" href="<?= $link ?>">
                                Read More
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>

</main>

<script type="application/ld+json">
<?= json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
</script>
