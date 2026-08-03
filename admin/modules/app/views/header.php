<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$this->session->userdata('name');?> <?=date("D d M Y")?></title>
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/images/logo/logo.jpeg">
    <link href="<?=base_url("assets")?>/admin/css/main.css" rel="stylesheet">
    <style type="text/css">
    :root {
      --admin-bg: #f4f7fb;
      --admin-card: rgba(255, 255, 255, 0.96);
      --admin-border: #e4e7ec;
      --admin-text: #1f2937;
      --admin-muted: #667085;
      --admin-accent: #f97316;
      --admin-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
    }

    body.admin-shell {
      background:
        radial-gradient(circle at top left, rgba(249, 115, 22, 0.08), transparent 28%),
        radial-gradient(circle at top right, rgba(59, 130, 246, 0.08), transparent 20%),
        var(--admin-bg);
      color: var(--admin-text);
      font-family: "Lato", "Segoe UI", sans-serif;
    }

    #hoe-header {
      background: rgba(255, 255, 255, 0.95) !important;
      border-bottom: 1px solid rgba(228, 231, 236, 0.9);
      box-shadow: 0 14px 34px rgba(15, 23, 42, 0.06);
      backdrop-filter: blur(12px);
    }

    #hoe-header .hoe-left-header,
    #hoe-header .hoe-right-header {
      background: transparent !important;
    }

    #hoe-header .right-navbar > li {
      margin-left: 10px;
    }

    #hoe-header .right-navbar .btn,
    #hoe-header .dropdown-toggle {
      border-radius: 12px;
    }

    #main-content {
      min-height: calc(100vh - 50px);
      padding: 26px 22px 34px;
      background: transparent;
    }

    #main-content .heading {
      margin-bottom: 16px;
    }

    #main-content .breadcrumb {
      background: transparent;
      margin: 0;
      padding: 0;
      font-size: 13px;
      font-weight: 600;
    }

    #main-content .breadcrumb > li + li:before {
      color: #98a2b3;
    }

    #main-content .well,
    #main-content .admin-module-panel {
      background: var(--admin-card);
      border: 1px solid var(--admin-border);
      border-radius: 22px;
      box-shadow: var(--admin-shadow);
      padding: 22px 18px;
    }

    #main-content .btn {
      border-radius: 12px;
      font-weight: 700;
      letter-spacing: 0.01em;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    #main-content .btn:hover,
    #main-content .btn:focus {
      transform: translateY(-1px);
      box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
    }

    #main-content .form-control,
    #main-content .input-group-addon {
      border-color: #d0d5dd;
      border-radius: 12px;
      box-shadow: none;
      min-height: 44px;
    }

    #main-content textarea.form-control {
      min-height: 98px;
      resize: vertical;
    }

    #main-content .form-control:focus {
      border-color: rgba(249, 115, 22, 0.7);
      box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.12);
    }

    #main-content label {
      color: #344054;
      font-weight: 700;
    }

    #main-content .help-block {
      color: var(--admin-muted);
    }

    #main-content .table-data {
      background: #fff;
      border: 1px solid var(--admin-border);
      border-radius: 18px;
      overflow-x: auto;
      overflow-y: hidden;
    }

    #main-content .table {
      margin-bottom: 0;
    }

    #main-content .table > thead > tr > th {
      background: #f8fafc;
      border-bottom: 1px solid var(--admin-border);
      color: #475467;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0.02em;
      text-transform: uppercase;
      vertical-align: middle;
    }

    #main-content .table > tbody > tr > td {
      border-top: 1px solid #eef2f6;
      vertical-align: middle;
      color: var(--admin-text);
    }

    #main-content .alert {
      border-radius: 14px;
      border: 1px solid transparent;
    }

    #main-content .alert-info {
      background: #eff8ff;
      border-color: #b2ddff;
      color: #175cd3;
    }

    @media print {
      aside,header, .col-lg-12, .myhead, hr{
        display:none !important;
      }
      #printarea{
        margin-top:-30px;
        margin-left:-230px;
      }

    }

    @media (max-width: 991px) {
      #main-content {
        padding: 18px 14px 26px;
      }

      #main-content .well,
      #main-content .admin-module-panel {
        border-radius: 18px;
        padding: 18px 14px;
      }
    }

    @media (max-width: 767px) {
      #main-content {
        padding: 14px 10px 22px;
      }

      #hoe-header .hoe-left-header img {
        height: 40px !important;
      }
    }
    </style>
</head>

<body ng-app="groveusCms" hoe-navigation-type="vertical" hoe-nav-placement="left" theme-layout="wide-layout" class="view-animate-container admin-shell">
    <div id="hoeapp-wrapper" class="hoe-hide-lpanel" hoe-device-type="desktop" class="view-animate">
        <header id="hoe-header" hoe-lpanel-effect="default">
            <div class="hoe-left-header">
                <a href="#">
                    <img id="logo1a" src="<?= base_url() ?>assets/img/logo/logo.png" style="display:inline-block;height: 45px;" alt="Tripjyada logo" loading="lazy">
                    <span></span>
                </a>
            </div>
            <span class="hoe-sidebar-toggle visible-xs"><a id="sidebtn" href=""></a></span>
            <div class="hoe-right-header" hoe-position-type="relative">
            <?php if($this->session->userdata('username')):?>
                <span class="hoe-sidebar-toggle"><a id="sidebtn" href=""></a></span>

                <ul class="right-navbar">

                    <li><button onClick="window.location.reload();" class="btn btn-default">
                        <i class="fa fa-refresh"></i></button></li>
                    <li class="dropdown hoe-rheader-submenu hoe-header-profile">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <span><span class="fa fa-user"></span>
                             <i class=" fa fa-angle-down"></i></span>
                        </a>
                        <ul class="dropdown-menu ">
                            <li><a href="#logs"><i class="fa fa-list"></i>View Logs</a></li>
                            <li><a href="#change_password"><i class="fa fa-lock"></i>Change Password</a></li>
                            <li><a href="<?=site_url()?>/login/logout"><i class="fa fa-power-off"></i>Logout</a></li>
                        </ul>
                    </li>

                </ul>
                <?php endif?>
            </div>
        </header>
