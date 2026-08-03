<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login — Tripjyada</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#f1f5f9;min-height:100vh;display:flex;align-items:center;justify-content:center}
.card{background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,.1);padding:40px;width:100%;max-width:400px}
.logo{text-align:center;margin-bottom:28px}
.logo img{height:48px}
.logo-text{font-size:22px;font-weight:700;color:#1e293b;margin-top:8px}
.logo-sub{font-size:13px;color:#64748b;margin-top:4px}
label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px}
input[type=password]{width:100%;padding:11px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:15px;outline:none;transition:border-color .2s}
input[type=password]:focus{border-color:#f97316}
.btn{width:100%;padding:12px;background:#f97316;color:#fff;border:none;border-radius:8px;font-size:15px;font-weight:600;cursor:pointer;margin-top:18px;transition:background .2s}
.btn:hover{background:#ea6a0a}
.error{background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:8px;padding:10px 14px;font-size:14px;margin-bottom:16px}
.lock-icon{text-align:center;font-size:40px;margin-bottom:12px}
</style>
<meta name="robots" content="noindex,nofollow">
</head>
<body>
<div class="card">
    <div class="logo">
        <div class="lock-icon">🔐</div>
        <div class="logo-text">Tripjyada Admin</div>
        <div class="logo-sub">Payment Management Panel</div>
    </div>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('admin/login') ?>">
        <label for="password">Admin Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your admin password" autofocus required>
        <button type="submit" class="btn">Login</button>
    </form>
</div>
</body>
</html>
