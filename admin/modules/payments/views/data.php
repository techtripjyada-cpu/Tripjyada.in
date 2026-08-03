<style>
.pay-filters { display:flex; gap:10px; flex-wrap:wrap; align-items:flex-end; margin-bottom:18px; }
.pay-filters input { border:1px solid #ddd; border-radius:6px; padding:7px 10px; font-size:13px; }
.pay-filters .pay-search { flex:1; min-width:180px; }
.pay-badge { display:inline-block; padding:2px 10px; border-radius:20px; font-size:11px; font-weight:700; }
.pay-badge.paid { background:#dcfce7; color:#166534; }
.pay-badge.captured { background:#dbeafe; color:#1e40af; }
.pay-breakdown { font-size:11px; color:#666; line-height:1.6; }
.pay-breakdown span { display:inline-block; margin-right:6px; }
.pay-total { font-weight:700; color:#111; }
.pay-advance { color:#f97316; font-weight:700; }
.pay-balance { color:#dc2626; }
.pay-empty { text-align:center; padding:40px; color:#999; font-size:14px; }
</style>

<div class="db-wrap" ng-controller="ctrl_payments">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:8px">
        <h4 style="margin:0;font-size:18px;font-weight:700">Completed Payments</h4>
        <span style="font-size:13px;color:#888">Only fully processed (captured) transactions are shown</span>
    </div>

    <div class="pay-filters">
        <input type="text" class="pay-search" ng-model="search_text" placeholder="Search by name, email, phone, package, payment ID…">
        <input type="date" ng-model="date_from" ng-change="loadData()" placeholder="From date">
        <input type="date" ng-model="date_to"   ng-change="loadData()" placeholder="To date">
        <button class="btn btn-default btn-sm" ng-click="clearFilters()">Clear</button>
    </div>

    <div ng-if="loading" style="text-align:center;padding:30px;color:#999">Loading…</div>

    <div ng-if="!loading && (datadb | filter: search_text).length === 0" class="pay-empty">
        No completed payments found.
    </div>

    <div ng-if="!loading && (datadb | filter: search_text).length > 0" style="overflow-x:auto">
        <table class="table table-bordered table-hover" style="font-size:13px;min-width:900px">
            <thead style="background:#f8f9fa">
                <tr>
                    <th>#</th>
                    <th>Booking Info</th>
                    <th>Customer</th>
                    <th>Trip Details</th>
                    <th>Pricing</th>
                    <th>Payment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="y in datadb | filter: search_text | itemsPerPage: 20" pagination-id="payments">
                    <td style="white-space:nowrap">
                        <strong>#{{y.id}}</strong><br>
                        <span class="pay-badge" ng-class="y.local_status">{{y.local_status}}</span>
                    </td>
                    <td>
                        <strong>{{y.package_title}}</strong><br>
                        <small class="text-muted" ng-if="y.razorpay_payment_id">ID: {{y.razorpay_payment_id}}</small>
                    </td>
                    <td>
                        <strong>{{y.customer_name}}</strong><br>
                        <small>{{y.customer_email}}</small><br>
                        <small>{{y.customer_phone}}</small>
                    </td>
                    <td>
                        <span ng-if="y.travel_date"><strong>Travel:</strong> {{y.travel_date}}<br></span>
                        <span ng-if="y.num_days"><strong>Days:</strong> {{y.num_days}}<br></span>
                        <span><strong>Pax:</strong>
                            {{y.num_adults}} adult<span ng-if="y.num_adults != 1">s</span>
                            <span ng-if="y.num_kids > 0">, {{y.num_kids}} kid<span ng-if="y.num_kids != 1">s</span></span>
                        </span>
                    </td>
                    <td>
                        <div class="pay-breakdown">
                            <span ng-if="y.base_amount > 0">Base: &#8377;{{y.base_amount | number}}</span><br ng-if="y.base_amount > 0">
                            <span ng-if="y.sdf_amount > 0">SDF: &#8377;{{y.sdf_amount | number}}</span><br ng-if="y.sdf_amount > 0">
                            <span ng-if="y.gst_amount > 0">GST: &#8377;{{y.gst_amount | number}}</span><br ng-if="y.gst_amount > 0">
                            <span ng-if="y.total_amount > 0" class="pay-total">Total: &#8377;{{y.total_amount | number}}</span><br ng-if="y.total_amount > 0">
                            <span ng-if="y.advance_percent > 0" class="pay-advance">Advance ({{y.advance_percent}}%): &#8377;{{y.amount_rupees | number}}</span><br ng-if="y.advance_percent > 0">
                            <span ng-if="y.balance_due > 0" class="pay-balance">Balance on arrival: &#8377;{{y.balance_due | number}}</span>
                        </div>
                    </td>
                    <td style="white-space:nowrap">
                        <span ng-if="y.payment_method" class="pay-badge paid">{{y.payment_method}}</span><br ng-if="y.payment_method">
                        <small ng-if="y.verified_at">Verified:<br>{{y.verified_at}}</small>
                    </td>
                    <td style="white-space:nowrap;font-size:12px">{{y.created_at}}</td>
                </tr>
            </tbody>
        </table>
        <dir-pagination-controls pagination-id="payments" max-size="7" boundary-links="true"></dir-pagination-controls>
    </div>
</div>
