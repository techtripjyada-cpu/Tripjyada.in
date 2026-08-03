<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Payments — Tripjyada Admin</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#f1f5f9;color:#1e293b}
.topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100}
.topbar-brand{font-size:18px;font-weight:700;color:#f97316}
.topbar-brand span{color:#1e293b;font-weight:400;font-size:14px;margin-left:8px}
.topbar-actions{display:flex;gap:12px;align-items:center}
.logout-btn{background:none;border:1px solid #e2e8f0;border-radius:8px;padding:7px 14px;font-size:13px;color:#64748b;cursor:pointer;text-decoration:none}
.logout-btn:hover{background:#f8fafc}
.main{padding:24px;max-width:1300px;margin:0 auto}
.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:24px}
.stat-card{background:#fff;border-radius:12px;padding:20px;text-align:center;border:1px solid #e2e8f0}
.stat-value{font-size:28px;font-weight:700;color:#1e293b}
.stat-label{font-size:12px;color:#64748b;margin-top:4px;text-transform:uppercase;letter-spacing:.5px}
.stat-card.green .stat-value{color:#16a34a}
.stat-card.orange .stat-value{color:#f97316}
.stat-card.red .stat-value{color:#dc2626}
.stat-card.blue .stat-value{color:#2563eb}
.toolbar{display:flex;gap:12px;flex-wrap:wrap;align-items:center;margin-bottom:18px}
.search-box{flex:1;min-width:200px;max-width:360px}
.search-box input{width:100%;padding:9px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none}
.search-box input:focus{border-color:#f97316}
.filter-group{display:flex;gap:6px;flex-wrap:wrap}
.filter-btn{padding:8px 14px;border-radius:8px;border:1.5px solid #e2e8f0;background:#fff;font-size:13px;cursor:pointer;color:#64748b;text-decoration:none;transition:all .15s}
.filter-btn:hover,.filter-btn.active{background:#f97316;color:#fff;border-color:#f97316}
.table-wrap{background:#fff;border-radius:12px;border:1px solid #e2e8f0;overflow:auto}
table{width:100%;border-collapse:collapse;min-width:800px}
th{padding:12px 16px;text-align:left;font-size:12px;font-weight:600;color:#64748b;background:#f8fafc;border-bottom:1px solid #e2e8f0;text-transform:uppercase;letter-spacing:.4px}
td{padding:13px 16px;font-size:14px;border-bottom:1px solid #f1f5f9;vertical-align:middle}
tr:last-child td{border-bottom:none}
tr:hover td{background:#fafafa}
.badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600}
.badge-paid{background:#dcfce7;color:#16a34a}
.badge-captured{background:#dcfce7;color:#16a34a}
.badge-created{background:#fef9c3;color:#854d0e}
.badge-refunded{background:#ede9fe;color:#7c3aed}
.badge-failed{background:#fee2e2;color:#dc2626}
.badge-cancelled{background:#f1f5f9;color:#64748b}
.badge-pending_review{background:#fff7ed;color:#c2410c}
.badge-default{background:#f1f5f9;color:#64748b}
.btn-detail{padding:6px 12px;border:1px solid #e2e8f0;border-radius:6px;font-size:12px;color:#374151;text-decoration:none;background:#fff}
.btn-detail:hover{background:#f97316;color:#fff;border-color:#f97316}
.amount{font-weight:700;color:#16a34a}
.empty{text-align:center;padding:60px 20px;color:#94a3b8}
.empty-icon{font-size:48px;margin-bottom:12px}
.pagination{display:flex;gap:6px;justify-content:center;margin-top:20px;flex-wrap:wrap}
.page-btn{padding:7px 12px;border:1px solid #e2e8f0;border-radius:6px;font-size:13px;color:#374151;text-decoration:none;background:#fff}
.page-btn:hover,.page-btn.current{background:#f97316;color:#fff;border-color:#f97316}
</style>
<meta name="robots" content="noindex,nofollow">
</head>
<body>

<div class="topbar">
    <div style="display:flex;align-items:center;gap:20px">
        <div class="topbar-brand">Tripjyada Admin</div>
        <nav style="display:flex;gap:4px">
            <a href="<?= site_url('admin/payments') ?>" style="padding:7px 14px;border-radius:8px;font-size:13px;background:#fff7ed;color:#f97316;font-weight:600;text-decoration:none">Payments</a>
            <a href="<?= site_url('admin/users') ?>" style="padding:7px 14px;border-radius:8px;font-size:13px;color:#64748b;text-decoration:none">Users <?php if(!empty($admin_stats['users'])): ?><span style="background:#e2e8f0;color:#374151;font-size:10px;padding:1px 6px;border-radius:20px;margin-left:3px"><?= $admin_stats['users'] ?></span><?php endif; ?></a>
            <a href="<?= site_url('admin/cancellations') ?>" style="padding:7px 14px;border-radius:8px;font-size:13px;color:#64748b;text-decoration:none">Cancellations <?php if(!empty($admin_stats['cancel_pending'])): ?><span style="background:#dc2626;color:#fff;font-size:10px;padding:1px 6px;border-radius:20px;margin-left:3px"><?= $admin_stats['cancel_pending'] ?></span><?php endif; ?></a>
            <a href="<?= site_url('admin/batch-changes') ?>" style="padding:7px 14px;border-radius:8px;font-size:13px;color:#64748b;text-decoration:none">Batch Changes <?php if(!empty($admin_stats['batch_pending'])): ?><span style="background:#f97316;color:#fff;font-size:10px;padding:1px 6px;border-radius:20px;margin-left:3px"><?= $admin_stats['batch_pending'] ?></span><?php endif; ?></a>
            <a href="<?= site_url('admin/cardpage') ?>" style="padding:7px 14px;border-radius:8px;font-size:13px;color:#64748b;text-decoration:none">Cardpage Content</a>
        </nav>
    </div>
    <div class="topbar-actions">
        <a href="<?= site_url('admin/logout') ?>" class="logout-btn">Logout</a>
    </div>
</div>

<div class="main">

    <!-- Summary Cards -->
    <div class="stats">
        <div class="stat-card">
            <div class="stat-value"><?= $summary['total'] ?></div>
            <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-card green">
            <div class="stat-value"><?= $summary['paid'] ?></div>
            <div class="stat-label">Paid</div>
        </div>
        <div class="stat-card orange">
            <div class="stat-value">₹<?= number_format($summary['revenue']) ?></div>
            <div class="stat-label">Revenue</div>
        </div>
        <div class="stat-card blue">
            <div class="stat-value"><?= $summary['refunded'] ?></div>
            <div class="stat-label">Refunded</div>
        </div>
        <div class="stat-card red">
            <div class="stat-value"><?= $summary['failed'] ?></div>
            <div class="stat-label">Failed</div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar">
        <form class="search-box" method="get" action="<?= site_url('admin/payments') ?>">
            <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search name, email, phone, order ID…">
            <?php if ($status): ?><input type="hidden" name="status" value="<?= htmlspecialchars($status) ?>"><?php endif; ?>
        </form>
        <div class="filter-group">
            <a href="<?= site_url('admin/payments') ?>" class="filter-btn <?= $status === '' ? 'active' : '' ?>">All</a>
            <a href="<?= site_url('admin/payments') ?>?status=paid" class="filter-btn <?= $status === 'paid' ? 'active' : '' ?>">Paid</a>
            <a href="<?= site_url('admin/payments') ?>?status=created" class="filter-btn <?= $status === 'created' ? 'active' : '' ?>">Pending</a>
            <a href="<?= site_url('admin/payments') ?>?status=refunded" class="filter-btn <?= $status === 'refunded' ? 'active' : '' ?>">Refunded</a>
            <a href="<?= site_url('admin/payments') ?>?status=failed" class="filter-btn <?= $status === 'failed' ? 'active' : '' ?>">Failed</a>
            <a href="<?= site_url('admin/payments') ?>?status=cancelled" class="filter-btn <?= $status === 'cancelled' ? 'active' : '' ?>">Cancelled</a>
        </div>
    </div>

    <!-- Table -->
    <div class="table-wrap">
        <?php if (empty($payments)): ?>
            <div class="empty">
                <div class="empty-icon">📭</div>
                <p>No payment records found.</p>
            </div>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Package</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Razorpay Order</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($payments as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td style="white-space:nowrap;color:#64748b;font-size:13px"><?= date('d M Y', strtotime($p['created_at'])) ?></td>
                    <td>
                        <div style="font-weight:600"><?= htmlspecialchars($p['customer_name']) ?></div>
                        <div style="font-size:12px;color:#64748b"><?= htmlspecialchars($p['customer_email']) ?></div>
                        <div style="font-size:12px;color:#64748b"><?= htmlspecialchars($p['customer_phone']) ?></div>
                    </td>
                    <td style="max-width:180px"><?= htmlspecialchars($p['package_title']) ?></td>
                    <td class="amount">₹<?= number_format($p['amount_rupees']) ?></td>
                    <td>
                        <?php
                        $s = $p['local_status'];
                        $cls = in_array($s, array('paid','captured','created','refunded','failed','cancelled','pending_review')) ? 'badge-'.$s : 'badge-default';
                        ?>
                        <span class="badge <?= $cls ?>"><?= ucfirst($s) ?></span>
                    </td>
                    <td style="font-size:12px;color:#64748b;font-family:monospace">
                        <?= $p['razorpay_order_id'] ? substr($p['razorpay_order_id'], 0, 20).'…' : '—' ?>
                    </td>
                    <td>
                        <a href="<?= site_url('admin/payment-detail/'.$p['id']) ?>" class="btn-detail">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total > $per_page): ?>
    <div class="pagination">
        <?php
        $totalPages = ceil($total / $per_page);
        $baseUrl = site_url('admin/payments') . '?' . ($status ? 'status='.urlencode($status).'&' : '') . ($search ? 'q='.urlencode($search).'&' : '');
        for ($i = 1; $i <= $totalPages; $i++):
        ?>
            <a href="<?= $baseUrl ?>page=<?= $i ?>" class="page-btn <?= $i === $page ? 'current' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>

</div>
</body>
</html>
