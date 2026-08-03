<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Account — TripJyada</title>
<link rel="icon" href="<?= base_url('assets/images/favicon.png') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;background:#f4f6f9;color:#1e293b;min-height:100vh}

/* Top bar */
.ud-topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:0 24px;height:60px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;box-shadow:0 1px 3px rgba(0,0,0,.06)}
.ud-topbar-logo{display:flex;align-items:center;gap:8px;text-decoration:none}
.ud-topbar-logo img{height:38px}
.ud-topbar-right{display:flex;align-items:center;gap:14px}
.ud-topbar-home{font-size:13px;color:#64748b;text-decoration:none;display:flex;align-items:center;gap:5px}
.ud-topbar-home:hover{color:#f97316}
.ud-topbar-logout{font-size:13px;padding:7px 16px;border:1.5px solid #e2e8f0;border-radius:8px;background:#fff;color:#64748b;cursor:pointer;text-decoration:none;transition:all .15s}
.ud-topbar-logout:hover{border-color:#f97316;color:#f97316}

/* Layout */
.ud-shell{display:flex;min-height:calc(100vh - 60px)}

/* Sidebar */
.ud-sidebar{width:220px;background:#fff;border-right:1px solid #e2e8f0;padding:20px 0;flex-shrink:0;position:sticky;top:60px;height:calc(100vh - 60px);overflow-y:auto}
.ud-sidebar-user{padding:16px 18px 20px;border-bottom:1px solid #f1f5f9;display:flex;flex-direction:column;align-items:center;text-align:center;gap:8px}
.ud-avatar{width:56px;height:56px;border-radius:50%;object-fit:cover;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:700;color:#f97316;border:2px solid #fed7aa}
.ud-avatar img{width:56px;height:56px;border-radius:50%;object-fit:cover}
.ud-sidebar-name{font-size:14px;font-weight:700;color:#1e293b;word-break:break-word}
.ud-sidebar-phone{font-size:12px;color:#94a3b8}

.ud-nav{list-style:none;padding:12px 0}
.ud-nav li a{display:flex;align-items:center;gap:10px;padding:10px 20px;font-size:13.5px;color:#475569;text-decoration:none;transition:all .15s;border-left:3px solid transparent}
.ud-nav li a:hover{background:#fff7ed;color:#f97316;border-left-color:#fed7aa}
.ud-nav li a.active{background:#fff7ed;color:#f97316;border-left-color:#f97316;font-weight:600}
.ud-nav li a svg{width:17px;height:17px;flex-shrink:0}

/* Main content */
.ud-main{flex:1;padding:28px 32px;min-width:0}
.ud-page-title{font-size:22px;font-weight:700;color:#1e293b;margin-bottom:4px;display:flex;align-items:center;gap:8px}
.ud-page-sub{font-size:13px;color:#94a3b8;margin-bottom:24px}

/* Cards */
.ud-card{background:#fff;border-radius:14px;border:1px solid #e2e8f0;padding:22px 24px;margin-bottom:20px}
.ud-card-title{font-size:14px;font-weight:700;color:#1e293b;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9}

/* Stat cards row */
.ud-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px}
.ud-stat{background:#fff;border-radius:14px;border:1px solid #e2e8f0;padding:20px 22px;display:flex;align-items:flex-start;justify-content:space-between}
.ud-stat-icon{width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center}
.ud-stat-icon svg{width:22px;height:22px}
.ud-stat-icon.blue{background:#eff6ff;color:#2563eb}
.ud-stat-icon.green{background:#f0fdf4;color:#16a34a}
.ud-stat-icon.purple{background:#f5f3ff;color:#7c3aed}
.ud-stat-val{font-size:26px;font-weight:800;color:#1e293b;line-height:1.1}
.ud-stat-label{font-size:12px;color:#94a3b8;margin-top:4px;text-transform:uppercase;letter-spacing:.4px}
.ud-stat-meta{font-size:11px;color:#94a3b8;text-align:right}

/* Table */
.ud-table-wrap{overflow-x:auto;border-radius:10px;border:1px solid #e2e8f0}
.ud-table{width:100%;border-collapse:collapse;min-width:600px}
.ud-table th{padding:11px 16px;text-align:left;font-size:11px;font-weight:700;color:#64748b;background:#f8fafc;text-transform:uppercase;letter-spacing:.5px;border-bottom:1px solid #e2e8f0}
.ud-table td{padding:13px 16px;font-size:13.5px;border-bottom:1px solid #f1f5f9;vertical-align:middle}
.ud-table tr:last-child td{border-bottom:none}
.ud-table tr:hover td{background:#fafafa}

/* Badge */
.ud-badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600}
.ud-badge-paid,.ud-badge-captured{background:#dcfce7;color:#15803d}
.ud-badge-pending{background:#fef9c3;color:#854d0e}
.ud-badge-approved{background:#dcfce7;color:#15803d}
.ud-badge-rejected{background:#fee2e2;color:#dc2626}
.ud-badge-refunded{background:#ede9fe;color:#6d28d9}
.ud-badge-failed,.ud-badge-cancelled{background:#f1f5f9;color:#64748b}
.ud-badge-created{background:#fef9c3;color:#854d0e}

/* Forms */
.ud-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.ud-form-grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px}
.ud-field{display:flex;flex-direction:column;gap:5px}
.ud-field label{font-size:12px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.4px}
.ud-input{width:100%;padding:11px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;color:#1e293b;background:#fff;transition:border-color .2s}
.ud-input:focus{outline:none;border-color:#f97316;box-shadow:0 0 0 3px rgba(249,115,22,.1)}
.ud-input[readonly]{background:#f8fafc;color:#64748b}
textarea.ud-input{min-height:80px;resize:vertical}
select.ud-input{appearance:auto}
.ud-submit{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:11px 28px;border-radius:10px;font-size:14px;font-weight:700;cursor:pointer;transition:transform .2s,box-shadow .2s}
.ud-submit:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(249,115,22,.3)}
.ud-submit:disabled{opacity:.7;cursor:not-allowed;transform:none;box-shadow:none}

/* Upload box */
.ud-upload-box{border:2px dashed #e2e8f0;border-radius:10px;padding:20px;text-align:center;cursor:pointer;transition:border-color .2s;background:#fafafa}
.ud-upload-box:hover{border-color:#f97316;background:#fff7ed}
.ud-upload-box input{display:none}
.ud-upload-box p{font-size:12px;color:#94a3b8;margin-top:6px}
.ud-upload-box svg{color:#94a3b8}

/* Avatar upload */
.ud-avatar-wrap{display:flex;flex-direction:column;align-items:center;gap:10px;margin-bottom:24px}
.ud-avatar-lg{width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid #fed7aa;background:#fff7ed;display:flex;align-items:center;justify-content:center;font-size:32px;font-weight:700;color:#f97316;overflow:hidden}
.ud-avatar-lg img{width:90px;height:90px;object-fit:cover}
.ud-avatar-change{font-size:12px;color:#f97316;cursor:pointer;font-weight:600}
.ud-avatar-change:hover{text-decoration:underline}

/* Alert */
.ud-alert{padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:18px;font-weight:500}
.ud-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0}
.ud-alert-error{background:#fef2f2;color:#b91c1c;border:1px solid #fecaca}
.ud-alert-info{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe}

/* Empty state */
.ud-empty{text-align:center;padding:48px 20px;color:#94a3b8}
.ud-empty-icon{font-size:48px;margin-bottom:12px;display:block}
.ud-empty h5{font-size:16px;font-weight:600;color:#64748b;margin-bottom:6px}
.ud-empty p{font-size:13px}

/* Pagination */
.ud-pagination{display:flex;gap:6px;justify-content:center;margin-top:20px;flex-wrap:wrap}
.ud-page-btn{padding:7px 12px;border:1px solid #e2e8f0;border-radius:7px;font-size:13px;color:#374151;text-decoration:none;background:#fff;transition:all .15s}
.ud-page-btn:hover,.ud-page-btn.active{background:#f97316;color:#fff;border-color:#f97316}

/* Payment options cards */
.ud-pay-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.ud-pay-card{background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:20px}
.ud-pay-card h5{font-size:14px;font-weight:700;color:#1e293b;margin-bottom:12px}
.ud-pay-row{display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f1f5f9;font-size:13px}
.ud-pay-row:last-child{border-bottom:none}
.ud-pay-label{color:#64748b}
.ud-pay-val{font-weight:600;color:#1e293b}
.ud-pay-note{background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:10px 14px;font-size:12px;color:#92400e;margin-top:14px}

/* Responsive */
@media(max-width:991px){
  .ud-stats{grid-template-columns:1fr 1fr}
  .ud-form-grid-3{grid-template-columns:1fr 1fr}
}
@media(max-width:767px){
  .ud-sidebar{display:none;position:fixed;left:0;top:60px;height:calc(100vh - 60px);z-index:200;width:250px;transform:translateX(-100%);transition:transform .3s}
  .ud-sidebar.open{display:block;transform:translateX(0)}
  .ud-main{padding:18px}
  .ud-stats{grid-template-columns:1fr}
  .ud-form-grid,.ud-form-grid-3{grid-template-columns:1fr}
  .ud-pay-grid{grid-template-columns:1fr}
  .ud-menu-toggle{display:flex!important}
}
.ud-menu-toggle{display:none;align-items:center;justify-content:center;width:38px;height:38px;background:#f1f5f9;border:none;border-radius:8px;cursor:pointer;color:#475569}
.ud-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.3);z-index:199}
.ud-overlay.open{display:block}
</style>
</head>
<body>

<div class="ud-topbar">
    <a class="ud-topbar-logo" href="<?= site_url() ?>">
        <img src="<?= base_url('assets/images/logo.png') ?>" alt="TripJyada">
    </a>
    <div class="ud-topbar-right">
        <button class="ud-menu-toggle" id="udMenuToggle" aria-label="Menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
        </button>
        <a class="ud-topbar-home" href="<?= site_url() ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75"/></svg>
            Home
        </a>
        <a class="ud-topbar-logout" href="<?= site_url('logout') ?>">Logout</a>
    </div>
</div>

<div class="ud-overlay" id="udOverlay"></div>

<div class="ud-shell">
    <!-- Sidebar -->
    <aside class="ud-sidebar" id="udSidebar">
        <div class="ud-sidebar-user">
            <div class="ud-avatar">
                <?php if (!empty($user['profile_pic'])): ?>
                    <img src="<?= base_url($user['profile_pic']) ?>" alt="">
                <?php else: ?>
                    <?= strtoupper(substr($user['name'] ?: $user['phone'], 0, 1)) ?>
                <?php endif; ?>
            </div>
            <div class="ud-sidebar-name"><?= htmlspecialchars($user['name'] ?: 'Traveller') ?></div>
            <div class="ud-sidebar-phone">+91 <?= htmlspecialchars($user['phone']) ?></div>
        </div>
        <ul class="ud-nav">
            <li><a href="<?= site_url('user') ?>" class="<?= $active_page === 'dashboard' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                Dashboard
            </a></li>
            <li><a href="<?= site_url('user/profile') ?>" class="<?= $active_page === 'profile' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                Profile
            </a></li>
            <li><a href="<?= site_url('user/bookings') ?>" class="<?= $active_page === 'bookings' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"/></svg>
                Bookings
            </a></li>
            <li><a href="<?= site_url('user/my-trips') ?>" class="<?= $active_page === 'my_trips' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>
                My Trips
            </a></li>
            <li><a href="<?= site_url('user/cancellation') ?>" class="<?= $active_page === 'cancellation' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                Cancellation
            </a></li>
            <li><a href="<?= site_url('user/batch-change') ?>" class="<?= $active_page === 'batch_change' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                Batch Change
            </a></li>
            <li><a href="<?= site_url('user/payment-options') ?>" class="<?= $active_page === 'payment_options' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/></svg>
                Payment Options
            </a></li>
            <li><a href="<?= site_url('user/terms') ?>" class="<?= $active_page === 'terms' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                Terms & Policies
            </a></li>
        </ul>
    </aside>

    <!-- Main -->
    <main class="ud-main">
        <?php $this->load->view($content_view, $this->load->get_vars()) ?>
    </main>
</div>

<script>
(function(){
  var toggle = document.getElementById('udMenuToggle');
  var sidebar = document.getElementById('udSidebar');
  var overlay = document.getElementById('udOverlay');
  if(toggle){
    toggle.addEventListener('click', function(){
      sidebar.classList.toggle('open');
      overlay.classList.toggle('open');
    });
    overlay.addEventListener('click', function(){
      sidebar.classList.remove('open');
      overlay.classList.remove('open');
    });
  }
})();
</script>
</body>
</html>
