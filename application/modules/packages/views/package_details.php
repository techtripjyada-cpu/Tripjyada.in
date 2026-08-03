<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
$category_names = array(
    'group'          => 'Group Tour',
    'family'         => 'Family Tour',
    'honeymoon'      => 'Honeymoon Tour',
    'luxury'         => 'Luxury Tour',
    'group-tour'     => 'Group Tour',
    'family-tour'    => 'Family Tour',
    'honeymoon-tour' => 'Honeymoon Tour',
    'luxury-tour'    => 'Luxury Tour',
);
$category_slug_map = array(
    'group'          => 'group-tour',
    'family'         => 'family-tour',
    'honeymoon'      => 'honeymoon-tour',
    'luxury'         => 'luxury-tour',
    'group-tour'     => 'group-tour',
    'family-tour'    => 'family-tour',
    'honeymoon-tour' => 'honeymoon-tour',
    'luxury-tour'    => 'luxury-tour',
);
$category_key   = !empty($package['category_slug']) ? $package['category_slug'] : $package['category'];
$category_name  = isset($category_names[$category_key]) ? $category_names[$category_key] : ucwords(str_replace('-', ' ', $category_key));
$category_slug  = isset($category_slug_map[$category_key]) ? $category_slug_map[$category_key] : $category_key;
$overview_text  = !empty($package['details']) ? $package['details'] : (!empty($package['description']) ? $package['description'] : '');
$overview_has_html = $overview_text !== strip_tags($overview_text);
$main_image     = !empty($package['image_src']) ? $package['image_src'] : base_url('assets/images/banner/bg-2.jpg');
$details_image  = !empty($package['details_image_src']) ? $package['details_image_src'] : '';
$highlights     = !empty($package['highlights']) ? array_values($package['highlights']) : array();
$_wa_number     = isset($wa_number) ? $wa_number : (isset($phone) ? $phone : '919558515518');
$wa_text        = 'Hello TripJyada, I want to know more about ' . $package['title'];
$wa_link        = 'https://wa.me/' . $_wa_number . '?text=' . urlencode($wa_text);
$best_selling   = !empty($package['best_selling']);
$urgency        = !empty($package['urgency']) ? $package['urgency'] : '';
$itinerary      = !empty($package['itinerary_json']) ? json_decode($package['itinerary_json'], true) : array();
$inclusions     = !empty($package['inclusions_json']) ? json_decode($package['inclusions_json'], true) : array();
$exclusions     = !empty($package['exclusions_json']) ? json_decode($package['exclusions_json'], true) : array();
$faqs           = !empty($package['faqs_json']) ? json_decode($package['faqs_json'], true) : array();
$package_price_rupees = !empty($package['price_on_request']) ? 0 : (int) preg_replace('/[^\d]/', '', (string) $package['price']);
$can_accept_payment = $package_price_rupees > 0 && !empty($package['p_id']) && !empty($package['slug']) && !empty($package['category_slug']);

// Auth check
$CI_pd = &get_instance();
$_tj_logged_in = (bool) $CI_pd->session->userdata('tj_user_id');

// Bhutan SDF detection — scan package text + itinerary
$_pd_text = strtolower(
    (isset($package['title'])       ? $package['title']       : '') . ' ' .
    (isset($package['description']) ? $package['description'] : '') . ' ' .
    (isset($package['details'])     ? $package['details']     : '') . ' ' .
    implode(' ', $highlights)
);
foreach ((array) $itinerary as $_pd_day) {
    $_pd_text .= ' ' . strtolower(isset($_pd_day['title']) ? $_pd_day['title'] : '')
               . ' ' . strtolower(isset($_pd_day['desc'])  ? $_pd_day['desc']  : '');
}
$is_bhutan_package = strpos($_pd_text, 'bhutan')        !== false;
$sdf_exempt        = strpos($_pd_text, 'phuentsholing') !== false
                   || strpos($_pd_text, 'phuntsholing')  !== false;
?>

