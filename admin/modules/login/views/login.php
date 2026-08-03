<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tripjyada Admin <?=date("D d M Y")?></title>

    <link href="<?=base_url()?>assets/admin/css/main.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/img/logo/favicon.png"/>
    <style>
        html,
        body {
            min-height: 100%;
        }

        body {
            margin: 0;
            font-family: "Lato", Arial, sans-serif;
            background:
                linear-gradient(135deg, rgba(255, 111, 0, 0.08), rgba(17, 24, 39, 0.04)),
                #f5f7fb;
            color: #1f2933;
        }

        .admin-login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 36px 18px;
        }

        .admin-login-shell {
            width: 100%;
            max-width: 980px;
            min-height: 540px;
            display: grid;
            grid-template-columns: 1fr 420px;
            overflow: hidden;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 24px 60px rgba(31, 41, 51, 0.16);
        }

        .login-brand-panel {
            position: relative;
            padding: 56px 48px;
            background:
                linear-gradient(135deg, rgba(255, 111, 0, 0.92), rgba(247, 144, 9, 0.88)),
                url("<?=base_url()?>assets/images/logo.png");
            background-size: cover;
            background-position: center;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .login-brand-panel:before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(21, 25, 32, 0.22);
        }

        .login-brand-content {
            position: relative;
            z-index: 1;
        }

        .login-logo-card {
            width: 156px;
            height: 120px;
            padding: 14px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.92);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 16px 36px rgba(17, 24, 39, 0.18);
        }

        .login-logo-card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .login-brand-panel h1 {
            margin: 42px 0 14px;
            font-size: 34px;
            line-height: 1.2;
            font-weight: 700;
            letter-spacing: 0;
        }

        .login-brand-panel p {
            max-width: 390px;
            margin: 0;
            font-size: 15px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.9);
        }

        .login-tag {
            position: relative;
            z-index: 1;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.6px;
            color: rgba(255, 255, 255, 0.9);
        }

        .login-form-panel {
            padding: 58px 46px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .login-form-panel h2 {
            margin: 0 0 10px;
            font-size: 27px;
            line-height: 1.25;
            color: #111827;
            font-weight: 700;
            letter-spacing: 0;
        }

        .login-subtitle {
            margin: 0 0 26px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
        }

        .login-form-panel .alert {
            border-radius: 6px;
            font-size: 13px;
            padding: 12px 14px;
            margin-bottom: 20px;
        }

        .login-field {
            margin-bottom: 17px;
        }

        .login-field label {
            display: block;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .login-field .form-control {
            height: 46px;
            border: 1px solid #d8dee8;
            border-radius: 6px;
            box-shadow: none;
            font-size: 14px;
            padding: 10px 13px;
        }

        .login-field .form-control:focus {
            border-color: #ff7a00;
            box-shadow: 0 0 0 3px rgba(255, 122, 0, 0.16);
        }

        .login-button {
            width: 100%;
            height: 46px;
            margin-top: 6px;
            border: 0;
            border-radius: 6px;
            background: #ff7a00;
            color: #ffffff;
            font-weight: 700;
            box-shadow: 0 10px 20px rgba(255, 122, 0, 0.24);
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .login-button:hover,
        .login-button:focus {
            background: #e96f00;
            color: #ffffff;
            transform: translateY(-1px);
        }

        @media (max-width: 860px) {
            .admin-login-shell {
                grid-template-columns: 1fr;
                max-width: 520px;
            }

            .login-brand-panel {
                min-height: 300px;
                padding: 36px 30px;
            }

            .login-brand-panel h1 {
                font-size: 29px;
                margin-top: 28px;
            }

            .login-form-panel {
                padding: 38px 28px;
            }
        }

        @media (max-width: 440px) {
            .admin-login-page {
                padding: 18px 12px;
            }

            .login-brand-panel,
            .login-form-panel {
                padding-left: 22px;
                padding-right: 22px;
            }

            .login-logo-card {
                width: 138px;
                height: 106px;
            }
        }
    </style>
</head>
<body hoe-navigation-type="vertical" hoe-nav-placement="left" theme-layout="wide-layout" class="view-animate-container">
    <div id="hoeapp-wrapper" class="hoe-hide-lpanel" hoe-device-type="desktop">
        <main class="admin-login-page">
            <section class="admin-login-shell">
                <aside class="login-brand-panel">
                    <div class="login-brand-content">
                        <div class="login-logo-card">
                            <img src="<?=base_url("assets/img/logo/logo.png")?>" alt="Tripjyada logo" loading="lazy">
                        </div>
                        <h1>Tripjyada Admin</h1>
                        <p>Manage bookings, blogs, packages, gallery content, and customer requests from one clean control panel.</p>
                    </div>
                    <div class="login-tag">One stop for all your travel needs</div>
                </aside>

                <section class="login-form-panel">
                    <h2>Welcome Administrator</h2>
                    <p class="login-subtitle">Sign in with your admin credentials to continue.</p>

                    <form action="<?=site_url('login/check');?>" method="post">
                        <?php
                        $error = validation_errors();
                        if (isset($msg)) {
                            echo '<div class="alert alert-danger">'.$msg.'</div>';
                        } else if (!$error) {
                            echo '<div class="alert alert-info">Please login with your Username and Password.</div>';
                        } else {
                            echo '<div class="alert alert-warning">'.$error.'</div>';
                        }
                        ?>

                        <div class="login-field">
                            <label for="username">Username</label>
                            <input class="form-control" name="user" autofocus id="username" value="<?=set_value('username');?>" placeholder="Enter username"/>
                        </div>

                        <div class="login-field">
                            <label for="password">Password</label>
                            <input class="form-control" name="pass" id="password" type="password" placeholder="Enter password"/>
                        </div>

                        <button type="submit" class="login-button" onclick="setvalue()" id="myButton">Login</button>
                    </form>
                </section>
            </section>
        </main>
    </div>

    <script>
        function setvalue() {
            document.getElementById('myButton').innerText = 'Verifying...';
        }
    </script>
</body>
</html>
