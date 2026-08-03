<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
// Build label map from DB categories (passed from controller)
$category_label = array();
foreach ($categories as $cat) {
  $s = !empty($cat['slug']) ? $cat['slug'] : ($cat['category_slug'] ?? '');
  $n = !empty($cat['name']) ? $cat['name'] : ucwords(str_replace('-', ' ', $s));
  $category_label[$s] = $n;
}
$wa_base = 'https://wa.me/' . $wa_number . '?text=';
?>

<!-- Hero -->
<div class="page-banner overlay">
  <picture class="media media-bg">
    <img src="<?= base_url() ?>assets/images/banner/page-banner.jpg" width="1920" height="620" loading="lazy"
      alt="Bhutan Tour Packages Banner">
  </picture>
  <div class="page-banner-content">
    <div class="container text-center">
      <h1 class="heading text-60 fw-700" id="heroTitle" data-aos="fade-up"><?= htmlspecialchars($page_title) ?>
      </h1>
      <ul class="breadcrumb list-unstyled" data-aos="fade-up" data-aos-delay="100">
        <li>
          <a href="<?= site_url() ?>" class="text text-18 no-underline" aria-label="Home Page">Home</a>
        </li>
        <li>
          <div class="svg-wrapper icon-12">
            <svg viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M7.08929 5.40903C7.24552 5.5653 7.33328 5.77723 7.33328 5.9982C7.33328 6.21917 7.24552 6.43109 7.08929 6.58736L2.37512 11.3015C2.29825 11.3811 2.2063 11.4446 2.10463 11.4883C2.00296 11.532 1.89361 11.5549 1.78296 11.5559C1.67231 11.5569 1.56258 11.5358 1.46016 11.4939C1.35775 11.452 1.2647 11.3901 1.18646 11.3119C1.10822 11.2336 1.04634 11.1406 1.00444 11.0382C0.962537 10.9357 0.941453 10.826 0.942414 10.7154C0.943376 10.6047 0.966364 10.4954 1.01004 10.3937C1.05371 10.292 1.1172 10.2001 1.19679 10.1232L5.32179 5.9982L1.19679 1.8732C1.04499 1.71603 0.960996 1.50553 0.962894 1.28703C0.964793 1.06853 1.05243 0.859522 1.20694 0.705015C1.36145 0.550508 1.57046 0.462868 1.78896 0.460969C2.00745 0.45907 2.21795 0.543066 2.37512 0.694864L7.08929 5.40903Z"
                fill="currentColor" />
            </svg>
          </div>
        </li>
        <li>
          <a role="link" aria-disabled="true" class="text text-18 no-underline active">Tour Packages</a>
        </li>
      </ul>
    </div>
  </div>
</div>

<?php if (!empty($cardpage_desc) && !empty($cardpage_desc['body'])): ?>
  <div class="cpdesc-section">
    <div class="container">
      <div class="cpdesc-wrap">
        <?php if (!empty($cardpage_desc['heading'])): ?>
          <h2 class="cpdesc-heading"><?= htmlspecialchars($cardpage_desc['heading']) ?></h2>
        <?php endif; ?>
        <div class="cpdesc-body" id="cpDescBody">
          <?= $cardpage_desc['body'] ?>
        </div>
        <button class="cpdesc-more" id="cpDescMore">More <svg width="12" height="12" fill="none" viewBox="0 0 24 24"
            stroke-width="2.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
          </svg></button>
      </div>
    </div>
  </div>
  <script>
    (function() {
      var body = document.getElementById('cpDescBody');
      var btn = document.getElementById('cpDescMore');
      if (!body || !btn) return;
      var fullH = body.scrollHeight;
      body.style.maxHeight = '100px';
      body.style.overflow = 'hidden';
      body.style.transition = 'max-height .35s ease';
      var collapsed = true;
      btn.addEventListener('click', function() {
        if (collapsed) {
          body.style.maxHeight = fullH + 'px';
          btn.innerHTML =
            'Less <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/></svg>';
        } else {
          body.style.maxHeight = '100px';
          btn.innerHTML =
            'More <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>';
        }
        collapsed = !collapsed;
      });
    }());
  </script>
