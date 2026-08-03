<?php

/**
 * @var string $wa_link
 * @var string $phone1_display
 * @var string $phone2_display
 * @var string $phonehtml1
 * @var string $phonehtml2
 * @var string $mail
 * @var string $mailhtml
 * @var string $facebookhtml
 * @var string $instagramhtml
 * @var string $youtubehtml
 * @var string $pinteresthtml
 * @var string $linkedinhtml
 */
?>
<!-- Footer -->
<footer>
    <!-- Main Footer -->
    <div class="footer-main">
        <div class="footer-main-overlay"></div>

        <!-- Contact Info Bar -->
        <div class="footer-contact-bar" style="position:relative; z-index:1; margin-bottom: 7px;">
            <div class="container">
                <div class="row align-items-center g-0">

                    <!-- To More Inquiry -->
                    <div class="col-12 col-sm-6 col-lg-3 fcb-item fcb-item-link">
                        <div class="fcb-icon-wrap fcb-icon-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="22"
                                height="22">
                                <path
                                    d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-3 12H7v-2h10v2zm0-3H7V9h10v2zm0-3H7V6h10v2z" />
                            </svg>
                        </div>
                        <div class="fcb-text">
                            <span class="fcb-title">To More Inquiry</span>
                            <span class="fcb-sub">Don't hesitate Call to Tripjyada</span>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <a href="<?= $wa_link ?>" target="_blank" rel="noopener"
                        class="col-12 col-sm-6 col-lg-3 fcb-item fcb-item-link">
                        <div class="fcb-icon-wrap fcb-icon-whatsapp">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="22"
                                height="22">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z" />
                            </svg>
                        </div>
                        <div class="fcb-text">
                            <span class="fcb-title">WhatsApp</span>
                            <span class="fcb-sub"><?= $phone1_display ?></span>
                        </div>
                    </a>

                    <!-- Mail Us -->
                    <a href="<?= $mailhtml ?>" class="col-12 col-sm-6 col-lg-3 fcb-item fcb-item-link">
                        <div class="fcb-icon-wrap fcb-icon-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="22"
                                height="22">
                                <path
                                    d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                        </div>
                        <div class="fcb-text">
                            <span class="fcb-title">Mail Us</span>
                            <span class="fcb-sub"><?= $mail ?></span>
                        </div>
                    </a>

                    <!-- Call Us -->
                    <div class="col-12 col-sm-6 col-lg-3 fcb-item fcb-item-last">
                        <div class="fcb-icon-wrap fcb-icon-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="22"
                                height="22">
                                <path
                                    d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                            </svg>
                        </div>
                        <div class="fcb-text">
                            <span class="fcb-title">Call Us</span>
                            <a href="<?= $phone1 ?>" class="fcb-sub no-anchor-style"><?= $phone1_display ?></a>
                            <a href="<?= $phone2 ?>" class="fcb-sub no-anchor-style"><?= $phone2_display ?></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /Contact Info Bar -->

        <div class="footer-top" style="position:relative; z-index:1;">
            <div class="container">
                <div class="row grid-gap">

                    <!-- Column 1: Logo & Info -->
                    <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up">
                        <div class="footer-widget">
                            <a href="<?= site_url() ?>" class="footer-logo d-inline-block mb-3"
                                style="background-color: #fff; border-radius: 10px;">
                                <img src="<?= base_url() ?>assets/images/logo.png" alt="Tripjyada Logo" width="150"
                                    height="auto" loading="lazy">
                            </a>
                            <p class="text text-16 fst-italic fw-600 text-white mb-1">Tripjyada Pvt Ltd</p>
                            <p class="text text-14 mb-3" style="color:rgba(255,255,255,0.6);">GSTIN : 19AATFT6367Q1ZS
                            </p>
                            <ul class="footer-social-round list-unstyled d-flex flex-wrap gap-2">
                                <li><a href="<?= $facebookhtml ?>" target="_blank" rel="noopener" aria-label="Facebook"
                                        class="fsr-link">
                                        <svg viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14">
                                            <path
                                                d="M6.667 10.255H8.75l.833-3.333H6.667V5.255c0-.858 0-1.667 1.666-1.667H8.75V.789C8.479.753 7.453.672 6.369.672c-2.262 0-3.869 1.381-3.869 3.917v2.333H0v3.333h2.5v7.083h3.333v-7.083z"
                                                fill="currentColor" />
                                        </svg>
                                    </a></li>
                                <li><a href="<?= $instagramhtml ?>" target="_blank" rel="noopener"
                                        aria-label="Instagram" class="fsr-link">
                                        <svg viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14">
                                            <path
                                                d="M9 0C6.562 0 6.25.01 5.291.054 4.333.098 3.677.252 3.105.473a4.9 4.9 0 0 0-1.77 1.152A4.9 4.9 0 0 0 .183 3.395C-.037 3.968-.19 4.624-.235 5.582-.279 6.541-.29 6.854-.29 9.29c0 2.437.01 2.75.055 3.708.044.958.198 1.614.42 2.187a4.9 4.9 0 0 0 1.152 1.77 4.9 4.9 0 0 0 1.771 1.152c.572.221 1.228.375 2.186.42C6.25 18.57 6.562 18.58 9 18.58s2.75-.01 3.708-.055c.958-.044 1.614-.198 2.187-.42a4.9 4.9 0 0 0 1.77-1.151 4.9 4.9 0 0 0 1.152-1.77c.221-.573.375-1.229.42-2.188C18.28 12.04 18.29 11.727 18.29 9.29s-.01-2.75-.054-3.708c-.045-.958-.199-1.614-.42-2.187A4.9 4.9 0 0 0 16.664 1.625 4.9 4.9 0 0 0 14.895.473C14.322.252 13.666.098 12.708.054 11.75.01 11.437 0 9 0zm0 1.622c2.396 0 2.68.009 3.625.052.875.04 1.35.187 1.667.31.419.163.718.357 1.032.671.314.314.508.613.671 1.032.123.317.27.792.31 1.667.043.945.052 1.23.052 3.624 0 2.396-.009 2.68-.052 3.625-.04.875-.187 1.35-.31 1.667-.163.419-.357.718-.671 1.032a2.778 2.778 0 0 1-1.032.671c-.317.123-.792.27-1.667.31-.945.043-1.229.052-3.625.052-2.396 0-2.68-.009-3.625-.052-.875-.04-1.35-.187-1.667-.31a2.778 2.778 0 0 1-1.032-.671 2.778 2.778 0 0 1-.671-1.032c-.123-.317-.27-.792-.31-1.667C1.631 11.97 1.622 11.686 1.622 9.29c0-2.395.009-2.68.052-3.624.04-.875.187-1.35.31-1.667.163-.419.357-.718.671-1.032a2.778 2.778 0 0 1 1.032-.671c.317-.123.792-.27 1.667-.31.945-.043 1.229-.052 3.625-.052zm0 2.76a4.908 4.908 0 1 0 0 9.816A4.908 4.908 0 0 0 9 4.382zm0 8.094a3.186 3.186 0 1 1 0-6.372 3.186 3.186 0 0 1 0 6.372zm6.247-8.286a1.146 1.146 0 1 1-2.292 0 1.146 1.146 0 0 1 2.292 0z"
                                                fill="currentColor" />
                                        </svg>
                                    </a></li>
                                <li><a href="<?= $youtubehtml ?>" target="_blank" rel="noopener" aria-label="YouTube"
                                        class="fsr-link">
                                        <svg viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14">
                                            <path
                                                d="M8.404 10.02L13.26 7.27 8.404 4.52v5.5zm10.815-7.18c.122.432.206 1.01.262 1.743.065.733.093 1.366.093 1.916l.056.77c0 2.008-.15 3.484-.411 4.428-.234.825-.777 1.357-1.619 1.586-.44.119-1.244.202-2.479.257-1.217.064-2.33.091-3.36.091l-1.487.055c-3.92 0-6.362-.147-7.326-.404-.842-.229-1.385-.761-1.619-1.586-.122-.43-.206-1.008-.262-1.741C2.003 8.443 1.975 7.81 1.975 7.26l-.056-.77C1.919 4.483 2.069 3.007 2.33 2.063c.234-.825.777-1.357 1.619-1.586.44-.119 1.244-.202 2.479-.257C7.644.156 8.758.128 9.787.128l1.487-.055c3.92 0 6.362.147 7.326.404.842.229 1.385.761 1.619 1.586z"
                                                fill="currentColor" />
                                        </svg>
                                    </a></li>
                                <li><a href="<?= $pinteresthtml ?>" target="_blank" rel="noopener"
                                        aria-label="Pinterest" class="fsr-link">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14">
                                            <path
                                                d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 0 1 .083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"
                                                fill="currentColor" />
                                        </svg>
                                    </a></li>
                                <li><a href="<?= $linkedinhtml ?>" target="_blank" rel="noopener" aria-label="LinkedIn"
                                        class="fsr-link">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14">
                                            <path
                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"
                                                fill="currentColor" />
                                        </svg>
                                    </a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Column 2: Contact Us -->
                    <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="50">
                        <div class="footer-widget footer-widget-menu">
                            <div class="widget-heading heading text-20 mb-3">Contact Us</div>
                            <ul class="footer-contact-list footer-menu list-unstyled">
                                <li class="footer-contact-item mb-3">
                                    <div class="svg-wrapper icon-map" style="color:#f17f00; flex-shrink:0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                            width="18" height="18">
                                            <path
                                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                        </svg>
                                    </div>
                                    <p class="text text-15"><strong>Registered Address:</strong> Shivmandir, Siliguri,
                                        Darjeeling – 734011</p>
                                </li>
                                <li class="footer-contact-item mb-3">
                                    <div class="svg-wrapper icon-map" style="color:#f17f00; flex-shrink:0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                            width="18" height="18">
                                            <path
                                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                        </svg>
                                    </div>
                                    <p class="text text-15"><strong>Corporate Office :</strong> 197, Jodhpur Gardens,
                                        Kolkata – 700045</p>
                                </li>
                                <li class="footer-contact-item">
                                    <div class="svg-wrapper icon-map" style="color:#f17f00; flex-shrink:0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                            width="18" height="18">
                                            <path
                                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                        </svg>
                                    </div>
                                    <p class="text text-15"><strong>Branch Office :</strong> Kachari Basti Rd,
                                        opposite Barbeque Nation, South Sarania, Ulubari, Guwahati, Assam 781007</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Column 3: Quick Links -->
                    <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="footer-widget footer-widget-menu">
                            <div class="widget-heading heading text-20 mb-3">Quick Links</div>
                            <ul class="footer-menu list-unstyled footer-circle-list">
                                <li><a href="<?= site_url() ?>" class="text text-16 link">Home</a></li>
                                <li><a href="<?= site_url('about') ?>" class="text text-16 link">About Us</a></li>
                                <li><a href="<?= site_url('contacts') ?>" class="text text-16 link">Contact Us</a>
                                </li>
                                <li><a href="<?= site_url('tour-package') ?>" class="text text-16 link">Tour
                                        Packages</a></li>
                                <li><a href="<?= site_url('contacts') ?>" class="text text-16 link">B2B Enquiry</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Column 4: Explore By Places -->
                    <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="150">
                        <div class="footer-widget footer-widget-menu">
                            <div class="widget-heading heading text-20 mb-3">Explore By Places</div>
                            <ul class="footer-menu list-unstyled footer-circle-list">
                                <li><a href="<?= site_url('tour-package') ?>" class="text text-16 link">Bhutan</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom" style="position:relative; z-index:1;">
            <div class="container">
                <div class="footer-copyright text text-16 text-center">
                    Copyright &copy;Tripjyada | All Right Reserved
                </div>
            </div>
        </div>

    </div>
    <!-- /Main Footer -->

