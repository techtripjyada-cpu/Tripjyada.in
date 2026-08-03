<h1 class="ud-page-title">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#f97316"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
    Welcome back<?= !empty($user['name']) ? ', ' . htmlspecialchars($user['name']) : '' ?>
</h1>
<p class="ud-page-sub">Here's your travel overview</p>

<!-- Stats -->
<div class="ud-stats">
    <div class="ud-stat">
        <div>
            <div class="ud-stat-val"><?= (int) $total_bookings ?></div>
            <div class="ud-stat-label">Bookings</div>
        </div>
        <div>
            <div class="ud-stat-icon blue">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"/></svg>
            </div>
            <div class="ud-stat-meta">Total</div>
        </div>
    </div>

    <div class="ud-stat">
        <div>
            <div class="ud-stat-val">&#8377;0</div>
            <div class="ud-stat-label">Credit Note</div>
        </div>
        <div>
            <div class="ud-stat-icon green">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/></svg>
            </div>
            <div class="ud-stat-meta">Balance</div>
        </div>
    </div>

    <div class="ud-stat">
        <div>
            <div class="ud-stat-val" style="font-size:16px;margin-top:4px">
                <?php if (!empty($next_trip)): ?>
                    <?= htmlspecialchars($next_trip['package_title']) ?>
                <?php else: ?>
                    <span style="color:#94a3b8;font-size:14px;font-weight:500">No upcoming trips</span>
                <?php endif; ?>
            </div>
            <div class="ud-stat-label">Next Trip</div>
        </div>
        <div>
            <div class="ud-stat-icon purple">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
            </div>
            <div class="ud-stat-meta"><?php if (!empty($next_trip)): ?><?= date('d M', strtotime($next_trip['travel_date'])) ?><?php else: ?>Next trip<?php endif; ?></div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="ud-card">
    <div class="ud-card-title" style="display:flex;justify-content:space-between;align-items:center">
        Recent Bookings
        <a href="<?= site_url('user/bookings') ?>" style="font-size:12px;color:#f97316;text-decoration:none;font-weight:600">View all →</a>
    </div>
    <?php
    $CI =& get_instance();
    $CI->load->model('user/user_mdl');
    $recent = $CI->user_mdl->get_bookings($user['phone'], 1, 5);
    ?>
    <?php if (empty($recent)): ?>
        <div class="ud-empty">
            <span class="ud-empty-icon">🧳</span>
            <h5>No Recent bookings found.</h5>
            <p>It looks like you haven't booked anything yet.<br>Discover exciting trips and start creating unforgettable memories today.</p>
            <a href="<?= site_url('tour-package') ?>" style="display:inline-block;margin-top:16px;padding:10px 24px;background:#f97316;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:13px">Explore Trips</a>
        </div>
    <?php else: ?>
        <div class="ud-table-wrap">
            <table class="ud-table">
                <thead><tr><th>Package</th><th>Travel Date</th><th>Amount</th><th>Status</th></tr></thead>
                <tbody>
                <?php foreach ($recent as $b): ?>
                <tr>
                    <td><?= htmlspecialchars($b['package_title']) ?></td>
                    <td><?= !empty($b['travel_date']) ? date('d M Y', strtotime($b['travel_date'])) : '—' ?></td>
                    <td><strong>&#8377;<?= number_format($b['total_amount'] ?: $b['amount_rupees']) ?></strong></td>
                    <td><span class="ud-badge ud-badge-<?= htmlspecialchars($b['local_status']) ?>"><?= ucfirst($b['local_status']) ?></span></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Quick actions -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
    <a href="<?= site_url('user/cancellation') ?>" style="text-decoration:none">
        <div class="ud-card" style="display:flex;align-items:center;gap:14px;cursor:pointer;transition:border-color .2s;margin-bottom:0" onmouseover="this.style.borderColor='#f97316'" onmouseout="this.style.borderColor='#e2e8f0'">
            <div class="ud-stat-icon" style="background:#fef2f2;color:#dc2626;width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            </div>
            <div><div style="font-size:14px;font-weight:700;color:#1e293b">Request Cancellation</div><div style="font-size:12px;color:#94a3b8;margin-top:2px">Cancel a booking</div></div>
        </div>
    </a>
    <a href="<?= site_url('user/batch-change') ?>" style="text-decoration:none">
        <div class="ud-card" style="display:flex;align-items:center;gap:14px;cursor:pointer;transition:border-color .2s;margin-bottom:0" onmouseover="this.style.borderColor='#f97316'" onmouseout="this.style.borderColor='#e2e8f0'">
            <div class="ud-stat-icon" style="background:#eff6ff;color:#2563eb;width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
            </div>
            <div><div style="font-size:14px;font-weight:700;color:#1e293b">Batch Change</div><div style="font-size:12px;color:#94a3b8;margin-top:2px">Change travel dates</div></div>
        </div>
    </a>
</div>
