 <body class="color-scheme">
     <!-- Header -->
     <div id="dot"></div>

     <script>
         const dot = document.getElementById('dot');
         let mx = 0,
             my = 0,
             cx = 0,
             cy = 0;
         document.addEventListener('mousemove', (e) => {
             mx = e.clientX;
             my = e.clientY;
         });
         (function loop() {
             cx += (mx - cx) * 0.12;
             cy += (my - cy) * 0.12;
             if (Math.abs(mx - cx) < 0.1) cx = mx;
             if (Math.abs(my - cy) < 0.1) cy = my;
             dot.style.transform = `translate(${cx}px, ${cy}px)`;
             requestAnimationFrame(loop);
         })();
     </script>

     <sticky-header data-sticky-type="always">
         <header class="header-1 header-white-bg">
             <div class="container">
                 <div class="header-grid">
                     <a class="header-logo" href="<?= site_url() ?>" aria-label="Tripjyada">
                         <img src="<?= base_url() ?>assets/images/logo.png" alt="Tripjyada Logo" width="212" height="52"
                             loading="lazy">
                     </a>
                     <drawer-menu>
                         <nav class="header-nav drawer-menu">
                             <div class="drawer-menu-top">
                                 <div class="d-lg-none header-nav-headings">
                                     <a class="header-logo" href="<?= site_url() ?>" aria-label="Tripjyada">
                                         <img src="<?= base_url() ?>assets/images/logo.png" alt="Tripjyada Logo" width="336" height="52" loading="lazy">
                                     </a>
                                     <drawer-opener class="svg-wrapper menu-close" data-drawer=".drawer-menu">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                             <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                         </svg>
                                     </drawer-opener>
                                 </div>
                                 <ul class="header-menu list-unstyled">
                                     <li class="nav-item">
                                         <a class="menu-link menu-link-main" href="<?= site_url() ?>">
                                             <span class="mob-nav-icon">
                                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                                             </span>
                                             Home
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="menu-link menu-link-main" href="<?= site_url('about') ?>">
                                             <span class="mob-nav-icon">
                                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                             </span>
                                             About
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="menu-link menu-link-main" href="<?= site_url('tour-package') ?>">
                                             <span class="mob-nav-icon">
                                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" /></svg>
                                             </span>
                                             Tour Packages
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="menu-link menu-link-main" href="<?= site_url('blogs') ?>">
                                             <span class="mob-nav-icon">
                                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                             </span>
                                             Blog
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="menu-link menu-link-main" href="<?= site_url('contact') ?>">
                                             <span class="mob-nav-icon">
                                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                                             </span>
                                             Contact
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                             <div class="mobile-menu-bottom d-lg-none d-block">
                                 <button type="button" class="mob-enquiry-btn" data-bs-toggle="modal" data-bs-target="#qteModal">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                     </svg>
                                     Enquiry Now
                                 </button>
                                 <p class="mob-footer-copy">© 2025 TripJyada. All rights reserved.</p>
                             </div>
                         </nav>
                     </drawer-menu>
                     <div class="header-actions d-flex align-items-center" style="gap:10px">
                         <?php
                         $CI_nav =& get_instance();
                         $CI_nav->load->library('session');
                         $_tj_uid = $CI_nav->session->userdata('tj_user_id');
                         $_tj_uname = $CI_nav->session->userdata('tj_user_name');
                         ?>

                         <?php if (!$_tj_uid): ?>
                         <!-- Guest: Login button (left of Book Now) -->
                         <button type="button" class="tj-login-btn" id="tjLoginNavBtn">
                             <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
                             Login
                         </button>
                         <?php endif; ?>

                         <button type="button" aria-label="Bookings Button"
                             class="button button--primary button--slim d-none d-lg-inline-flex" data-bs-toggle="modal"
                             data-bs-target="#qteModal">
                             Book Now
                         </button>

                         <?php if ($_tj_uid): ?>
                         <!-- Logged-in: profile icon (right of Book Now) -->
                         <div class="tj-user-menu" style="position:relative">
                             <button class="tj-user-avatar-btn" id="tjUserMenuBtn" aria-label="My Account">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                             </button>
                             <div class="tj-user-dropdown" id="tjUserDropdown">
                                 <div class="tj-user-dropdown-header">
                                     <span class="tj-user-avatar tj-user-avatar--lg"><?= strtoupper(substr($_tj_uname ?: 'U', 0, 1)) ?></span>
                                     <span class="tj-user-dropdown-name"><?= htmlspecialchars($_tj_uname ?: 'Account') ?></span>
                                 </div>
                                 <div style="border-top:1px solid #f1f5f9;margin:4px 0"></div>
                                 <a href="<?= site_url('user') ?>">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75"/></svg>
                                     Dashboard
                                 </a>
                                 <a href="<?= site_url('user/bookings') ?>">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"/></svg>
                                     My Bookings
                                 </a>
                                 <a href="<?= site_url('user/profile') ?>">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                     Profile
                                 </a>
                                 <div style="border-top:1px solid #f1f5f9;margin:4px 0"></div>
                                 <a href="<?= site_url('logout') ?>" style="color:#dc2626">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/></svg>
                                     Logout
                                 </a>
                             </div>
                         </div>
                         <?php endif; ?>
                        <!-- Mobile: icon buttons -->
                        <div class="mob-header-icons d-lg-none d-flex align-items-center">
                            <?php if ($_tj_uid): ?>
                            <a href="<?= site_url('user') ?>" class="mob-icon-btn" aria-label="My Account">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                            </a>
                            <?php else: ?>
                            <button type="button" class="mob-icon-btn" aria-label="Login" id="tjLoginMobBtn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
                            </button>
                            <?php endif; ?>

                            <!-- Quote / Book -->
                            <button type="button" class="mob-icon-btn" aria-label="Get Quote"
                                data-bs-toggle="modal" data-bs-target="#qteModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                            </button>

                            <!-- Call -->
                            <a href="tel:+919558515518" class="mob-icon-btn" aria-label="Call Us">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
                            </a>

                            <!-- Menu -->
                            <drawer-opener class="mob-icon-btn" data-drawer=".drawer-menu" aria-label="Menu">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </drawer-opener>
                        </div>
                     </div>

