<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Payment #<?= $payment['id'] ?> — Tripjyada Admin</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#f1f5f9;color:#1e293b}
.topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100}
.topbar-brand{font-size:18px;font-weight:700;color:#f97316}
.topbar-brand span{color:#1e293b;font-weight:400;font-size:14px;margin-left:8px}
.back-btn{padding:7px 14px;border:1px solid #e2e8f0;border-radius:8px;font-size:13px;color:#64748b;text-decoration:none;background:#fff}
.back-btn:hover{background:#f8fafc}
.main{padding:24px;max-width:900px;margin:0 auto}
.page-title{font-size:22px;font-weight:700;margin-bottom:20px}
.grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:640px){.grid{grid-template-columns:1fr}}
.card{background:#fff;border-radius:12px;border:1px solid #e2e8f0;padding:20px}
.card-title{font-size:13px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;margin-bottom:16px}
.row{display:flex;justify-content:space-between;align-items:flex-start;padding:8px 0;border-bottom:1px solid #f1f5f9}
.row:last-child{border-bottom:none}
.row-label{font-size:13px;color:#64748b;flex-shrink:0;margin-right:12px}
.row-value{font-size:14px;font-weight:500;text-align:right;word-break:break-all}
.badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600}
.badge-paid{background:#dcfce7;color:#16a34a}
.badge-captured{background:#dcfce7;color:#16a34a}
.badge-created{background:#fef9c3;color:#854d0e}
.badge-refunded{background:#ede9fe;color:#7c3aed}
.badge-failed{background:#fee2e2;color:#dc2626}
.badge-cancelled{background:#f1f5f9;color:#64748b}
.badge-pending_review{background:#fff7ed;color:#c2410c}
.badge-default{background:#f1f5f9;color:#64748b}
.amount{font-size:28px;font-weight:700;color:#16a34a}
.actions-card{background:#fff;border-radius:12px;border:1px solid #e2e8f0;padding:20px;margin-top:20px}
.actions-title{font-size:13px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;margin-bottom:16px}
.action-section{margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #f1f5f9}
.action-section:last-child{margin-bottom:0;padding-bottom:0;border-bottom:none}
.action-label{font-size:14px;font-weight:600;margin-bottom:8px}
.action-desc{font-size:13px;color:#64748b;margin-bottom:12px}
.flex-row{display:flex;gap:10px;flex-wrap:wrap;align-items:flex-start}
.btn{padding:9px 18px;border-radius:8px;border:none;font-size:14px;font-weight:600;cursor:pointer;transition:all .15s}
.btn-danger{background:#dc2626;color:#fff}
.btn-danger:hover{background:#b91c1c}
.btn-warning{background:#f97316;color:#fff}
.btn-warning:hover{background:#ea6a0a}
.btn-secondary{background:#f1f5f9;color:#374151;border:1px solid #e2e8f0}
.btn-secondary:hover{background:#e2e8f0}
select{padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;background:#fff}
select:focus{border-color:#f97316}
textarea{width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;outline:none;resize:vertical;min-height:70px;font-family:inherit}
textarea:focus{border-color:#f97316}
.alert{padding:12px 16px;border-radius:8px;font-size:14px;margin-top:12px;display:none}
.alert-success{background:#dcfce7;color:#166534;border:1px solid #bbf7d0}
.alert-error{background:#fee2e2;color:#991b1b;border:1px solid #fecaca}
.mono{font-family:monospace;font-size:13px;color:#64748b}
.amount-input{padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;width:160px;outline:none}
.amount-input:focus{border-color:#f97316}
</style>
<meta name="robots" content="noindex,nofollow">
</head>
<body>

<div class="topbar">
    <div class="topbar-brand">Tripjyada <span>/ Admin / Payment #<?= $payment['id'] ?></span></div>
    <a href="<?= site_url('admin/payments') ?>" class="back-btn">← Back to Payments</a>
</div>

<div class="main">
    <div class="page-title">Payment #<?= $payment['id'] ?></div>

    <?php
    $s = $payment['local_status'];
    $statusCls = in_array($s, array('paid','captured','created','refunded','failed','cancelled','pending_review')) ? 'badge-'.$s : 'badge-default';
    $isPaid = in_array($s, array('paid', 'captured'));
    ?>

    <div class="grid">

        <!-- Customer Info -->
        <div class="card">
            <div class="card-title">Customer</div>
            <div class="row"><span class="row-label">Name</span><span class="row-value"><?= htmlspecialchars($payment['customer_name']) ?></span></div>
            <div class="row"><span class="row-label">Email</span><span class="row-value"><?= htmlspecialchars($payment['customer_email']) ?></span></div>
            <div class="row"><span class="row-label">Phone</span><span class="row-value"><?= htmlspecialchars($payment['customer_phone']) ?></span></div>
        </div>

        <!-- Payment Info -->
        <div class="card">
            <div class="card-title">Payment</div>
            <div class="row"><span class="row-label">Amount</span><span class="row-value amount">₹<?= number_format($payment['amount_rupees']) ?></span></div>
            <div class="row"><span class="row-label">Currency</span><span class="row-value"><?= htmlspecialchars($payment['currency']) ?></span></div>
            <div class="row"><span class="row-label">Status</span><span class="row-value"><span class="badge <?= $statusCls ?>"><?= ucfirst($s) ?></span></span></div>
            <div class="row"><span class="row-label">Method</span><span class="row-value"><?= $payment['payment_method'] ? htmlspecialchars($payment['payment_method']) : '—' ?></span></div>
            <div class="row"><span class="row-label">Date</span><span class="row-value"><?= date('d M Y, h:i A', strtotime($payment['created_at'])) ?></span></div>
        </div>

        <!-- Package Info -->
        <div class="card">
            <div class="card-title">Package</div>
            <div class="row"><span class="row-label">Title</span><span class="row-value"><?= htmlspecialchars($payment['package_title']) ?></span></div>
            <div class="row"><span class="row-label">Package ID</span><span class="row-value"><?= $payment['package_id'] ?: '—' ?></span></div>
            <div class="row"><span class="row-label">Slug</span><span class="row-value mono"><?= htmlspecialchars($payment['package_slug']) ?></span></div>
            <div class="row"><span class="row-label">Category</span><span class="row-value mono"><?= htmlspecialchars($payment['package_category_slug']) ?></span></div>
        </div>

        <!-- Razorpay Info -->
        <div class="card">
            <div class="card-title">Razorpay</div>
            <div class="row"><span class="row-label">Order ID</span><span class="row-value mono"><?= htmlspecialchars($payment['razorpay_order_id']) ?: '—' ?></span></div>
            <div class="row"><span class="row-label">Payment ID</span><span class="row-value mono"><?= htmlspecialchars($payment['razorpay_payment_id']) ?: '—' ?></span></div>
            <div class="row"><span class="row-label">Gateway Status</span><span class="row-value"><?= htmlspecialchars($payment['gateway_status']) ?: '—' ?></span></div>
            <div class="row"><span class="row-label">Captured</span><span class="row-value"><?= $payment['captured'] ? 'Yes' : 'No' ?></span></div>
            <div class="row"><span class="row-label">Verified At</span><span class="row-value"><?= $payment['verified_at'] ? date('d M Y, h:i A', strtotime($payment['verified_at'])) : '—' ?></span></div>
            <?php if (!empty($payment['refund_id'])): ?>
            <div class="row"><span class="row-label">Refund ID</span><span class="row-value mono"><?= htmlspecialchars($payment['refund_id']) ?></span></div>
            <div class="row"><span class="row-label">Refunded At</span><span class="row-value"><?= $payment['refunded_at'] ? date('d M Y, h:i A', strtotime($payment['refunded_at'])) : '—' ?></span></div>
            <div class="row"><span class="row-label">Refund Amt</span><span class="row-value">₹<?= number_format((int)$payment['refund_amount'] / 100) ?></span></div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Admin Notes -->
    <?php if (!empty($payment['admin_note'])): ?>
    <div class="card" style="margin-top:20px">
        <div class="card-title">Admin Note</div>
        <p style="font-size:14px;color:#374151"><?= nl2br(htmlspecialchars($payment['admin_note'])) ?></p>
    </div>
    <?php endif; ?>

    <!-- Actions -->
    <div class="actions-card">
        <div class="actions-title">Actions</div>

        <!-- Refund -->
        <?php if ($isPaid && !empty($payment['razorpay_payment_id'])): ?>
        <div class="action-section">
            <div class="action-label">Initiate Refund via Razorpay</div>
            <div class="action-desc">This will call Razorpay's refund API and mark the payment as refunded. The customer will receive the money back within 5–7 business days.</div>
            <div class="flex-row">
                <input type="number" id="refundAmt" class="amount-input" placeholder="Amount in ₹" value="<?= $payment['amount_rupees'] ?>" min="1" max="<?= $payment['amount_rupees'] ?>">
                <button class="btn btn-danger" onclick="initiateRefund(<?= $payment['id'] ?>)">Refund via Razorpay</button>
            </div>
            <div id="refund-alert" class="alert"></div>
        </div>
        <?php elseif ($isPaid): ?>
        <div class="action-section">
            <div class="action-label">Refund</div>
            <div class="action-desc">No Razorpay payment ID linked. Use manual status update below to mark as refunded after processing it directly in your Razorpay dashboard.</div>
        </div>
        <?php endif; ?>

        <!-- Manual Status Update -->
        <div class="action-section">
            <div class="action-label">Manual Status Update / Rollback</div>
            <div class="action-desc">Override the payment status manually. Use this to rollback, cancel, or flag a payment for review.</div>
            <div class="flex-row">
                <select id="statusSelect">
                    <?php
                    $statuses = array('created','paid','captured','refunded','failed','cancelled','pending_review');
                    foreach ($statuses as $st):
                    ?>
                    <option value="<?= $st ?>" <?= $payment['local_status'] === $st ? 'selected' : '' ?>><?= ucfirst(str_replace('_', ' ', $st)) ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-warning" onclick="updateStatus(<?= $payment['id'] ?>)">Update Status</button>
            </div>
            <textarea id="statusNote" placeholder="Optional note (reason for change, etc.)" style="margin-top:10px"></textarea>
            <div id="status-alert" class="alert"></div>
        </div>

    </div>
</div>

<script>
function showAlert(id, msg, type) {
    var el = document.getElementById(id);
    el.textContent = msg;
    el.className = 'alert alert-' + type;
    el.style.display = 'block';
}

function initiateRefund(id) {
    var amtRupees = parseInt(document.getElementById('refundAmt').value, 10);
    if (!amtRupees || amtRupees <= 0) { showAlert('refund-alert','Enter a valid amount.','error'); return; }
    if (!confirm('Refund ₹' + amtRupees + ' to the customer? This cannot be undone.')) return;

    fetch('<?= site_url('admin/refund') ?>/' + id, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'amount_subunits=' + (amtRupees * 100)
    })
    .then(function(r){return r.json();})
    .then(function(data){
        if (data.ok) {
            showAlert('refund-alert', data.message + (data.refund_id ? ' Refund ID: ' + data.refund_id : ''), 'success');
            setTimeout(function(){ location.reload(); }, 2000);
        } else {
            showAlert('refund-alert', data.message, 'error');
        }
    })
    .catch(function(){ showAlert('refund-alert','Request failed. Please try again.','error'); });
}

function updateStatus(id) {
    var status = document.getElementById('statusSelect').value;
    var note   = document.getElementById('statusNote').value;
    if (!confirm('Change status to "' + status + '"?')) return;

    fetch('<?= site_url('admin/update-status') ?>/' + id, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'status=' + encodeURIComponent(status) + '&note=' + encodeURIComponent(note)
    })
    .then(function(r){return r.json();})
    .then(function(data){
        showAlert('status-alert', data.message, data.ok ? 'success' : 'error');
        if (data.ok) setTimeout(function(){ location.reload(); }, 1500);
    })
    .catch(function(){ showAlert('status-alert','Request failed. Please try again.','error'); });
}
</script>
</body>
</html>
