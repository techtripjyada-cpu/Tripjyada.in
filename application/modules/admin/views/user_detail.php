<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($user['name'] ?: $user['phone']) ?> — Tripjyada Admin</title>
<meta name="robots" content="noindex,nofollow">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#f1f5f9;color:#1e293b}
.topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100}
.topbar-brand{font-size:18px;font-weight:700;color:#f97316}
.topbar-nav{display:flex;gap:4px}
.topbar-nav a{padding:7px 14px;border-radius:8px;font-size:13px;color:#64748b;text-decoration:none;transition:all .15s}
.topbar-nav a:hover,.topbar-nav a.active{background:#fff7ed;color:#f97316;font-weight:600}
.logout-btn{background:none;border:1px solid #e2e8f0;border-radius:8px;padding:7px 14px;font-size:13px;color:#64748b;cursor:pointer;text-decoration:none}
.main{padding:24px;max-width:1100px;margin:0 auto}
.back-link{display:inline-flex;align-items:center;gap:6px;font-size:13px;color:#64748b;text-decoration:none;margin-bottom:18px}
.back-link:hover{color:#f97316}
.two-col{display:grid;grid-template-columns:280px 1fr;gap:20px;align-items:start}
@media(max-width:768px){.two-col{grid-template-columns:1fr}}
.card{background:#fff;border-radius:12px;border:1px solid #e2e8f0;padding:24px}
.card-title{font-size:14px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9}
.avatar-wrap{text-align:center;margin-bottom:20px}
.avatar{width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid #f97316}
.avatar-placeholder{width:80px;height:80px;border-radius:50%;background:#fff7ed;color:#f97316;font-weight:700;font-size:28px;display:flex;align-items:center;justify-content:center;margin:0 auto;border:3px solid #f97316}
.user-name{font-size:18px;font-weight:700;text-align:center;margin-top:10px}
.user-phone{font-size:14px;color:#64748b;text-align:center;margin-top:4px}
.detail-row{display:flex;flex-direction:column;gap:2px;padding:10px 0;border-bottom:1px solid #f1f5f9}
.detail-row:last-child{border-bottom:none}
.detail-label{font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;font-weight:600}
.detail-value{font-size:14px;color:#1e293b}
.id-proof-img{width:100%;border-radius:8px;border:1px solid #e2e8f0;margin-top:8px;max-height:200px;object-fit:contain;background:#f8fafc}
.table-wrap{overflow:auto}
table{width:100%;border-collapse:collapse;min-width:600px}
th{padding:10px 14px;text-align:left;font-size:11px;font-weight:700;color:#64748b;background:#f8fafc;border-bottom:1px solid #e2e8f0;text-transform:uppercase;letter-spacing:.4px}
td{padding:12px 14px;font-size:13px;border-bottom:1px solid #f1f5f9;vertical-align:middle}
tr:last-child td{border-bottom:none}
tr:hover td{background:#fafafa}
.badge{display:inline-block;padding:3px 9px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.3px}
.badge-paid{background:#dcfce7;color:#16a34a}
.badge-pending{background:#fef9c3;color:#92400e}
.badge-failed{background:#fee2e2;color:#dc2626}
.badge-refunded{background:#e0e7ff;color:#4338ca}
.empty{text-align:center;padding:40px;color:#94a3b8;font-size:14px}
</style>
</head>
<body>
<div class="topbar">
    <div style="display:flex;align-items:center;gap:20px">
        <div class="topbar-brand">Tripjyada Admin</div>
        <nav class="topbar-nav">
            <a href="<?= site_url('admin/payments') ?>">Payments</a>
            <a href="<?= site_url('admin/users') ?>" class="active">Users</a>
            <a href="<?= site_url('admin/cancellations') ?>">Cancellations</a>
            <a href="<?= site_url('admin/batch-changes') ?>">Batch Changes</a>
            <a href="<?= site_url('admin/cardpage') ?>">Cardpage Content</a>
        </nav>
    </div>
    <a href="<?= site_url('admin/logout') ?>" class="logout-btn">Logout</a>
</div>
<div class="main">
    <a href="<?= site_url('admin/users') ?>" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
        Back to Users
    </a>
    <div class="two-col">
        <!-- Left: profile card -->
        <div class="card">
            <div class="avatar-wrap">
                <?php if (!empty($user['profile_pic'])): ?>
                    <img src="<?= base_url($user['profile_pic']) ?>" class="avatar" alt="Avatar">
                <?php else: ?>
                    <div class="avatar-placeholder"><?= strtoupper(substr($user['name'] ?: $user['phone'], 0, 1)) ?></div>
                <?php endif; ?>
                <div class="user-name"><?= htmlspecialchars($user['name'] ?: '—') ?></div>
                <div class="user-phone"><?= htmlspecialchars($user['phone']) ?></div>
            </div>
            <?php $fields = array(
                'Email'         => $user['email'],
                'Gender'        => $user['gender'] ? ucfirst($user['gender']) : null,
                'Date of Birth' => $user['dob'],
                'Instagram'     => $user['instagram'],
                'Hometown'      => $user['hometown'],
                'Current Town'  => $user['current_town'],
                'Address'       => $user['address'],
                'About'         => $user['about'],
                'Registered'    => date('d M Y', strtotime($user['created_at'])),
            ); ?>
            <?php foreach ($fields as $label => $val): if (!$val) continue; ?>
            <div class="detail-row">
                <div class="detail-label"><?= $label ?></div>
                <div class="detail-value"><?= htmlspecialchars($val) ?></div>
            </div>
            <?php endforeach; ?>
            <?php if (!empty($user['id_proof'])): ?>
            <div class="detail-row">
                <div class="detail-label">ID Proof</div>
                <img src="<?= base_url($user['id_proof']) ?>" class="id-proof-img" alt="ID Proof">
            </div>
            <?php endif; ?>
        </div>
        <!-- Right: bookings table -->
        <div class="card">
            <div class="card-title">Bookings (<?= count($bookings) ?>)</div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>#</th><th>Package</th><th>Travel Date</th><th>Persons</th><th>Total</th><th>Paid</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                    <?php if (empty($bookings)): ?>
                    <tr><td colspan="8" class="empty">No bookings found for this user.</td></tr>
                    <?php else: foreach ($bookings as $b): ?>
                    <?php
                        $statusClass = 'badge-pending';
                        if (in_array($b['local_status'], array('paid','captured'))) $statusClass = 'badge-paid';
                        elseif ($b['local_status'] === 'refunded') $statusClass = 'badge-refunded';
                        elseif ($b['local_status'] === 'failed') $statusClass = 'badge-failed';
                    ?>
                    <tr>
                        <td style="color:#94a3b8;font-size:11px"><?= $b['id'] ?></td>
                        <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= htmlspecialchars($b['package_title'] ?: '—') ?></td>
                        <td><?= $b['travel_date'] ? date('d M Y', strtotime($b['travel_date'])) : '—' ?></td>
                        <td><?= (int)($b['num_adults'] ?? 0) + (int)($b['num_kids'] ?? 0) ?></td>
                        <td>₹<?= number_format($b['amount_rupees'] ?? 0) ?></td>
                        <td>₹<?= number_format($b['advance_paid'] ?? 0) ?></td>
                        <td><span class="badge <?= $statusClass ?>"><?= $b['local_status'] ?></span></td>
                        <td><a href="<?= site_url('admin/payment-detail/' . $b['id']) ?>" style="font-size:11px;color:#f97316;text-decoration:none">View</a></td>
                    </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
