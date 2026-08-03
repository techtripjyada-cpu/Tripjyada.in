<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cardpage Content — Tripjyada Admin</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#f1f5f9;color:#1e293b}
.topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100}
.topbar-brand{font-size:18px;font-weight:700;color:#f97316}
.topbar-actions{display:flex;gap:12px;align-items:center}
.logout-btn{background:none;border:1px solid #e2e8f0;border-radius:8px;padding:7px 14px;font-size:13px;color:#64748b;cursor:pointer;text-decoration:none}
.logout-btn:hover{background:#f8fafc}
.main{padding:24px;max-width:1200px;margin:0 auto}
.page-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px}
.page-head h1{font-size:20px;font-weight:700;color:#1e293b}
.slug-bar{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.slug-bar label{font-size:13px;color:#64748b;font-weight:600}
.slug-bar select,.slug-bar input{padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;outline:none;background:#fff}
.slug-bar select:focus,.slug-bar input:focus{border-color:#f97316}
.slug-bar button{padding:8px 16px;background:#f97316;color:#fff;border:none;border-radius:8px;font-size:13px;cursor:pointer;font-weight:600}
.slug-bar button:hover{background:#e06010}
.card{background:#fff;border-radius:12px;border:1px solid #e2e8f0;padding:22px;margin-bottom:20px}
.card-title{font-size:15px;font-weight:700;color:#1e293b;margin-bottom:16px;display:flex;align-items:center;gap:8px}
.card-title span{background:#f97316;color:#fff;font-size:11px;padding:2px 8px;border-radius:20px}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px}
.form-row.three{grid-template-columns:1fr 1fr 1fr}
.form-row.one{grid-template-columns:1fr}
.form-group{display:flex;flex-direction:column;gap:5px}
.form-group label{font-size:12px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.5px}
.form-group input,.form-group textarea,.form-group select{padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;outline:none;font-family:inherit}
.form-group input:focus,.form-group textarea:focus,.form-group select:focus{border-color:#f97316}
.form-group textarea{resize:vertical;min-height:90px}
.form-group textarea.tall{min-height:160px;font-family:monospace;font-size:12px}
.form-hint{font-size:11px;color:#94a3b8;margin-top:3px}
.form-actions{display:flex;gap:10px;align-items:center;margin-top:6px}
.btn-save{padding:9px 22px;background:#f97316;color:#fff;border:none;border-radius:8px;font-size:14px;cursor:pointer;font-weight:600}
.btn-save:hover{background:#e06010}
.btn-cancel{padding:9px 18px;background:#fff;color:#64748b;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;cursor:pointer;text-decoration:none;font-weight:500}
.btn-cancel:hover{background:#f8fafc}
.toggle-wrap{display:flex;align-items:center;gap:8px;font-size:13px;color:#374151}
.toggle-wrap input[type=checkbox]{width:16px;height:16px;accent-color:#f97316;cursor:pointer}
.msg{padding:10px 16px;border-radius:8px;font-size:13px;margin-bottom:16px}
.msg.success{background:#dcfce7;color:#16a34a;border:1px solid #bbf7d0}
.msg.error{background:#fee2e2;color:#dc2626;border:1px solid #fecaca}
.tabs-table{width:100%;border-collapse:collapse}
.tabs-table th{padding:10px 14px;text-align:left;font-size:11px;font-weight:700;color:#64748b;background:#f8fafc;border-bottom:1px solid #e2e8f0;text-transform:uppercase;letter-spacing:.4px}
.tabs-table td{padding:11px 14px;font-size:13px;border-bottom:1px solid #f1f5f9;vertical-align:middle}
.tabs-table tr:last-child td{border-bottom:none}
.tabs-table tr:hover td{background:#fafafa}
.badge-active{display:inline-block;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600;background:#dcfce7;color:#16a34a}
.badge-inactive{display:inline-block;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600;background:#f1f5f9;color:#94a3b8}
.btn-edit{padding:5px 12px;border:1px solid #e2e8f0;border-radius:6px;font-size:12px;color:#374151;text-decoration:none;background:#fff;cursor:pointer}
.btn-edit:hover{background:#f97316;color:#fff;border-color:#f97316}
.btn-del{padding:5px 12px;border:1px solid #fecaca;border-radius:6px;font-size:12px;color:#dc2626;text-decoration:none;background:#fff;cursor:pointer;margin-left:4px}
.btn-del:hover{background:#dc2626;color:#fff;border-color:#dc2626}
.empty-row{text-align:center;padding:30px;color:#94a3b8;font-size:13px}
.section-divider{border:none;border-top:1px solid #e2e8f0;margin:24px 0}
.img-preview{max-width:120px;max-height:70px;border-radius:6px;object-fit:cover;border:1px solid #e2e8f0}
@media(max-width:640px){.form-row,.form-row.three{grid-template-columns:1fr}}
</style>
<meta name="robots" content="noindex,nofollow">
</head>
<body>

<div class="topbar">
    <div style="display:flex;align-items:center;gap:20px">
        <div class="topbar-brand">Tripjyada Admin</div>
        <nav style="display:flex;gap:4px;flex-wrap:wrap">
            <a href="<?= site_url('admin/payments') ?>" style="padding:7px 14px;border-radius:8px;font-size:13px;color:#64748b;text-decoration:none">Payments</a>
            <a href="<?= site_url('admin/users') ?>" style="padding:7px 14px;border-radius:8px;font-size:13px;color:#64748b;text-decoration:none">Users</a>
            <a href="<?= site_url('admin/cancellations') ?>" style="padding:7px 14px;border-radius:8px;font-size:13px;color:#64748b;text-decoration:none">Cancellations</a>
            <a href="<?= site_url('admin/batch-changes') ?>" style="padding:7px 14px;border-radius:8px;font-size:13px;color:#64748b;text-decoration:none">Batch Changes</a>
            <a href="<?= site_url('admin/cardpage') ?>" style="padding:7px 14px;border-radius:8px;font-size:13px;background:#fff7ed;color:#f97316;font-weight:600;text-decoration:none">Cardpage Content</a>
        </nav>
    </div>
    <div class="topbar-actions">
        <a href="<?= site_url('admin/logout') ?>" class="logout-btn">Logout</a>
    </div>
</div>

<div class="main">

    <div class="page-head">
        <h1>Cardpage Content</h1>
        <form method="get" action="<?= site_url('admin/cardpage') ?>" class="slug-bar">
            <label>Page:</label>
            <select name="slug" onchange="this.form.submit()">
                <?php
                $known_slugs = array('all' => 'All Packages', 'group-tour' => 'Group Tour', 'family-tour' => 'Family Tour', 'honeymoon-tour' => 'Honeymoon Tour', 'luxury-tour' => 'Luxury Tour');
                foreach ($known_slugs as $s => $label): ?>
                    <option value="<?= $s ?>" <?= $page_slug === $s ? 'selected' : '' ?>><?= $label ?> (<?= $s ?>)</option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="slug" placeholder="or type custom slug..." style="width:160px">
            <button type="submit">Load</button>
        </form>
    </div>

    <?php if ($msg === 'tab_saved'): ?>
        <div class="msg success">Tab saved successfully.</div>
    <?php elseif ($msg === 'tab_deleted'): ?>
        <div class="msg success">Tab deleted.</div>
    <?php elseif ($msg === 'desc_saved'): ?>
        <div class="msg success">Description saved successfully.</div>
    <?php endif; ?>

    <!-- ── Description Section ── -->
    <div class="card">
        <div class="card-title">Page Description <span>SEO / Bottom Text</span></div>
        <form method="post" action="<?= site_url('admin/cardpage-save-desc') ?>">
            <input type="hidden" name="page_slug" value="<?= htmlspecialchars($page_slug) ?>">
            <div class="form-row one">
                <div class="form-group">
                    <label>Heading</label>
                    <input type="text" name="heading" value="<?= htmlspecialchars($desc['heading'] ?? '') ?>" placeholder="e.g. North East Tour Packages by Tripjyada">
                </div>
            </div>
            <div class="form-row one">
                <div class="form-group">
                    <label>Body Text</label>
                    <textarea name="body" class="tall" placeholder="Enter description text here..."><?= htmlspecialchars($desc['body'] ?? '') ?></textarea>
                </div>
            </div>
            <div class="form-actions">
                <label class="toggle-wrap">
                    <input type="checkbox" name="active" value="1" <?= !empty($desc['active']) ? 'checked' : '' ?>> Show on page
                </label>
                <button type="submit" class="btn-save">Save Description</button>
            </div>
        </form>
    </div>

    <hr class="section-divider">

    <!-- ── Itinerary Tabs ── -->
    <div class="card">
        <div class="card-title">Itinerary Tabs <span>page: <?= htmlspecialchars($page_slug) ?></span></div>

        <?php if (!empty($tabs)): ?>
        <div style="overflow-x:auto;margin-bottom:20px">
            <table class="tabs-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Days</th>
                        <th>Tab Title</th>
                        <th>Heading</th>
                        <th>Image</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tabs as $tab): ?>
                    <tr>
                        <td><?= $tab['id'] ?></td>
                        <td><strong><?= htmlspecialchars($tab['days_label']) ?></strong></td>
                        <td><?= htmlspecialchars($tab['tab_title']) ?></td>
                        <td style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= htmlspecialchars($tab['itinerary_heading'] ?? '') ?></td>
                        <td>
                            <?php if (!empty($tab['hero_image'])): ?>
                                <img src="<?= base_url('assets/uploads/cardpage/' . $tab['hero_image']) ?>" class="img-preview" alt="">
                            <?php else: ?>
                                <span style="color:#94a3b8;font-size:12px">No image</span>
                            <?php endif; ?>
                        </td>
                        <td><?= (int)$tab['sort_order'] ?></td>
                        <td><?= $tab['active'] ? '<span class="badge-active">Active</span>' : '<span class="badge-inactive">Hidden</span>' ?></td>
                        <td>
                            <a href="<?= site_url('admin/cardpage?slug=' . $page_slug . '&edit=' . $tab['id']) ?>" class="btn-edit">Edit</a>
                            <a href="<?= site_url('admin/cardpage-delete-tab/' . $tab['id']) ?>" class="btn-del" onclick="return confirm('Delete this tab?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <p class="empty-row">No tabs yet for "<?= htmlspecialchars($page_slug) ?>". Add one below.</p>
        <?php endif; ?>

        <hr class="section-divider">

        <!-- Add / Edit form -->
        <div class="card-title" style="margin-bottom:14px">
            <?= $edit_tab ? 'Edit Tab #' . $edit_tab['id'] : 'Add New Tab' ?>
        </div>
        <form method="post" action="<?= site_url('admin/cardpage-save-tab') ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $edit_tab ? (int)$edit_tab['id'] : 0 ?>">
            <input type="hidden" name="page_slug" value="<?= htmlspecialchars($page_slug) ?>">

            <div class="form-row three">
                <div class="form-group">
                    <label>Days Label</label>
                    <input type="text" name="days_label" value="<?= htmlspecialchars($edit_tab['days_label'] ?? '') ?>" placeholder="e.g. 4 Days" required>
                </div>
                <div class="form-group">
                    <label>Tab Title</label>
                    <input type="text" name="tab_title" value="<?= htmlspecialchars($edit_tab['tab_title'] ?? '') ?>" placeholder="e.g. Kaziranga | Guwahati Tour" required>
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="<?= (int)($edit_tab['sort_order'] ?? 0) ?>" min="0">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Itinerary Heading</label>
                    <input type="text" name="itinerary_heading" value="<?= htmlspecialchars($edit_tab['itinerary_heading'] ?? '') ?>" placeholder="e.g. 4 Days Itinerary for North East India">
                </div>
                <div class="form-group">
                    <label>Itinerary Subheading</label>
                    <input type="text" name="itinerary_subheading" value="<?= htmlspecialchars($edit_tab['itinerary_subheading'] ?? '') ?>" placeholder="e.g. 2 Nights Kaziranga | 1 Night Guwahati">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Hero Image</label>
                    <input type="file" name="hero_image" accept="image/*">
                    <?php if (!empty($edit_tab['hero_image'])): ?>
                        <div style="margin-top:6px">
                            <img src="<?= base_url('assets/uploads/cardpage/' . $edit_tab['hero_image']) ?>" class="img-preview" alt="">
                            <div class="form-hint">Current image. Upload a new one to replace.</div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Day-by-Day Data (JSON)</label>
                    <textarea name="day_data" class="tall" placeholder='[{"day":"Day 1","title":"Arrive in Guwahati"},{"day":"Day 2","title":"Safari in Kaziranga"}]'><?= htmlspecialchars($edit_tab['day_data'] ?? '') ?></textarea>
                    <span class="form-hint">JSON array: [{&quot;day&quot;:&quot;Day 1&quot;,&quot;title&quot;:&quot;Description...&quot;}, ...]</span>
                </div>
            </div>

            <div class="form-actions">
                <label class="toggle-wrap">
                    <input type="checkbox" name="active" value="1" <?= (!isset($edit_tab) || !empty($edit_tab['active'])) ? 'checked' : '' ?>> Active
                </label>
                <button type="submit" class="btn-save"><?= $edit_tab ? 'Update Tab' : 'Add Tab' ?></button>
                <?php if ($edit_tab): ?>
                    <a href="<?= site_url('admin/cardpage?slug=' . $page_slug) ?>" class="btn-cancel">Cancel</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

</div>
</body>
</html>
