<style>
.ppm-section-title { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .8px; color: #f97316; margin-bottom: 12px; }
.ppm-booking-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.ppm-breakdown-title { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .8px; color: #888; margin-bottom: 10px; }
.ppm-breakdown-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.ppm-breakdown-table tr { border-bottom: 1px solid #f0f0f0; }
.ppm-breakdown-table tr:last-child { border-bottom: none; }
.ppm-bd-label { padding: 6px 0; color: #555; }
.ppm-bd-amt { padding: 6px 0; text-align: right; color: #222; font-weight: 500; white-space: nowrap; }
.ppm-bd-total-row .ppm-bd-label,
.ppm-bd-total-row .ppm-bd-amt { padding-top: 10px; font-size: 15px; color: #111; border-top: 2px solid #e0e0e0; }
.ppm-advance-wrap { margin-top: 14px; }

/* Pay in Full — primary */
.ppm-full-opt { display: block; cursor: pointer; margin-bottom: 8px; }
.ppm-full-opt input[type="radio"] { position: absolute; opacity: 0; width: 0; height: 0; }
.ppm-full-btn { display: flex; align-items: center; justify-content: space-between; padding: 12px 14px; border: 2px solid #e0e0e0; border-radius: 10px; background: #fff; cursor: pointer; transition: all .15s; gap: 10px; }
.ppm-full-opt input[type="radio"]:checked + .ppm-full-btn { border-color: #f97316; background: linear-gradient(135deg,#fff7f0,#fff); box-shadow: 0 2px 10px rgba(249,115,22,.15); }
.ppm-full-inner { flex: 1; }
.ppm-full-label { font-size: 14px; font-weight: 700; color: #111; display: block; }
.ppm-full-opt input[type="radio"]:checked + .ppm-full-btn .ppm-full-label { color: #f97316; }
.ppm-full-sub { font-size: 11px; color: #888; margin-top: 2px; display: block; }
.ppm-full-opt input[type="radio"]:checked + .ppm-full-btn .ppm-full-sub { color: #16a34a; font-weight: 600; }
.ppm-full-badge { font-size: 10px; font-weight: 700; background: #f97316; color: #fff; padding: 3px 9px; border-radius: 20px; white-space: nowrap; flex-shrink: 0; }

/* Partial toggle link */
.ppm-partial-toggle { font-size: 12px; color: #aaa; cursor: pointer; display: flex; align-items: center; gap: 5px; margin-bottom: 6px; user-select: none; transition: color .15s; }
.ppm-partial-toggle:hover { color: #f97316; }

/* Partial options */
.ppm-partial-options { background: #f9f9f9; border: 1px solid #eee; border-radius: 10px; padding: 12px; }
.ppm-partial-row { display: flex; gap: 8px; margin-bottom: 10px; flex-wrap: wrap; }
.ppm-adv-opt { margin: 0; cursor: pointer; }
.ppm-adv-opt input[type="radio"] { position: absolute; opacity: 0; width: 0; height: 0; }
.ppm-adv-btn { display: inline-block; padding: 5px 16px; border: 1.5px solid #ddd; border-radius: 7px; font-size: 12px; font-weight: 600; color: #888; background: #fff; cursor: pointer; transition: all .15s; }
.ppm-adv-opt input[type="radio"]:checked + .ppm-adv-btn { border-color: #f97316; background: #fff7f0; color: #f97316; }
.ppm-pay-summary { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.ppm-pay-box { background: #fff; border: 1px solid #e8e8e8; border-radius: 8px; padding: 10px 12px; }
.ppm-pay-box.is-now { border-color: #f97316; background: #fff7f0; }
.ppm-pay-box-balance { border-color: #fca5a5 !important; background: #fff5f5 !important; }
.ppm-pay-box-label { font-size: 10px; color: #888; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 3px; }
.ppm-pay-box-amt { font-size: 16px; font-weight: 700; color: #222; }
.ppm-pay-box.is-now .ppm-pay-box-amt { color: #f97316; }
.ppm-pay-box-balance .ppm-pay-box-amt { color: #dc2626 !important; }
.ppm-partial-note { font-size: 11px; color: #888; margin-top: 8px; text-align: center; font-style: italic; }
.ppm-result { margin-top: 12px; }
.ppm-result:empty { margin-top: 0; }
.ppm-result-error { background: #fff5f5; border: 1px solid #fcc; border-radius: 8px; padding: 10px 12px; font-size: 13px; color: #c0392b; line-height: 1.5; }
.ppm-result-warn  { background: #fffbea; border: 1px solid #f5e07a; border-radius: 8px; padding: 10px 12px; font-size: 13px; color: #7d6608; line-height: 1.5; }
.ppm-result-success { background: #f0fdf4; border: 1px solid #86efac; border-radius: 8px; padding: 10px 12px; font-size: 13px; color: #166534; line-height: 1.5; }
/* Coupon */
.ppm-coupon-row { display: flex; gap: 8px; margin-top: 2px; }
.ppm-coupon-input { flex: 1; }
.ppm-coupon-btn { padding: 8px 14px; background: #f97316; color: #fff; border: none; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; white-space: nowrap; flex-shrink: 0; transition: background .15s; }
.ppm-coupon-btn:hover { background: #ea6b0a; }
.ppm-coupon-btn.is-remove { background: #64748b; }
.ppm-coupon-btn.is-remove:hover { background: #475569; }
.ppm-coupon-msg { font-size: 12px; margin-top: 7px; padding: 5px 10px; border-radius: 6px; display: none; }
.ppm-coupon-msg.ok  { display: block; background: #f0fdf4; border: 1px solid #86efac; color: #15803d; }
.ppm-coupon-msg.err { display: block; background: #fff5f5; border: 1px solid #fca5a5; color: #dc2626; }
.ppm-bd-discount { color: #15803d !important; font-weight: 700 !important; }

/* Child age inputs */
.ppm-child-ages-wrap { margin-top: 10px; display: none; }
.ppm-child-age-row { display: flex; align-items: center; gap: 8px; margin-bottom: 7px; }
.ppm-child-age-row label { font-size: 12px; color: #555; min-width: 72px; flex-shrink: 0; }
.ppm-child-age-row input { flex: 1; }
.ppm-child-age-note { font-size: 11px; color: #888; font-style: italic; margin-top: 4px; }

/* Itinerary preview section */
.ppm-itin-section { border: 1px solid #ffe5cc; border-radius: 10px; overflow: hidden; margin-bottom: 14px; }
.ppm-itin-toggle { display: flex; align-items: center; justify-content: space-between; padding: 10px 14px; background: #fff7f0; cursor: pointer; user-select: none; border: none; width: 100%; text-align: left; }
.ppm-itin-toggle-label { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .8px; color: #f97316; }
.ppm-itin-toggle-arrow { transition: transform .2s; color: #f97316; }
.ppm-itin-body { padding: 8px 14px 12px; }
.ppm-itin-day { display: flex; gap: 10px; padding: 7px 0; border-bottom: 1px solid #f5ece4; }
.ppm-itin-day:last-child { border-bottom: none; }
.ppm-itin-day-num { font-size: 10px; font-weight: 700; color: #f97316; min-width: 36px; padding-top: 2px; text-transform: uppercase; }
.ppm-itin-day-title { font-size: 12px; font-weight: 600; color: #1a1a1a; line-height: 1.4; }
.ppm-itin-day-stay { font-size: 11px; color: #888; margin-top: 2px; }
</style>

<div class="modal fade" id="packagePaymentModal" tabindex="-1" role="dialog" aria-labelledby="packagePaymentTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered ppm-dialog" role="document">
        <div class="modal-content ppm-modal-content">

            <div class="ppm-modal-header">
                <div>
                    <p class="ppm-kicker">Secure Booking</p>
                    <h4 class="ppm-title" id="packagePaymentTitle">Book Your Trip</h4>
                </div>
                <button type="button" class="ppm-close" data-bs-dismiss="modal" aria-label="Close">&#x2715;</button>
            </div>

            <div class="ppm-body-grid">

                <!-- Left column: form inputs -->
                <div class="ppm-col-left">

                    <div class="ppm-package-summary">
                        <div>
                            <div class="ppm-package-label">Package</div>
                            <div class="ppm-package-name" id="ppmPackageName">Selected Package</div>
                        </div>
                        <div class="ppm-package-price" id="ppmRateLabel">&#8377;0 / person / day</div>
                    </div>

                    <div id="ppmSuccessState" class="ppm-success-state" style="display:none">
                        <div class="ppm-success-badge">Booking Confirmed</div>
                        <h5 id="ppmSuccessTitle">Payment completed successfully.</h5>
                        <p id="ppmSuccessText">Your advance payment has been received. Our team will contact you shortly with trip details.</p>
                        <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:4px">
                            <a id="ppmInvoiceBtn" href="#" target="_blank" class="ppm-submit-btn" style="display:none;text-decoration:none;text-align:center;background:#1e293b">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="vertical-align:middle;margin-right:5px"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                Download Invoice
                            </a>
                            <button type="button" class="ppm-submit-btn" data-bs-dismiss="modal" style="flex:1">Close</button>
                        </div>
                    </div>

                    <div id="ppmFormState">

                        <div class="ppm-india-notice">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="flex-shrink:0;margin-top:2px"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>
                            <span>These rates are only for <strong>Indian nationals</strong>. SDF &amp; pricing may differ for foreign travelers.</span>
                        </div>

                        <div class="ppm-section">
                            <div class="ppm-section-title">Trip Details</div>
                            <div class="ppm-booking-grid">
                                <div class="ppm-field-wrap">
                                    <label class="ppm-label" for="ppmTravelDate">Travel Date</label>
                                    <input type="date" class="ppm-input" id="ppmTravelDate">
                                </div>
                                <div class="ppm-field-wrap">
                                    <label class="ppm-label" for="ppmNumDays">Number of Days</label>
                                    <input type="number" class="ppm-input" id="ppmNumDays" value="1" min="1" max="60" placeholder="e.g. 5">
                                </div>
                                <div class="ppm-field-wrap">
                                    <label class="ppm-label" for="ppmNumAdults">Adults</label>
                                    <input type="number" class="ppm-input" id="ppmNumAdults" value="2" min="2" max="2" placeholder="e.g. 2">
                                    <span class="ppm-field-note">Adults travelling must be minimum of 2</span>
                                </div>
                                <div class="ppm-field-wrap">
                                    <label class="ppm-label" for="ppmNumKids">Children</label>
                                    <input type="number" class="ppm-input" id="ppmNumKids" value="0" min="0" max="10" placeholder="e.g. 0">
                                </div>
                            </div>
                            <!-- Dynamic child age inputs -->
                            <div id="ppmChildAgesWrap" class="ppm-child-ages-wrap"></div>
                            <p class="ppm-child-note">&#9432; These rates are applicable for <strong>Indian nationals</strong> only. Children aged <strong>6 to 12</strong> pay half SDF.</p>
                        </div>

                        <!-- Tour Itinerary Preview -->
                        <div class="ppm-itin-section" id="ppmItinerarySection" style="display:none">
                            <button type="button" class="ppm-itin-toggle" id="ppmItinToggle" aria-expanded="false">
                                <span class="ppm-itin-toggle-label">&#128205; Tour Itinerary</span>
                                <svg class="ppm-itin-toggle-arrow" id="ppmItinArrow" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                            </button>
                            <div class="ppm-itin-body" id="ppmItinBody" style="display:none">
                                <div id="ppmItinDays"></div>
                            </div>
                        </div>

                        <form id="packagePaymentForm" onsubmit="return false;">
                            <input type="hidden" name="package_id" id="ppmPackageId" value="">
                            <input type="hidden" name="package_slug" id="ppmPackageSlug" value="">
                            <input type="hidden" name="package_category_slug" id="ppmPackageCategorySlug" value="">
                            <input type="hidden" name="travel_date" id="ppmTravelDateHidden">
                            <input type="hidden" name="num_days" id="ppmNumDaysHidden">
                            <input type="hidden" name="num_adults" id="ppmNumAdultsHidden">
                            <input type="hidden" name="num_kids" id="ppmNumKidsHidden">
                            <input type="hidden" name="advance_percent" id="ppmAdvancePercentHidden">
                            <input type="hidden" name="child_ages" id="ppmChildAgesHidden" value="[]">

                            <div class="ppm-section">
                                <div class="ppm-section-title">Your Details</div>
                                <?php
                                    $CI =& get_instance();
                                    $CI->load->library('session');
                                    $_sess_name  = htmlspecialchars($CI->session->userdata('tj_user_name')  ?? '', ENT_QUOTES);
                                    $_sess_email = htmlspecialchars($CI->session->userdata('tj_user_email') ?? '', ENT_QUOTES);
                                    $_sess_phone = htmlspecialchars($CI->session->userdata('tj_user_phone') ?? '', ENT_QUOTES);
                                ?>
                                <div class="ppm-field-wrap">
                                    <label class="ppm-label" for="ppmName">Full Name</label>
                                    <input type="text" class="ppm-input" id="ppmName" name="name" placeholder="Enter your full name" value="<?= $_sess_name ?>">
                                </div>
                                <div class="ppm-grid">
                                    <div class="ppm-field-wrap">
                                        <label class="ppm-label" for="ppmEmail">Email</label>
                                        <input type="email" class="ppm-input" id="ppmEmail" name="email" placeholder="name@example.com" value="<?= $_sess_email ?>">
                                    </div>
                                    <div class="ppm-field-wrap">
                                        <label class="ppm-label" for="ppmPhone">Phone</label>
                                        <input type="tel" class="ppm-input" id="ppmPhone" name="phone" placeholder="+91 9876543210" value="<?= $_sess_phone ?>">
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

                <!-- Right column: price sidebar -->
                <div class="ppm-col-right">
                    <div class="ppm-price-sidebar">

                        <div class="ppm-sidebar-empty" id="ppmSidebarEmpty">
                            <div class="ppm-sidebar-empty-icon">&#8377;</div>
                            <p>Enter your trip details to see the price breakdown</p>
                        </div>

                        <div class="ppm-breakdown" id="ppmBreakdown" style="display:none">
                            <div class="ppm-breakdown-title">Price Breakdown</div>
                            <table class="ppm-breakdown-table">
                                <tr>
                                    <td class="ppm-bd-label" id="bdBaseLabel">Base amount</td>
                                    <td class="ppm-bd-amt">&#8377;<span id="bdBase">0</span></td>
                                </tr>
                                <tr id="bdSdfRow" style="display:none">
                                    <td class="ppm-bd-label" id="bdSdfLabel">SDF</td>
                                    <td class="ppm-bd-amt">&#8377;<span id="bdSdf">0</span></td>
                                </tr>
                                <tr>
                                    <td class="ppm-bd-label" id="bdGuideLabel">Guide charges</td>
                                    <td class="ppm-bd-amt">&#8377;<span id="bdGuide">0</span></td>
                                </tr>
                                <tr id="bdDiscountRow" style="display:none">
                                    <td class="ppm-bd-label ppm-bd-discount" id="bdDiscountLabel">Coupon Discount</td>
                                    <td class="ppm-bd-amt ppm-bd-discount">&#8722; &#8377;<span id="bdDiscount">0</span></td>
                                </tr>
                                <tr>
                                    <td class="ppm-bd-label">GST (5%)</td>
                                    <td class="ppm-bd-amt">&#8377;<span id="bdGst">0</span></td>
                                </tr>
                                <tr class="ppm-bd-total-row">
                                    <td class="ppm-bd-label"><strong>Grand Total</strong></td>
                                    <td class="ppm-bd-amt"><strong>&#8377;<span id="bdTotal">0</span></strong></td>
                                </tr>
                            </table>

                            <div class="ppm-coupon-row" style="margin-top:12px">
                                <input type="text" class="ppm-input ppm-coupon-input" id="ppmCouponInput" placeholder="Have a coupon code?" autocomplete="off" style="text-transform:uppercase;font-size:12px">
                                <button type="button" id="ppmCouponApplyBtn" class="ppm-coupon-btn">Apply</button>
                            </div>
                            <div class="ppm-coupon-msg" id="ppmCouponMsg"></div>
                            <input type="hidden" name="coupon_code" id="ppmCouponCodeHidden" value="" form="packagePaymentForm">

                            <div class="ppm-advance-wrap">
                                <!-- Pay in Full — primary CTA -->
                                <label class="ppm-full-opt">
                                    <input type="radio" name="advance_percent_ui" value="100" checked>
                                    <span class="ppm-full-btn">
                                        <span class="ppm-full-inner">
                                            <span class="ppm-full-label">Pay in Full</span>
                                            <span class="ppm-full-sub">Final Invoice issued instantly · No balance due</span>
                                        </span>
                                        <span class="ppm-full-badge">Recommended</span>
                                    </span>
                                </label>

                                <!-- Partial options — secondary -->
                                <div class="ppm-partial-toggle" id="ppmPartialToggle">
                                    <span>or pay a smaller advance</span>
                                    <svg id="ppmPartialArrow" xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                                </div>
                                <div class="ppm-partial-options" id="ppmPartialOptions" style="display:none">
                                    <div class="ppm-partial-row">
                                        <label class="ppm-adv-opt">
                                            <input type="radio" name="advance_percent_ui" value="20">
                                            <span class="ppm-adv-btn">20%</span>
                                        </label>
                                        <label class="ppm-adv-opt">
                                            <input type="radio" name="advance_percent_ui" value="30">
                                            <span class="ppm-adv-btn">30%</span>
                                        </label>
                                        <label class="ppm-adv-opt">
                                            <input type="radio" name="advance_percent_ui" value="40">
                                            <span class="ppm-adv-btn">40%</span>
                                        </label>
                                    </div>
                                    <div class="ppm-pay-summary">
                                        <div class="ppm-pay-box is-now">
                                            <div class="ppm-pay-box-label">Pay Now</div>
                                            <div class="ppm-pay-box-amt" id="bdAdvance">&#8377;0</div>
                                        </div>
                                        <div class="ppm-pay-box ppm-pay-box-balance">
                                            <div class="ppm-pay-box-label">Balance Due on Arrival</div>
                                            <div class="ppm-pay-box-amt" id="bdBalance">&#8377;0</div>
                                        </div>
                                    </div>
                                    <div class="ppm-partial-note" id="ppmPartialNote">Proforma Invoice issued now · Final Invoice after full payment</div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" form="packagePaymentForm" id="packagePaymentSubmit" class="ppm-submit-btn">Continue to Pay</button>
                        <div id="packagePaymentResult" class="ppm-result"></div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function () {
    var $modal        = $('#packagePaymentModal');
    var $formState    = $('#ppmFormState');
    var $successState = $('#ppmSuccessState');
    var $result       = $('#packagePaymentResult');
    var $submit       = $('#packagePaymentSubmit');
    var $breakdown    = $('#ppmBreakdown');
    var $sidebarEmpty = $('#ppmSidebarEmpty');
    var createOrderUrl        = "<?= site_url('payment/create-order') ?>";
    var verifyUrl             = "<?= site_url('payment/verify') ?>";
    var invoiceBaseUrl        = "<?= site_url('user/invoice/') ?>";
    var applyCouponUrl        = "<?= site_url('payment/apply-coupon') ?>";
    var razorpayScriptPromise = null;
    var packageRate           = 0;
    var isBhutanPackage       = false;
    var sdfExempt             = false;
    var appliedDiscountPct    = 0;
    var appliedCouponCode     = '';
    var packageItinerary      = [];
    var phuentsholingNights   = 0;
    var pricingData           = null; // PAX-based season pricing (Bhutan new packages)

    // Detect season from travel date string (YYYY-MM-DD)
    function detectSeason(dateStr) {
        if (!dateStr) return null;
        var parts = dateStr.split('-');
        if (parts.length !== 3) return null;
        var m = parseInt(parts[1], 10);
        var d = parseInt(parts[2], 10);
        if (m >= 9 || (m === 1 && d <= 10)) return 'season';
        if (m >= 7 && m <= 8)               return 'offseason';
        return 'season'; // default for Feb–Jun
    }

    // Find the smallest PAX bracket >= totalPax
    function getPaxBracket(totalPax) {
        var brackets = [2, 4, 6, 8, 10, 12];
        for (var i = 0; i < brackets.length; i++) {
            if (totalPax <= brackets[i]) return String(brackets[i]);
        }
        return '12';
    }

    // Resolve per-person rate from pricingData, date & PAX
    function resolvePaxRate(dateStr, totalPax) {
        if (!pricingData) return 0;
        var season = detectSeason(dateStr);
        if (!season) return 0;
        var tier   = pricingData[season];
        if (!tier || !tier.pax) return 0;
        var bracket = getPaxBracket(totalPax);
        return parseInt(tier.pax[bracket]) || 0;
    }

    function fmtINR(n) {
        return parseInt(n || 0).toLocaleString('en-IN');
    }

    function getGapDays() {
        var v = $('#ppmTravelDate').val();
        if (!v) return 999;
        var today  = new Date(); today.setHours(0, 0, 0, 0);
        var travel = new Date(v); travel.setHours(0, 0, 0, 0);
        var diff   = Math.floor((travel - today) / 86400000);
        return diff < 0 ? 0 : diff;
    }

    function updatePartialOptions(gapDays) {
        var avail = [];
        if      (gapDays >= 90) avail = [20, 30, 40];
        else if (gapDays >= 60) avail = [30, 40];
        else if (gapDays >= 30) avail = [40];
        // < 30 days: only 100% allowed

        // Show / hide individual partial radio buttons
        $('.ppm-adv-opt').each(function () {
            var pct = parseInt($(this).find('input').val(), 10);
            $(this).toggle(avail.indexOf(pct) !== -1);
        });

        if (avail.length === 0) {
            // No partial options available — force 100% and hide toggle
            $('#ppmPartialToggle').hide();
            $('#ppmPartialOptions').hide();
            $('#ppmPartialArrow').css('transform', 'rotate(0deg)');
            $('input[name="advance_percent_ui"][value="100"]').prop('checked', true);
            $('#ppmPartialNote').text('Full payment required — travel date is within 30 days.');
        } else {
            $('#ppmPartialToggle').show();
            var noteText = gapDays < 60
                ? 'Only 40% advance available for this travel date.'
                : (gapDays < 90 ? 'Options limited — select an earlier travel date for all options.' : 'Proforma Invoice issued now · Final Invoice after full payment');
            $('#ppmPartialNote').text(noteText);
        }

        // If current selection is no longer in avail, revert to 100%
        var curPct = parseInt($('input[name="advance_percent_ui"]:checked').val(), 10);
        if (curPct !== 100 && avail.indexOf(curPct) === -1) {
            $('input[name="advance_percent_ui"][value="100"]').prop('checked', true);
            $('#ppmPartialOptions').hide();
            $('#ppmPartialArrow').css('transform', 'rotate(0deg)');
        }

        recalculate();
    }

    function recalculate() {
        var days    = Math.max(1, parseInt($('#ppmNumDays').val())   || 1);
        var nights  = Math.max(0, days - 1);
        var adults  = 2;
        $('#ppmNumAdults').val(2);
        var kids    = Math.max(0, parseInt($('#ppmNumKids').val())   || 0);
        var persons = adults + kids;
        var advPct  = parseInt($('input[name="advance_percent_ui"]:checked').val(), 10) || 100;

        // PAX-based pricing: resolve rate from travel date + total persons
        if (pricingData) {
            var dateStr = $('#ppmTravelDate').val();
            var resolved = resolvePaxRate(dateStr, persons);
            if (resolved > 0) {
                packageRate = resolved;
                var season = detectSeason(dateStr);
                var bracket = getPaxBracket(persons);
                var seasonLabel = season === 'offseason' ? 'Off Season' : 'Peak Season';
                $('#ppmRateLabel').text('₹' + fmtINR(packageRate) + '/person (' + seasonLabel + ', ' + bracket + ' PAX)');
            } else if (!dateStr) {
                $('#ppmRateLabel').text('Select travel date to see your rate');
                $breakdown.hide();
                $sidebarEmpty.show();
                return;
            }
        }

        if (packageRate <= 0) {
            $breakdown.hide();
            $sidebarEmpty.show();
            return;
        }

        var base = packageRate * persons;
        var sdf  = 0;

        if (isBhutanPackage && nights > 0) {
            // Phuentsholing arrival night(s) are SDF-free; charge only remaining nights
            var chargeableNights = Math.max(0, nights - phuentsholingNights);

            // Adult SDF: ₹1,200 per adult × chargeable nights
            var adultSdf = 1200 * adults * chargeableNights;

            // Child SDF: check each child's age first, then × chargeable nights
            var childSdf = 0;
            var cFree = 0, cHalf = 0, cFull = 0;
            $('#ppmChildAgesWrap .ppm-child-age-input').each(function () {
                var age = parseInt($(this).val());
                if (isNaN(age) || $(this).val().trim() === '') return; // skip unfilled
                if      (age < 6)  { cFree++; }
                else if (age <= 12) { cHalf++; childSdf += 600  * chargeableNights; }
                else               { cFull++; childSdf += 1200 * chargeableNights; }
            });

            sdf = adultSdf + childSdf;

            var nw = chargeableNights === 1 ? ' night' : ' nights';
            var sdfLbl = '';
            if (chargeableNights > 0) {
                sdfLbl = '₹1,200 × ' + adults + (adults > 1 ? ' adults' : ' adult') + ' × ' + chargeableNights + nw;
                if (cFull > 0) sdfLbl += ' + ₹1,200 × ' + cFull + (cFull > 1 ? ' children' : ' child') + ' (>12 yrs) × ' + chargeableNights + nw;
                if (cHalf > 0) sdfLbl += ' + ₹600 × '   + cHalf + (cHalf > 1 ? ' children' : ' child') + ' (6–12 yrs) × ' + chargeableNights + nw;
                if (cFree > 0) sdfLbl += ' + Free × '    + cFree + (cFree > 1 ? ' children' : ' child') + ' (<6 yrs)';
            }
            if (phuentsholingNights > 0) {
                var freeNote = phuentsholingNights + ' Phuentsholing night' + (phuentsholingNights > 1 ? 's' : '') + ' free';
                sdfLbl = sdfLbl ? sdfLbl + '  |  ' + freeNote : freeNote;
            }
            $('#bdSdfLabel').text('SDF (' + (sdfLbl || '₹0') + ')');
            $('#bdSdfRow').show();
        } else {
            $('#bdSdfRow').hide();
        }

        // PAX-priced packages already include guide + tax; skip those line-items
        var guide, gst, gross;
        var personWord = persons > 1 ? 'persons' : 'person';
        var dayWord    = days > 1 ? 'days' : 'day';
        if (pricingData) {
            guide = 0;
            var sub = base + sdf;
            gst   = 0;
            gross = sub;
            $('#bdGuideRow').hide();
            $('#bdGstRow').hide();
        } else {
            guide = 3000 * days;
            var sub = base + sdf + guide;
            gst   = Math.ceil(sub * 0.05);
            gross = sub + gst;
            $('#bdGuideRow').show();
            $('#bdGstRow').show();
        }
        var discount = appliedDiscountPct > 0 ? Math.floor(gross * appliedDiscountPct / 100) : 0;
        var total    = gross - discount;
        var advance  = advPct === 100 ? total : Math.ceil(total * advPct / 100);
        var balance  = total - advance;

        $('#bdBaseLabel').text('Package (₹' + fmtINR(packageRate) + '/person × ' + persons + ' ' + personWord + ')');
        $('#bdGuideLabel').text('Guide (₹3,000 × ' + days + ' ' + dayWord + ')');
        $('#bdBase').text(fmtINR(base));
        $('#bdSdf').text(fmtINR(sdf));
        $('#bdGuide').text(fmtINR(guide));
        $('#bdGst').text(fmtINR(gst));

        if (discount > 0) {
            $('#bdDiscountLabel').text('Coupon Discount (' + appliedDiscountPct + '% off)');
            $('#bdDiscount').text(fmtINR(discount));
            $('#bdDiscountRow').show();
        } else {
            $('#bdDiscountRow').hide();
        }

        $('#bdTotal').text(fmtINR(total));
        $('#bdAdvance').text('₹' + fmtINR(advance));
        $('#bdBalance').text('₹' + fmtINR(balance));

        if (advPct === 100) {
            $submit.text('Pay ₹' + fmtINR(total) + ' — Full Payment');
        } else {
            $submit.text('Pay ₹' + fmtINR(advance) + ' Now · ₹' + fmtINR(balance) + ' due later');
        }

        // Warn when advance exceeds Razorpay's default ₹5,00,000 limit
        var RAZORPAY_MAX = 500000;
        var $limitWarn = $('#ppmLimitWarning');
        if (advance > RAZORPAY_MAX) {
            if (!$limitWarn.length) {
                $submit.after('<div id="ppmLimitWarning" style="margin-top:8px;padding:8px 12px;background:#fff3cd;border:1px solid #ffc107;border-radius:8px;font-size:12px;color:#856404;line-height:1.5">' +
                    '&#9888; Advance of ₹' + fmtINR(advance) + ' exceeds the ₹5,00,000 gateway limit. Please select a smaller advance % above.' +
                    '</div>');
            } else {
                $limitWarn.html('&#9888; Advance of ₹' + fmtINR(advance) + ' exceeds the ₹5,00,000 gateway limit. Please select a smaller advance % above.').show();
            }
            $submit.prop('disabled', true);
        } else {
            $('#ppmLimitWarning').hide();
            $submit.prop('disabled', false);
        }

        $sidebarEmpty.hide();
        $breakdown.show();
    }

    function escapeHtml(v) {
        return $('<div>').text(v == null ? '' : String(v)).html();
    }

    function renderChildAges() {
        var n = Math.max(0, parseInt($('#ppmNumKids').val()) || 0);
        var $wrap = $('#ppmChildAgesWrap');
        if (n === 0) { $wrap.hide().empty(); recalculate(); return; }
        // Preserve existing values
        var existing = [];
        $wrap.find('.ppm-child-age-input').each(function () { existing.push($(this).val()); });
        var html = '';
        for (var i = 0; i < n; i++) {
            var prev = existing[i] !== undefined ? escapeHtml(existing[i]) : '';
            html += '<div class="ppm-child-age-row">'
                  + '<label for="ppmChildAge' + i + '">Child ' + (i + 1) + ' age</label>'
                  + '<input type="number" class="ppm-input ppm-child-age-input" id="ppmChildAge' + i + '" min="0" max="17" placeholder="Age in years" value="' + prev + '">'
                  + '</div>';
        }
        var ageNote = isBhutanPackage
            ? 'SDF: under 6 = free · 6–12 = ₹600/night · above 12 = ₹1,200/night'
            : 'Age required for SDF calculation on Bhutan packages';
        html += '<div class="ppm-child-age-note">' + ageNote + '</div>';
        $wrap.html(html).show();
        $wrap.find('.ppm-child-age-input').on('input change', recalculate);
        recalculate();
    }

    function renderItinerary(itin) {
        var $sec = $('#ppmItinerarySection');
        if (!itin || !itin.length) { $sec.hide(); return; }
        var html = '';
        $.each(itin, function (i, d) {
            var dayLabel = d.day || ('Day ' + (i + 1));
            var title    = d.title || '';
            var stay     = d.stay  || '';
            html += '<div class="ppm-itin-day">'
                  + '<div class="ppm-itin-day-num">' + escapeHtml(dayLabel) + '</div>'
                  + '<div>'
                  + '<div class="ppm-itin-day-title">' + escapeHtml(title) + '</div>'
                  + (stay ? '<div class="ppm-itin-day-stay">&#127960; Stay: ' + escapeHtml(stay) + '</div>' : '')
                  + '</div></div>';
        });
        $('#ppmItinDays').html(html);
        $sec.show();
    }

    function showResult(msg, type, showRetry) {
        var cls = type === 'success' ? 'ppm-result-success' : (type === 'warn' ? 'ppm-result-warn' : 'ppm-result-error');
        var retry = showRetry ? '<br><button type="button" id="ppmRetryBtn" style="margin-top:8px;padding:7px 18px;background:#f97316;color:#fff;border:none;border-radius:6px;font-size:13px;font-weight:600;cursor:pointer;">Try Again</button>' : '';
        $result.html('<div class="' + cls + '">' + escapeHtml(msg) + retry + '</div>');
    }

    function setSubmitState(busy, label) {
        $submit.prop('disabled', busy).text(label);
    }

    function resetModal() {
        $('#packagePaymentForm')[0].reset();
        $('#ppmTravelDate').val('');
        $('#ppmNumDays').val('1');
        $('#ppmNumAdults').val('2');
        $('#ppmNumKids').val('0');
        $('#ppmChildAgesWrap').hide().empty();
        $('#ppmChildAgesHidden').val('[]');
        $('#ppmItinerarySection').hide();
        $('#ppmItinBody').hide();
        $('#ppmItinArrow').css('transform', 'rotate(0deg)');
        packageItinerary    = [];
        phuentsholingNights = 0;
        $('input[name="advance_percent_ui"][value="100"]').prop('checked', true);
        $('#ppmPartialOptions').hide();
        $('#ppmPartialArrow').css('transform', 'rotate(0deg)');
        $('.ppm-adv-opt').show();
        $('#ppmPartialToggle').show();
        $result.empty();
        $formState.show();
        $successState.hide();
        $breakdown.hide();
        $sidebarEmpty.show();
        $submit.prop('disabled', false).text('Continue to Pay');
        packageRate        = 0;
        isBhutanPackage    = false;
        sdfExempt          = false;
        pricingData        = null;
        appliedDiscountPct = 0;
        appliedCouponCode  = '';
        $('#ppmCouponInput').val('').prop('readonly', false);
        $('#ppmCouponCodeHidden').val('');
        $('#ppmCouponMsg').removeClass('ok err').hide();
        $('#ppmCouponApplyBtn').text('Apply').removeClass('is-remove').prop('disabled', false);
        $('#ppmLimitWarning').remove();
    }

    function loadRazorpayScript() {
        if (window.Razorpay) return $.Deferred().resolve().promise();
        if (razorpayScriptPromise) return razorpayScriptPromise;
        razorpayScriptPromise = $.Deferred();
        var s = document.createElement('script');
        s.src = 'https://checkout.razorpay.com/v1/checkout.js';
        s.async = true;
        s.onload = function () { razorpayScriptPromise.resolve(); };
        s.onerror = function () { razorpayScriptPromise.reject(new Error('Razorpay checkout could not be loaded.')); };
        document.head.appendChild(s);
        return razorpayScriptPromise.promise();
    }

    function showSuccess(msg, detail, localId) {
        $('#ppmSuccessTitle').text(msg || 'Booking confirmed!');
        $('#ppmSuccessText').text(detail || 'Your advance payment has been received. Our team will contact you shortly.');
        if (localId) {
            $('#ppmInvoiceBtn').attr('href', invoiceBaseUrl + localId).show();
        } else {
            $('#ppmInvoiceBtn').hide();
        }
        $formState.hide();
        $successState.show();
    }

    function openCheckout(orderData) {
        var options = {
            key: orderData.key,
            amount: orderData.amount,
            currency: orderData.currency,
            name: orderData.name,
            description: orderData.description,
            image: orderData.image,
            order_id: orderData.order_id,
            prefill: orderData.prefill || {},
            theme: { color: orderData.theme_color || '#f97316' },
            modal: {
                confirm_close: true,
                ondismiss: function () { setSubmitState(false, orderData.submit_label || 'Continue to Pay'); }
            },
            handler: function (response) {
                setSubmitState(true, 'Verifying payment…');
                $.ajax({
                    type: 'POST', url: verifyUrl, dataType: 'json',
                    data: {
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id:   response.razorpay_order_id,
                        razorpay_signature:  response.razorpay_signature
                    }
                }).done(function (res) {
                    if (res && res.ok) {
                        var detail = res.captured
                            ? 'Payment ID: ' + (res.payment_id || '') + '. Balance of ' + (res.balance_display || '') + ' is due on arrival.'
                            : 'Payment received; awaiting final Razorpay capture.';
                        showSuccess(res.message, detail, res.local_id || null);
                        $result.empty();
                        return;
                    }
                    showResult((res && res.message) ? res.message : 'Verification failed. Contact support with your payment reference.', 'error');
                    setSubmitState(false, orderData.submit_label || 'Continue to Pay');
                }).fail(function (xhr) {
                    var msg = 'Verification failed. Contact support with your payment reference.';
                    if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                    showResult(msg, 'error');
                    setSubmitState(false, orderData.submit_label || 'Continue to Pay');
                });
            }
        };

        var rzp = new Razorpay(options);
        if (typeof rzp.on === 'function') {
            rzp.on('payment.failed', function (resp) {
                var errMsg = 'Payment was not completed.';
                if (resp && resp.error && resp.error.description) errMsg = resp.error.description;
                showResult(errMsg + ' You can try again below.', 'error', true);
                setSubmitState(false, orderData.submit_label || 'Continue to Pay');
                $result.off('click', '#ppmRetryBtn').on('click', '#ppmRetryBtn', function () {
                    $result.empty();
                    rzp.open();
                });
            });
        }
        rzp.open();
    }

    $modal.on('show.bs.modal', function (e) {
        resetModal();
        var $t = $(e.relatedTarget || []);
        packageRate     = parseInt($t.data('packageRate'), 10) || 0;
        isBhutanPackage = parseInt($t.data('isBhutan'), 10)  === 1;
        sdfExempt       = parseInt($t.data('sdfExempt'), 10) === 1;

        // PAX-based pricing JSON (new Bhutan packages)
        try {
            var raw = $t.data('pricingJson');
            pricingData = (raw && typeof raw === 'object') ? raw : null;
        } catch(ex) { pricingData = null; }

        try { packageItinerary = $t.data('itinerary') || []; } catch(ex) { packageItinerary = []; }
        if (!Array.isArray(packageItinerary)) { packageItinerary = []; }
        // Count nights stayed at Phuentsholing — those specific nights are SDF-free
        phuentsholingNights = 0;
        $.each(packageItinerary, function (i, d) {
            var stay = ((d.stay || '') + '').toLowerCase();
            if (stay.indexOf('phuentsholing') !== -1 || stay.indexOf('phuntsholing') !== -1) {
                phuentsholingNights++;
            }
        });
        // Fallback: if itinerary has no stay data but package text flags Phuentsholing, assume 1 free night
        if (phuentsholingNights === 0 && sdfExempt) { phuentsholingNights = 1; }

        var autoNumDays  = parseInt($t.data('numDays'), 10) || 0;
        if (autoNumDays > 0) { $('#ppmNumDays').val(autoNumDays); }
        $('#ppmPackageName').text($t.data('packageTitle') || 'Selected Package');
        if (pricingData) {
            $('#ppmRateLabel').text('Select travel date to see your rate');
        } else {
            $('#ppmRateLabel').text(packageRate > 0 ? '₹' + fmtINR(packageRate) + ' / person' : 'Price on Request');
        }
        $('#ppmPackageId').val($t.data('packageId') || '');
        $('#ppmPackageSlug').val($t.data('packageSlug') || '');
        $('#ppmPackageCategorySlug').val($t.data('packageCategorySlug') || '');
        renderItinerary(packageItinerary);
        recalculate();
    });

    $modal.on('hidden.bs.modal', resetModal);

    // Travel date change — update partial options AND reprice for PAX packages
    $('#ppmTravelDate').on('change', function () {
        updatePartialOptions(getGapDays());
        if (pricingData) recalculate();
    });

    // Partial options toggle
    $('#ppmPartialToggle').on('click', function () {
        var $opts = $('#ppmPartialOptions');
        var open  = $opts.is(':visible');
        $opts.slideToggle(180);
        $('#ppmPartialArrow').css('transform', open ? 'rotate(0deg)' : 'rotate(180deg)');
        if (!open) {
            // Opening: switch to first visible partial option if currently 100%
            if ($('input[name="advance_percent_ui"]:checked').val() === '100') {
                $('.ppm-adv-opt:visible input').first().prop('checked', true);
                recalculate();
            }
        }
    });

    // When 100% is selected, collapse partial panel
    $modal.on('change', 'input[name="advance_percent_ui"]', function () {
        if ($(this).val() === '100') {
            $('#ppmPartialOptions').slideUp(180);
            $('#ppmPartialArrow').css('transform', 'rotate(0deg)');
        }
        recalculate();
    });

    $('#ppmNumDays, #ppmNumAdults').on('input change', recalculate);
    $('#ppmNumKids').on('input change', renderChildAges);

    // Itinerary accordion toggle
    $('#ppmItinToggle').on('click', function () {
        var $body  = $('#ppmItinBody');
        var $arrow = $('#ppmItinArrow');
        var open   = $body.is(':visible');
        $body.slideToggle(180);
        $arrow.css('transform', open ? 'rotate(0deg)' : 'rotate(180deg)');
        $(this).attr('aria-expanded', open ? 'false' : 'true');
    });

    // Coupon apply / remove
    $('#ppmCouponApplyBtn').on('click', function () {
        var $btn = $(this);
        var $msg = $('#ppmCouponMsg');

        // Remove mode
        if ($btn.hasClass('is-remove')) {
            appliedDiscountPct = 0;
            appliedCouponCode  = '';
            $('#ppmCouponInput').val('').prop('readonly', false);
            $('#ppmCouponCodeHidden').val('');
            $btn.text('Apply').removeClass('is-remove');
            $msg.removeClass('ok err').hide();
            recalculate();
            return;
        }

        var code  = $('#ppmCouponInput').val().trim().toUpperCase();
        var pkgId = $('#ppmPackageId').val() || 0;

        if (!code) {
            $msg.removeClass('ok').addClass('err').text('Please enter a coupon code.').show();
            return;
        }

        $btn.prop('disabled', true).text('Checking…');
        $msg.removeClass('ok err').hide();

        $.ajax({
            type: 'POST',
            url: applyCouponUrl,
            dataType: 'json',
            data: { coupon_code: code, package_id: pkgId }
        }).done(function (res) {
            if (res && res.ok) {
                appliedDiscountPct = res.discount_percent;
                appliedCouponCode  = code;
                $('#ppmCouponInput').val(code).prop('readonly', true);
                $('#ppmCouponCodeHidden').val(code);
                $btn.text('Remove').addClass('is-remove').prop('disabled', false);
                $msg.removeClass('err').addClass('ok').text(res.message || ('Coupon applied! ' + res.discount_percent + '% off')).show();
                recalculate();
            } else {
                $btn.text('Apply').prop('disabled', false);
                $msg.removeClass('ok').addClass('err').text((res && res.message) ? res.message : 'Invalid or expired coupon code.').show();
            }
        }).fail(function (xhr) {
            var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Could not validate coupon. Please try again.';
            $btn.text('Apply').prop('disabled', false);
            $msg.removeClass('ok').addClass('err').text(msg).show();
        });
    });

    $('#packagePaymentForm').on('submit', function () {
        $result.empty();

        var travelDate = $('#ppmTravelDate').val();
        var numDays    = parseInt($('#ppmNumDays').val()) || 0;
        var numAdults  = parseInt($('#ppmNumAdults').val()) || 0;
        var numKids    = parseInt($('#ppmNumKids').val()) || 0;
        var advPct     = parseInt($('input[name="advance_percent_ui"]:checked').val()) || 0;

        if (!travelDate) { showResult('Please select your travel date.', 'error'); return; }
        if (numDays < 1)  { showResult('Please enter a valid number of days (minimum 1).', 'error'); return; }
        if (numAdults < 1){ showResult('Please enter at least 1 adult.', 'error'); return; }
        if (!advPct)      { showResult('Please choose an advance payment option.', 'error'); return; }

        // Collect child ages and validate
        var childAges = [];
        var agesValid = true;
        $('#ppmChildAgesWrap .ppm-child-age-input').each(function (idx) {
            var v = $(this).val().trim();
            if (v === '') { agesValid = false; return false; }
            var age = parseInt(v);
            if (isNaN(age) || age < 0 || age > 17) { agesValid = false; return false; }
            childAges.push(age);
        });
        if (numKids > 0 && !agesValid) {
            showResult('Please enter a valid age (0–17) for each child.', 'error');
            return;
        }
        $('#ppmChildAgesHidden').val(JSON.stringify(childAges));

        $('#ppmTravelDateHidden').val(travelDate);
        $('#ppmNumDaysHidden').val(numDays);
        $('#ppmNumAdultsHidden').val(numAdults);
        $('#ppmNumKidsHidden').val(numKids);
        $('#ppmAdvancePercentHidden').val(advPct);

        var submitLabel = $submit.text();
        setSubmitState(true, 'Creating secure order…');

        var formData = $(this).serialize();
        if (appliedCouponCode) {
            formData += '&coupon_code=' + encodeURIComponent(appliedCouponCode);
        }

        $.ajax({
            type: 'POST',
            url: createOrderUrl,
            data: formData,
            dataType: 'json'
        }).done(function (res) {
            if (!res || !res.ok) {
                showResult((res && res.message) ? res.message : 'Could not create order. Please try again.', 'error');
                setSubmitState(false, submitLabel);
                return;
            }
            res.submit_label = submitLabel;
            loadRazorpayScript().done(function () {
                openCheckout(res);
            }).fail(function () {
                showResult('Razorpay checkout could not be loaded. Please refresh and try again.', 'error');
                setSubmitState(false, submitLabel);
            });
        }).fail(function (xhr) {
            var msg = 'Could not create order. Please try again.';
            if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
            showResult(msg, 'error');
            setSubmitState(false, submitLabel);
        });
    });
});
</script>
