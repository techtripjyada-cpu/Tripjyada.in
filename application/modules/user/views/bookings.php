<h1 class="ud-page-title">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#f97316"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"/></svg>
    My Bookings
</h1>
<p class="ud-page-sub">All your trip bookings with TripJyada</p>

<?php if (empty($bookings)): ?>
<div class="ud-card">
    <div class="ud-empty">
        <span class="ud-empty-icon">🧳</span>
        <h5>No bookings found.</h5>
        <p>It looks like you haven't booked anything yet.<br>Discover exciting trips and start creating unforgettable memories today.</p>
        <a href="<?= site_url('tour-package') ?>" style="display:inline-block;margin-top:16px;padding:10px 24px;background:#f97316;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:13px">Explore Trips</a>
    </div>
</div>
<?php else: ?>

<div class="bk-list">
<?php foreach ($bookings as $b):
    $is_paid   = in_array($b['local_status'], array('paid', 'captured', 'verified'));
    $pkg       = isset($b['_package']) ? $b['_package'] : null;
    $itinerary = ($pkg && !empty($pkg['itinerary_json'])) ? json_decode($pkg['itinerary_json'], true) : array();
    $inclusions = ($pkg && !empty($pkg['inclusions_json'])) ? json_decode($pkg['inclusions_json'], true) : array();
    $exclusions = ($pkg && !empty($pkg['exclusions_json'])) ? json_decode($pkg['exclusions_json'], true) : array();
    $pkg_url   = ($pkg && !empty($pkg['slug']) && !empty($pkg['category_slug']))
                 ? site_url($pkg['category_slug'] . '/' . $pkg['slug'])
                 : '';
