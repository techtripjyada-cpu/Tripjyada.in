<h1 class="ud-page-title">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#f97316"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>
    My Trips
</h1>
<p class="ud-page-sub">Your completed travel history with TripJyada</p>

<!-- Stat banner -->
<div class="mt-stat-banner">
    <div class="mt-stat">
        <div class="mt-stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
        </div>
        <div>
            <div class="mt-stat-val"><?= (int) $completed_count ?></div>
            <div class="mt-stat-label">Trip<?= $completed_count !== 1 ? 's' : '' ?> Completed</div>
        </div>
    </div>
    <div class="mt-stat-divider"></div>
    <p class="mt-stat-desc">
        <?php if ($completed_count === 0): ?>
            No completed trips yet — your adventures are ahead of you!
        <?php elseif ($completed_count === 1): ?>
            You've completed 1 trip with TripJyada. Here's to many more!
        <?php else: ?>
            You've explored <?= $completed_count ?> trips with TripJyada. Amazing!
        <?php endif; ?>
    </p>
</div>

<?php if (empty($completed_trips)): ?>
<div class="ud-card">
    <div class="ud-empty">
        <span class="ud-empty-icon">🗺️</span>
        <h5>No completed trips yet.</h5>
        <p>Trips you've taken will appear here once the travel date has passed.<br>Book your next adventure today!</p>
        <a href="<?= site_url('tour-package') ?>" style="display:inline-block;margin-top:16px;padding:10px 24px;background:#f97316;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:13px">Explore Trips</a>
    </div>
</div>
<?php else: ?>

<div class="mt-list">
<?php foreach ($completed_trips as $t):
    $pkg_url = (!empty($t['package_slug']) && !empty($t['package_category_slug']))
               ? site_url($t['package_category_slug'] . '/' . $t['package_slug'])
               : '';
    $persons = (int)$t['num_adults'] + (int)$t['num_kids'];
?>
<div class="mt-card">
    <div class="mt-card-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="#f97316"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
    </div>
    <div class="mt-card-body">
        <div class="mt-card-title">
            <?php if ($pkg_url): ?>
                <a href="<?= $pkg_url ?>" target="_blank"><?= htmlspecialchars($t['package_title']) ?></a>
            <?php else: ?>
                <?= htmlspecialchars($t['package_title']) ?>
            <?php endif; ?>
        </div>
        <div class="mt-card-meta">
            <?php if (!empty($t['travel_date'])): ?>
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5"/></svg>
                <?= date('d M Y', strtotime($t['travel_date'])) ?>
            </span>
            <?php endif; ?>
            <?php if ($t['num_days'] > 0): ?>
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                <?= $t['num_days'] ?> day<?= $t['num_days'] > 1 ? 's' : '' ?>
            </span>
            <?php endif; ?>
            <?php if ($persons > 0): ?>
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0"/></svg>
                <?= $persons ?> traveller<?= $persons > 1 ? 's' : '' ?>
            </span>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-card-right">
        <div class="mt-completed-badge">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            Completed
        </div>
        <?php if ($t['total_amount'] > 0): ?>
        <div class="mt-amount">&#8377;<?= number_format($t['total_amount']) ?></div>
        <?php endif; ?>
        <a href="<?= site_url('user/invoice/' . $t['id']) ?>" class="mt-invoice-link" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Invoice
        </a>
    </div>
</div>
<?php endforeach; ?>
</div>

<?php endif; ?>

<style>
/* Stat banner */
.mt-stat-banner{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:20px 24px;margin-bottom:20px;display:flex;align-items:center;gap:20px}
.mt-stat{display:flex;align-items:center;gap:14px;flex-shrink:0}
.mt-stat-icon{width:48px;height:48px;border-radius:12px;background:#fff7ed;display:flex;align-items:center;justify-content:center}
.mt-stat-val{font-size:28px;font-weight:800;color:#f97316;line-height:1}
.mt-stat-label{font-size:12px;color:#94a3b8;margin-top:3px;text-transform:uppercase;letter-spacing:.4px}
.mt-stat-divider{width:1px;height:40px;background:#e2e8f0;flex-shrink:0}
.mt-stat-desc{font-size:14px;color:#475569;line-height:1.6}
@media(max-width:560px){.mt-stat-banner{flex-direction:column;align-items:flex-start}.mt-stat-divider{display:none}}

/* Trip cards */
.mt-list{display:flex;flex-direction:column;gap:12px}
.mt-card{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:18px 20px;display:flex;align-items:flex-start;gap:14px;transition:box-shadow .15s}
.mt-card:hover{box-shadow:0 4px 16px rgba(0,0,0,.07)}
.mt-card-icon{width:44px;height:44px;border-radius:10px;background:#fff7ed;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.mt-card-body{flex:1;min-width:0}
.mt-card-title{font-size:14px;font-weight:700;color:#1e293b;margin-bottom:6px}
.mt-card-title a{color:#1e293b;text-decoration:none}
.mt-card-title a:hover{color:#f97316}
.mt-card-meta{display:flex;flex-wrap:wrap;gap:10px;font-size:12px;color:#64748b}
.mt-card-meta span{display:inline-flex;align-items:center;gap:4px}
.mt-card-right{display:flex;flex-direction:column;align-items:flex-end;gap:6px;flex-shrink:0}
.mt-completed-badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:20px;background:#dcfce7;color:#15803d;font-size:11px;font-weight:700}
.mt-amount{font-size:14px;font-weight:700;color:#1e293b}
.mt-invoice-link{display:inline-flex;align-items:center;gap:4px;font-size:12px;color:#f97316;text-decoration:none;font-weight:600}
.mt-invoice-link:hover{text-decoration:underline}
</style>
