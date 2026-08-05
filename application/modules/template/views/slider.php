  <!-- Main -->
  <main>
    <!-- Hero Slider -->
    <?php
    $hs_slides = [
      [
        'desktop_webp' => base_url() . 'assets/images/slider/1.webp',
        'desktop_jpg'  => base_url() . 'assets/images/slider/1.jpg',
        'mobile_webp'  => base_url() . 'assets/images/slider/mobile/1.webp',
        'mobile_jpg'   => base_url() . 'assets/images/slider/1.webp',
        'card_webp'    => base_url() . 'assets/images/slider/1.webp',
        'card_jpg'     => base_url() . 'assets/images/slider/1.webp',
        'width'        => 1920,
        'height'       => 1280,
        'name'         => 'DISCOVER BHUTAN',
        'location'     => 'Bhutan is Calling',
        'rating'       => '4.8',
        'desc'         => "Stop scrolling, start packing. Tiger's Nest, Punakha Dzong & pristine Himalayan valleys — your most unforgettable trip starts here.",
        'link'         => site_url('tour-package'),
      ],
      [
        'desktop_webp' => base_url() . 'assets/images/slider/2.webp',
        'desktop_jpg'  => base_url() . 'assets/images/slider/2.jpg',
        'mobile_webp'  => base_url() . 'assets/images/slider/mobile/2.webp',
        'mobile_jpg'   => base_url() . 'assets/images/slider/2.webp',
        'card_webp'    => base_url() . 'assets/images/slider/2.webp',
        'card_jpg'     => base_url() . 'assets/images/slider/2.webp',
        'width'        => 1920,
        'height'       => 1280,
        'name'         => 'SEATS FILLING',
        'location'     => '2025 Season — Act Fast',
        'rating'       => '4.9',
        'desc'         => "Our October–November 2025 Bhutan packages are booking up fast. Only a handful of spots remain — don't let someone else take yours.",
        'link'         => site_url('tour-package'),
      ],
      [
        'desktop_webp' => base_url() . 'assets/images/slider/3.webp',
        'desktop_jpg'  => base_url() . 'assets/images/slider/3.jpg',
        'mobile_webp'  => base_url() . 'assets/images/slider/mobile/3.webp',
        'mobile_jpg'   => base_url() . 'assets/images/slider/3.webp',
        'card_webp'    => base_url() . 'assets/images/slider/3.webp',
        'card_jpg'     => base_url() . 'assets/images/slider/3.webp',
        'width'        => 1919,
        'height'       => 1281,
        'name'         => 'BOOK TODAY',
        'location'     => 'Best Price Guaranteed',
        'rating'       => '4.7',
        'desc'         => "Group, family, honeymoon & luxury — fully curated Bhutan tours at India's best prices. Lock your dates before they're gone.",
        'link'         => site_url('tour-package'),
      ],
    ];
    ?>

    <div class="hs-hero" id="hsHero">
      <?php $hs_card_placeholder = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=='; ?>

      <!-- Backgrounds -->
      <?php foreach ($hs_slides as $i => $s): ?>
        <div class="hs-bg<?= $i === 0 ? ' hs-bg--active' : '' ?>" data-hs-bg="<?= $i ?>" aria-hidden="true">
          <?php if ($i === 0): ?>
            <picture class="hs-bg-picture">
              <source media="(max-width: 767px)" srcset="<?= $s['mobile_webp'] ?>" type="image/webp">
              <source media="(max-width: 767px)" srcset="<?= $s['mobile_jpg'] ?>" type="image/jpeg">
              <source srcset="<?= $s['desktop_webp'] ?>" type="image/webp">
              <source srcset="<?= $s['desktop_jpg'] ?>" type="image/jpeg">
              <img class="hs-bg-media" src="<?= $s['desktop_webp'] ?>" alt="" fetchpriority="high" loading="eager"
                decoding="async" width="<?= $s['width'] ?>" height="<?= $s['height'] ?>">
            </picture>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>

      <!-- Dark overlay -->
      <div class="hs-overlay"></div>

      <!-- LEFT: content -->
      <div class="hs-left">
        <span class="hs-counter" id="hsCounter">/ 01.</span>
        <h1 class="hs-title" id="hsTitle"><?= $hs_slides[0]['name'] ?></h1>
        <div class="hs-meta">
          <span class="hs-rating">
            <i class="fa-solid fa-star"></i> <span id="hsRating"><?= $hs_slides[0]['rating'] ?></span>
          </span>
          <span class="hs-loc">
            <i class="fa-solid fa-location-dot"></i> <span id="hsLoc"><?= $hs_slides[0]['location'] ?></span>
          </span>
        </div>
        <p class="hs-desc" id="hsDesc"><?= $hs_slides[0]['desc'] ?></p>

        <!-- Urgency strip -->
        <div class="hs-urgency">
          <span class="hs-urgency-dot"></span>
          <span class="hs-urgency-text">🔥 Limited slots left for this season — <strong>Book before they fill
              up!</strong></span>
        </div>

        <div class="hs-actions">
          <button class="hs-btn-book" data-bs-toggle="modal" data-bs-target="#qteModal" data-tour="Bhutan Tour">
            <i class="fa-solid fa-calendar-check"></i> Book Now
          </button>
          <a href="<?= $hs_slides[0]['link'] ?>" class="hs-btn-discover" id="hsLink">Explore Tours</a>
        </div>
      </div>

      <!-- RIGHT: stacked cards -->
      <div class="hs-panel">
        <div class="hs-cards">
          <?php foreach ($hs_slides as $i => $s): ?>
            <button class="hs-card<?= $i === 0 ? ' hs-card--active' : '' ?>" data-hs="<?= $i ?>">
              <picture class="hs-card-picture">
                <source data-srcset="<?= $s['card_webp'] ?>" type="image/webp">
                <img src="<?= $hs_card_placeholder ?>" data-src="<?= $s['card_jpg'] ?>"
                  alt="<?= htmlspecialchars($s['name'], ENT_QUOTES, 'UTF-8') ?>" width="640" height="272"
                  loading="lazy" decoding="async" fetchpriority="low">
              </picture>
              <div class="hs-card-glass"></div>
              <div class="hs-card-info">
                <div class="hs-card-top">
                  <span class="hs-card-name"><?= $s['name'] ?></span>
                  <span class="hs-card-rating"><i class="fa-solid fa-star"></i> <?= $s['rating'] ?></span>
                </div>
                <p class="hs-card-desc"><?= mb_substr($s['desc'], 0, 72) ?>...</p>
              </div>
            </button>
          <?php endforeach; ?>
        </div>

        <!-- Arrows -->
        <div class="hs-arrows">
          <button class="hs-arrow" id="hsPrev" aria-label="Previous">
            <i class="fa-solid fa-chevron-left"></i>
          </button>
          <button class="hs-arrow" id="hsNext" aria-label="Next">
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div>
      </div>

      <!-- Vertical progress track -->
      <div class="hs-track-wrap">
        <div class="hs-track-bg"></div>
        <div class="hs-track-fill" id="hsTrack"></div>
      </div>

    </div><!-- /.hs-hero -->

    <script>
      (function() {
        var slides = <?= json_encode(array_values($hs_slides), JSON_UNESCAPED_SLASHES) ?>;
        var hero = document.getElementById('hsHero');
        var bgs = hero.querySelectorAll('.hs-bg');
        var cards = hero.querySelectorAll('.hs-card');
        var counter = document.getElementById('hsCounter');
        var title = document.getElementById('hsTitle');
        var desc = document.getElementById('hsDesc');
        var link = document.getElementById('hsLink');
        var rating = document.getElementById('hsRating');
        var loc = document.getElementById('hsLoc');
        var track = document.getElementById('hsTrack');
        var prev = document.getElementById('hsPrev');
        var next = document.getElementById('hsNext');
        var cur = 0;
        var total = slides.length;
        var timer = null;
        var heroReady = false;

        function pad(n) {
          return (n < 10 ? '0' : '') + n;
        }

        function setTrack(idx) {
          track.style.height = ((idx + 1) / total * 100) + '%';
        }

        function animOut(els, cb) {
          els.forEach(function(el) {
            el.style.transition = 'opacity 0.22s ease, transform 0.22s ease';
            el.style.opacity = '0';
            el.style.transform = 'translateY(10px)';
          });
          setTimeout(cb, 240);
        }

        function animIn(els) {
          els.forEach(function(el) {
            el.style.transition =
              'opacity 0.5s cubic-bezier(.22,1,.36,1), transform 0.5s cubic-bezier(.22,1,.36,1)';
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
          });
        }

        function createBgPicture(slide, eager) {
          var picture = document.createElement('picture');
          picture.className = 'hs-bg-picture';

          if (slide.mobile_webp) {
            var mobileWebp = document.createElement('source');
            mobileWebp.media = '(max-width: 767px)';
            mobileWebp.srcset = slide.mobile_webp;
            mobileWebp.type = 'image/webp';
            picture.appendChild(mobileWebp);
          }

          if (slide.mobile_jpg) {
            var mobileJpg = document.createElement('source');
            mobileJpg.media = '(max-width: 767px)';
            mobileJpg.srcset = slide.mobile_jpg;
            mobileJpg.type = 'image/jpeg';
            picture.appendChild(mobileJpg);
          }

          if (slide.desktop_webp) {
            var desktopWebp = document.createElement('source');
            desktopWebp.srcset = slide.desktop_webp;
            desktopWebp.type = 'image/webp';
            picture.appendChild(desktopWebp);
          }

          if (slide.desktop_jpg) {
            var desktopJpg = document.createElement('source');
            desktopJpg.srcset = slide.desktop_jpg;
            desktopJpg.type = 'image/jpeg';
            picture.appendChild(desktopJpg);
          }

          var img = document.createElement('img');
          img.className = 'hs-bg-media';
          img.src = slide.desktop_webp || slide.desktop_jpg;
          img.alt = '';
          img.width = slide.width;
          img.height = slide.height;
          img.decoding = 'async';
          img.loading = eager ? 'eager' : 'lazy';
          img.setAttribute('fetchpriority', eager ? 'high' : 'low');
          picture.appendChild(img);

          return picture;
        }

        function ensureBgMedia(idx, eager) {
          var bg = bgs[idx];
          if (!bg) return;

          var picture = bg.querySelector('.hs-bg-picture');
          if (!picture) {
            bg.appendChild(createBgPicture(slides[idx], eager));
            return;
          }

          var img = picture.querySelector('.hs-bg-media');
          if (img && eager) {
            img.loading = 'eager';
            img.decoding = 'async';
            img.setAttribute('fetchpriority', 'high');
          }
        }

        function afterFirstPaint(cb) {
          window.requestAnimationFrame(function() {
            window.requestAnimationFrame(cb);
          });
        }

        function enableHeroAnimations() {
          if (heroReady) {
            return;
          }

          heroReady = true;
          hero.classList.add('hs-hero--ready');
        }

        function hydrateDeferredSlides() {
          slides.forEach(function(_, idx) {
            if (idx !== cur) {
              ensureBgMedia(idx, false);
            }
          });
        }

        function hydrateCardImages() {
          cards.forEach(function(card) {
            var picture = card.querySelector('.hs-card-picture');
            if (!picture || picture.dataset.hydrated === 'true') {
              return;
            }

            var sources = picture.querySelectorAll('source[data-srcset]');
            sources.forEach(function(source) {
              source.srcset = source.dataset.srcset;
            });

            var img = picture.querySelector('img[data-src]');
            if (img) {
              img.src = img.dataset.src;
            }

            picture.dataset.hydrated = 'true';
          });
        }

        function scheduleCardHydration() {
          if (window.requestIdleCallback) {
            window.requestIdleCallback(hydrateCardImages, {
              timeout: 1500
            });
            return;
          }

          window.setTimeout(hydrateCardImages, 600);
        }

        function goTo(idx) {
          idx = ((idx % total) + total) % total;
          if (idx === cur) return;
          clearTimeout(timer);
          ensureBgMedia(idx, true);
          bgs[cur].classList.remove('hs-bg--active');
          cards[cur].classList.remove('hs-card--active');
          animOut([counter, title, desc], function() {
            cur = idx;
            bgs[cur].classList.add('hs-bg--active');
            cards[cur].classList.add('hs-card--active');
            counter.textContent = '/ ' + pad(cur + 1) + '.';
            title.textContent = slides[cur].name;
            desc.textContent = slides[cur].desc;
            link.href = slides[cur].link;
            rating.textContent = slides[cur].rating;
            loc.textContent = slides[cur].location;
            animIn([counter, title, desc]);
            setTrack(cur);
            scheduleNext();
          });
        }

        function scheduleNext() {
          clearTimeout(timer);
          timer = setTimeout(function() {
            goTo(cur + 1);
          }, 5000);
        }

        cards.forEach(function(c) {
          c.addEventListener('click', function() {
            goTo(parseInt(this.dataset.hs));
          });
        });
        prev.addEventListener('click', function() {
          goTo(cur - 1);
        });
        next.addEventListener('click', function() {
          goTo(cur + 1);
        });

        ensureBgMedia(0, true);
        var firstHeroImage = hero.querySelector('.hs-bg-media');
        if (firstHeroImage && firstHeroImage.complete) {
          afterFirstPaint(enableHeroAnimations);
          scheduleCardHydration();
        } else if (firstHeroImage) {
          firstHeroImage.addEventListener('load', function() {
            afterFirstPaint(enableHeroAnimations);
            scheduleCardHydration();
          }, {
            once: true
          });
        } else {
          window.addEventListener('load', scheduleCardHydration, {
            once: true
          });
          window.addEventListener('load', function() {
            afterFirstPaint(enableHeroAnimations);
          }, {
            once: true
          });
        }

        if (window.requestIdleCallback) {
          window.addEventListener('load', function() {
            window.requestIdleCallback(hydrateDeferredSlides, {
              timeout: 2000
            });
          }, {
            once: true
          });
        } else {
          window.addEventListener('load', function() {
            window.setTimeout(hydrateDeferredSlides, 1200);
          }, {
            once: true
          });
        }

        setTrack(0);
        scheduleNext();
      })();
    </script>

  </main>