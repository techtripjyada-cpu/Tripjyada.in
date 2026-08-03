    <div class="home-gallery-carousel mt-100">
        <div class="container">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
                <div class="carousel-inner">

                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <picture>
                            <source media="(max-width: 767px)"
                                srcset="<?= base_url() ?>assets/images/home_sl_banner/10.svg" type="image/svg+xml">
                            <img src="<?= base_url() ?>assets/images/banner/ban1.jpg" class="d-block w-100"
                                alt="Bhutan Tour" loading="lazy">
                        </picture>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <picture>
                            <source media="(max-width: 767px)"
                                srcset="<?= base_url() ?>assets/images/home_sl_banner/11.svg" type="image/svg+xml">
                            <img src="<?= base_url() ?>assets/images/banner/ban2.jpg" class="d-block w-100"
                                alt="Bhutan Landscape" loading="lazy">
                        </picture>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <picture>
                            <source media="(max-width: 767px)"
                                srcset="<?= base_url() ?>assets/images/home_sl_banner/12.svg" type="image/svg+xml">
                            <img src="<?= base_url() ?>assets/images/banner/ban3.jpg" class="d-block w-100"
                                alt="Bhutan Destination" loading="lazy">
                        </picture>
                    </div>

                    <!-- Slide 4 -->
                    <div class="carousel-item">
                        <picture>
                            <source media="(max-width: 767px)"
                                srcset="<?= base_url() ?>assets/images/home_sl_banner/13.svg" type="image/svg+xml">
                            <img src="<?= base_url() ?>assets/images/banner/ban4.jpg" class="d-block w-100"
                                alt="Bhutan Adventure" loading="lazy">
                        </picture>
                    </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <script>
        (function() {
            var el = document.getElementById('carouselExampleAutoplaying');
            if (!el) return;
            var startX = 0;
            el.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
            }, {
                passive: true
            });
            el.addEventListener('touchend', function(e) {
                var diff = startX - e.changedTouches[0].clientX;
                if (Math.abs(diff) < 40) return;
                if (diff > 0) {
                    el.querySelector('.carousel-control-next').click();
                } else {
                    el.querySelector('.carousel-control-prev').click();
                }
            }, {
                passive: true
            });
        })();
    </script>