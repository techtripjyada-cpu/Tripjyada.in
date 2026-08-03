<!-- Hero Banner -->
<div class="tnc-hero">
    <div class="tnc-hero-overlay"></div>
    <div class="tnc-hero-content">
        <h1 class="tnc-hero-title">Terms &amp; Conditions</h1>
        <ul class="tnc-breadcrumb">
            <li><a href="<?= site_url() ?>">Home</a></li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="currentColor">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.09 5.41C7.25 5.57 7.33 5.78 7.33 6s-.08.43-.24.59L2.38 11.3a1.12 1.12 0 0 1-1.59-.01 1.12 1.12 0 0 1-.01-1.58L5.32 6 .79 1.87A1.12 1.12 0 1 1 2.37.69L7.09 5.41Z"/>
                </svg>
            </li>
            <li class="active">Terms &amp; Conditions</li>
        </ul>
    </div>
</div>

<!-- Tab Navigation -->
<section class="tnc-section">
    <div class="container">
        <div class="tnc-tabs-wrapper">
            <div class="tnc-tabs" role="tablist">
                <button class="tnc-tab active" role="tab" data-tab="general" aria-selected="true">General Policies</button>
                <button class="tnc-tab" role="tab" data-tab="payment" aria-selected="false">Payment Policies</button>
                <button class="tnc-tab" role="tab" data-tab="cancellation" aria-selected="false">Cancellation Policies</button>
                <button class="tnc-tab" role="tab" data-tab="bypass" aria-selected="false">Bypass Policies</button>
                <button class="tnc-tab" role="tab" data-tab="other" aria-selected="false">Other Policies</button>
            </div>
        </div>

        <!-- Tab Panels -->
        <div class="tnc-panels">

            <!-- General Policies -->
            <div class="tnc-panel active" id="tab-general">
                <h2 class="tnc-panel-title">General</h2>
                <p class="tnc-intro">The Terms and Conditions define how a user interacts with our services and establish the company's stand on the usage of these services. This document governs the relationship a customer has with our services. Upon acceptance, a user will by default be agreeing to all the clauses mentioned below.</p>

                <div class="tnc-items">
                    <div class="tnc-item">
                        <h3>Tour Price</h3>
                        <p>The tour price may change depending on how many people join the trip. Prices quoted at the time of booking are subject to revision in the event of a significant change in group size, currency fluctuation, or increase in fuel/permit costs. We will inform you of any such changes before they take effect.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Accommodations</h3>
                        <p>In some places, you won't find fancy hotels because they are in remote areas. So, don't expect things like 24/7 electricity, hot water, or Wi-Fi in these places. We do our best to ensure comfortable stays but cannot guarantee amenities that are unavailable at specific destinations.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Itinerary Changes</h3>
                        <p>TripJyada reserves the right to alter itineraries due to unforeseen circumstances such as weather, road conditions, government restrictions, or force majeure events. We will make every effort to minimize disruption and provide reasonable alternatives at no additional cost.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Health &amp; Fitness</h3>
                        <p>Some of our tours involve trekking, high-altitude travel, and physically demanding activities. Guests are responsible for assessing their own fitness level and informing us of any medical conditions before booking. TripJyada is not liable for health complications arising from undisclosed conditions.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Travel Documents</h3>
                        <p>Travellers are solely responsible for ensuring they hold valid travel documents including passports, visas, and permits. TripJyada will assist in obtaining required permits wherever possible but is not liable for denied entries resulting from incomplete or invalid documents.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Liability</h3>
                        <p>TripJyada acts as an agent for hotels, transport, and other service providers. We are not liable for any injury, loss, damage, or delay caused by third-party service providers. We recommend all travellers purchase comprehensive travel insurance before departure.</p>
                    </div>
                </div>
            </div>

            <!-- Payment Policies -->
            <div class="tnc-panel" id="tab-payment">
                <h2 class="tnc-panel-title">Payment Policies</h2>
                <p class="tnc-intro">Our payment policies are designed to be simple and transparent. Please read the following carefully to understand the payment structure for your booking with TripJyada.</p>

                <div class="tnc-items">
                    <div class="tnc-item">
                        <h3>Advance Payment</h3>
                        <p>An advance payment of 10–30% of the total tour cost is required to confirm your booking. The exact percentage depends on the package and departure date. Your booking slot will not be secured until this advance is received.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Balance Payment</h3>
                        <p>The remaining balance is due on the day of arrival or departure, as agreed at the time of booking. In some cases, full payment may be required prior to departure — this will be clearly communicated during booking confirmation.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Payment Methods</h3>
                        <p>We accept payments via UPI, debit/credit cards, net banking, and bank transfers through our secure Razorpay payment gateway. Cash payments may be accepted for balance due at the time of departure with prior agreement.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Failure to Pay</h3>
                        <p>If the balance payment is not received by the agreed due date, TripJyada reserves the right to cancel the booking. In such cases, the advance payment may be forfeited as per the cancellation policy. We will attempt to contact you before taking any action.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Price Inclusions &amp; Exclusions</h3>
                        <p>All quoted prices include accommodation, meals, transport, and guide services as specified in the itinerary. Prices exclude airfare (unless stated), personal expenses, travel insurance, visa fees, and any optional activities not listed in the package.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Currency &amp; Taxes</h3>
                        <p>All prices are quoted in Indian Rupees (INR). Applicable taxes (GST) will be added at the time of invoice generation. Any bank charges or transaction fees are borne by the customer.</p>
                    </div>
                </div>
            </div>

            <!-- Cancellation Policies -->
            <div class="tnc-panel" id="tab-cancellation">
                <h2 class="tnc-panel-title">Cancellation Policies</h2>
                <p class="tnc-intro">We understand that plans can change. Our cancellation policy is structured to be fair while also covering the costs we incur on your behalf when a booking is made.</p>

                <div class="tnc-items">
                    <div class="tnc-item">
                        <h3>Cancellation by Customer</h3>
                        <p>All cancellation requests must be submitted in writing via email to <a href="mailto:info@tripjyada.com">info@tripjyada.com</a>. Cancellations are effective from the date the written request is received.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Cancellation Charges</h3>
                        <div class="tnc-table-wrap">
                            <table class="tnc-table">
                                <thead>
                                    <tr>
                                        <th>Days Before Departure</th>
                                        <th>Cancellation Charge</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>More than 30 days</td><td>10% of total tour cost</td></tr>
                                    <tr><td>15 – 30 days</td><td>25% of total tour cost</td></tr>
                                    <tr><td>7 – 14 days</td><td>50% of total tour cost</td></tr>
                                    <tr><td>Less than 7 days</td><td>100% of total tour cost (No Refund)</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tnc-item">
                        <h3>Refund Processing</h3>
                        <p>Eligible refunds will be processed within 7–14 business days to the original payment method. Bank transfer timelines may vary. TripJyada is not responsible for delays caused by the customer's bank.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>No-Show Policy</h3>
                        <p>If a traveller fails to arrive at the designated departure point without prior notice, the booking will be treated as a no-show and 100% of the tour cost will be forfeited. No refund will be issued.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Cancellation by TripJyada</h3>
                        <p>In rare circumstances such as insufficient group size, natural disasters, or government-imposed travel restrictions, TripJyada may cancel a tour. In such cases, a full refund of all amounts paid will be issued, or an alternative tour date will be offered.</p>
                    </div>
                </div>
            </div>

            <!-- Bypass Policies -->
            <div class="tnc-panel" id="tab-bypass">
                <h2 class="tnc-panel-title">Bypass Policies</h2>
                <p class="tnc-intro">Certain circumstances beyond our control may require adjustments to the planned itinerary. The following policies govern how TripJyada handles such situations.</p>

                <div class="tnc-items">
                    <div class="tnc-item">
                        <h3>Force Majeure</h3>
                        <p>TripJyada is not liable for any failure or delay in performance arising from causes beyond our reasonable control, including but not limited to acts of God, natural disasters, war, terrorism, civil unrest, strikes, government actions, or pandemics. In such events, we will attempt to provide alternative arrangements.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Route &amp; Destination Changes</h3>
                        <p>In the event of road closures, landslides, or adverse weather conditions, TripJyada guides and drivers may bypass specific routes or destinations for the safety of travellers. No refund will be issued for bypassed destinations due to safety concerns, but reasonable alternative sightseeing may be arranged.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Permit &amp; Entry Restrictions</h3>
                        <p>Some destinations require special permits which are subject to government approval. If permits are denied at the last minute due to government restrictions, those sections of the itinerary will be bypassed and replaced with comparable alternatives where possible.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Accommodation Substitution</h3>
                        <p>In rare situations where pre-booked accommodations become unavailable due to unforeseen circumstances, TripJyada reserves the right to substitute with accommodations of a similar standard. We will inform travellers as early as possible of any such changes.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Medical Emergencies</h3>
                        <p>In the event of a medical emergency during the tour, TripJyada staff will assist in arranging evacuation or medical care. Any costs incurred for emergency medical services, evacuation, or unplanned overnight stays are the responsibility of the traveller or their travel insurance provider.</p>
                    </div>
                </div>
            </div>

            <!-- Other Policies -->
            <div class="tnc-panel" id="tab-other">
                <h2 class="tnc-panel-title">Other Policies</h2>
                <p class="tnc-intro">The following miscellaneous policies apply to all bookings and interactions with TripJyada's services.</p>

                <div class="tnc-items">
                    <div class="tnc-item">
                        <h3>Privacy Policy</h3>
                        <p>TripJyada collects personal information including name, phone number, and email address solely for the purpose of tour coordination and communication. We do not sell or share your personal data with third parties except as required to fulfill your booking (e.g., hotels, permit authorities). Your data is stored securely and in compliance with applicable Indian data protection laws.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Code of Conduct</h3>
                        <p>Travellers are expected to behave respectfully towards fellow travellers, local communities, guides, and staff. Any traveller whose conduct is deemed disruptive, abusive, or illegal may be removed from the tour at their own expense. No refund will be issued in such cases.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Photography &amp; Content</h3>
                        <p>TripJyada may photograph or video travellers during tours for promotional use on our website and social media. By joining a tour, you consent to such use unless you explicitly opt out in writing before departure. Drone usage at certain heritage sites and restricted zones is prohibited and the traveller is solely responsible for compliance.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Environmental Responsibility</h3>
                        <p>We are committed to sustainable and responsible travel. Travellers are expected to follow Leave No Trace principles, avoid littering, and respect local flora and fauna. TripJyada reserves the right to refuse service to anyone who knowingly damages natural or cultural heritage sites.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Dispute Resolution</h3>
                        <p>Any disputes arising from TripJyada's services shall first be addressed through direct communication with our customer support team. If unresolved, disputes shall be subject to the jurisdiction of courts in Siliguri, West Bengal, India, governed by Indian law.</p>
                    </div>
                    <div class="tnc-item">
                        <h3>Policy Updates</h3>
                        <p>TripJyada reserves the right to update these Terms &amp; Conditions at any time without prior notice. The most current version will always be available on this page. Continued use of our services after any changes constitutes your acceptance of the updated terms.</p>
                    </div>
                </div>
            </div>

        </div><!-- /.tnc-panels -->
    </div><!-- /.container -->