<?php endif; ?>

<div style="margin-bottom: 20px; margin-top: -100px;">
  <?php $this->load->view('home/banner_widget.php') ?>
</div>

<!-- Page body -->
<div class="pkg-page">
  <div class="container">

    <!-- ── Filter Bar ── -->
    <div class="pkg-filterbar">
      <div class="pkg-fb-head">
        <button class="pkg-fb-toggle" id="sbToggle" type="button">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
          </svg>
          Refine Results
          <svg class="sb-chevron" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
          </svg>
        </button>
        <div class="pkg-tb-right">
          <div class="pkg-count">
            Showing <strong id="visibleCount"><?= count($packages) ?></strong>
            of <?= count($packages) ?> packages
          </div>
          <div class="pkg-sort">
            Sort by:
            <select id="sortSelect">
              <option value="default">Default</option>
              <option value="price-asc">Price: Low → High</option>
              <option value="price-desc">Price: High → Low</option>
            </select>
          </div>
        </div>
      </div>

      <div class="pkg-filter-panel" id="sbBody">
        <div class="pfp-inner">

          <!-- Tour Type -->
          <div class="pfp-section">
            <div class="sb-label">Tour Type</div>
            <div class="pfp-cats">
              <button class="sb-cat-btn active" data-cat="">
                All Packages <span class="sb-count"><?= (int)$total_count ?></span>
              </button>
              <?php foreach ($categories as $cat):
                $cat_slug = !empty($cat['slug']) ? $cat['slug'] : ($cat['category_slug'] ?? '');
                $cat_name = !empty($cat['name']) ? $cat['name'] : ucwords(str_replace('-', ' ', $cat_slug));
              ?>
                <button class="sb-cat-btn" data-cat="<?= htmlspecialchars($cat_slug) ?>">
                  <?= htmlspecialchars($cat_name) ?> <span
                    class="sb-count"><?= (int)($cat['pkg_count'] ?? 0) ?></span>
                </button>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Duration -->
          <div class="pfp-section">
            <div class="sb-label">Duration</div>
            <div class="dur-chips">
              <button class="dur-chip active" data-dur="all">All</button>
              <button class="dur-chip" data-dur="short">1–4 Days</button>
              <button class="dur-chip" data-dur="medium">5–7 Days</button>
              <button class="dur-chip" data-dur="long">8+ Days</button>
            </div>
          </div>

          <!-- Budget -->
          <div class="pfp-section">
            <div class="sb-label">Max Budget (₹)</div>
            <div class="price-wrap">
              <input type="range" id="priceRange" min="0" max="200000" step="500" value="200000">
              <div class="price-labels">
                <span>₹0</span>
                <strong id="priceVal">Any</strong>
              </div>
            </div>
          </div>

          <!-- CTA -->
          <div class="pfp-section pfp-cta-section">
            <div class="sb-label">&nbsp;</div>
            <h4>Need Help?</h4>
            <p>Our experts will craft your perfect trip</p>
            <a href="<?= site_url('contacts') ?>">Contact Us</a>
          </div>

        </div>
      </div>
    </div>

    <!-- ── Package Grid ── -->
    <div class="pkg-grid" id="pkgGrid">
      <?php if (empty($packages)): ?>
        <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:#999">
          No packages found. Check back soon!
        </div>
      <?php else: ?>
        <?php foreach ($packages as $pkg):
          $cat_label  = isset($category_label[$pkg['category_slug']]) ? $category_label[$pkg['category_slug']] : ucwords(str_replace('-', ' ', $pkg['category_slug']));
          $highlights = array_slice(array_filter(array_map('trim', explode(',', $pkg['highlights']))), 0, 3);
          $img_src    = !empty($pkg['image'])
            ? base_url('assets/uploads/packages/' . $pkg['image'])
            : (!empty($pkg['default_image'])
              ? base_url('assets/images/product/' . $pkg['default_image'])
              : base_url('assets/images/product/1.jpg'));
          $detail_url = site_url($pkg['category_slug'] . '/' . $pkg['slug']);
          $wa_msg     = $wa_base . urlencode('Hello TripJyada! I am interested in the "' . $pkg['title'] . '" package. Please share details.');
          preg_match('/\d+/', $pkg['days'], $dm);
          $day_num = isset($dm[0]) ? (int)$dm[0] : 0;
          $dur_cls = $day_num === 0 ? 'dur-all' : ($day_num <= 4 ? 'dur-short' : ($day_num <= 7 ? 'dur-medium' : 'dur-long'));
        ?>
          <?php
          $show_price = ($pkg['category_slug'] === 'group-tour') && empty($pkg['price_on_request']);
          $pay_amount = ($show_price && !empty($pkg['price'])) ? (int) preg_replace('/[^\d]/', '', (string) $pkg['price']) : 0;
          ?>
          <div class="pkg-item" data-cat="<?= htmlspecialchars($pkg['category_slug']) ?>"
            data-price="<?= (int)$pkg['price'] ?>" data-dur="<?= $dur_cls ?>">
            <a href="<?= $detail_url ?>" class="ft-card">
              <div class="ft-card-image">
                <img src="<?= htmlspecialchars($img_src) ?>" alt="<?= htmlspecialchars($pkg['title']) ?>"
                  loading="lazy">
                <?php if (!empty($pkg['best_selling'])): ?>
                  <div class="ft-card-badge">&#9733; Best Selling</div>
                <?php endif; ?>
                <span class="pkg-catbdg"><?= htmlspecialchars($cat_label) ?></span>
              </div>
              <div class="ft-card-overlay">
                <h3 class="ft-card-title"><?= htmlspecialchars($pkg['title']) ?></h3>
                <div class="ft-card-meta">
                  <?php if (!empty($pkg['days'])): ?>
                    <span class="ft-duration-badge"><?= htmlspecialchars($pkg['days']) ?></span>
                  <?php endif; ?>
                  <div class="ft-star-rating">
                    <span class="ft-stars">
                      <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                        class="fa-solid fa-star-half-stroke"></i>
                    </span>
                    <span class="ft-rating-text">4.5 &nbsp;<span class="ft-review-count">400+
                        reviews</span></span>
                  </div>
                </div>
                <div class="ft-card-price-row">
                  <div class="ft-price-info">
                    <?php if ($show_price && $pay_amount > 0): ?>
                      <div class="ft-price-main">&#8377;<?= number_format($pay_amount) ?>/-</div>
                    <?php else: ?>
                      <div class="ft-price-main ft-price-req">Price On Request</div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Empty state -->
    <div class="pkg-empty" id="pkgEmpty">
      No packages match your filters.
      <a href="#" id="resetFilters">Reset filters</a>
    </div>

  </div>
