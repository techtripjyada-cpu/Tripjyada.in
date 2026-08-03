<?php

/**
 * GROUP TOUR PACKAGES — Data-driven view
 * To add/edit packages: update $packages array below.
 * Later this can be replaced by a model/DB query.
 */
$packages = [
  [
    'id'          => 1,
    'name'        => '6 Nights Bhutan Backpacking Group Tour Package',
    'duration'    => '7 Days 6 Nights',
    'nights'      => 6,
    'dest'        => 'bhutan',
    'type'        => 'group-tour',
    'best_seller' => true,
    'image'       => 'assets/images/product/1.jpg',
    'icons'       => ['🚗', '🏨', '🗺️'],
    'highlights'  => ['Phuentsholing', 'Thimphu', 'Dochula Pass', 'Punakha', 'Punakha Dzong', 'Paro', 'Tiger\'s Nest Monastery'],
    'wa_msg'      => 'Interested in 6 Nights Bhutan Backpacking Group Tour Package',
    'link'        => 'bhutan-tour/6-nights-bhutan-backpacking-group-tour-package',
  ],
  [
    'id'          => 2,
    'name'        => '8 Day Bhutan Kingdom Explorer Tour Package',
    'duration'    => '8 Days 7 Nights',
    'nights'      => 7,
    'dest'        => 'bhutan',
    'type'        => 'cultural',
    'best_seller' => true,
    'image'       => 'assets/images/product/2.jpg',
    'icons'       => ['🚗', '🏨', '👥', '🗺️'],
    'highlights'  => ['Phuentsholing', 'Thimphu', 'Bumthang', 'Punakha Dzong'],
    'wa_msg'      => 'Interested in 8 Day Bhutan Kingdom Explorer Tour Package',
    'link'        => 'bhutan-tour/8-day-bhutan-kingdom-explorer-tour-package',
  ],
  [
    'id'          => 3,
    'name'        => '11 Days Bhutan Ultimate Escape Tour Package',
    'duration'    => '11 Days 10 Nights',
    'nights'      => 10,
    'dest'        => 'bhutan',
    'type'        => 'luxury',
    'best_seller' => true,
    'image'       => 'assets/images/product/3.jpg',
    'icons'       => ['🚗', '🏨', '👥', '🗺️'],
    'highlights'  => ['Phuentsholing', 'Thimphu', 'Punakha', 'Phobjikha', 'Bumthang', 'Paro'],
    'wa_msg'      => 'Interested in 11 Days Bhutan Ultimate Escape Tour Package',
    'link'        => 'bhutan-tour/11-days-bhutan-ultimate-escape-tour-package',
  ],
  [
    'id'          => 4,
    'name'        => '9 Nights Bhutan Hill Stations Tour Package',
    'duration'    => '10 Days 9 Nights',
    'nights'      => 9,
    'dest'        => 'bhutan',
    'type'        => 'group-tour',
    'best_seller' => true,
    'image'       => 'assets/images/product/4.jpg',
    'icons'       => ['🚗', '🏨', '👥'],
    'highlights'  => ['Phuentsholing', 'Thimphu', 'Punakha', 'Paro'],
    'wa_msg'      => 'Interested in 9 Nights Bhutan Hill Stations Tour Package',
    'link'        => 'bhutan-tour/9-nights-bhutan-hill-stations-tour-package',
  ],
  [
    'id'          => 5,
    'name'        => '7 Days Bhutan Cultural Tour Package',
    'duration'    => '7 Days 6 Nights',
    'nights'      => 6,
    'dest'        => 'bhutan',
    'type'        => 'cultural',
    'best_seller' => true,
    'image'       => 'assets/images/product/5.jpg',
    'icons'       => ['🚗', '🏨', '👥'],
    'highlights'  => ['Phuentsholing', 'Thimphu', ' Punakha', ' Paro', 'Tiger\'s Nest Monastery'],
    'wa_msg'      => 'Interested in 7 Days Bhutan Cultural Tour Package',
    'link'        => 'bhutan-tour/7-days-bhutan-cultural-tour-package',
  ],
  [
    'id'          => 6,
    'name'        => '6 Days Bhutan Bliss Tour Package',
    'duration'    => '6 Days 5 Nights',
    'nights'      => 5,
    'dest'        => 'bhutan',
    'type'        => 'honeymoon',
    'best_seller' => true,
    'image'       => 'assets/images/product/6.jpg',
    'icons'       => ['🚗', '🏨', '👥', '🗺️'],
    'highlights'  => ['Phuentsholing', 'Thimphu', ' Punakha', ' Paro'],
    'wa_msg'      => 'Interested in 6 Days Bhutan Bliss Tour Package',
    'link'        => 'bhutan-tour/6-days-bhutan-bliss-tour-package',
  ],
];

