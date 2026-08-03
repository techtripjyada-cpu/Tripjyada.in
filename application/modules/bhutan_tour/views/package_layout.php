<?php
/** @var array  $package    Injected via include in package_view.php */
/** @var string $wa_number  Injected by controller */
$waLink = 'https://wa.me/' . $wa_number . '?text=' . urlencode($package['wa_msg']);

$hasPricing   = !empty($package['pricing']);
$pricingData  = $hasPricing ? $package['pricing'] : null;
$pricingJson  = $hasPricing ? htmlspecialchars(json_encode($pricingData), ENT_QUOTES) : '';

// Derive "starting from" price
$startPrice   = '';
if ($hasPricing) {
    $allPax = array_merge(
        array_values($pricingData['offseason']['pax']),
        array_values($pricingData['season']['pax'])
    );
    $minPrice = min($allPax);
    $startPrice = '₹' . number_format($minPrice) . '/person';
} elseif (!empty($package['price'])) {
    $startPrice = $package['price'];
}

// Payment modal data attrs (only for packages with pricing)
$numDays = !empty($package['num_days']) ? (int)$package['num_days'] : 0;
?>

<!-- Breadcrumb -->
<nav class="bt-breadcrumb-bar" aria-label="Breadcrumb">
  <div class="container">
    <ol class="bt-breadcrumb-list">
      <li>
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
        </svg>
        <a href="<?= site_url() ?>">Home</a>
      </li>
      <li><span class="bt-sep">›</span><a href="<?= site_url('group-tour') ?>">Group Tours</a></li>
      <li><span class="bt-sep">›</span><?= htmlspecialchars($package['name']) ?></li>
    </ol>
  </div>
</nav>

<!-- Hero -->
<div class="bt-hero">
  <img src="<?= base_url() . htmlspecialchars($package['image']) ?>" alt="<?= htmlspecialchars($package['name']) ?>" loading="lazy">
  <div class="bt-hero-overlay">
    <div class="bt-hero-content">
      <div class="container">
        <div class="bt-hero-badges">
          <?php if (!empty($package['best_seller'])): ?>
            <span class="bt-badge bt-badge-seller">Best Selling</span>
          <?php endif; ?>
          <span class="bt-badge bt-badge-type"><?= htmlspecialchars($package['type']) ?></span>
          <?php if ($hasPricing): ?>
            <span class="bt-badge bt-badge-indian">Indian Nationals</span>
          <?php endif; ?>
        </div>
        <h1 class="bt-hero-title"><?= htmlspecialchars($package['name']) ?></h1>
        <div class="bt-hero-meta">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
            </svg>
            <?= htmlspecialchars($package['duration']) ?>
          </span>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
            </svg>
            Bhutan
          </span>
          <?php if ($hasPricing && $startPrice): ?>
          <span style="background:rgba(249,115,22,.85);border-radius:6px;padding:3px 10px;font-weight:700;">
            Starting ₹<?= number_format($minPrice) ?>/person
          </span>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Urgency Banner -->
<?php if (!empty($package['urgency'])): ?>
<div class="bt-urgency-bar">
  <div class="container">
    <span class="bt-urgency-text"><?= htmlspecialchars($package['urgency']) ?></span>
  </div>
</div>
<?php endif; ?>

