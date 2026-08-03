<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Batch Changes — Tripjyada Admin</title>
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
.main{padding:24px;max-width:1300px;margin:0 auto}
.toolbar{display:flex;gap:10px;align-items:center;margin-bottom:18px;flex-wrap:wrap}
.filter-btn{padding:7px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;color:#374151;text-decoration:none;background:#fff}
.filter-btn:hover,.filter-btn.active{background:#f97316;color:#fff;border-color:#f97316}
.table-wrap{background:#fff;border-radius:12px;border:1px solid #e2e8f0;overflow:auto}
table{width:100%;border-collapse:collapse;min-width:800px}
th{padding:11px 16px;text-align:left;font-size:11px;font-weight:700;color:#64748b;background:#f8fafc;border-bottom:1px solid #e2e8f0;text-transform:uppercase;letter-spacing:.4px}
td{padding:13px 16px;font-size:13px;border-bottom:1px solid #f1f5f9;vertical-align:middle}
tr:last-child td{border-bottom:none}
tr:hover td{background:#fafafa}
.badge{display:inline-block;padding:3px 9px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.3px}
.badge-pending{background:#fef9c3;color:#92400e}
.badge-approved{background:#dcfce7;color:#16a34a}
.badge-rejected{background:#fee2e2;color:#dc2626}
.empty{text-align:center;padding:60px 20px;color:#94a3b8}
.pagination{display:flex;gap:6px;justify-content:center;margin-top:20px;flex-wrap:wrap}
.page-btn{padding:7px 12px;border:1px solid #e2e8f0;border-radius:6px;font-size:13px;color:#374151;text-decoration:none;background:#fff}
.page-btn:hover,.page-btn.current{background:#f97316;color:#fff;border-color:#f97316}
.action-btn{padding:5px 10px;border:none;border-radius:6px;font-size:11px;font-weight:600;cursor:pointer;transition:all .15s}
.btn-approve{background:#dcfce7;color:#16a34a}
.btn-approve:hover{background:#16a34a;color:#fff}
.btn-reject{background:#fee2e2;color:#dc2626}
.btn-reject:hover{background:#dc2626;color:#fff}
.note-input{padding:4px 8px;border:1px solid #e2e8f0;border-radius:6px;font-size:12px;width:140px}
.note-input:focus{outline:none;border-color:#f97316}
.arrow-icon{display:inline-block;margin:0 4px;color:#94a3b8}
.flash-msg{position:fixed;bottom:20px;right:20px;background:#1e293b;color:#fff;padding:12px 20px;border-radius:10px;font-size:13px;z-index:9999;display:none}
</style>
</head>
<body>
<div class="topbar">
    <div style="display:flex;align-items:center;gap:20px">
        <div class="topbar-brand">Tripjyada Admin</div>
        <nav class="topbar-nav">
            <a href="<?= site_url('admin/payments') ?>">Payments</a>
            <a href="<?= site_url('admin/users') ?>">Users</a>
            <a href="<?= site_url('admin/cancellations') ?>">Cancellations <?php if(!empty($admin_stats['cancel_pending'])): ?><span style="background:#dc2626;color:#fff;font-size:10px;padding:1px 6px;border-radius:20px;margin-left:3px"><?= $admin_stats['cancel_pending'] ?></span><?php endif; ?></a>
            <a href="<?= site_url('admin/batch-changes') ?>" class="active">Batch Changes <?php if(!empty($admin_stats['batch_pending'])): ?><span style="background:#f97316;color:#fff;font-size:10px;padding:1px 6px;border-radius:20px;margin-left:3px"><?= $admin_stats['batch_pending'] ?></span><?php endif; ?></a>
            <a href="<?= site_url('admin/cardpage') ?>">Cardpage Content</a>
        </nav>
    </div>
    <a href="<?= site_url('admin/logout') ?>" class="logout-btn">Logout</a>
</div>
<div class="main">
    <div class="toolbar">
        <a href="?status=" class="filter-btn <?= $status === '' ? 'active' : '' ?>">All</a>
        <a href="?status=pending" class="filter-btn <?= $status === 'pending' ? 'active' : '' ?>">Pending <?php if($admin_stats['batch_pending']): ?><span style="background:#f97316;color:#fff;font-size:10px;padding:1px 6px;border-radius:20px;margin-left:3px"><?= $admin_stats['batch_pending'] ?></span><?php endif; ?></a>
        <a href="?status=approved" class="filter-btn <?= $status === 'approved' ? 'active' : '' ?>">Approved</a>
        <a href="?status=rejected" class="filter-btn <?= $status === 'rejected' ? 'active' : '' ?>">Rejected</a>
        <span style="margin-left:auto;font-size:13px;color:#64748b"><?= $total ?> request<?= $total !== 1 ? 's' : '' ?></span>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>#</th><th>User</th><th>Booking Ref</th><th>Batch Change</th><th>Reason</th><th>Requested</th><th>Status</th><th>Admin Note</th><th>Action</th></tr></thead>
            <tbody>
            <?php if (empty($requests)): ?>
            <tr><td colspan="9" class="empty">No batch change requests found.</td></tr>
            <?php else: foreach ($requests as $r): ?>
            <tr id="row-<?= $r['id'] ?>">
                <td style="color:#94a3b8;font-size:11px"><?= $r['id'] ?></td>
                <td>
                    <div style="font-weight:600"><?= htmlspecialchars($r['user_name'] ?: '—') ?></div>
                    <div style="font-size:11px;color:#64748b"><?= htmlspecialchars($r['user_phone'] ?: '—') ?></div>
                </td>
                <td>
                    <div style="font-size:12px;color:#374151"><?= htmlspecialchars($r['booking_ref'] ?: '—') ?></div>
                    <?php if ($r['payment_id']): ?>
                    <a href="<?= site_url('admin/payment-detail/' . $r['payment_id']) ?>" style="font-size:11px;color:#f97316">Booking #<?= $r['payment_id'] ?></a>
                    <?php endif; ?>
                </td>
                <td>
                    <div style="font-size:12px">
                        <span style="background:#f1f5f9;padding:2px 8px;border-radius:4px"><?= htmlspecialchars($r['current_batch'] ?: '—') ?></span>
                        <span class="arrow-icon">→</span>
                        <span style="background:#fff7ed;color:#f97316;padding:2px 8px;border-radius:4px;font-weight:600"><?= htmlspecialchars($r['requested_batch'] ?: '—') ?></span>
                    </div>
                </td>
                <td style="max-width:180px">
                    <div style="font-size:12px;color:#475569;line-height:1.4"><?= htmlspecialchars(substr($r['reason'] ?? '', 0, 100)) ?><?= strlen($r['reason'] ?? '') > 100 ? '…' : '' ?></div>
                </td>
                <td style="font-size:12px;color:#64748b"><?= date('d M Y', strtotime($r['created_at'])) ?></td>
                <td><span class="badge badge-<?= $r['status'] ?>"><?= $r['status'] ?></span></td>
                <td>
                    <div style="font-size:11px;color:#64748b;max-width:140px"><?= htmlspecialchars($r['admin_note'] ?: '—') ?></div>
                </td>
                <td>
                    <?php if ($r['status'] === 'pending'): ?>
                    <div style="display:flex;flex-direction:column;gap:6px">
                        <input type="text" class="note-input" id="note-<?= $r['id'] ?>" placeholder="Add note (optional)">
                        <div style="display:flex;gap:5px">
                            <button class="action-btn btn-approve" onclick="updateBatch(<?= $r['id'] ?>,'approved')">Approve</button>
                            <button class="action-btn btn-reject" onclick="updateBatch(<?= $r['id'] ?>,'rejected')">Reject</button>
                        </div>
                    </div>
                    <?php else: ?>
                    <span style="font-size:11px;color:#94a3b8">Done</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <?php if ($total > $per_page): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= ceil($total / $per_page); $i++): ?>
        <a href="?page=<?= $i ?>&status=<?= urlencode($status) ?>" class="page-btn <?= $i === $page ? 'current' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>
</div>
<div class="flash-msg" id="flashMsg"></div>
<script>
function updateBatch(id, status) {
    var note = document.getElementById('note-' + id);
    var noteVal = note ? note.value : '';
    var fd = new FormData();
    fd.append('status', status);
    fd.append('note', noteVal);
    fetch('<?= site_url('admin/update-batch-change') ?>/' + id, {method:'POST', body:fd})
        .then(function(r){return r.json();})
        .then(function(d){
            flash(d.message || 'Updated');
            if (d.ok) {
                var row = document.getElementById('row-' + id);
                if (row) {
                    var badge = row.querySelector('.badge');
                    if (badge) { badge.className = 'badge badge-' + status; badge.textContent = status; }
                    var cell = row.cells[row.cells.length - 1];
                    if (cell) cell.innerHTML = '<span style="font-size:11px;color:#94a3b8">Done</span>';
                    var noteCell = row.cells[row.cells.length - 2];
                    if (noteCell && noteVal) noteCell.innerHTML = '<div style="font-size:11px;color:#64748b;max-width:140px">' + noteVal + '</div>';
                }
            }
        })
        .catch(function(){flash('Error — please retry');});
}
function flash(msg) {
    var el = document.getElementById('flashMsg');
    el.textContent = msg;
    el.style.display = 'block';
    setTimeout(function(){el.style.display='none';}, 3000);
}
</script>
</body>
</html>