<nav class="pd-breadcrumb-bar" aria-label="Breadcrumb">
  <div class="container">
    <ol class="pd-breadcrumb-list">
      <li>
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
        </svg>
        <a href="<?= site_url() ?>">Home</a>
      </li>
      <li><span class="pd-sep">›</span><a href="<?= site_url($category_slug) ?>"><?= htmlspecialchars($category_name) ?></a></li>
      <li><span class="pd-sep">›</span><?= htmlspecialchars($package['title']) ?></li>
    </ol>
  </div>
</nav>

<div class="pd-hero">
  <img src="<?= htmlspecialchars($main_image) ?>" alt="<?= htmlspecialchars($package['title']) ?>" loading="lazy">
  <div class="pd-hero-overlay">
    <div class="pd-hero-content">
      <div class="container">
        <div class="pd-hero-badges">
          <?php if ($best_selling): ?>
            <span class="pd-badge pd-badge-seller">Best Selling</span>
          <?php endif; ?>
          <span class="pd-badge pd-badge-type"><?= htmlspecialchars($category_name) ?></span>
        </div>
        <h1 class="pd-hero-title"><?= htmlspecialchars($package['title']) ?></h1>
        <div class="pd-hero-meta">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
            </svg>
            <?= htmlspecialchars($package['days']) ?>
          </span>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
            </svg>
            Bhutan
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if ($urgency): ?>
<div class="pd-urgency-bar">
  <div class="container">
    <span class="pd-urgency-text"><?= htmlspecialchars($urgency) ?></span>
  </div>
</div>
<?php endif; ?>