</footer>

<!-- Package Payment Modal -->
<?php $this->load->view('payments/package_payment_modal'); ?>

<!-- Quote Modal -->
<?php $this->load->view('contacts/quotemodal'); ?>

<!-- Modal and Drawer Overlay -->
<drawer-opener id="drawer-overlay"></drawer-opener>

<!-- Scroll to Top Button -->
<scroll-top>
    <div class="scroll-to-top">
        <div class="svg-wrapper">
            <i class="fa-solid fa-arrow-up-long text-white"></i>
        </div>
    </div>
</scroll-top>

<!-- all js -->
<?php
$vendor_js_version = @filemtime(FCPATH . 'assets/js/vendor.js');
$main_js_version = @filemtime(FCPATH . 'assets/js/main.js');
?>
<script src="<?= base_url() ?>assets/js/vendor.js<?= $vendor_js_version ? '?v=' . $vendor_js_version : '' ?>" defer></script>
<script src="<?= base_url() ?>assets/js/main.js<?= $main_js_version ? '?v=' . $main_js_version : '' ?>" defer></script>

<!-- TripBot Chat Widget -->
<style>
#tripbot-widget{position:fixed;bottom:24px;right:24px;z-index:9999;font-family:inherit}
#tripbot-btn{width:60px;height:60px;border-radius:50%;background:#f97316;color:#fff;border:none;cursor:pointer;box-shadow:0 4px 16px rgba(249,115,22,.4);display:flex;align-items:center;justify-content:center;transition:transform .2s,box-shadow .2s}
#tripbot-btn:hover{transform:scale(1.08);box-shadow:0 6px 20px rgba(249,115,22,.5)}
#tripbot-panel{position:absolute;bottom:72px;right:0;width:360px;height:500px;background:#fff;border-radius:16px;box-shadow:0 8px 32px rgba(0,0,0,.18);display:flex;flex-direction:column;overflow:hidden;opacity:0;pointer-events:none;transform:translateY(12px) scale(.97);transition:opacity .2s,transform .2s}
#tripbot-panel.tb-open{opacity:1;pointer-events:all;transform:translateY(0) scale(1)}
#tripbot-head{background:#f97316;color:#fff;padding:14px 16px;display:flex;align-items:center;gap:10px;flex-shrink:0}
.tb-avatar{width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,.22);display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
.tb-info{flex:1}
.tb-name{font-weight:700;font-size:15px;line-height:1.2}
.tb-status{font-size:12px;opacity:.85}
#tripbot-close{background:none;border:none;color:#fff;cursor:pointer;padding:4px;opacity:.8;line-height:1}
#tripbot-close:hover{opacity:1}
#tripbot-msgs{flex:1;overflow-y:auto;padding:14px;display:flex;flex-direction:column;gap:10px;scroll-behavior:smooth}
.tb-msg{display:flex;max-width:86%}
.tb-msg.tb-user{align-self:flex-end;flex-direction:row-reverse}
.tb-msg.tb-bot{align-self:flex-start}
.tb-bubble{padding:9px 13px;border-radius:14px;font-size:14px;line-height:1.55;word-break:break-word}
.tb-bot .tb-bubble{background:#f3f4f6;color:#1f2937;border-radius:2px 14px 14px 14px}
.tb-user .tb-bubble{background:#f97316;color:#fff;border-radius:14px 2px 14px 14px}
.tb-typing-wrap{display:flex;gap:5px;padding:10px 14px;align-items:center}
.tb-dot{width:7px;height:7px;border-radius:50%;background:#9ca3af;animation:tb-bounce .9s infinite}
.tb-dot:nth-child(2){animation-delay:.15s}
.tb-dot:nth-child(3){animation-delay:.3s}
@keyframes tb-bounce{0%,60%,100%{transform:translateY(0)}30%{transform:translateY(-6px)}}
#tripbot-foot{padding:10px 12px;border-top:1px solid #f3f4f6;display:flex;gap:8px;flex-shrink:0}
#tripbot-input{flex:1;border:1.5px solid #e5e7eb;border-radius:24px;padding:9px 14px;font-size:14px;outline:none;resize:none;font-family:inherit;transition:border-color .2s;max-height:100px;min-height:40px;line-height:1.4}
#tripbot-input:focus{border-color:#f97316}
#tripbot-send{width:40px;height:40px;border-radius:50%;background:#f97316;border:none;cursor:pointer;color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background .2s;align-self:flex-end}
#tripbot-send:hover{background:#ea6a0a}
#tripbot-send:disabled{background:#d1d5db;cursor:not-allowed}
.tb-link{color:#f97316;text-decoration:underline}
@media(max-width:480px){#tripbot-panel{width:calc(100vw - 32px);right:-8px;height:430px}}
</style>

<div id="tripbot-widget">
    <div id="tripbot-panel" role="dialog" aria-label="TripBot Chat">
        <div id="tripbot-head">
            <div class="tb-avatar">✈</div>
            <div class="tb-info">
                <div class="tb-name">TripBot</div>
                <div class="tb-status">Tripjyada Travel Assistant</div>
            </div>
            <button id="tripbot-close" aria-label="Close chat">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="18" height="18"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
        </div>
        <div id="tripbot-msgs"></div>
        <div id="tripbot-foot">
            <textarea id="tripbot-input" placeholder="Ask about our packages..." rows="1"></textarea>
            <button id="tripbot-send" aria-label="Send message">
                <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
            </button>
        </div>
    </div>
    <button id="tripbot-btn" aria-label="Chat with TripBot" title="Chat with TripBot">
        <svg id="tb-icon-chat" viewBox="0 0 24 24" fill="currentColor" width="28" height="28"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
        <svg id="tb-icon-x" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="26" height="26" style="display:none"><path d="M18 6L6 18M6 6l12 12"/></svg>
    </button>
</div>

<script>
(function () {
    'use strict';
    var REPLY_URL = '<?= site_url("chatbot/reply") ?>';
    var history   = [];
    var busy      = false;
    var isOpen    = false;

    var panel    = document.getElementById('tripbot-panel');
    var btn      = document.getElementById('tripbot-btn');
    var closeBtn = document.getElementById('tripbot-close');
    var msgs     = document.getElementById('tripbot-msgs');
    var input    = document.getElementById('tripbot-input');
    var send     = document.getElementById('tripbot-send');
    var iconChat = document.getElementById('tb-icon-chat');
    var iconX    = document.getElementById('tb-icon-x');

    function togglePanel() {
        isOpen = !isOpen;
        panel.classList.toggle('tb-open', isOpen);
        iconChat.style.display = isOpen ? 'none' : 'block';
        iconX.style.display    = isOpen ? 'block' : 'none';
        if (isOpen) {
            if (msgs.children.length === 0) greet();
            input.focus();
            scrollDown();
        }
    }

    btn.addEventListener('click', togglePanel);
    closeBtn.addEventListener('click', function () { if (isOpen) togglePanel(); });

    function scrollDown() { msgs.scrollTop = msgs.scrollHeight; }

    function esc(str) {
        return String(str)
            .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function fmt(text) {
        return esc(text)
            .replace(/\*\*(.*?)\*\*/g,'<strong>$1</strong>')
            .replace(/\*(.*?)\*/g,'<em>$1</em>')
            .replace(/\[([^\]]+)\]\((https?:\/\/[^\)]+)\)/g,'<a href="$2" class="tb-link" target="_blank" rel="noopener">$1</a>')
            .replace(/(https?:\/\/[^\s<&]+)/g,'<a href="$1" class="tb-link" target="_blank" rel="noopener">$1</a>')
            .replace(/\n/g,'<br>');
    }

    function addMsg(role, text) {
        var div = document.createElement('div');
        div.className = 'tb-msg ' + (role === 'user' ? 'tb-user' : 'tb-bot');
        div.innerHTML = '<div class="tb-bubble">' + (role === 'user' ? esc(text) : fmt(text)) + '</div>';
        msgs.appendChild(div);
        scrollDown();
    }

    function showTyping() {
        var el = document.createElement('div');
        el.className = 'tb-msg tb-bot';
        el.id = 'tb-typing';
        el.innerHTML = '<div class="tb-bubble tb-typing-wrap"><div class="tb-dot"></div><div class="tb-dot"></div><div class="tb-dot"></div></div>';
        msgs.appendChild(el);
        scrollDown();
    }

    function hideTyping() {
        var el = document.getElementById('tb-typing');
        if (el) el.parentNode.removeChild(el);
    }

    function greet() {
        addMsg('bot', "Namaste! 🙏 I'm TripBot, your Tripjyada travel assistant.\n\nI can help you with:\n• Our tour packages & pricing\n• Travel FAQs & visa info\n• Booking & secure payment\n\nWhat would you like to know?");
    }

    function openPayment(action) {
        var modal = document.getElementById('packagePaymentModal');
        if (!modal) { addMsg('bot', 'Please visit our packages page to book. Our team will assist you!'); return; }

        window._tbBooking = action;

        modal.addEventListener('shown.bs.modal', function onShown() {
            modal.removeEventListener('shown.bs.modal', onShown);
            var d = window._tbBooking;
            if (!d) return;
            var nameEl  = document.getElementById('ppmPackageName');
            var priceEl = document.getElementById('ppmPackagePrice');
            var idEl    = document.getElementById('ppmPackageId');
            var slugEl  = document.getElementById('ppmPackageSlug');
            var catEl   = document.getElementById('ppmPackageCategorySlug');
            if (nameEl)  nameEl.textContent = d.package_title   || 'Selected Package';
            if (priceEl) priceEl.textContent = d.amount_display  || 'Rs 0';
            if (idEl)    idEl.value          = d.package_id      || '';
            if (slugEl)  slugEl.value        = d.package_slug    || '';
            if (catEl)   catEl.value         = d.package_category_slug || '';
            window._tbBooking = null;
        });

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            bootstrap.Modal.getOrCreateInstance(modal).show();
        } else if (typeof jQuery !== 'undefined') {
            jQuery('#packagePaymentModal').modal('show');
        }
    }

    function sendMessage() {
        var text = input.value.trim();
        if (!text || busy) return;
        input.value = '';
        input.style.height = 'auto';

        addMsg('user', text);
        history.push({ role: 'user', content: text });

        busy = true;
        send.disabled = true;
        showTyping();

        var historyToSend = history.slice(0, -1).slice(-16);
        var body = 'message=' + encodeURIComponent(text) +
                   '&history=' + encodeURIComponent(JSON.stringify(historyToSend));

        fetch(REPLY_URL, {
            method:  'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body:    body
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            hideTyping();
            busy = false;
            send.disabled = false;

            if (!data.ok) {
                addMsg('bot', 'Sorry, something went wrong. Please try again or contact us directly.');
                return;
            }

            addMsg('bot', data.message);
            history.push({ role: 'assistant', content: data.message });
            if (history.length > 20) history = history.slice(-20);

            if (data.action && data.action.type === 'open_payment') {
                setTimeout(function () { openPayment(data.action); }, 700);
            }
        })
        .catch(function () {
            hideTyping();
            busy = false;
            send.disabled = false;
            addMsg('bot', "Oops! I couldn't connect right now. Please WhatsApp or call us directly.");
        });
    }

    send.addEventListener('click', sendMessage);
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });
    input.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';
    });
})();
</script>
</body>

</html>