// Type label mapping for display
$typeLabels = [
  'group-tour' => 'Group Tour',
  'honeymoon'  => 'Honeymoon',
  'adventure'  => 'Adventure',
  'family'     => 'Family',
  'cultural'   => 'Cultural',
  'luxury'     => 'Luxury',
  'budget'     => 'Budget',
];

// WA number — update this
$waNumber = '919999999999';
?>

<!-- ============================================================
     GROUP TOUR PACKAGES PAGE  — Embedded CSS & JS
     ============================================================ -->

<style>
  /* ---- Breadcrumb ---- */
  .gt-breadcrumb-bar {
    background: #fff7f0;
    border-bottom: 1px solid rgba(249, 115, 22, .18);
    padding: 11px 0
  }

  .gt-breadcrumb-list {
    display: flex;
    align-items: center;
    gap: 6px;
    list-style: none;
    padding: 0;
    margin: 0;
    flex-wrap: wrap
  }

  .gt-breadcrumb-list li {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #777
  }

  .gt-breadcrumb-list a {
    color: #555;
    text-decoration: none;
    font-weight: 500;
    transition: color .2s
  }

  .gt-breadcrumb-list a:hover {
    color: #f97316
  }

  .gt-breadcrumb-list .gt-bc-sep {
    color: #bbb;
    font-size: 11px;
    line-height: 1
  }

  .gt-breadcrumb-list li:last-child {
    color: #f97316;
    font-weight: 600
  }

  /* ---- Layout ---- */

  @media (max-width: 991px) {
    .gt-page {
      padding-top: 30px
    }
  }

  @media (max-width: 575px) {
    .gt-page {
      padding-top: 16px
    }
  }

  /* ---- Sidebar ---- */
  .gt-sidebar {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
    position: sticky;
    top: 20px
  }

  .gt-search-wrap {
    position: relative;
    margin-bottom: 4px
  }

  .gt-search-wrap input {
    width: 100%;
    padding: 10px 40px 10px 14px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    box-sizing: border-box
  }

  .gt-search-wrap input:focus {
    border-color: #f97316
  }

  .gt-search-wrap button {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    font-size: 16px
  }

  .gt-filter-group {
    margin-bottom: 16px;
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 14px
  }

  .gt-filter-group:last-child {
    border-bottom: none;
    margin-bottom: 0
  }

  .gt-filter-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    user-select: none;
    margin-bottom: 10px
  }

  .gt-filter-head>span:first-child {
    font-size: 15px;
    font-weight: 700;
    color: #1a1a1a
  }

  .gt-filter-head .arr {
    font-size: 10px;
    color: #888;
    transition: transform .2s;
    display: inline-block
  }

  .gt-filter-head.collapsed .arr {
    transform: rotate(-90deg)
  }

  .gt-filter-body.hidden {
    display: none
  }

  .gt-cb {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 4px 0;
    cursor: pointer;
    font-size: 13px;
    color: #444;
    line-height: 1.3
  }

  .gt-cb input[type=checkbox] {
    width: 15px;
    height: 15px;
    accent-color: #f97316;
    cursor: pointer;
    flex-shrink: 0
  }

  .gt-cb:hover {
    color: #f97316
  }

  /* ---- Sort bar ---- */
  .gt-sort-bar {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 10px
  }

  .gt-sort-bar h2 {
    font-size: 22px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 4px
  }

  .gt-result-count {
    font-size: 12px;
    color: #888
  }

  .gt-sort-select {
    padding: 9px 14px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 13px;
    cursor: pointer;
    background: #fff;
    outline: none;
    min-width: 180px
  }

  .gt-sort-select:focus {
    border-color: #f97316
  }

  /* ---- Grid ---- */
  .gt-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px
  }

  @media(max-width:991px) {
    .gt-grid {
      grid-template-columns: repeat(2, 1fr)
    }
  }

  @media(max-width:575px) {
    .gt-grid {
      grid-template-columns: 1fr
    }
  }

  /* ---- Cards ---- */
  .gt-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0, 0, 0, .08);
    display: flex;
    flex-direction: column;
    transition: transform .3s, box-shadow .3s;
    border-top: 3px solid #f97316
  }

  .gt-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 28px rgba(249, 115, 22, .22)
  }

  .gt-card.gt-hidden {
    display: none
  }

  .gt-img-wrap {
    position: relative;
    overflow: hidden;
    height: 180px;
    flex-shrink: 0
  }

  .gt-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .4s;
    display: block
  }

  .gt-card:hover .gt-img-wrap img {
    transform: scale(1.06)
  }

  .gt-best-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #f97316;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: .5px
  }

  .gt-type-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0, 0, 0, .55);
    color: #fff;
    font-size: 10px;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 4px
  }

  .gt-body {
    padding: 13px;
    display: flex;
    flex-direction: column;
    flex: 1
  }

  .gt-title {
    font-size: 14px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 3px;
    line-height: 1.35
  }

  .gt-duration {
    font-size: 12px;
    color: #666;
    margin-bottom: 8px
  }

  .gt-icons {
    display: flex;
    gap: 5px;
    margin-bottom: 9px;
    flex-wrap: wrap
  }

  .gt-icons span {
    font-size: 17px;
    line-height: 1
  }

  .gt-hl {
    margin-bottom: 10px
  }

  .gt-hl h5 {
    font-size: 12px;
    font-weight: 700;
    color: #333;
    margin-bottom: 5px
  }

  .gt-hl ul {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2px 8px;
    list-style: none;
    padding: 0;
    margin: 0
  }

  .gt-hl ul li {
    font-size: 11px;
    color: #555;
    display: flex;
    align-items: flex-start;
    gap: 3px;
    line-height: 1.3
  }

  .gt-hl ul li::before {
    content: "•";
    color: #f97316;
    flex-shrink: 0
  }

  .gt-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: auto;
    padding-top: 10px;
    border-top: 1px solid rgba(249, 115, 22, .15);
    flex-wrap: wrap;
    gap: 6px
  }

  .gt-price {
    font-size: 17px;
    font-weight: 800;
    color: #f97316
  }

  .gt-actions {
    display: flex;
    gap: 6px;
    align-items: center
  }

  .gt-btn-detail {
    background: #f97316;
    color: #fff;
    padding: 7px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    transition: background .2s;
    display: inline-block
  }

  .gt-btn-detail:hover {
    background: #c95c00;
    color: #fff;
    text-decoration: none
  }

  .gt-btn-wa {
    background: #25d366;
    color: #fff;
    padding: 7px 9px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    text-decoration: none;
    transition: background .2s
  }

  .gt-btn-wa:hover {
    background: #1ebe5a
  }

  .gt-btn-wa svg {
    width: 15px;
    height: 15px;
    fill: #fff;
    display: block
  }

  .gt-no-results {
    display: none;
    text-align: center;
    padding: 50px 20px;
    color: #888;
    font-size: 15px;
    grid-column: 1/-1;
    flex-direction: column;
    align-items: center;
    gap: 8px
  }

  .gt-no-results.show {
    display: flex
  }

  /* ---- Best Time section ---- */
  .gt-best-time {
    margin-top: 60px;
    padding-top: 40px;
    border-top: 2px solid #f0f0f0
  }

  .gt-best-time>h2 {
    font-size: 26px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 6px
  }

  .gt-best-time>p {
    color: #666;
    font-size: 14px;
    margin-bottom: 20px
  }

  .gt-months-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 10px
  }

  @media(max-width:991px) {
    .gt-months-grid {
      grid-template-columns: repeat(4, 1fr)
    }
  }

  @media(max-width:575px) {
    .gt-months-grid {
      grid-template-columns: repeat(3, 1fr)
    }
  }

  .gt-month-card {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    aspect-ratio: 3/4;
    transition: transform .3s, box-shadow .3s
  }

  .gt-month-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, .2)
  }

  .gt-month-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block
  }

  .gt-month-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, .78) 40%, transparent);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    padding: 10px 6px;
    color: #fff;
    text-align: center
  }

  .gt-month-overlay .month-name {
    font-size: 13px;
    font-weight: 700;
    line-height: 1.2
  }

  .gt-month-overlay .month-dest {
    font-size: 10px;
    opacity: .85;
    line-height: 1.3;
    margin-top: 2px
  }

  .gt-month-overlay .month-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    background: #f97316;
    color: #fff;
    font-size: 9px;
    font-weight: 700;
    padding: 2px 6px;
    border-radius: 4px;
    text-transform: uppercase
  }