<div class="pd-info-strip">
  <div class="container">
    <div class="pd-info-strip-inner">
      <?php if (!empty($package['days'])): ?>
      <div class="pd-info-item">
        <div class="pd-info-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
        </div>
        <div>
          <div class="pd-info-label">Duration</div>
          <div class="pd-info-value"><?= htmlspecialchars($package['days']) ?></div>
        </div>
      </div>
      <div class="pd-info-sep"></div>
      <?php endif; ?>
      <div class="pd-info-item">
        <div class="pd-info-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/></svg>
        </div>
        <div>
          <div class="pd-info-label">Category</div>
          <div class="pd-info-value"><?= htmlspecialchars($category_name) ?></div>
        </div>
      </div>
      <div class="pd-info-sep"></div>
      <div class="pd-info-item">
        <div class="pd-info-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
        </div>
        <div>
          <div class="pd-info-label">Destination</div>
          <div class="pd-info-value">Bhutan</div>
        </div>
      </div>
      <?php if ($package_price_rupees > 0): ?>
      <div class="pd-info-sep"></div>
      <div class="pd-info-item pd-info-price">
        <div class="pd-info-icon">
          <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 8.25H9m6 3H9m3 6-3-3h1.5a3 3 0 1 0 0-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
        </div>
        <div>
          <div class="pd-info-label">Starting Price</div>
          <div class="pd-info-value">&#8377;<?= number_format($package_price_rupees) ?><span class="pd-info-unit">/ person</span></div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="pd-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-12">
        <?php if ($overview_text): ?>
        <div class="mb-4">
          <div class="pd-section-title">About This Tour</div>
          <?php if ($overview_has_html): ?>
            <div class="pd-richtext"><?= $overview_text ?></div>
          <?php else: ?>
            <?php foreach (explode("\n\n", trim($overview_text)) as $para): ?>
              <?php if (trim($para) !== ''): ?>
                <p class="pd-overview"><?= nl2br(htmlspecialchars(trim($para))) ?></p>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <?php if ($details_image): ?>
            <div class="pd-overview-media">
              <img src="<?= htmlspecialchars($details_image) ?>" alt="<?= htmlspecialchars($package['title']) ?>" loading="lazy">
            </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($highlights)): ?>
        <div class="mb-4">
          <div class="pd-section-title">Tour Highlights</div>
          <ul class="pd-highlights">
            <?php foreach ($highlights as $h): ?>
              <li><?= htmlspecialchars($h) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <?php if (!empty($itinerary)): ?>
        <div class="pd-itinerary">
          <div class="pd-section-title">Day-by-Day Itinerary</div>
          <?php foreach ($itinerary as $i => $day): ?>
            <div class="pd-day <?= $i === 0 ? 'open' : '' ?>">
              <div class="pd-day-header" onclick="pdToggle(this)">
                <span class="pd-day-num"><?= htmlspecialchars($day['day']) ?></span>
                <span class="pd-day-name"><?= htmlspecialchars($day['title']) ?></span>
                <span class="pd-day-arrow">▼</span>
              </div>
              <div class="pd-day-body" <?= $i === 0 ? 'style="display:block"' : '' ?>>
                <p><?= htmlspecialchars($day['desc']) ?></p>
                <div class="pd-day-meta">
                  <?php if (!empty($day['stay'])): ?>
                    <span class="pd-day-tag pd-day-tag-stay">Stay: <?= htmlspecialchars($day['stay']) ?></span>
                  <?php endif; ?>
                  <?php if (!empty($day['meals'])): ?>
                    <span class="pd-day-tag pd-day-tag-meals">Meals: <?= htmlspecialchars($day['meals']) ?></span>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($inclusions) || !empty($exclusions)): ?>
        <div class="pd-inc-exc">
          <?php if (!empty($inclusions)): ?>
          <div class="pd-inc-box">
            <h4>What's Included</h4>
            <ul>
              <?php foreach ($inclusions as $inc): ?>
                <li><?= htmlspecialchars($inc) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php endif; ?>

          <?php if (!empty($exclusions)): ?>
          <div class="pd-exc-box">
            <h4>Not Included</h4>
            <ul>
              <?php foreach ($exclusions as $exc): ?>
                <li><?= htmlspecialchars($exc) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($faqs)): ?>
        <div class="pd-faqs">
          <div class="pd-section-title">Frequently Asked Questions</div>
          <?php foreach ($faqs as $faq): ?>
            <div class="pd-faq-item">
              <div class="pd-faq-q" onclick="pdFaqToggle(this)"><?= htmlspecialchars($faq['q']) ?></div>
              <div class="pd-faq-a"><p><?= nl2br(htmlspecialchars($faq['a'])) ?></p></div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="col-lg-4 col-12 mt-4 mt-lg-0">
        <div style="position:sticky;top:80px;">
        <div class="pd-sidebar-card">
          <div class="pd-price-box">
            <div class="pd-price-label">Starting from</div>
            <div class="pd-price-val">
              <?php if (!empty($package['price_on_request'])): ?>
                Contact for Price
              <?php elseif ($package_price_rupees > 0): ?>
                &#8377;<?= number_format($package_price_rupees) ?>
              <?php else: ?>
                &#8377;<?= htmlspecialchars($package['price']) ?>
              <?php endif; ?>
            </div>
          </div>
          <?php if ($can_accept_payment): ?>
          <?php
            $itin_slim = array_map(function($d) {
                return array(
                    'day'   => isset($d['day'])   ? $d['day']   : '',
                    'title' => isset($d['title']) ? $d['title'] : '',
                    'stay'  => isset($d['stay'])  ? $d['stay']  : '',
                );
            }, $itinerary);

            // Extract number of days from duration string like "6 Nights 7 Days" or "7 Nights 8 Days"
            $_btn_num_days = 0;
            if (!empty($package['days'])) {
                if (preg_match('/(\d+)\s*days?/i', $package['days'], $_dm)) {
                    $_btn_num_days = (int) $_dm[1];                        // "7 Days" → 7
                } elseif (preg_match('/(\d+)\s*nights?/i', $package['days'], $_dm)) {
                    $_btn_num_days = (int) $_dm[1] + 1;                    // "6 Nights" → 7
                } else {
                    preg_match('/(\d+)/', $package['days'], $_dm);
                    $_btn_num_days = isset($_dm[1]) ? (int) $_dm[1] : 0;
                }
            }
            if ($_btn_num_days === 0 && !empty($itinerary)) {
                $_btn_num_days = count($itinerary);                        // fallback: count itinerary days
            }
          ?>
          <button type="button" class="pd-btn-pay js-package-pay" data-bs-toggle="modal"
            data-bs-target="#packagePaymentModal" data-package-id="<?= (int) $package['p_id'] ?>"
            data-package-title="<?= htmlspecialchars($package['title'], ENT_QUOTES, 'UTF-8') ?>"
            data-package-slug="<?= htmlspecialchars($package['slug'], ENT_QUOTES, 'UTF-8') ?>"
            data-package-category-slug="<?= htmlspecialchars($package['category_slug'], ENT_QUOTES, 'UTF-8') ?>"
            data-amount-display="<?= htmlspecialchars('Rs ' . number_format($package_price_rupees), ENT_QUOTES, 'UTF-8') ?>"
            data-package-rate="<?= (int) $package_price_rupees ?>"
            data-is-bhutan="<?= $is_bhutan_package ? '1' : '0' ?>"
            data-sdf-exempt="<?= $sdf_exempt ? '1' : '0' ?>"
            data-itinerary="<?= htmlspecialchars(json_encode($itin_slim, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?>"
            data-num-days="<?= $_btn_num_days ?>">
            Book Now
          </button>
          <?php endif; ?>
          <button type="button" class="pd-btn-book" data-bs-toggle="modal" data-bs-target="#qteModal"
            data-tour="<?= htmlspecialchars($package['title']) ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="display:inline;vertical-align:middle;margin-right:5px"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
            Enquire Now
          </button>
          <a href="<?= htmlspecialchars($wa_link) ?>" target="_blank" rel="noopener" class="pd-btn-wa">
            <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            WhatsApp Us
          </a>
        </div>

        <div class="pd-sidebar-card">
          <div class="pd-section-title" style="font-size:16px;margin-bottom:14px">Quick Facts</div>
          <ul class="pd-facts">
            <li><span class="fact-label">Duration</span><span class="fact-value"><?= htmlspecialchars($package['days']) ?></span></li>
            <li><span class="fact-label">Tour Type</span><span class="fact-value"><?= htmlspecialchars($category_name) ?></span></li>
            <li><span class="fact-label">Destination</span><span class="fact-value">Bhutan</span></li>
            <li><span class="fact-label">Best Season</span><span class="fact-value">Mar-May, Sep-Nov</span></li>
            <li><span class="fact-label">Guide</span><span class="fact-value">English-speaking</span></li>
            <li><span class="fact-label">Price</span><span class="fact-value" style="color:#f97316"><?php if (!empty($package['price_on_request'])): ?>Contact for Price<?php elseif ($package_price_rupees > 0): ?>&#8377;<?= number_format($package_price_rupees) ?><?php else: ?>&#8377;<?= htmlspecialchars($package['price']) ?><?php endif; ?></span></li>
          </ul>
        </div>
        </div><!-- /sticky -->
      </div>
    </div>
  </div>
