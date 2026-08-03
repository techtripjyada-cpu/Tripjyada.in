<h1 class="ud-page-title">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#f97316"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
    Cancellation
</h1>
<p class="ud-page-sub">Request cancellation for your bookings</p>

<?php if ($success): ?>
<div class="ud-alert ud-alert-success">Your cancellation request has been submitted. Our team will review it shortly.</div>
<?php endif; ?>

<!-- Submit form -->
<div class="ud-card">
    <div class="ud-card-title">Submit New Cancellation Request</div>
    <form action="<?= site_url('user/cancellation') ?>" method="post">
        <div class="ud-form-grid" style="margin-bottom:14px">
            <div class="ud-field">
                <label>Select Booking</label>
                <select name="booking_ref" class="ud-input" required>
                    <option value="">-- Choose a booking --</option>
                    <?php foreach ($bookings as $b): ?>
                        <?php if (in_array($b['local_status'], array('paid', 'captured', 'created'))): ?>
                        <option value="<?= $b['id'] ?>">#<?= $b['id'] ?> — <?= htmlspecialchars($b['package_title']) ?> <?= !empty($b['travel_date']) ? '(' . date('d M Y', strtotime($b['travel_date'])) . ')' : '' ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <option value="other">Other (specify below)</option>
                </select>
            </div>
        </div>
        <div class="ud-field" style="margin-bottom:14px">
            <label>Reason for Cancellation *</label>
            <textarea name="reason" class="ud-input" rows="4" placeholder="Please explain why you want to cancel this booking..." required></textarea>
        </div>
        <div class="ud-alert ud-alert-info" style="margin-bottom:14px">
            Cancellation requests are subject to our cancellation policy. Refunds (if applicable) will be processed within 5–7 business days after approval.
        </div>
        <button type="submit" class="ud-submit">Submit Cancellation Request</button>
    </form>
</div>

<!-- History -->
<div class="ud-card">
    <div class="ud-card-title">My Cancellation Requests</div>
    <?php if (empty($requests)): ?>
        <div class="ud-empty" style="padding:28px 20px">
            <h5>No cancellation requests yet.</h5>
        </div>
    <?php else: ?>
        <div class="ud-table-wrap">
            <table class="ud-table">
                <thead><tr><th>#</th><th>Booking Ref</th><th>Reason</th><th>Status</th><th>Admin Note</th><th>Date</th></tr></thead>
                <tbody>
                <?php foreach ($requests as $r): ?>
                <tr>
                    <td style="color:#94a3b8;font-size:12px"><?= $r['id'] ?></td>
                    <td><?= htmlspecialchars($r['booking_ref'] ?: '—') ?></td>
                    <td style="max-width:220px;white-space:normal"><?= htmlspecialchars($r['reason']) ?></td>
                    <td><span class="ud-badge ud-badge-<?= $r['status'] ?>"><?= ucfirst($r['status']) ?></span></td>
                    <td><?= $r['admin_note'] ? htmlspecialchars($r['admin_note']) : '<span style="color:#94a3b8">—</span>' ?></td>
                    <td style="white-space:nowrap"><?= date('d M Y', strtotime($r['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