<!-- Main content -->
<div class="bt-page">
  <div class="container">
    <div class="row">

      <!-- Left column -->
      <div class="col-lg-8 col-12">

        <!-- Overview -->
        <div class="mb-4">
          <div class="bt-section-title">About This Tour</div>
          <?php
          $paragraphs = explode("\n\n", trim($package['overview']));
          foreach ($paragraphs as $para): ?>
            <p class="bt-overview"><?= nl2br(htmlspecialchars(trim($para))) ?></p>
          <?php endforeach; ?>
        </div>

        <!-- Highlights -->
        <div class="mb-4">
          <div class="bt-section-title">Tour Highlights</div>
          <ul class="bt-highlights">
            <?php foreach ($package['highlights'] as $h): ?>
              <li><?= htmlspecialchars($h) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- PAX Pricing Table -->
        <?php if ($hasPricing): ?>
        <div class="bt-pricing-section mb-4">
          <div class="bt-section-title">Tour Pricing — Indian Nationals Only</div>
          <div class="bt-pricing-notice">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>
            These rates are for <strong>Indian nationals only</strong>. SDF (₹1,200/adult/night) is payable separately. Prices are per person, all-inclusive of cab, guide &amp; hotel.
          </div>

          <!-- Season tabs -->
          <div class="bt-pricing-tabs">
            <button class="bt-ptab active" data-tab="season">
              Peak Season <span class="bt-ptab-sub">1 Sep – 10 Jan</span>
            </button>
            <button class="bt-ptab" data-tab="offseason">
              Off Season <span class="bt-ptab-sub">1 Jul – 31 Aug</span>
            </button>
          </div>

          <!-- Season table -->
          <div class="bt-ptable-wrap" id="bt-tab-season">
            <table class="bt-ptable">
              <thead>
                <tr>
                  <th>Group Size</th>
                  <th>Per Person</th>
                  <th>Total (approx.)</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pricingData['season']['pax'] as $pax => $rate): ?>
                <tr>
                  <td><span class="bt-pax-chip"><?= $pax ?> PAX</span></td>
                  <td class="bt-rate-cell">₹<?= number_format($rate) ?></td>
                  <td class="bt-total-cell">₹<?= number_format($rate * (int)$pax) ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <!-- Off-season table -->
          <div class="bt-ptable-wrap" id="bt-tab-offseason" style="display:none">
            <table class="bt-ptable">
              <thead>
                <tr>
                  <th>Group Size</th>
                  <th>Per Person</th>
                  <th>Total (approx.)</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pricingData['offseason']['pax'] as $pax => $rate): ?>
                <tr>
                  <td><span class="bt-pax-chip"><?= $pax ?> PAX</span></td>
                  <td class="bt-rate-cell">₹<?= number_format($rate) ?></td>
                  <td class="bt-total-cell">₹<?= number_format($rate * (int)$pax) ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <p class="bt-pricing-footnote">* SDF of ₹1,200 per adult per night is additional. Children under 5 years free; ages 6–12 pay half SDF.</p>
        </div>
        <?php endif; ?>

        <!-- Itinerary -->
        <div class="bt-itinerary">
          <div class="bt-section-title">Day-by-Day Itinerary</div>
          <?php foreach ($package['itinerary'] as $i => $day): ?>
            <div class="bt-day <?= $i === 0 ? 'open' : '' ?>">
              <div class="bt-day-header" onclick="btToggle(this)">
                <span class="bt-day-num"><?= htmlspecialchars($day['day']) ?></span>
                <span class="bt-day-name"><?= htmlspecialchars($day['title']) ?></span>
                <span class="bt-day-arrow">▼</span>
              </div>
              <div class="bt-day-body" <?= $i === 0 ? 'style="display:block"' : '' ?>>
                <p><?= htmlspecialchars($day['desc']) ?></p>
                <div class="bt-day-meta">
                  <?php if (!empty($day['stay'])): ?>
                    <span class="bt-day-tag bt-day-tag-stay">🏨 Stay: <?= htmlspecialchars($day['stay']) ?></span>
                  <?php endif; ?>
                  <?php if (!empty($day['meals'])): ?>
                    <span class="bt-day-tag bt-day-tag-meals">🍽️ Meals: <?= htmlspecialchars($day['meals']) ?></span>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Inclusions / Exclusions -->
        <div class="bt-inc-exc">
          <div class="bt-inc-box">
            <h4>✓ What's Included</h4>
            <ul>
              <?php foreach ($package['inclusions'] as $inc): ?>
                <li><?= htmlspecialchars($inc) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="bt-exc-box">
            <h4>✗ Not Included</h4>
            <ul>
              <?php foreach ($package['exclusions'] as $exc): ?>
                <li><?= htmlspecialchars($exc) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>

        <!-- FAQs -->
        <?php if (!empty($package['faqs'])): ?>
        <div class="bt-faqs">
          <div class="bt-section-title">Frequently Asked Questions</div>
          <?php foreach ($package['faqs'] as $faq): ?>
            <div class="bt-faq-item">
              <div class="bt-faq-q" onclick="btFaqToggle(this)"><?= htmlspecialchars($faq['q']) ?></div>
              <div class="bt-faq-a"><p><?= nl2br(htmlspecialchars($faq['a'])) ?></p></div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

      </div><!-- /col-lg-8 -->

      <!-- Sidebar -->
      <div class="col-lg-4 col-12 mt-4 mt-lg-0">
        <div class="bt-sidebar-card" id="bt-sticky-sidebar">

          <?php if ($hasPricing): ?>
          <!-- Dynamic pricing sidebar -->
          <div class="bt-price-box">
            <div class="bt-price-label">Starting from</div>
            <div class="bt-price-val" id="btSidebarPrice">₹<?= number_format($minPrice) ?><span style="font-size:14px;font-weight:500;color:#6b7280">/person</span></div>
            <div class="bt-price-season-note" id="btSeasonNote">Select your travel date to see your rate</div>
          </div>
          <button type="button" class="bt-btn-book"
            data-bs-toggle="modal"
            data-bs-target="#packagePaymentModal"
            data-package-title="<?= htmlspecialchars($package['name']) ?>"
            data-package-id="<?= htmlspecialchars($package['p_id']) ?>"
            data-package-slug="<?= htmlspecialchars($package['slug']) ?>"
            data-package-category-slug="<?= htmlspecialchars($package['category_slug']) ?>"
            data-package-rate="0"
            data-is-bhutan="1"
            data-sdf-exempt="0"
            data-num-days="<?= $numDays ?>"
            data-pricing-json="<?= $pricingJson ?>"
            data-itinerary="[]">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="display:inline;vertical-align:middle;margin-right:5px"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
            Book Now
          </button>

          <?php else: ?>
          <!-- Static price sidebar (non-PAX packages) -->
          <div class="bt-price-box">
            <div class="bt-price-label">Starting from</div>
            <div class="bt-price-val"><?= htmlspecialchars($startPrice) ?></div>
          </div>
          <button type="button" class="bt-btn-book" data-bs-toggle="modal" data-bs-target="#qteModal"
            data-tour="<?= htmlspecialchars($package['name']) ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="display:inline;vertical-align:middle;margin-right:5px"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
            Enquire Now
          </button>
          <?php endif; ?>

          <a href="<?= $waLink ?>" target="_blank" rel="noopener" class="bt-btn-wa">
            <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            WhatsApp Us
          </a>
        </div>

        <div class="bt-sidebar-card" style="margin-top:20px">
          <div class="bt-section-title" style="font-size:16px;margin-bottom:14px">Quick Facts</div>
          <ul class="bt-facts">
            <li><span class="fact-label">Duration</span><span class="fact-value"><?= htmlspecialchars($package['duration']) ?></span></li>
            <li><span class="fact-label">Tour Type</span><span class="fact-value"><?= htmlspecialchars($package['type']) ?></span></li>
            <li><span class="fact-label">Destination</span><span class="fact-value">Bhutan</span></li>
            <li><span class="fact-label">Best Season</span><span class="fact-value">Sep–Jan (Peak), Jul–Aug (Off)</span></li>
            <li><span class="fact-label">Language</span><span class="fact-value">English / Hindi Guide</span></li>
            <li><span class="fact-label">Min. Group</span><span class="fact-value" style="color:#f97316">2 Persons</span></li>
          </ul>
        </div>
      </div><!-- /sidebar -->

    </div><!-- /row -->
  </div>