</div>

<script>
function pdToggle(header) {
  var day = header.parentElement;
  var body = day.querySelector('.pd-day-body');
  var isOpen = day.classList.contains('open');
  document.querySelectorAll('.pd-day').forEach(function(d) {
    d.classList.remove('open');
    d.querySelector('.pd-day-body').style.display = 'none';
  });
  if (!isOpen) {
    day.classList.add('open');
    body.style.display = 'block';
  }
}

function pdFaqToggle(question) {
  var item = question.parentElement;
  var answer = item.querySelector('.pd-faq-a');
  var isOpen = item.classList.contains('open');
  document.querySelectorAll('.pd-faq-item').forEach(function(faq) {
    faq.classList.remove('open');
    faq.querySelector('.pd-faq-a').style.display = 'none';
  });
  if (!isOpen) {
    item.classList.add('open');
    answer.style.display = 'block';
  }
}
</script>
<script>
// Auth gate — redirect to login if not logged in when clicking Book Now
(function () {
    var loggedIn = <?= $_tj_logged_in ? 'true' : 'false' ?>;
    var loginUrl = '<?= site_url() ?>?login=1';
    document.querySelectorAll('.js-package-pay').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            if (!loggedIn) {
                e.preventDefault();
                e.stopImmediatePropagation();
                window.location.href = loginUrl;
            }
        }, true);
    });
}());
</script>