</div>

<!-- ── FAQ Accordion ── -->
<div class="pkg-faq-section">
  <div class="container">
    <div class="pkg-faq-hd">
      <h2 class="pkg-faq-title">Frequently Asked Questions</h2>
      <p class="pkg-faq-sub">Everything you need to know before booking your Bhutan trip</p>
    </div>
    <div class="pkg-faq-list" id="pkgFaqList">

      <div class="pkg-faq-item">
        <button class="pkg-faq-q" type="button" aria-expanded="false">
          Do Indians need a visa for Bhutan?
          <svg class="pkg-faq-chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div class="pkg-faq-a">
          <p>No. You can travel on an entry permit — it is not a visa — and a valid passport or voter ID is sufficient. We will organize the permit as part of your package.</p>
        </div>
      </div>

      <div class="pkg-faq-item">
        <button class="pkg-faq-q" type="button" aria-expanded="false">
          How much does a Bhutan tour from India really cost?
          <svg class="pkg-faq-chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div class="pkg-faq-a">
          <p>Depends on how long you stay, which hotels you choose, and the season. The SDF is fixed at INR 1,200 per person per night, and everything else is added on top. Quote us and we will provide you with an exact itemized number.</p>
        </div>
      </div>

      <div class="pkg-faq-item">
        <button class="pkg-faq-q" type="button" aria-expanded="false">
          What is the Sustainable Development Fee?
          <svg class="pkg-faq-chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div class="pkg-faq-a">
          <p>A daily government tax that funds Bhutan's free healthcare, free education, and conservation work. Indians pay INR 1,200 a night, well below the USD 100 foreign rate.</p>
        </div>
      </div>

      <div class="pkg-faq-item">
        <button class="pkg-faq-q" type="button" aria-expanded="false">
          How many days do I actually need?
          <svg class="pkg-faq-chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div class="pkg-faq-a">
          <p>Five days cover Thimphu, Paro, and the Tiger's Nest well. Seven slows the pace and lets you add Punakha. Ten is for those who want to really slow down and see the quieter valleys like Phobjikha.</p>
        </div>
      </div>

      <div class="pkg-faq-item">
        <button class="pkg-faq-q" type="button" aria-expanded="false">
          Can I really customize everything?
          <svg class="pkg-faq-chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div class="pkg-faq-a">
          <p>Yes, that is the whole purpose of our customized Bhutan tour packages. Routes, hotels, pace, activities — all up to you.</p>
        </div>
      </div>

      <div class="pkg-faq-item">
        <button class="pkg-faq-q" type="button" aria-expanded="false">
          Is Bhutan safe for families and solo travelers?
          <svg class="pkg-faq-chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div class="pkg-faq-a">
          <p>As safe as travel gets. Crime is rare, the locals couldn't be nicer, and it works beautifully for families, couples, and people traveling alone.</p>
        </div>
      </div>

    </div>
  </div>
