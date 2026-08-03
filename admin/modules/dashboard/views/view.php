<style>
/* ── Dashboard layout ── */
.db-wrap { padding: 20px 20px 30px; background: #f0f2f7; min-height: 100vh; }

/* ── Top bar ── */
.db-topbar { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 22px; }
.db-greeting h2 { font-size: 20px; font-weight: 800; color: #111827; margin: 0 0 3px; }
.db-greeting p  { font-size: 13px; color: #6b7280; margin: 0; }
.db-date-badge  { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 7px 14px; font-size: 12px; font-weight: 600; color: #374151; white-space: nowrap; }

/* ── Section label ── */
.db-section-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #9ca3af; margin: 0 0 12px; }

/* ── Grid ── */
.db-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
@media (min-width: 576px)  { .db-grid { grid-template-columns: repeat(2, 1fr); } }
@media (min-width: 768px)  { .db-grid { grid-template-columns: repeat(3, 1fr); gap: 16px; } }
@media (min-width: 992px)  { .db-grid { grid-template-columns: repeat(4, 1fr); } }
@media (min-width: 1200px) { .db-grid { grid-template-columns: repeat(4, 1fr); gap: 20px; } }

/* ── Card ── */
.db-card {
    background: #fff;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 8px rgba(15,23,42,.06);
    cursor: pointer;
    display: flex;
    flex-direction: column;
    gap: 0;
    overflow: hidden;
    transition: box-shadow .22s ease, transform .22s ease;
}
.db-card:hover { box-shadow: 0 8px 24px rgba(15,23,42,.13); transform: translateY(-3px); }

.db-card-top { padding: 16px 16px 12px; display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; }
.db-card-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; color: #fff; flex-shrink: 0; }
.db-card-trend { font-size: 11px; font-weight: 700; padding: 3px 7px; border-radius: 20px; }

.db-card-body { padding: 0 16px 16px; }
.db-card-num { font-size: 30px; font-weight: 800; color: #111827; line-height: 1; margin: 0 0 4px; }
.db-card-label { font-size: 13px; font-weight: 700; color: #374151; margin: 0 0 2px; }
.db-card-sub { font-size: 11px; color: #9ca3af; margin: 0; }

.db-card-bar { height: 4px; border-radius: 0 0 12px 12px; }

/* colour tokens */
.db-blue   .db-card-icon { background: #2563eb; }
.db-blue   .db-card-bar  { background: linear-gradient(90deg,#2563eb,#60a5fa); }
.db-blue   .db-card-trend { background: #eff6ff; color: #2563eb; }

.db-green  .db-card-icon { background: #16a34a; }
.db-green  .db-card-bar  { background: linear-gradient(90deg,#16a34a,#4ade80); }
.db-green  .db-card-trend { background: #f0fdf4; color: #16a34a; }

.db-orange .db-card-icon { background: #f97316; }
.db-orange .db-card-bar  { background: linear-gradient(90deg,#f97316,#fdba74); }
.db-orange .db-card-trend { background: #fff7ed; color: #f97316; }

.db-pink   .db-card-icon { background: #db2777; }
.db-pink   .db-card-bar  { background: linear-gradient(90deg,#db2777,#f9a8d4); }
.db-pink   .db-card-trend { background: #fdf2f8; color: #db2777; }

.db-cyan   .db-card-icon { background: #0891b2; }
.db-cyan   .db-card-bar  { background: linear-gradient(90deg,#0891b2,#67e8f9); }
.db-cyan   .db-card-trend { background: #ecfeff; color: #0891b2; }

.db-violet .db-card-icon { background: #7c3aed; }
.db-violet .db-card-bar  { background: linear-gradient(90deg,#7c3aed,#c4b5fd); }
.db-violet .db-card-trend { background: #f5f3ff; color: #7c3aed; }

.db-yellow .db-card-icon { background: #ca8a04; }
.db-yellow .db-card-bar  { background: linear-gradient(90deg,#ca8a04,#fde047); }
.db-yellow .db-card-trend { background: #fefce8; color: #ca8a04; }

.db-slate  .db-card-icon { background: #475569; }
.db-slate  .db-card-bar  { background: linear-gradient(90deg,#475569,#94a3b8); }
.db-slate  .db-card-trend { background: #f8fafc; color: #475569; }

.db-red    .db-card-icon { background: #dc2626; }
.db-red    .db-card-bar  { background: linear-gradient(90deg,#dc2626,#fca5a5); }
.db-red    .db-card-trend { background: #fef2f2; color: #dc2626; }

/* mobile tweaks */
@media (max-width: 575px) {
    .db-wrap { padding: 14px 12px 24px; }
    .db-card-num { font-size: 24px; }
    .db-card-icon { width: 38px; height: 38px; font-size: 17px; border-radius: 8px; }
    .db-card-top { padding: 12px 12px 8px; }
    .db-card-body { padding: 0 12px 12px; }
}
</style>

<div class="db-wrap">

    <!-- Top bar -->
    <div class="db-topbar">
        <div class="db-greeting">
            <h2>Dashboard</h2>
            <p>Welcome back — here's what's happening today.</p>
        </div>
        <div class="db-date-badge">
            <i class="fa fa-calendar" style="margin-right:5px;color:#f97316"></i>
            <?= date('D, d M Y') ?>
        </div>
    </div>

    <p class="db-section-label">Admin Overview</p>

    <div class="db-grid">

        <!-- Bookings -->
        <div class="db-card db-blue" ui-sref="booking">
            <div class="db-card-top">
                <span class="db-card-icon"><i class="fa fa-calendar-check-o"></i></span>
                <span class="db-card-trend">Live</span>
            </div>
            <div class="db-card-body">
                <p class="db-card-num">{{bookings || 0}}</p>
                <p class="db-card-label">Bookings</p>
                <p class="db-card-sub">Total bookings</p>
            </div>
            <div class="db-card-bar"></div>
        </div>

        <!-- Contacts -->
        <div class="db-card db-green" ui-sref="contact">
            <div class="db-card-top">
                <span class="db-card-icon"><i class="fa fa-envelope"></i></span>
                <span class="db-card-trend">Live</span>
            </div>
            <div class="db-card-body">
                <p class="db-card-num">{{contact || 0}}</p>
                <p class="db-card-label">Contacts</p>
                <p class="db-card-sub">Customer messages</p>
            </div>
            <div class="db-card-bar"></div>
        </div>

        <!-- Blog -->
        <div class="db-card db-orange" ui-sref="blog">
            <div class="db-card-top">
                <span class="db-card-icon"><i class="fa fa-bullhorn"></i></span>
                <span class="db-card-trend">Live</span>
            </div>
            <div class="db-card-body">
                <p class="db-card-num">{{blog || 0}}</p>
                <p class="db-card-label">Blog</p>
                <p class="db-card-sub">Published posts</p>
            </div>
            <div class="db-card-bar"></div>
        </div>

        <!-- Gallery -->
        <div class="db-card db-pink" ui-sref="gallery">
            <div class="db-card-top">
                <span class="db-card-icon"><i class="fa fa-photo"></i></span>
                <span class="db-card-trend">Live</span>
            </div>
            <div class="db-card-body">
                <p class="db-card-num">{{gallery || 0}}</p>
                <p class="db-card-label">Gallery</p>
                <p class="db-card-sub">Uploaded images</p>
            </div>
            <div class="db-card-bar"></div>
        </div>

        <!-- Branches -->
        <div class="db-card db-cyan" ui-sref="branches">
            <div class="db-card-top">
                <span class="db-card-icon"><i class="fa fa-map-marker"></i></span>
                <span class="db-card-trend">Live</span>
            </div>
            <div class="db-card-body">
                <p class="db-card-num">{{branches || 0}}</p>
                <p class="db-card-label">Branches</p>
                <p class="db-card-sub">Active branches</p>
            </div>
            <div class="db-card-bar"></div>
        </div>

        <!-- Newsletter -->
        <div class="db-card db-violet" ui-sref="newsletter">
            <div class="db-card-top">
                <span class="db-card-icon"><i class="fa fa-paper-plane"></i></span>
                <span class="db-card-trend">Live</span>
            </div>
            <div class="db-card-body">
                <p class="db-card-num">{{newsletter || 0}}</p>
                <p class="db-card-label">Newsletter</p>
                <p class="db-card-sub">Subscribers</p>
            </div>
            <div class="db-card-bar"></div>
        </div>

        <!-- Reviews -->
        <div class="db-card db-yellow" ui-sref="reviews">
            <div class="db-card-top">
                <span class="db-card-icon"><i class="fa fa-star"></i></span>
                <span class="db-card-trend">Live</span>
            </div>
            <div class="db-card-body">
                <p class="db-card-num">{{reviews || 0}}</p>
                <p class="db-card-label">Reviews</p>
                <p class="db-card-sub">Customer reviews</p>
            </div>
            <div class="db-card-bar"></div>
        </div>

        <!-- Logs -->
        <div class="db-card db-slate" ui-sref="logs">
            <div class="db-card-top">
                <span class="db-card-icon"><i class="fa fa-list-alt"></i></span>
                <span class="db-card-trend">Live</span>
            </div>
            <div class="db-card-body">
                <p class="db-card-num">{{logs || 0}}</p>
                <p class="db-card-label">Logs</p>
                <p class="db-card-sub">Admin activity</p>
            </div>
            <div class="db-card-bar"></div>
        </div>

        <!-- Card (tour cards) -->
        <div class="db-card db-red" ui-sref="card">
            <div class="db-card-top">
                <span class="db-card-icon"><i class="fa fa-suitcase"></i></span>
                <span class="db-card-trend">Live</span>
            </div>
            <div class="db-card-body">
                <p class="db-card-num">{{cards || 0}}</p>
                <p class="db-card-label">Tour Cards</p>
                <p class="db-card-sub">Frontend tour cards</p>
            </div>
            <div class="db-card-bar"></div>
        </div>

    </div>
</div>