<style>
.tj-login-btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border:1.5px solid #e5e7eb;border-radius:10px;background:#fff;color:#374151;font-size:13px;font-weight:600;cursor:pointer;transition:all .15s}
.tj-login-btn:hover{border-color:#f97316;color:#f97316}
.tj-user-avatar{width:34px;height:34px;border-radius:50%;background:#f97316;color:#fff;font-size:13px;font-weight:700;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0}
.tj-user-avatar--lg{width:38px;height:38px;font-size:15px}
.tj-user-avatar-btn{width:38px;height:38px;border-radius:50%;background:#f97316;color:#fff;font-size:14px;font-weight:700;border:2px solid transparent;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;transition:box-shadow .15s,border-color .15s;padding:0}
.tj-user-avatar-btn:hover{box-shadow:0 0 0 3px rgba(249,115,22,.25);border-color:#f97316}
.tj-login-btn,.tj-user-menu{display:none}
@media(min-width:992px){.tj-login-btn{display:inline-flex!important}.tj-user-menu{display:flex!important;align-items:center}}
.tj-user-dropdown{position:absolute;top:calc(100% + 10px);right:0;background:#fff;border:1px solid #e5e7eb;border-radius:14px;box-shadow:0 8px 30px rgba(0,0,0,.12);min-width:190px;padding:6px;display:none;z-index:1000}
.tj-user-dropdown.open{display:block}
.tj-user-dropdown-header{display:flex;align-items:center;gap:10px;padding:8px 10px 10px}
.tj-user-dropdown-name{font-size:13px;font-weight:700;color:#111827;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:120px}
.tj-user-dropdown a{display:flex;align-items:center;gap:9px;padding:9px 12px;font-size:13px;color:#374151;text-decoration:none;border-radius:8px;transition:background .15s}
.tj-user-dropdown a:hover{background:#f8fafc}
#tjLoginResult .tj-err{background:#fef2f2;color:#b91c1c;padding:10px 12px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:0}
#tjLoginResult .tj-ok{background:#f0fdf4;color:#15803d;padding:10px 12px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:0}
</style>
<script>
document.addEventListener('DOMContentLoaded', function(){
(function(){
  var sendOtpUrl = '<?= site_url("auth/send-otp") ?>';
  var verifyUrl  = '<?= site_url("auth/verify-otp") ?>';
  var phone = '';

  function openModal(){
    var el = document.getElementById('tjLoginModal');
    if(el && typeof bootstrap !== 'undefined') new bootstrap.Modal(el).show();
    else if(el && typeof $ !== 'undefined') $(el).modal('show');
  }

  var navBtn = document.getElementById('tjLoginNavBtn');
  var mobBtn = document.getElementById('tjLoginMobBtn');
  if(navBtn) navBtn.addEventListener('click', openModal);
  if(mobBtn) mobBtn.addEventListener('click', openModal);

  // Open if ?login=1 in URL
  if(window.location.search.indexOf('login=1') !== -1) openModal();

  // User dropdown toggle
  var udBtn = document.getElementById('tjUserMenuBtn');
  var udDrop = document.getElementById('tjUserDropdown');
  if(udBtn && udDrop){
    udBtn.addEventListener('click', function(e){
      e.stopPropagation();
      udDrop.classList.toggle('open');
    });
    document.addEventListener('click', function(){ udDrop.classList.remove('open'); });
  }

  // Phone input focus style
  var wrap = document.getElementById('phoneInputWrap');
  var inp = document.getElementById('tjPhone');
  if(inp && wrap){
    inp.addEventListener('focus', function(){ wrap.style.borderColor='#f97316'; wrap.style.boxShadow='0 0 0 3px rgba(249,115,22,.1)'; });
    inp.addEventListener('blur', function(){ wrap.style.borderColor='#d1d5db'; wrap.style.boxShadow='none'; });
  }

  function setResult(html){ document.getElementById('tjLoginResult').innerHTML = html ? '<div style="margin:12px 28px 0">'+html+'</div>' : ''; }

  function setBusy(btn, busy, label){
    btn.disabled = busy;
    btn.style.opacity = busy ? '.7' : '1';
    btn.style.cursor = busy ? 'not-allowed' : 'pointer';
    if(label) btn.textContent = label;
  }

  var sendBtn = document.getElementById('tjSendOtpBtn');
  if(sendBtn){
    sendBtn.addEventListener('click', function(){
      var p = (inp ? inp.value : '').replace(/\D/g,'');
      if(p.length !== 10){ setResult('<div class="tj-err">Enter a valid 10-digit number.</div>'); return; }
      setResult('');
      setBusy(sendBtn, true, 'Sending OTP…');
      fetch(sendOtpUrl, {
        method:'POST', headers:{'X-Requested-With':'XMLHttpRequest','Content-Type':'application/x-www-form-urlencoded'},
        body:'phone='+encodeURIComponent(p)
      }).then(function(r){ return r.json(); }).then(function(d){
        setBusy(sendBtn, false);
        sendBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> Send OTP on WhatsApp';
        if(d.ok){
          phone = p;
          document.getElementById('tjPhoneDisplay').textContent = p;
          document.getElementById('tjStep1').style.display='none';
          document.getElementById('tjStep2').style.display='block';
          // Test mode: extract OTP, auto-fill input, show banner
          if(d.message && d.message.indexOf('TEST MODE') !== -1){
            var testOtp = d.message.replace(/\D/g,'').slice(-6);
            if(testOtp) document.getElementById('tjOtp').value = testOtp;
            setResult('<div style="background:#fef9c3;border:1.5px solid #f59e0b;border-radius:10px;padding:12px 14px;font-size:14px;color:#78350f;font-weight:700;display:flex;align-items:center;gap:10px"><span style="font-size:20px">🧪</span><span>TEST MODE &nbsp;— OTP auto-filled: <span style="font-family:monospace;font-size:18px;letter-spacing:4px">'+testOtp+'</span></span></div>');
          }
        } else {
          setResult('<div class="tj-err">'+d.message+'</div>');
        }
      }).catch(function(){
        setBusy(sendBtn, false);
        sendBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> Send OTP on WhatsApp';
        setResult('<div class="tj-err">Network error. Please try again.</div>');
      });
    });
  }

  var verifyBtn = document.getElementById('tjVerifyOtpBtn');
  if(verifyBtn){
    verifyBtn.addEventListener('click', function(){
      var otp = document.getElementById('tjOtp').value.replace(/\D/g,'');
      if(otp.length !== 6){ setResult('<div class="tj-err">Enter the 6-digit OTP.</div>'); return; }
      setResult('');
      setBusy(verifyBtn, true, 'Verifying…');
      fetch(verifyUrl, {
        method:'POST', headers:{'X-Requested-With':'XMLHttpRequest','Content-Type':'application/x-www-form-urlencoded'},
        body:'phone='+encodeURIComponent(phone)+'&otp='+encodeURIComponent(otp)
      }).then(function(r){ return r.json(); }).then(function(d){
        setBusy(verifyBtn, false, 'Verify & Login');
        if(d.ok){
          setResult('<div class="tj-ok">Login successful! Redirecting…</div>');
          setTimeout(function(){ window.location.href = d.redirect || '<?= site_url("user") ?>'; }, 800);
        } else {
          setResult('<div class="tj-err">'+d.message+'</div>');
        }
      }).catch(function(){ setBusy(verifyBtn,false,'Verify & Login'); setResult('<div class="tj-err">Network error. Please try again.</div>'); });
    });
  }

  var resendBtn = document.getElementById('tjResendBtn');
  if(resendBtn){
    resendBtn.addEventListener('click', function(){
      document.getElementById('tjStep2').style.display='none';
      document.getElementById('tjStep1').style.display='block';
      document.getElementById('tjOtp').value='';
      setResult('');
    });
  }
})();
});
</script>
                 </div>
             </div>
         </header>
     </sticky-header>

<!-- Login Modal — placed outside sticky-header to avoid stacking-context trap -->
<div class="modal fade" id="tjLoginModal" tabindex="-1" aria-labelledby="tjLoginTitle" aria-hidden="true" style="z-index:10000">
  <div class="modal-dialog modal-dialog-centered" style="max-width:420px">
    <div class="modal-content" style="border:0;border-radius:20px;box-shadow:0 30px 70px rgba(17,24,39,.2);overflow:hidden">
      <div style="padding:28px 28px 0">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:6px">
          <div>
            <div style="font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#f97316;margin-bottom:4px">TripJyada</div>
            <h4 id="tjLoginTitle" style="margin:0;font-size:22px;font-weight:800;color:#111827">Login with WhatsApp OTP</h4>
            <p style="margin:6px 0 0;font-size:13px;color:#6b7280">We'll send a 6-digit OTP to your WhatsApp</p>
          </div>
          <button type="button" data-bs-dismiss="modal" style="border:0;background:#f3f4f6;color:#4b5563;width:34px;height:34px;border-radius:50%;font-size:16px;cursor:pointer;flex-shrink:0">&#x2715;</button>
        </div>
      </div>
      <div id="tjLoginResult" style="margin:0 28px;min-height:0"></div>
      <!-- Step 1: Phone -->
      <div id="tjStep1" style="padding:20px 28px 28px">
        <div style="display:flex;flex-direction:column;gap:5px;margin-bottom:14px">
          <label style="font-size:12px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.4px">Mobile Number</label>
          <div style="display:flex;align-items:center;border:1.5px solid #d1d5db;border-radius:12px;overflow:hidden;transition:border-color .2s" id="phoneInputWrap">
            <span style="padding:12px 12px 12px 14px;font-size:14px;color:#6b7280;border-right:1px solid #e5e7eb;background:#f9fafb;font-weight:600;white-space:nowrap">+91</span>
            <input type="tel" id="tjPhone" maxlength="10" placeholder="Enter 10-digit number" style="flex:1;padding:12px 14px;border:0;outline:none;font-size:15px;color:#111827" inputmode="numeric">
          </div>
        </div>
        <button type="button" id="tjSendOtpBtn" style="width:100%;background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:0;border-radius:12px;padding:13px;font-size:15px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          Send OTP on WhatsApp
        </button>
      </div>
      <!-- Step 2: OTP -->
      <div id="tjStep2" style="display:none;padding:20px 28px 28px">
        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:10px 14px;font-size:13px;color:#15803d;margin-bottom:16px;display:flex;align-items:center;gap:8px">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          OTP sent to WhatsApp: +91 <strong id="tjPhoneDisplay"></strong>
        </div>
        <div style="display:flex;flex-direction:column;gap:5px;margin-bottom:14px">
          <label style="font-size:12px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.4px">Enter 6-digit OTP</label>
          <input type="number" id="tjOtp" maxlength="6" placeholder="• • • • • •" style="width:100%;padding:14px;border:1.5px solid #d1d5db;border-radius:12px;font-size:22px;font-weight:700;letter-spacing:6px;text-align:center;outline:none;color:#111827" inputmode="numeric">
        </div>
        <button type="button" id="tjVerifyOtpBtn" style="width:100%;background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:0;border-radius:12px;padding:13px;font-size:15px;font-weight:700;cursor:pointer;margin-bottom:12px">
          Verify & Login
        </button>
        <button type="button" id="tjResendBtn" style="width:100%;background:none;border:1.5px solid #e5e7eb;border-radius:12px;padding:11px;font-size:13px;color:#6b7280;cursor:pointer">
          Resend OTP
        </button>
      </div>
    </div>
  </div>
</div>
<style>
/* Ensure modal backdrop doesn't cover our modal */
body.modal-open .modal-backdrop { z-index: 1040; }
</style>