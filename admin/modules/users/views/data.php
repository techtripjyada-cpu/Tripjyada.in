<div class="db-wrap" ng-controller="ctrl_users">

    <!-- Stats row -->
    <div style="display:flex;gap:14px;flex-wrap:wrap;margin-bottom:20px">
        <div style="flex:1;min-width:130px;background:#fff;border:1px solid #e8edf3;border-radius:10px;padding:16px 18px;text-align:center">
            <div style="font-size:26px;font-weight:700;color:#2563eb">{{stats.total || 0}}</div>
            <div style="font-size:11px;color:#667085;text-transform:uppercase;letter-spacing:.5px;margin-top:2px">Total Users</div>
        </div>
        <div style="flex:1;min-width:130px;background:#fff;border:1px solid #e8edf3;border-radius:10px;padding:16px 18px;text-align:center">
            <div style="font-size:26px;font-weight:700;color:#16a34a">{{stats.logged_today || 0}}</div>
            <div style="font-size:11px;color:#667085;text-transform:uppercase;letter-spacing:.5px;margin-top:2px">Logged In Today</div>
        </div>
        <div style="flex:1;min-width:130px;background:#fff;border:1px solid #e8edf3;border-radius:10px;padding:16px 18px;text-align:center">
            <div style="font-size:26px;font-weight:700;color:#f97316">{{stats.logged_week || 0}}</div>
            <div style="font-size:11px;color:#667085;text-transform:uppercase;letter-spacing:.5px;margin-top:2px">Active This Week</div>
        </div>
        <div style="flex:1;min-width:130px;background:#fff;border:1px solid #e8edf3;border-radius:10px;padding:16px 18px;text-align:center">
            <div style="font-size:26px;font-weight:700;color:#dc2626">{{stats.cancel_pending || 0}}</div>
            <div style="font-size:11px;color:#667085;text-transform:uppercase;letter-spacing:.5px;margin-top:2px">Pending Cancellations</div>
        </div>
        <div style="flex:1;min-width:130px;background:#fff;border:1px solid #e8edf3;border-radius:10px;padding:16px 18px;text-align:center">
            <div style="font-size:26px;font-weight:700;color:#7c3aed">{{stats.batch_pending || 0}}</div>
            <div style="font-size:11px;color:#667085;text-transform:uppercase;letter-spacing:.5px;margin-top:2px">Pending Batch Changes</div>
        </div>
    </div>

    <!-- Tab controls -->
    <div style="display:flex;gap:8px;margin-bottom:16px;align-items:center;flex-wrap:wrap">
        <button class="btn btn-sm" ng-class="tab==='users' ? 'btn-primary' : 'btn-default'" ng-click="showUsers()">
            <i class="fa fa-users"></i> Users
        </button>
        <button class="btn btn-sm" ng-class="tab==='otp' ? 'btn-primary' : 'btn-default'" ng-click="loadOtpLogs('')">
            <i class="fa fa-key"></i> OTP Logs
        </button>
        <span ng-if="tab==='otp' && selected_phone" style="font-size:12px;color:#667085;margin-left:4px">
            — filtered by +91{{selected_phone}}
            <a href="javascript:void(0)" ng-click="loadOtpLogs('')" style="margin-left:6px;color:#f97316">clear</a>
        </span>
        <div style="flex:1"></div>
        <div ng-if="tab==='users'" class="input-group" style="max-width:280px">
            <input type="text" class="form-control input-sm" ng-model="search_text" ng-change="loadUsers()" placeholder="Search name, phone, email…">
            <span class="input-group-btn"><button class="btn btn-default btn-sm" ng-click="clearSearch()"><i class="fa fa-times"></i></button></span>
        </div>
    </div>

    <!-- Users Table -->
    <div ng-if="tab==='users'">
        <div ng-if="loading" style="text-align:center;padding:40px;color:#999">Loading…</div>
        <div ng-if="!loading && users.length === 0" style="text-align:center;padding:40px;color:#999">
            No users registered yet. Users appear here after they log in with OTP.
        </div>
        <div ng-if="!loading && users.length > 0" style="overflow-x:auto">
            <table class="table table-bordered table-hover" style="font-size:13px">
                <thead style="background:#f8f9fa">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Last Login</th>
                        <th>Registered</th>
                        <th>OTP Logs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr dir-paginate="u in users | filter: '' | itemsPerPage: 25" pagination-id="users">
                        <td style="color:#aaa;font-size:11px">{{u.id}}</td>
                        <td>
                            <strong>{{u.name || '—'}}</strong>
                            <span ng-if="!u.name" style="font-size:11px;color:#aaa;display:block">Not set</span>
                        </td>
                        <td><strong>+91 {{u.phone}}</strong></td>
                        <td>{{u.email || '—'}}</td>
                        <td>{{u.gender ? (u.gender | uppercase) : '—'}}</td>
                        <td ng-if="u.last_login_at">
                            <span style="font-size:12px">{{u.last_login_at}}</span>
                        </td>
                        <td ng-if="!u.last_login_at" style="color:#aaa">Never</td>
                        <td style="font-size:12px;color:#aaa">{{u.created_at}}</td>
                        <td>
                            <a href="javascript:void(0)" ng-click="loadOtpLogs(u.phone)" class="btn btn-xs btn-default">
                                <i class="fa fa-key"></i> View
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <dir-pagination-controls pagination-id="users" max-size="7" boundary-links="true" template-url="app/pagination"></dir-pagination-controls>
        </div>
    </div>

    <!-- OTP Logs Table -->
    <div ng-if="tab==='otp'">
        <div ng-if="otp_logs.length === 0" style="text-align:center;padding:40px;color:#999">No OTP logs found.</div>
        <div ng-if="otp_logs.length > 0" style="overflow-x:auto">
            <table class="table table-bordered table-hover" style="font-size:13px">
                <thead style="background:#f8f9fa">
                    <tr>
                        <th>#</th>
                        <th>Phone</th>
                        <th>OTP</th>
                        <th>Status</th>
                        <th>Attempts</th>
                        <th>Expires At</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr dir-paginate="o in otp_logs | itemsPerPage: 30" pagination-id="otp">
                        <td style="color:#aaa;font-size:11px">{{o.id}}</td>
                        <td><strong>+91 {{o.phone}}</strong></td>
                        <td style="font-family:monospace;font-weight:700;letter-spacing:3px">{{o.otp}}</td>
                        <td>
                            <span class="label" ng-class="otpClass(o)">{{otpLabel(o)}}</span>
                        </td>
                        <td>{{o.attempts}}</td>
                        <td style="font-size:12px;color:#aaa">{{o.expires_at}}</td>
                        <td style="font-size:12px;color:#aaa">{{o.created_at}}</td>
                    </tr>
                </tbody>
            </table>
            <dir-pagination-controls pagination-id="otp" max-size="7" boundary-links="true" template-url="app/pagination"></dir-pagination-controls>
        </div>
    </div>
</div>
