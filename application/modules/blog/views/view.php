<?php
/**
 * Variables injected by CodeIgniter's view loader (from controller $data array
 * merged with $this->comp global template vars).
 *
 * @var array        $query        Blog post result rows
 * @var string       $facebookhtml Facebook URL
 * @var string       $twitterhtml  Twitter/X URL
 * @var string       $instagramhtml Instagram URL
 * @var string       $youtubehtml  YouTube URL
 */
$post   = isset($query[0]) ? $query[0] : null;
$title  = $post ? htmlspecialchars($post->title) : 'Blog Post';
$img    = ($post && $post->image && file_exists(FCPATH . 'assets/uploads/blog/' . $post->image))
            ? base_url('assets/uploads/blog/' . $post->image)
            : base_url('assets/img/blog/bs-3.jpg');
?>
<main class="main">

    <!-- Page Banner -->
    <div class="page-banner overlay">
      <picture class="media media-bg">
        <img src="<?= base_url() ?>assets/images/banner/page-banner.jpg" width="1920" height="620" loading="lazy" alt="Blog Banner">
      </picture>
      <div class="page-banner-content">
        <div class="container text-center">
          <h1 class="heading text-60 fw-700" data-aos="fade-up"><?= htmlspecialchars($title) ?></h1>
          <ul class="breadcrumb list-unstyled" data-aos="fade-up" data-aos-delay="100">
            <li><a href="<?= site_url() ?>" class="text text-18 no-underline">Home</a></li>
            <li><div class="svg-wrapper icon-12"><svg viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.08929 5.40903C7.24552 5.5653 7.33328 5.77723 7.33328 5.9982C7.33328 6.21917 7.24552 6.43109 7.08929 6.58736L2.37512 11.3015C2.29825 11.3811 2.2063 11.4446 2.10463 11.4883C2.00296 11.532 1.89361 11.5549 1.78296 11.5559C1.67231 11.5569 1.56258 11.5358 1.46016 11.4939C1.35775 11.452 1.2647 11.3901 1.18646 11.3119C1.10822 11.2336 1.04634 11.1406 1.00444 11.0382C0.962537 10.9357 0.941453 10.826 0.942414 10.7154C0.943376 10.6047 0.966364 10.4954 1.01004 10.3937C1.05371 10.292 1.1172 10.2001 1.19679 10.1232L5.32179 5.9982L1.19679 1.8732C1.04499 1.71603 0.960996 1.50553 0.962894 1.28703C0.964793 1.06853 1.05243 0.859522 1.20694 0.705015C1.36145 0.550508 1.57046 0.462868 1.78896 0.460969C2.00745 0.45907 2.21795 0.543066 2.37512 0.694864L7.08929 5.40903Z" fill="currentColor"/></svg></div></li>
            <li><a href="<?= site_url('blog') ?>" class="text text-18 no-underline">Blog</a></li>
            <li><div class="svg-wrapper icon-12"><svg viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.08929 5.40903C7.24552 5.5653 7.33328 5.77723 7.33328 5.9982C7.33328 6.21917 7.24552 6.43109 7.08929 6.58736L2.37512 11.3015C2.29825 11.3811 2.2063 11.4446 2.10463 11.4883C2.00296 11.532 1.89361 11.5549 1.78296 11.5559C1.67231 11.5569 1.56258 11.5358 1.46016 11.4939C1.35775 11.452 1.2647 11.3901 1.18646 11.3119C1.10822 11.2336 1.04634 11.1406 1.00444 11.0382C0.962537 10.9357 0.941453 10.826 0.942414 10.7154C0.943376 10.6047 0.966364 10.4954 1.01004 10.3937C1.05371 10.292 1.1172 10.2001 1.19679 10.1232L5.32179 5.9982L1.19679 1.8732C1.04499 1.71603 0.960996 1.50553 0.962894 1.28703C0.964793 1.06853 1.05243 0.859522 1.20694 0.705015C1.36145 0.550508 1.57046 0.462868 1.78896 0.460969C2.00745 0.45907 2.21795 0.543066 2.37512 0.694864L7.08929 5.40903Z" fill="currentColor"/></svg></div></li>
            <li><span class="text text-18 no-underline active"><?= htmlspecialchars($title) ?></span></li>
          </ul>
        </div>
      </div>
    </div>
    </div>

    <!-- Blog Single -->
    <div class="blog-single">
        <div class="container">
            <div class="row g-4">

                <!-- Main article -->
                <div class="col-lg-8">
                    <div class="blog-single-wrap" data-aos="fade-up">

                        <div class="blog-thumb-img">
                            <img src="<?= $img ?>" alt="<?= $title ?>" loading="lazy">
                        </div>

                        <div class="blog-info">
                            <div class="blog-meta">
                                <div class="blog-meta-left">
                                    <ul>
                                        <li><i class="fa-solid fa-calendar-days"></i><?= $post ? htmlspecialchars($post->date ?? '') : '' ?></li>
                                        <li><i class="far fa-eye"></i><?= $post ? (int)$post->views : 0 ?> Views</li>
                                        <li><i class="far fa-user-circle"></i>By Tripjyada</li>
                                    </ul>
                                </div>
                                <div class="blog-meta-right">
                                    <a href="javascript:void(0);" class="share-link" data-bs-toggle="modal" data-bs-target="#shareModal">
                                        <i class="far fa-share-alt"></i> Share
                                    </a>
                                </div>
                            </div>

                            <div class="blog-details">
                                <h2 class="blog-details-title"><?= $title ?></h2>
                                <div class="blog-desc">
                                    <?= $post ? $post->description : '' ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4" data-aos="fade-up">
                    <aside class="blog-sidebar">

                        <!-- Recent posts -->
                        <div class="widget recent-post">
                            <h5 class="widget-title">Recent Posts</h5>
                            <?php
                            $this->db->select('b_id, title, image, date');
                            $this->db->order_by('b_id', 'DESC');
                            $this->db->limit(5);
                            $recent = $this->db->get('blog')->result_array();
                            foreach ($recent as $rp):
                                $rImg = (!empty($rp['image']) && file_exists(FCPATH . 'assets/uploads/blog/' . $rp['image']))
                                    ? base_url('assets/uploads/blog/' . $rp['image'])
                                    : base_url('assets/img/blog/bs-3.jpg');
                                $rTitle = rtrim(str_replace("--", "-", urlencode(str_replace(" ", "-", str_replace(",", " ", $rp['title'])))), "-");
                                $rLink  = strtolower(site_url('blog/read/' . $rTitle . '/' . $rp['b_id']));
                            ?>
                            <div class="recent-post-item">
                                <div class="recent-post-img">
                                    <img src="<?= $rImg ?>" alt="<?= htmlspecialchars($rp['title']) ?>" loading="lazy">
                                </div>
                                <div class="recent-post-info">
                                    <h6><a href="<?= $rLink ?>"><?= htmlspecialchars($rp['title']) ?></a></h6>
                                    <span><i class="far fa-clock"></i> <?= htmlspecialchars($rp['date'] ?? '') ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Follow us -->
                        <div class="widget social">
                            <h5 class="widget-title">Follow Us</h5>
                            <div class="social-link">
                                <a href="<?= $facebookhtml ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="<?= $instagramhtml ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="<?= $youtubehtml ?>" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                                <a href="<?= $twitterhtml ?>" target="_blank" rel="noopener" aria-label="X / Twitter"><i class="fab fa-x-twitter"></i></a>
                            </div>
                        </div>

                    </aside>
                </div>

            </div>
        </div>
    </div>