</style>

<!-- Breadcrumb -->
<nav class="gt-breadcrumb-bar" aria-label="Breadcrumb">
  <div class="container">
    <ol class="gt-breadcrumb-list">
      <li>
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24"
          stroke-width="1.8" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>
        <a href="<?= site_url() ?>">Home</a>
      </li>
      <li>
        <span class="gt-bc-sep">&#8250;</span>
        <a href="<?= site_url('group-tour') ?>">Tours</a>
      </li>
      <li>
        <span class="gt-bc-sep">&#8250;</span>
        Group Tour Packages
      </li>
    </ol>
  </div>
</nav>

<div class="gt-page mt-100">
  <div class="container">

    <!-- Mobile filter toggle -->
    <div class="d-flex align-items-center justify-content-between mb-3 d-lg-none">
      <drawer-opener class="open-sidebar text text-18 fw-500 d-flex align-items-center gap-2"
        data-drawer=".drawer-service-sidebar">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
          stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z">
          </path>
        </svg>
        Filter
      </drawer-opener>
    </div>

    <div class="row">

      <!-- =================== SIDEBAR =================== -->
      <div class="col-lg-3 col-12">
        <div class="drawer-service-sidebar">
          <div class="page-sidebar gt-sidebar">

            <!-- Mobile close button -->
            <div class="drawer-headings d-lg-none"
              style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
              <h2 style="font-size:20px;font-weight:700;margin:0">Filters</h2>
              <drawer-opener class="icon-24" data-drawer=".drawer-service-sidebar" style="cursor:pointer">
                <svg viewBox="0 0 24 24" fill="none" width="22" height="22" stroke="currentColor"
                  stroke-width="2">
                  <path d="M18 6L6 18M6 6l12 12" stroke-linecap="round" />
                </svg>
              </drawer-opener>
            </div>

            <!-- Search -->
            <div class="gt-filter-group gt-search-wrap">
              <input type="search" id="gt-search-input" placeholder="Search packages...">
              <button id="gt-search-btn" type="button">🔍</button>
            </div>
            <!-- Destination -->
            <div class="gt-filter-group">
              <div class="gt-filter-head" data-target="gt-dest-body"><span>Destination</span><span
                  class="arr">▼</span></div>
              <div class="gt-filter-body" id="gt-dest-body">
                <?php
                $destOptions = ['bhutan' => 'Bhutan'];
                foreach ($destOptions as $val => $label): ?>
                  <label class="gt-cb"><input type="checkbox" class="gt-dest-cb"
                      value="<?= htmlspecialchars($val) ?>"> <?= htmlspecialchars($label) ?></label>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Package Type -->
            <div class="gt-filter-group">
              <div class="gt-filter-head" data-target="gt-type-body"><span>Package Type</span><span
                  class="arr">▼</span></div>
              <div class="gt-filter-body" id="gt-type-body">
                <?php
                $typeOptions = ['group-tour' => 'Group Tour', 'honeymoon' => 'Honeymoon', 'adventure' => 'Adventure', 'family' => 'Family Tour', 'cultural' => 'Cultural', 'luxury' => 'Luxury', 'budget' => 'Budget'];
                foreach ($typeOptions as $val => $label): ?>
                  <label class="gt-cb"><input type="checkbox" class="gt-type-cb"
                      value="<?= htmlspecialchars($val) ?>"> <?= htmlspecialchars($label) ?></label>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Duration (Nights) -->
            <div class="gt-filter-group">
              <div class="gt-filter-head" data-target="gt-nights-body"><span>Duration (Nights)</span><span
                  class="arr">▼</span></div>
              <div class="gt-filter-body" id="gt-nights-body">
                <label class="gt-cb"><input type="checkbox" class="gt-nights-cb" value="1-5"> 1–5 Nights
                  (Short)</label>
                <label class="gt-cb"><input type="checkbox" class="gt-nights-cb" value="6-10"> 6–10
                  Nights (Medium)</label>
                <label class="gt-cb"><input type="checkbox" class="gt-nights-cb" value="11-15"> 11–15
                  Nights (Long)</label>
                <label class="gt-cb"><input type="checkbox" class="gt-nights-cb" value="16+"> 16+ Nights
                  (Extended)</label>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- =================== MAIN CONTENT =================== -->
      <div class="col-lg-9 col-12">

        <!-- Sort bar -->
        <div class="gt-sort-bar">
          <div>
            <h2>Group Tour Packages</h2>
            <div class="gt-result-count" id="gt-result-count">Loading...</div>
          </div>
          <select class="gt-sort-select" id="gt-sort-select" aria-label="Sort packages">
            <option value="default">Sort by: Default</option>
            <option value="name-asc">Name: A to Z</option>
            <option value="name-desc">Name: Z to A</option>
            <option value="nights-asc">Duration: Short to Long</option>
            <option value="nights-desc">Duration: Long to Short</option>
          </select>
        </div>

        <!-- Cards Grid (rendered by PHP loop) -->
        <div class="gt-grid" id="gt-grid">
          <?php foreach ($packages as $pkg):
            $typeLabel = isset($typeLabels[$pkg['type']]) ? $typeLabels[$pkg['type']] : ucfirst($pkg['type']);
            // $priceFormatted = '₹' . number_format($pkg['price']);
            $priceFormatted = 'Contact for Price';
            $waLink = 'https://wa.me/' . $waNumber . '?text=' . urlencode($pkg['wa_msg']);
          ?>
            <div class="gt-card" data-name="<?= htmlspecialchars($pkg['name']) ?>"
              data-nights="<?= $pkg['nights'] ?>" data-dest="<?= htmlspecialchars($pkg['dest']) ?>"
              data-flight="<?= htmlspecialchars($pkg['flight'] ?? 'no') ?>"
              data-type="<?= htmlspecialchars($pkg['type']) ?>">
              <div class="gt-img-wrap">
                <img src="<?= base_url() . htmlspecialchars($pkg['image']) ?>" loading="lazy"
                  alt="<?= htmlspecialchars($pkg['name']) ?>">
                <?php if ($pkg['best_seller']): ?><span class="gt-best-badge">Best
                    Selling</span><?php endif; ?>
                <span class="gt-type-badge"><?= htmlspecialchars($typeLabel) ?></span>
              </div>
              <div class="gt-body">
                <div class="gt-title"><?= htmlspecialchars($pkg['name']) ?></div>
                <div class="gt-duration"><?= htmlspecialchars($pkg['duration']) ?></div>
                <div class="gt-icons">
                  <?php foreach ($pkg['icons'] as $ic): ?><span><?= $ic ?></span><?php endforeach; ?>
                </div>
                <div class="gt-hl">
                  <h5>Tours Highlights</h5>
                  <ul>
                    <?php foreach ($pkg['highlights'] as $hl): ?>
                      <li><?= htmlspecialchars($hl) ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
                <div class="gt-footer">
                  <div class="gt-actions">
                    <a href="<?= site_url(htmlspecialchars($pkg['link'])) ?>" class="gt-btn-detail">View
                      Details</a>
                    <a href="<?= htmlspecialchars($waLink) ?>" class="gt-btn-wa" target="_blank"
                      rel="noopener" aria-label="WhatsApp">
                      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

          <!-- No results placeholder -->
          <div class="gt-no-results" id="gt-no-results">
            <span style="font-size:40px">😕</span>
            <strong>No packages found</strong>
            <span style="font-size:13px">Try adjusting your filters</span>
          </div>

        </div><!-- /.gt-grid -->
      </div><!-- /.col-lg-9 -->

    </div><!-- /.row -->

    <!-- =================== BEST TIME TO TRAVEL =================== -->
    <div class="gt-best-time">
      <h2>Best Time to Travel</h2>
      <p>Pick the perfect month for your dream group tour</p>
      <?php
      $months = [
        ['name' => 'January',  'dest' => 'Bhutan', 'badge' => 'Peak', 'img' => 'sm-1.jpg'],
        ['name' => 'February', 'dest' => 'Bhutan', 'badge' => '',     'img' => 'sm-2.jpg'],
        ['name' => 'March',    'dest' => 'Bhutan', 'badge' => 'Best', 'img' => 'sm-3.jpg'],
        ['name' => 'April',    'dest' => 'Bhutan', 'badge' => 'Best', 'img' => 'sm-4.jpg'],
        ['name' => 'May',      'dest' => 'Bhutan', 'badge' => '',     'img' => 'sm-5.jpg'],
        ['name' => 'June',     'dest' => 'Bhutan', 'badge' => 'Peak', 'img' => 'sm-6.jpg'],
        ['name' => 'July',     'dest' => 'Bhutan', 'badge' => 'Peak', 'img' => 'sm-1.jpg'],
        ['name' => 'August',   'dest' => 'Bhutan', 'badge' => '',     'img' => 'sm-2.jpg'],
        ['name' => 'September', 'dest' => 'Bhutan', 'badge' => 'Best', 'img' => 'sm-3.jpg'],
        ['name' => 'October',  'dest' => 'Bhutan', 'badge' => 'Best', 'img' => 'sm-4.jpg'],
        ['name' => 'November', 'dest' => 'Bhutan', 'badge' => '',     'img' => 'sm-5.jpg'],
        ['name' => 'December', 'dest' => 'Bhutan', 'badge' => 'Peak', 'img' => 'sm-6.jpg'],
      ];
      ?>
      <div class="gt-months-grid">
        <?php foreach ($months as $m): ?>
          <div class="gt-month-card">
            <img src="<?= base_url() ?>assets/images/destination/<?= $m['img'] ?>" loading="lazy"
              alt="<?= htmlspecialchars($m['name']) ?>">
            <div class="gt-month-overlay">
              <?php if ($m['badge']): ?><span
                  class="month-badge"><?= htmlspecialchars($m['badge']) ?></span><?php endif; ?>
              <div class="month-name"><?= htmlspecialchars($m['name']) ?></div>
              <div class="month-dest"><?= htmlspecialchars($m['dest']) ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div><!-- /.container -->
