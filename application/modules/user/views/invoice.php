<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Proforma Invoice — TripJyada #<?= $booking['id'] ?></title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Arial,Helvetica,sans-serif;background:#f0f0f0;color:#111;font-size:13px}

.print-bar{background:#1e293b;padding:12px 24px;display:flex;justify-content:space-between;align-items:center}
.print-bar p{color:#94a3b8;font-size:13px}
.print-btn{padding:8px 20px;background:#c0392b;color:#fff;border:none;border-radius:5px;font-size:13px;font-weight:700;cursor:pointer}
@media print{.print-bar{display:none}body{background:#fff}}

.inv{max-width:780px;margin:24px auto;background:#fff;border:1px solid #ddd}
@media print{.inv{margin:0;border:none;max-width:100%}}

/* Banner */
.inv-banner{background:#c0392b;color:#fff;text-align:center;padding:11px;font-size:15px;font-weight:700;letter-spacing:2px}

/* Header */
.inv-head{display:flex;justify-content:space-between;align-items:center;padding:14px 20px 12px;border-bottom:2px solid #c0392b}
.inv-logo{display:flex;align-items:center;gap:10px}
.inv-logo img{height:54px;width:auto}
.inv-logo-text{font-size:18px;font-weight:800;color:#c0392b;letter-spacing:-0.5px}
.inv-head-meta{display:flex;gap:30px;text-align:center}
.inv-meta-item label{display:block;font-size:10px;color:#888;font-weight:700;text-transform:uppercase;letter-spacing:.4px;margin-bottom:2px}
.inv-meta-item span{font-size:13px;font-weight:700;color:#111}

/* Seller / Buyer */
.inv-parties{display:grid;grid-template-columns:1fr 1fr;border-bottom:1px solid #ddd}
.inv-party{padding:14px 20px}
.inv-party-label{font-size:10px;font-weight:700;color:#888;text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px}
.inv-party-name{font-size:14px;font-weight:800;color:#111;margin-bottom:5px}
.inv-party-addr{font-size:12px;color:#444;line-height:1.7}
.inv-party-gst{font-size:11px;color:#555;margin-top:4px}
.inv-party.buyer{border-left:1px solid #ddd;text-align:right}
.inv-party.buyer .inv-party-name{font-size:15px}
.inv-supply{text-align:right;padding:5px 20px 10px;font-size:11.5px;font-weight:700;color:#333;border-bottom:1px solid #ddd}

/* Overview */
.inv-overview{padding:12px 20px;background:#fdf9f9;border-bottom:1px solid #ddd}
.inv-overview-title{font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#888;margin-bottom:6px}
.inv-overview-line{font-size:12.5px;color:#333;line-height:1.8}
.inv-overview-line strong{color:#111}

/* Table */
.inv-table-wrap{padding:0 20px}
.inv-table{width:100%;border-collapse:collapse;margin:14px 0}
.inv-table th{background:#f5e6e6;color:#7a1c1c;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.4px;padding:9px 12px;border:1px solid #dfc4c4;text-align:left}
.inv-table th:last-child{text-align:right}
.inv-table td{padding:10px 12px;border:1px solid #e8e8e8;vertical-align:top;font-size:12.5px;color:#222;line-height:1.6}
.inv-table td:last-child{text-align:right;font-weight:600;white-space:nowrap}
.inv-table .inv-tr-total td{font-size:13px;font-weight:800;background:#fff5f5;border-top:2px solid #c0392b}
.inv-table .inv-tr-total td:last-child{font-size:14px}
.inv-part-main{font-weight:700;color:#111}
.inv-part-sub{font-size:11.5px;color:#555;margin-top:2px}

/* Amount in words */
.inv-words{padding:8px 20px 12px;border-bottom:1px solid #ddd;display:flex;justify-content:space-between;align-items:flex-start;gap:12px}
.inv-words-left label{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.4px;color:#888;display:block;margin-bottom:3px}
.inv-words-left span{font-size:12.5px;font-weight:700;color:#111}
.inv-words-right{font-size:11px;color:#888;white-space:nowrap;margin-top:14px}

/* Bank Details */
.inv-bank{padding:12px 20px 14px;border-bottom:1px solid #ddd;background:#fafafa}
.inv-bank-title{font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.4px;color:#888;margin-bottom:10px}
.inv-bank-list{list-style:none;font-size:12.5px;color:#222;line-height:1.9}
.inv-bank-list li span{font-weight:700}

/* Note */
.inv-note{text-align:center;padding:9px 20px;font-size:11px;color:#888;border-bottom:1px solid #ddd;font-style:italic}

/* Footer */
.inv-footer{display:grid;grid-template-columns:1fr auto 1fr;align-items:center;padding:12px 20px;gap:12px;background:#fff}
.inv-footer-office{font-size:11.5px;color:#555;line-height:1.7}
.inv-footer-office strong{color:#111;display:block;font-size:11.5px;margin-bottom:1px}
.inv-footer-center{text-align:center}
.inv-footer-brand{font-size:15px;font-weight:800;color:#c0392b;margin-bottom:6px}
.inv-footer-badges{display:flex;gap:5px;justify-content:center;flex-wrap:wrap}
.inv-footer-badge{font-size:9px;border:1px solid #bbb;border-radius:3px;padding:2px 7px;color:#555;font-weight:700}
.inv-footer-right{text-align:right}

@media(max-width:600px){
    .inv-parties{grid-template-columns:1fr}
    .inv-party.buyer{border-left:none;border-top:1px solid #ddd;text-align:left}
    .inv-supply{text-align:left}
    .inv-head{flex-direction:column;gap:12px}
    .inv-footer{grid-template-columns:1fr}
    .inv-footer-right{text-align:left}
    .inv-words{flex-direction:column}
}
</style>
</head>
<body>
<?php
$b = $booking;

function tj_amount_words($n) {
    $n = (int) round($n);
    if ($n === 0) return 'Zero';
    $ones = ['','One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten',
             'Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen',
             'Eighteen','Nineteen'];
    $tens = ['','','Twenty','Thirty','Forty','Fifty','Sixty','Seventy','Eighty','Ninety'];
    function _seg($n, $ones, $tens) {
        $s = '';
        if ($n >= 100) { $s .= $ones[intval($n/100)] . ' Hundred '; $n %= 100; }
        if ($n >= 20)  { $s .= $tens[intval($n/10)] . ($n%10 ? ' '.$ones[$n%10] : ''); }
        else if ($n > 0) { $s .= $ones[$n]; }
        return trim($s);
    }
    $crore = intval($n / 10000000); $n %= 10000000;
    $lakh  = intval($n / 100000);   $n %= 100000;
    $thou  = intval($n / 1000);     $n %= 1000;
    $rest  = $n;
    $parts = [];
    if ($crore) $parts[] = _seg($crore,$ones,$tens) . ' Crore';
    if ($lakh)  $parts[] = _seg($lakh,$ones,$tens)  . ' Lakh';
    if ($thou)  $parts[] = _seg($thou,$ones,$tens)  . ' Thousand';
    if ($rest)  $parts[] = _seg($rest,$ones,$tens);
    return implode(' ', $parts) . ' Only';
}

$pkg         = isset($b['_package']) ? $b['_package'] : null;
$trip_id     = str_pad($b['id'], 7, '0', STR_PAD_LEFT);
$issue_date  = date('d M, Y', strtotime($b['created_at']));
$due_date    = !empty($b['travel_date']) ? date('d M, Y', strtotime($b['travel_date'])) : $issue_date;
$total_amt   = (int)$b['total_amount'] ?: (int)$b['amount_rupees'];
$advance_amt = (int)$b['amount_rupees'];
$balance_amt = (int)$b['balance_due'];
$adv_pct     = (int)$b['advance_percent'] ?: 30;
$is_full_pay = ($adv_pct === 100 || $balance_amt === 0);
$inv_type    = $is_full_pay ? 'TAX INVOICE' : 'PROFORMA INVOICE';
$num_nights  = max(0, (int)$b['num_days'] - 1);
$num_days    = (int)$b['num_days'];
$num_adults  = (int)$b['num_adults'];
$num_kids    = (int)$b['num_kids'];
$gst_amt     = (int)$b['gst_amount'];

// Format phone for display: ensure +91- prefix
$raw_phone   = preg_replace('/\D/', '', (string)$b['customer_phone']);
$disp_phone  = '+91-' . (strlen($raw_phone) > 10 ? substr($raw_phone, -10) : $raw_phone);
?>

<!-- Print bar -->
<div class="print-bar">
    <p>Proforma Invoice — TripJyada #<?= $trip_id ?></p>
    <button class="print-btn" onclick="window.print()">&#x2399; Print / Save PDF</button>
</div>

<div class="inv">

    <!-- Banner -->
    <div class="inv-banner" style="<?= $is_full_pay ? 'background:#16a34a' : '' ?>"><?= $inv_type ?></div>

    <!-- Logo + Meta -->
    <div class="inv-head">
        <div class="inv-logo">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="TripJyada" onerror="this.style.display='none'">
            <div class="inv-logo-text">TRIPJYADA</div>
        </div>
        <div class="inv-head-meta">
            <div class="inv-meta-item">
                <label>Issue Date</label>
                <span><?= $issue_date ?></span>
            </div>
            <div class="inv-meta-item">
                <label>Due Date</label>
                <span><?= $due_date ?></span>
            </div>
            <div class="inv-meta-item">
                <label>Trip ID</label>
                <span><?= $trip_id ?></span>
            </div>
        </div>
    </div>

    <!-- Seller / Buyer -->
    <div class="inv-parties">
        <div class="inv-party seller">
            <div class="inv-party-label">Seller</div>
            <div class="inv-party-name">TRIPJYADA PVT LTD</div>
            <div class="inv-party-addr">
                Phansidewa More, Shivmandir Siliguri,<br>
                West Bengal, India - 734011<br>
                Darjeeling, West Bengal, India - 734011<br>
                +91-8927169005 &nbsp;·&nbsp; info@tripjyada.com
            </div>
            <div class="inv-party-gst">GST 19AATFT6367Q1ZS</div>
        </div>
        <div class="inv-party buyer">
            <div class="inv-party-label">Buyer (Bill To)</div>
            <div class="inv-party-name"><?= htmlspecialchars($b['customer_name']) ?></div>
            <div class="inv-party-addr">
                <?php if (!empty($b['customer_phone'])): ?>
                Phone: <?= htmlspecialchars($disp_phone) ?><br>
                <?php endif; ?>
                <?php if (!empty($b['customer_email'])): ?>
                <?= htmlspecialchars($b['customer_email']) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="inv-supply">Place of Supply: West Bengal (19)</div>

    <!-- Overview -->
    <div class="inv-overview">
        <div class="inv-overview-title">Overview</div>
        <?php if ($is_full_pay): ?>
        <div class="inv-overview-line">
            <strong>FULL PAYMENT ₹<?= number_format($total_amt) ?>/-</strong> &nbsp;+5% GST &nbsp;— PAID IN FULL
        </div>
        <?php else: ?>
        <div class="inv-overview-line">
            <strong>ADVANCE BOOKING AMOUNT <?= number_format($advance_amt - $gst_amt) ?>/- + 5% GST = <?= number_format($advance_amt) ?>/-</strong> PAID
        </div>
        <div class="inv-overview-line">
            <strong><?= number_format($balance_amt) ?>/- REMAINING AMOUNT</strong> +5% GST — DUE ON ARRIVAL
        </div>
        <?php endif; ?>
    </div>

    <!-- Table -->
    <div class="inv-table-wrap">
        <table class="inv-table">
            <thead>
                <tr>
                    <th style="width:44px">S.No.</th>
                    <th>Particulars</th>
                    <th style="width:150px">Amount (INR)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>
                        <div class="inv-part-main">Trip#: <?= $trip_id ?></div>
                        <div class="inv-part-sub"><?= htmlspecialchars($b['package_title']) ?> Tour Package</div>
                        <div class="inv-part-sub">
                            <?= htmlspecialchars($b['customer_name']) ?>
                            <?php if (!empty($b['travel_date'])): ?> — <?= date('d M Y', strtotime($b['travel_date'])) ?><?php endif; ?>
                            <?php if ($num_days > 0): ?> — <?= $num_nights ?>N,<?= $num_days ?>D<?php endif; ?>
                            <?php if ($num_adults > 0): ?> — <?= $num_adults ?>A<?= $num_kids > 0 ? ', '.$num_kids.'K' : '' ?><?php endif; ?>
                        </div>
                    </td>
                    <td>INR <?= number_format($total_amt) ?>.00</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="inv-tr-total">
                    <td colspan="2" style="text-align:right"><strong>Total (INR)</strong></td>
                    <td>INR <?= number_format($total_amt) ?>.00</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Amount in words -->
    <div class="inv-words">
        <div class="inv-words-left">
            <label>Amount Chargeable (in words)</label>
            <span>INR: <?= tj_amount_words($total_amt) ?></span>
        </div>
        <div class="inv-words-right">E. &amp; O.E.</div>
    </div>

    <!-- Bank Details -->
    <div class="inv-bank">
        <div class="inv-bank-title">Seller's Bank Details</div>
        <ul class="inv-bank-list">
            <li>Bank Name &nbsp;<span>HDFC Bank</span></li>
            <li>A/c Holder Name &nbsp;<span>TRIPJYADA</span></li>
            <li>A/c No. &nbsp;<span>50200084110605</span></li>
            <li>IFSC: &nbsp;<span>HDFC0004155</span></li>
            <li>Branch: &nbsp;<span>SHIVMANDIR</span></li>
            <?php if (!empty($b['razorpay_payment_id'])): ?>
            <li>Payment Ref. &nbsp;<span style="font-family:monospace;font-size:11px"><?= htmlspecialchars($b['razorpay_payment_id']) ?></span></li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Note -->
    <div class="inv-note">This is a computer generated document. No signature required.</div>

    <!-- Footer -->
    <div class="inv-footer">
        <div class="inv-footer-office">
            <strong>Branch-Office —</strong>
            Jodhpur Gardens,<br>Kolkata - 700045
        </div>
        <div class="inv-footer-center">
            <div class="inv-footer-brand">TRIPJYADA Pvt. Ltd.</div>
            <div class="inv-footer-badges">
                <span class="inv-footer-badge">ISO</span>
                <span class="inv-footer-badge">BNI</span>
                <span class="inv-footer-badge">IATA</span>
            </div>
        </div>
        <div class="inv-footer-right inv-footer-office">
            <strong>Head-Office —</strong>
            Shiv Mandir, Siliguri,<br>Darjeiling - 734011
        </div>
    </div>

</div>
</body>
</html>