</div>
<script>
(function() {
  var items = [].slice.call(document.querySelectorAll('#pkgFaqList .pkg-faq-item'));
  items.forEach(function(item) {
    var btn = item.querySelector('.pkg-faq-q');
    btn.addEventListener('click', function() {
      var open = item.classList.toggle('open');
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  });
}());
</script>

<script>
  (function() {
    /* ── state ── */
    var activeCat = '<?= addslashes($category_slug) ?>';
    var activeDur = 'all';
    var maxPrice = 200000;

    /* ── elements ── */
    var items = [].slice.call(document.querySelectorAll('.pkg-item'));
    var grid = document.getElementById('pkgGrid');
    var countEl = document.getElementById('visibleCount');
    var emptyEl = document.getElementById('pkgEmpty');
    var heroTitle = document.getElementById('heroTitle');
    var catBtns = [].slice.call(document.querySelectorAll('.sb-cat-btn'));
    var durChips = [].slice.call(document.querySelectorAll('.dur-chip'));
    var priceRng = document.getElementById('priceRange');
    var priceVal = document.getElementById('priceVal');
    var sortSel = document.getElementById('sortSelect');
    var resetBtn = document.getElementById('resetFilters');

    var catTitles = {
      '': 'All Tour Packages'
      <?php foreach ($categories as $cat):
        $ct_slug = !empty($cat['slug']) ? $cat['slug'] : ($cat['category_slug'] ?? '');
        $ct_name = !empty($cat['name']) ? $cat['name'] : ucwords(str_replace('-', ' ', $ct_slug));
        if (!$ct_slug) continue;
      ?>,
        '<?= addslashes($ct_slug) ?>': '<?= addslashes($ct_name) ?> Packages'
      <?php endforeach; ?>
    };

    /* ── core filter function ── */
    function applyFilters() {
      var vis = 0;
      items.forEach(function(el) {
        var cat = el.dataset.cat;
        var price = parseInt(el.dataset.price, 10) || 0;
        var dur = el.dataset.dur;

        var catOk = activeCat === '' || cat === activeCat;
        var durOk = activeDur === 'all' || dur === 'dur-' + activeDur || dur === 'dur-all';
        var priceOk = maxPrice >= 200000 || price <= maxPrice;

        if (catOk && durOk && priceOk) {
          el.classList.remove('pkg-hidden');
          vis++;
        } else {
          el.classList.add('pkg-hidden');
        }
      });

      if (countEl) countEl.textContent = vis;
      if (emptyEl) emptyEl.style.display = vis === 0 ? 'block' : 'none';

      /* update hero title */
      if (heroTitle) heroTitle.textContent = catTitles[activeCat] || 'Tour Packages';

      /* update URL silently (shareable link) */
      var newPath = activeCat ?
        '<?= site_url('tour-package') ?>/' + activeCat :
        '<?= site_url('tour-package') ?>';
      history.replaceState(null, '', newPath);
    }

    /* ── category buttons ── */
    catBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        activeCat = this.dataset.cat;
        catBtns.forEach(function(b) {
          b.classList.remove('active');
        });
        this.classList.add('active');
        applyFilters();
      });
    });

    /* ── duration chips ── */
    durChips.forEach(function(chip) {
      chip.addEventListener('click', function() {
        activeDur = this.dataset.dur;
        durChips.forEach(function(c) {
          c.classList.remove('active');
        });
        this.classList.add('active');
        applyFilters();
      });
    });

    /* ── price slider ── */
    if (priceRng) {
      priceRng.addEventListener('input', function() {
        maxPrice = parseInt(this.value, 10);
        if (priceVal) priceVal.textContent = maxPrice >= 200000 ? 'Any' : '₹' + maxPrice.toLocaleString(
          'en-IN');
        applyFilters();
      });
    }

    /* ── sort ── */
    if (sortSel) {
      sortSel.addEventListener('change', function() {
        var val = this.value;
        var arr = [].slice.call(grid.querySelectorAll('.pkg-item'));
        arr.sort(function(a, b) {
          var pa = parseInt(a.dataset.price, 10) || 0;
          var pb = parseInt(b.dataset.price, 10) || 0;
          if (val === 'price-asc') return pa - pb;
          if (val === 'price-desc') return pb - pa;
          return 0;
        });
        arr.forEach(function(el) {
          grid.appendChild(el);
        });
      });
    }

    /* ── reset ── */
    if (resetBtn) {
      resetBtn.addEventListener('click', function(e) {
        e.preventDefault();
        activeCat = '';
        activeDur = 'all';
        maxPrice = 200000;
        catBtns.forEach(function(b) {
          b.classList.toggle('active', b.dataset.cat === '');
        });
        durChips.forEach(function(c) {
          c.classList.toggle('active', c.dataset.dur === 'all');
        });
        if (priceRng) priceRng.value = 200000;
        if (priceVal) priceVal.textContent = 'Any';
        if (sortSel) sortSel.value = 'default';
        applyFilters();
      });
    }

    /* ── pre-activate category from PHP (for deep-link URLs) ── */
    if (activeCat) {
      catBtns.forEach(function(b) {
        b.classList.toggle('active', b.dataset.cat === activeCat);
      });
      applyFilters();
    }

    /* ── filter panel toggle ── */
    var sbToggle = document.getElementById('sbToggle');
    var sbBody = document.getElementById('sbBody');
    if (sbToggle && sbBody) {
      sbToggle.addEventListener('click', function() {
        var open = sbBody.classList.toggle('sb-open');
        sbToggle.classList.toggle('sb-open', open);
      });
    }
  }());
</script>