</div><!-- /.gt-page -->


<!-- Expose package data as JSON for JS -->
<script>
  var GT_PACKAGES = <?= json_encode($packages, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
</script>

<script>
  (function() {
    'use strict';

    /* ---- Collapsible filter sections ---- */
    document.querySelectorAll('.gt-filter-head').forEach(function(head) {
      head.addEventListener('click', function() {
        var targetId = this.getAttribute('data-target');
        var body = document.getElementById(targetId);
        if (!body) return;
        var isHidden = body.classList.contains('hidden');
        body.classList.toggle('hidden', !isHidden);
        this.classList.toggle('collapsed', !isHidden);
      });
    });

    /* ---- Filter + Sort engine ---- */
    var grid = document.getElementById('gt-grid');
    var noRes = document.getElementById('gt-no-results');
    var countEl = document.getElementById('gt-result-count');
    var sortSel = document.getElementById('gt-sort-select');
    var srch = document.getElementById('gt-search-input');

    function cards() {
      return Array.from(grid.querySelectorAll('.gt-card'));
    }

    function checked(cls) {
      return Array.from(document.querySelectorAll('.' + cls + ':checked')).map(function(c) {
        return c.value;
      });
    }

    function nightsMatch(nights, ranges) {
      if (!ranges.length) return true;
      nights = parseInt(nights, 10);
      return ranges.some(function(r) {
        if (r === '1-5') return nights >= 1 && nights <= 5;
        if (r === '6-10') return nights >= 6 && nights <= 10;
        if (r === '11-15') return nights >= 11 && nights <= 15;
        if (r === '16+') return nights >= 16;
        return false;
      });
    }

    function runFilter() {
      var dests = checked('gt-dest-cb');
      var flights = checked('gt-flight-cb');
      var types = checked('gt-type-cb');
      var nRanges = checked('gt-nights-cb');
      var q = srch ? srch.value.trim().toLowerCase() : '';

      var visible = 0;
      cards().forEach(function(card) {
        var d = card.dataset;
        var ok = true;
        if (dests.length && dests.indexOf(d.dest) === -1) ok = false;
        if (flights.length && flights.indexOf(d.flight) === -1) ok = false;
        if (types.length && types.indexOf(d.type) === -1) ok = false;
        if (!nightsMatch(d.nights, nRanges)) ok = false;
        if (q) {
          var haystack = (d.name + ' ' + d.dest + ' ' + d.type).toLowerCase();
          if (haystack.indexOf(q) === -1) ok = false;
        }
        card.classList.toggle('gt-hidden', !ok);
        if (ok) visible++;
      });

      noRes.classList.toggle('show', visible === 0);
      if (countEl) countEl.textContent = 'Showing ' + visible + ' of ' + cards().length + ' package' + (cards()
        .length !== 1 ? 's' : '');
      runSort(false);
    }

    function runSort(reFilter) {
      if (reFilter) {
        runFilter();
        return;
      }
      var val = sortSel ? sortSel.value : 'default';
      var visible = cards().filter(function(c) {
        return !c.classList.contains('gt-hidden');
      });
      visible.sort(function(a, b) {
        if (val === 'name-asc') return a.dataset.name.localeCompare(b.dataset.name);
        if (val === 'name-desc') return b.dataset.name.localeCompare(a.dataset.name);
        if (val === 'nights-asc') return +a.dataset.nights - +b.dataset.nights;
        if (val === 'nights-desc') return +b.dataset.nights - +a.dataset.nights;
        return 0;
      });
      visible.forEach(function(c) {
        grid.appendChild(c);
      });
    }

    /* ---- Bind all events ---- */
    document.querySelectorAll('.gt-dest-cb,.gt-flight-cb,.gt-type-cb,.gt-nights-cb').forEach(function(cb) {
      cb.addEventListener('change', runFilter);
    });
    if (sortSel) sortSel.addEventListener('change', function() {
      runSort(false);
    });
    if (srch) srch.addEventListener('input', runFilter);
    var sb = document.getElementById('gt-search-btn');
    if (sb) sb.addEventListener('click', runFilter);

    // Initial run
    runFilter();

  })();
</script>