</section>

<style>
/* ── Hero Banner ───────────────────────────────────────── */
.tnc-hero {
    position: relative;
    background: #0d1b2a;
    min-height: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.tnc-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 50% at 20% 50%, rgba(0,180,160,.18) 0%, transparent 70%),
        radial-gradient(ellipse 40% 60% at 80% 30%, rgba(0,100,200,.15) 0%, transparent 70%);
}
.tnc-hero-overlay {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(0,180,160,.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,180,160,.06) 1px, transparent 1px);
    background-size: 60px 60px;
}
.tnc-hero-content {
    position: relative;
    z-index: 1;
    text-align: center;
    padding: 60px 20px;
}
.tnc-hero-title {
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 700;
    color: #fff;
    margin: 0 0 16px;
    letter-spacing: -0.5px;
}
.tnc-breadcrumb {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 14px;
    color: rgba(255,255,255,.55);
}
.tnc-breadcrumb a {
    color: rgba(255,255,255,.7);
    text-decoration: none;
    transition: color .2s;
}
.tnc-breadcrumb a:hover { color: #fff; }
.tnc-breadcrumb svg { color: rgba(255,255,255,.4); }
.tnc-breadcrumb .active { color: rgba(255,255,255,.9); }

/* ── Section wrapper ───────────────────────────────────── */
.tnc-section {
    padding: 60px 0 80px;
    background: #f8fafc;
}

/* ── Tabs ──────────────────────────────────────────────── */
.tnc-tabs-wrapper {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    margin-bottom: 40px;
    border-bottom: 2px solid #e2e8f0;
}
.tnc-tabs-wrapper::-webkit-scrollbar { display: none; }
.tnc-tabs {
    display: flex;
    gap: 0;
    min-width: max-content;
}
.tnc-tab {
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 600;
    color: #64748b;
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    margin-bottom: -2px;
    cursor: pointer;
    white-space: nowrap;
    transition: color .2s, border-color .2s;
}
.tnc-tab:hover { color: #f97316; }
.tnc-tab.active {
    color: #f97316;
    border-bottom-color: #f97316;
}

/* ── Panels ────────────────────────────────────────────── */
.tnc-panel { display: none; }
.tnc-panel.active { display: block; }

.tnc-panel-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 12px;
}
.tnc-intro {
    font-size: 15px;
    color: #475569;
    line-height: 1.7;
    margin-bottom: 32px;
    max-width: 800px;
}

/* ── Policy items ──────────────────────────────────────── */
.tnc-items {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.tnc-item {
    background: #fff;
    border-radius: 12px;
    padding: 24px 28px;
    border-left: 4px solid #f97316;
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
}
.tnc-item h3 {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 8px;
}
.tnc-item p {
    font-size: 14px;
    color: #475569;
    line-height: 1.7;
    margin: 0;
}
.tnc-item a {
    color: #f97316;
    text-decoration: none;
}
.tnc-item a:hover { text-decoration: underline; }

/* ── Cancellation table ────────────────────────────────── */
.tnc-table-wrap {
    overflow-x: auto;
    margin-top: 8px;
}
.tnc-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    min-width: 360px;
}
.tnc-table th {
    background: #fff8f3;
    color: #c2410c;
    font-weight: 700;
    padding: 10px 16px;
    text-align: left;
    border-bottom: 2px solid #fed7aa;
}
.tnc-table td {
    padding: 10px 16px;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
}
.tnc-table tr:last-child td { border-bottom: none; }
.tnc-table tr:hover td { background: #fffaf7; }
</style>

<script>
(function () {
    var tabs   = document.querySelectorAll('.tnc-tab');
    var panels = document.querySelectorAll('.tnc-panel');

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var target = this.dataset.tab;

            tabs.forEach(function (t) {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
            });
            panels.forEach(function (p) { p.classList.remove('active'); });

            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');
            document.getElementById('tab-' + target).classList.add('active');
        });
    });
}());
</script>