</main>

<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Share this post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="social-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=PAGE_URL" target="_blank" rel="noopener" class="btn btn-primary w-100">
                        <i class="fab fa-facebook-f me-2"></i>Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=PAGE_URL" target="_blank" rel="noopener" class="btn btn-info w-100 text-white">
                        <i class="fab fa-x-twitter me-2"></i>Twitter / X
                    </a>
                    <a href="https://api.whatsapp.com/send?text=PAGE_URL" target="_blank" rel="noopener" class="btn btn-success w-100">
                        <i class="fab fa-whatsapp me-2"></i>WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    var url = encodeURIComponent(window.location.href);
    document.querySelectorAll('#shareModal .social-buttons a').forEach(function (a) {
        a.href = a.href.replace('PAGE_URL', url);
    });
})();
</script>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": "<?= addslashes($title) ?>",
    "image": "<?= $img ?>",
    "datePublished": "<?= $post ? htmlspecialchars($post->date ?? '') : '' ?>",
    "dateModified": "<?= $post ? htmlspecialchars($post->timestamp ?? '') : '' ?>",
    "author": { "@type": "Person", "name": "Tripjyada" },
    "publisher": {
        "@type": "Organization",
        "name": "Tripjyada",
        "logo": { "@type": "ImageObject", "url": "<?= base_url('assets/img/logo/logo.png') ?>" }
    },
    "description": "<?= $post ? addslashes(substr(strip_tags($post->description), 0, 160)) : '' ?>",
    "mainEntityOfPage": { "@type": "WebPage", "@id": "<?= current_url() ?>" }
}
</script>