</div>

<script>
function btToggle(header) {
  var day = header.parentElement;
  var body = day.querySelector('.bt-day-body');
  var isOpen = day.classList.contains('open');
  document.querySelectorAll('.bt-day').forEach(function(d) {
    d.classList.remove('open');
    d.querySelector('.bt-day-body').style.display = 'none';
  });
  if (!isOpen) { day.classList.add('open'); body.style.display = 'block'; }
}
function btFaqToggle(qEl) {
  var item = qEl.parentElement;
  var answer = item.querySelector('.bt-faq-a');
  var isOpen = item.classList.contains('open');
  document.querySelectorAll('.bt-faq-item').forEach(function(f) {
    f.classList.remove('open');
    f.querySelector('.bt-faq-a').style.display = 'none';
  });
  if (!isOpen) { item.classList.add('open'); answer.style.display = 'block'; }
}

// Pricing table tab toggle
document.querySelectorAll('.bt-ptab').forEach(function(btn) {
  btn.addEventListener('click', function() {
    document.querySelectorAll('.bt-ptab').forEach(function(b) { b.classList.remove('active'); });
    document.querySelectorAll('.bt-ptable-wrap').forEach(function(t) { t.style.display = 'none'; });
    btn.classList.add('active');
    var target = document.getElementById('bt-tab-' + btn.dataset.tab);
    if (target) target.style.display = 'block';
  });
});
</script>
