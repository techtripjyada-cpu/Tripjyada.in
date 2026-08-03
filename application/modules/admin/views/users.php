<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Users — Tripjyada Admin</title>
<meta name="robots" content="noindex,nofollow">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#f1f5f9;color:#1e293b}
.topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100}
.topbar-brand{font-size:18px;font-weight:700;color:#f97316}
.topbar-nav{display:flex;gap:4px}
.topbar-nav a{padding:7px 14px;border-radius:8px;font-size:13px;color:#64748b;text-decoration:none;transition:all .15s}
.topbar-nav a:hover,.topbar-nav a.active{background:#fff7ed;color:#f97316;font-weight:600}
.topbar-right{display:flex;gap:10px;align-items:center}
.logout-btn{background:none;border:1px solid #e2e8f0;border-radius:8px;padding:7px 14px;font-size:13px;color:#64748b;cursor:pointer;text-decoration:none}
.logout-btn:hover{background:#f8fafc}
.main{padding:24px;max-width:1300px;margin:0 auto}
.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:14px;margin-bottom:24px}
.stat-card{background:#fff;border-radius:12px;padding:18px 20px;border:1px solid #e2e8f0;text-align:center}
.stat-value{font-size:26px;font-weight:700}
.stat-label{font-size:11px;color:#64748b;margin-top:3px;text-transform:uppercase;letter-spacing:.5px}
.toolbar{display:flex;gap:10px;align-items:center;margin-bottom:18px;flex-wrap:wrap}
.search-box{flex:1;min-width:200px;max-width:340px}
.search-box input{width:100%;padding:9px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none}
.search-box input:focus{border-color:#f97316}
.table-wrap{background:#fff;border-radius:12px;border:1px solid #e2e8f0;overflow:auto}
table{width:100%;border-collapse:collapse;min-width:700px}
th{padding:11px 16px;text-align:left;font-size:11px;font-weight:700;color:#64748b;background:#f8fafc;border-bottom:1px solid #e2e8f0;text-transform:uppercase;letter-spacing:.4px}
td{padding:13px 16px;font-size:14px;border-bottom:1px solid #f1f5f9;vertical-align:middle}
tr:last-child td{border-bottom:none}
tr:hover td{background:#fafafa}
.btn-detail{padding:6px 12px;border:1px solid #e2e8f0;border-radius:6px;font-size:12px;color:#374151;text-decoration:none;background:#fff}
.btn-detail:hover{background:#f97316;color:#fff;border-color:#f97316}
.empty{text-align:center;padding:60px 20px;color:#94a3b8}
.pagination{display:flex;gap:6px;justify-content:center;margin-top:20px;flex-wrap:wrap}
.page-btn{padding:7px 12px;border:1px solid #e2e8f0;border-radius:6px;font-size:13px;color:#374151;text-decoration:none;background:#fff}
.page-btn:hover,.page-btn.current{background:#f97316;color:#fff;border-color:#f97316}
</style>
</head>
<body>
<div class="topbar">
    <div style="display:flex;align-items:center;gap:20px">
        <div class="topbar-brand">Tripjyada Admin</div>
        <nav class="topbar-nav">
            <a href="<?= site_url('admin/payments') ?>">Payments</a>
            <a href="<?= site_url('admin/users') ?>" class="active">Users</a>
            <a href="<?= site_url('admin/cancellations') ?>">Cancellations <?php if(!empty($admin_stats['cancel_pending'])): ?><span style="background:#dc2626;color:#fff;font-size:10px;padding:1px 6px;border-radius:20px;margin-left:3px"><?= $admin_stats['cancel_pending'] ?></span><?php endif; ?></a>
            <a href="<?= site_url('admin/batch-changes') ?>">Batch Changes <?php if(!empty($admin_stats['batch_pending'])): ?><span style="background:#f97316;color:#fff;font-size:10px;padding:1px 6px;border-radius:20px;margin-left:3px"><?= $admin_stats['batch_pending'] ?></span><?php endif; ?></a>
            <a href="<?= site_url('admin/cardpage') ?>">Cardpage Content</a>
        </nav>
    </div>
    <div class="topbar-right">
        <a href="<?= site_url('admin/logout') ?>" class="logout-btn">Logout</a>
    </div>
</div>
<div class="main">
    <div class="stats">
        <div class="stat-card"><div class="stat-value" style="color:#2563eb"><?= (int)$admin_stats['users'] ?></div><div class="stat-label">Total Users</div></div>
        <div class="stat-card"><div class="stat-value" style="color:#dc2626"><?= (int)$admin_stats['cancel_pending'] ?></div><div class="stat-label">Pending Cancellations</div></div>
        <div class="stat-card"><div class="stat-value" style="color:#f97316"><?= (int)$admin_stats['batch_pending'] ?></div><div class="stat-label">Pending Batch Changes</div></div>
        <div class="stat-card"><div class="stat-value" style="color:#16a34a"><?= $total ?></div><div class="stat-label">Showing</div></div>
    </div>
    <div class="toolbar">
        <form method="get" class="search-box">
            <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search by name, phone or email…">
        </form>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>#</th><th>Name</th><th>Phone</th><th>Email</th><th>Gender</th><th>Registered</th><th>Action</th></tr></thead>
            <tbody>
            <?php if (empty($users)): ?>
            <tr><td colspan="7" class="empty">No users found.</td></tr>
            <?php else: foreach ($users as $u): ?>
            <tr>
                <td style="color:#94a3b8;font-size:12px"><?= $u['id'] ?></td>
                <td>
                    <?php if (!empty($u['profile_pic'])): ?>
                    <img src="<?= base_url($u['profile_pic']) ?>" style="width:30px;height:30px;border-radius:50%;object-fit:cover;vertical-align:middle;margin-right:8px">
                    <?php else: ?>
                    <span style="display:inline-flex;width:30px;height:30px;border-radius:50%;background:#fff7ed;color:#f97316;font-weight:700;font-size:13px;align-items:center;justify-content:center;margin-right:8px;vertical-align:middle"><?= strtoupper(substr($u['name'] ?: $u['phone'], 0, 1)) ?></span>
                    <?php endif; ?>
                    <strong><?= htmlspecialchars($u['name'] ?: '—') ?></strong>
                </td>
                <td><?= htmlspecialchars($u['phone']) ?></td>
                <td><?= htmlspecialchars($u['email'] ?: '—') ?></td>
                <td><?= ucfirst($u['gender'] ?: '—') ?></td>
                <td><?= date('d M Y', strtotime($u['created_at'])) ?></td>
                <td><a href="<?= site_url('admin/user-detail/' . $u['id']) ?>" class="btn-detail">View</a></td>
            </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <?php if ($total > $per_page): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= ceil($total / $per_page); $i++): ?>
        <a href="?page=<?= $i ?>&q=<?= urlencode($search) ?>" class="page-btn <?= $i === $page ? 'current' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
