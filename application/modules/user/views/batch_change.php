<h1 class="ud-page-title">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#f97316"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
    Batch Change
</h1>
<p class="ud-page-sub">Request a change to your travel batch/dates</p>

<?php if ($success): ?>
<div class="ud-alert ud-alert-success">Your batch change request has been submitted. Our team will review it and get back to you shortly.</div>
<?php endif; ?>

<!-- Submit form -->
<div class="ud-card">
    <div class="ud-card-title">Submit Batch Change Request</div>
    <form action="<?= site_url('user/batch-change') ?>" method="post">
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
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
        <div class="ud-form-grid" style="margin-bottom:14px">
            <div class="ud-field">
                <label>Current Batch / Date</label>
                <input type="text" name="current_batch" class="ud-input" placeholder="e.g. 14-Nov to 20-Nov">
            </div>
            <div class="ud-field">
                <label>Requested Batch / Date *</label>
                <input type="text" name="requested_batch" class="ud-input" placeholder="e.g. 21-Nov to 27-Nov" required>
            </div>
        </div>
        <div class="ud-field" style="margin-bottom:14px">
            <label>Reason (optional)</label>
            <textarea name="reason" class="ud-input" rows="3" placeholder="Why do you want to change your batch?"></textarea>
        </div>
        <div class="ud-alert ud-alert-info" style="margin-bottom:14px">
            Batch change requests are subject to availability and may involve additional charges. Our team will confirm via WhatsApp.
        </div>
        <button type="submit" class="ud-submit">Submit Batch Change Request</button>
    </form>
</div>

<!-- History -->
<div class="ud-card">
    <div class="ud-card-title">My Batch Change Requests</div>
    <?php if (empty($requests)): ?>
        <div class="ud-empty" style="padding:28px 20px">
            <h5>No batch change requests yet.</h5>
        </div>
    <?php else: ?>
        <div class="ud-table-wrap">
            <table class="ud-table">
                <thead><tr><th>#</th><th>Booking</th><th>Current Batch</th><th>Requested</th><th>Status</th><th>Admin Note</th><th>Date</th></tr></thead>
                <tbody>
                <?php foreach ($requests as $r): ?>
                <tr>
                    <td style="color:#94a3b8;font-size:12px"><?= $r['id'] ?></td>
                    <td><?= htmlspecialchars($r['booking_ref'] ?: '—') ?></td>
                    <td><?= htmlspecialchars($r['current_batch'] ?: '—') ?></td>
                    <td style="font-weight:600;color:#f97316"><?= htmlspecialchars($r['requested_batch']) ?></td>
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