?>
<div class="bk-card">
    <!-- Card Header -->
    <div class="bk-card-head">
        <div class="bk-card-head-left">
            <div class="bk-booking-id">#<?= $b['id'] ?></div>
            <div class="bk-package-name">
                <?php if ($pkg_url): ?>
                    <a href="<?= $pkg_url ?>" target="_blank"><?= htmlspecialchars($b['package_title']) ?></a>
                <?php else: ?>
                    <?= htmlspecialchars($b['package_title']) ?>
                <?php endif; ?>
            </div>
            <div class="bk-meta">
                <?php if (!empty($b['travel_date'])): ?>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5"/></svg>
                    <?= date('d M Y', strtotime($b['travel_date'])) ?>
                </span>
                <?php endif; ?>
                <?php if (!empty($b['num_days'])): ?>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    <?= $b['num_days'] ?> day<?= $b['num_days'] > 1 ? 's' : '' ?>
                </span>
                <?php endif; ?>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>
                    <?= (int)$b['num_adults'] ?> adult<?= $b['num_adults'] > 1 ? 's' : '' ?><?= $b['num_kids'] > 0 ? ' · ' . $b['num_kids'] . ' kid' . ($b['num_kids'] > 1 ? 's' : '') : '' ?>
                </span>
            </div>
        </div>
        <div class="bk-card-head-right">
            <span class="ud-badge ud-badge-<?= htmlspecialchars($b['local_status']) ?>"><?= ucfirst($b['local_status']) ?></span>
            <div class="bk-amount-paid">&#8377;<?= number_format($b['amount_rupees']) ?> paid</div>
            <?php if ($b['balance_due'] > 0): ?>
            <div class="bk-balance-due">&#8377;<?= number_format($b['balance_due']) ?> due</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Card Actions -->
    <div class="bk-card-actions">
        <button class="bk-toggle-btn" data-id="<?= $b['id'] ?>">
            <svg class="bk-toggle-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            View Details
        </button>
        <?php if ($is_paid): ?>
        <a class="bk-invoice-btn" href="<?= site_url('user/invoice/' . $b['id']) ?>" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Download Invoice
        </a>
        <?php endif; ?>
    </div>

    <!-- Expandable Detail -->
    <div class="bk-detail" id="bk-detail-<?= $b['id'] ?>" style="display:none">

        <!-- Price Breakdown -->
        <div class="bk-detail-section">
            <div class="bk-detail-title">Price Breakdown</div>
            <div class="bk-price-grid">
                <?php if ($b['base_amount'] > 0): ?>
                <div class="bk-price-row"><span>Base Amount</span><span>&#8377;<?= number_format($b['base_amount']) ?></span></div>
                <?php endif; ?>
                <?php if ($b['sdf_amount'] > 0): ?>
                <div class="bk-price-row"><span>SDF (Sustainable Dev. Fee)</span><span>&#8377;<?= number_format($b['sdf_amount']) ?></span></div>
                <?php endif; ?>
                <?php if ($b['gst_amount'] > 0): ?>
                <div class="bk-price-row"><span>GST (5%)</span><span>&#8377;<?= number_format($b['gst_amount']) ?></span></div>
                <?php endif; ?>
                <?php if ($b['total_amount'] > 0): ?>
                <div class="bk-price-row bk-price-total"><span>Total Amount</span><span>&#8377;<?= number_format($b['total_amount']) ?></span></div>
                <?php endif; ?>
                <div class="bk-price-row bk-price-paid"><span>Advance Paid (<?= $b['advance_percent'] ?>%)</span><span>&#8377;<?= number_format($b['amount_rupees']) ?></span></div>
                <?php if ($b['balance_due'] > 0): ?>
                <div class="bk-price-row bk-price-balance"><span>Balance Due</span><span>&#8377;<?= number_format($b['balance_due']) ?></span></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Payment Info -->
        <?php if (!empty($b['razorpay_payment_id']) || !empty($b['payment_method'])): ?>
        <div class="bk-detail-section">
            <div class="bk-detail-title">Payment Info</div>
            <div class="bk-price-grid">
                <?php if (!empty($b['razorpay_payment_id'])): ?>
                <div class="bk-price-row"><span>Payment ID</span><span style="font-family:monospace;font-size:12px"><?= htmlspecialchars($b['razorpay_payment_id']) ?></span></div>
                <?php endif; ?>
                <?php if (!empty($b['payment_method'])): ?>
                <div class="bk-price-row"><span>Payment Method</span><span><?= ucfirst(htmlspecialchars($b['payment_method'])) ?></span></div>
                <?php endif; ?>
                <?php if (!empty($b['verified_at'])): ?>
                <div class="bk-price-row"><span>Paid On</span><span><?= date('d M Y, h:i A', strtotime($b['verified_at'])) ?></span></div>
                <?php endif; ?>
                <div class="bk-price-row"><span>Booked On</span><span><?= date('d M Y', strtotime($b['created_at'])) ?></span></div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Inclusions / Amenities -->
        <?php if (!empty($inclusions)): ?>
        <div class="bk-detail-section">
            <div class="bk-detail-title">What's Included</div>
            <ul class="bk-inclusion-list">
                <?php foreach ($inclusions as $inc): ?>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#16a34a"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                    <?= htmlspecialchars(is_array($inc) ? ($inc['text'] ?? $inc['title'] ?? '') : $inc) ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Exclusions -->
        <?php if (!empty($exclusions)): ?>
        <div class="bk-detail-section">
            <div class="bk-detail-title">Not Included</div>
            <ul class="bk-inclusion-list bk-exclusion-list">
                <?php foreach ($exclusions as $exc): ?>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#dc2626"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                    <?= htmlspecialchars(is_array($exc) ? ($exc['text'] ?? $exc['title'] ?? '') : $exc) ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Itinerary -->
        <?php if (!empty($itinerary)): ?>
        <div class="bk-detail-section">
            <div class="bk-detail-title">Itinerary</div>
            <div class="bk-itinerary">
                <?php foreach ($itinerary as $i => $day): ?>
                <div class="bk-itin-day">
                    <div class="bk-itin-marker">
                        <div class="bk-itin-dot"></div>
                        <?php if ($i < count($itinerary) - 1): ?><div class="bk-itin-line"></div><?php endif; ?>
                    </div>
                    <div class="bk-itin-content">
                        <div class="bk-itin-label">Day <?= $i + 1 ?></div>
                        <div class="bk-itin-title"><?= htmlspecialchars(is_array($day) ? ($day['title'] ?? $day['heading'] ?? '') : $day) ?></div>
                        <?php if (is_array($day) && !empty($day['description'])): ?>
                        <div class="bk-itin-desc"><?= nl2br(htmlspecialchars($day['description'])) ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div><!-- /.bk-detail -->
</div><!-- /.bk-card -->
<?php endforeach; ?>
</div><!-- /.bk-list -->

<?php if ($total > $per_page): ?>
<div class="ud-pagination">
    <?php for ($i = 1; $i <= ceil($total / $per_page); $i++): ?>
    <a href="?page=<?= $i ?>" class="ud-page-btn <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>
<?php endif; ?>
<?php endif; ?>

<style>
/* Booking cards */
.bk-list{display:flex;flex-direction:column;gap:16px}
.bk-card{background:#fff;border-radius:14px;border:1px solid #e2e8f0;overflow:hidden}
.bk-card-head{display:flex;justify-content:space-between;align-items:flex-start;gap:12px;padding:18px 20px}
.bk-card-head-left{flex:1;min-width:0}
.bk-booking-id{font-size:11px;color:#94a3b8;font-weight:600;margin-bottom:4px}
.bk-package-name{font-size:15px;font-weight:700;color:#1e293b;margin-bottom:6px}
.bk-package-name a{color:#1e293b;text-decoration:none}
.bk-package-name a:hover{color:#f97316}
.bk-meta{display:flex;flex-wrap:wrap;gap:10px;font-size:12px;color:#64748b}
.bk-meta span{display:inline-flex;align-items:center;gap:4px}
.bk-card-head-right{display:flex;flex-direction:column;align-items:flex-end;gap:5px;flex-shrink:0}
.bk-amount-paid{font-size:14px;font-weight:700;color:#1e293b}
.bk-balance-due{font-size:12px;color:#dc2626;font-weight:600}

/* Actions row */
.bk-card-actions{display:flex;gap:10px;padding:0 20px 16px;flex-wrap:wrap}
.bk-toggle-btn{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border:1.5px solid #e2e8f0;border-radius:8px;background:#fff;font-size:13px;font-weight:600;color:#64748b;cursor:pointer;transition:all .15s}
.bk-toggle-btn:hover{border-color:#f97316;color:#f97316}
.bk-toggle-btn.open .bk-toggle-icon{transform:rotate(180deg)}
.bk-toggle-icon{transition:transform .2s}
.bk-invoice-btn{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border:1.5px solid #f97316;border-radius:8px;background:#fff7ed;font-size:13px;font-weight:600;color:#f97316;text-decoration:none;transition:all .15s}
.bk-invoice-btn:hover{background:#f97316;color:#fff}

/* Detail panel */
.bk-detail{border-top:1px solid #f1f5f9;padding:20px}
.bk-detail-section{margin-bottom:20px}
.bk-detail-section:last-child{margin-bottom:0}
.bk-detail-title{font-size:12px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px}

/* Price grid */
.bk-price-grid{display:flex;flex-direction:column;gap:0;border:1px solid #f1f5f9;border-radius:10px;overflow:hidden}
.bk-price-row{display:flex;justify-content:space-between;padding:9px 14px;font-size:13px;border-bottom:1px solid #f1f5f9;color:#475569}
.bk-price-row:last-child{border-bottom:none}
.bk-price-total{font-weight:700;color:#1e293b;background:#f8fafc}
.bk-price-paid{font-weight:700;color:#16a34a;background:#f0fdf4}
.bk-price-balance{font-weight:700;color:#dc2626;background:#fef2f2}

/* Inclusions */
.bk-inclusion-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:7px}
.bk-inclusion-list li{display:flex;align-items:flex-start;gap:8px;font-size:13px;color:#374151;line-height:1.5}
.bk-inclusion-list svg{flex-shrink:0;margin-top:2px}

/* Itinerary */
.bk-itinerary{display:flex;flex-direction:column;gap:0}
.bk-itin-day{display:flex;gap:12px}
.bk-itin-marker{display:flex;flex-direction:column;align-items:center;flex-shrink:0;width:20px}
.bk-itin-dot{width:12px;height:12px;border-radius:50%;background:#f97316;border:2px solid #fff;box-shadow:0 0 0 2px #f97316;flex-shrink:0;margin-top:3px}
.bk-itin-line{flex:1;width:2px;background:#e2e8f0;margin:4px 0}
.bk-itin-content{padding-bottom:16px;flex:1}
.bk-itin-label{font-size:11px;font-weight:700;color:#f97316;text-transform:uppercase;letter-spacing:.5px;margin-bottom:2px}
.bk-itin-title{font-size:13.5px;font-weight:700;color:#1e293b}
.bk-itin-desc{font-size:13px;color:#475569;line-height:1.6;margin-top:4px}
</style>

<script>
(function(){
    document.querySelectorAll('.bk-toggle-btn').forEach(function(btn){
        btn.addEventListener('click', function(){
            var id = btn.dataset.id;
            var panel = document.getElementById('bk-detail-' + id);
            var open = panel.style.display === 'block';
            panel.style.display = open ? 'none' : 'block';
            btn.classList.toggle('open', !open);
            btn.querySelector('span') && (btn.querySelector('span').textContent = open ? 'View Details' : 'Hide Details');
            // Update button text (text node)
            btn.childNodes.forEach(function(n){ if(n.nodeType===3 && n.textContent.trim()) n.textContent = open ? ' View Details' : ' Hide Details'; });
        });
    });
}());
</script>
