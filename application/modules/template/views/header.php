<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (!@$description) {
        $description = $company3 . " offers handcrafted Bhutan tour packages with trusted local guides, great prices, and hassle-free travel planning for every kind of Bhutan trip.";
    }
    if (!@$city) $city = "$addressRegion";
    if (!@$state) $state = "$companystate";
    if (!@$img) $img = base_url('') . "assets/images/logo.png";
    if (!isset($phone) || $phone === '') {
        $phone = !empty($wa_number) ? $wa_number : '919558515518';
    }
    $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = ($url == site_url('home')) ? site_url() : strtolower($url);
    ?>
    <meta name="description" content="<?= @$description ?>" />
    <meta name="keywords" content="<?= @$keywords ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <link rel="canonical" href="<?= @$url ?>" />
    <meta name="author" content="<?= $company3 ?>" />
    <meta name="copyright" content="<?= $company3 ?>" />
    <meta name="reply-to" content="<?= $replyToMail ?>" />
    <meta name="expires" content="never" />
    <meta name="og_title" property="og:title" content="<?= @$title ?>">
    <meta property="og:type" content="website">
    <meta name="og_site_name" property="og:site_name" content="<?= $company3 ?>" />
    <meta property="og:image" content="<?= $img ?>" />
    <meta name="og_url" property="og:url" content="<?= @$url ?>" />
    <meta property="og:description" content="<?= @$description ?>" />
    <meta name="coverage" content="Worldwide" />
    <meta name="allow-search" content="yes" />
    <meta name="robots" content="index, follow" />
    <meta property="al:web:url" content="<?= site_url() ?>">
    <meta name="theme-color" content="<?= $themeColor ?>">
    <meta name="HandheldFriendly" content="True">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="<?= $themeColor ?>">
    <meta name="allow-search" content="yes" />
    <?php $stateCodes = ['Andhra Pradesh' => 'AP', 'Arunachal Pradesh' => 'AR', 'Assam' => 'AS', 'Bihar' => 'BR', 'Chhattisgarh' => 'CG', 'Goa' => 'GA', 'Gujarat' => 'GJ', 'Haryana' => 'HR', 'Himachal Pradesh' => 'HP', 'Jharkhand' => 'JH', 'Karnataka' => 'KA', 'Kerala' => 'KL', 'Madhya Pradesh' => 'MP', 'Maharashtra' => 'MH', 'Manipur' => 'MN', 'Meghalaya' => 'ML', 'Mizoram' => 'MZ', 'Nagaland' => 'NL', 'Odisha' => 'OR', 'Punjab' => 'PB', 'Rajasthan' => 'RJ', 'Sikkim' => 'SK', 'Tamil Nadu' => 'TN', 'Telangana' => 'TG', 'Tripura' => 'TR', 'Uttar Pradesh' => 'UP', 'Uttarakhand' => 'UK', 'West Bengal' => 'WB', 'Delhi' => 'DL', 'Jammu and Kashmir' => 'JK', 'Ladakh' => 'LA', 'Puducherry' => 'PY', 'Chandigarh' => 'CH', 'Andaman and Nicobar Islands' => 'AN', 'Lakshadweep' => 'LD', 'Dadra and Nagar Haveli and Daman and Diu' => 'DN',];
    $stateName = "$state";
    $stateShortCode = $stateCodes[$stateName] ?? $companystate;
    ?>
    <meta name="geo.region" content="IN-<?= $stateShortCode ?>">
    <meta name="geo.placename" content="<?= @$city ?>">
    <meta name="revisit-after" content="weekly" />
    <meta name="distribution" content="global" />
    <meta name="language" content="en" />
    <link rel="apple-touch-icon" href="<?= base_url('assets/images/logo.png') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('assets/images/logo.png') ?>">
    <?php if (!empty($hero_image_preloads) && is_array($hero_image_preloads)): ?>
        <?php foreach ($hero_image_preloads as $hero_preload): ?>
            <link
                rel="preload"
                as="image"
                href="<?= $hero_preload['href'] ?>"
                fetchpriority="high"
                <?php if (!empty($hero_preload['media'])): ?>media="<?= $hero_preload['media'] ?>"<?php endif; ?>
                <?php if (!empty($hero_preload['type'])): ?>type="<?= $hero_preload['type'] ?>"<?php endif; ?>>
        <?php endforeach; ?>
    <?php endif; ?>

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "<?= $company3 ?>",
            "url": "<?= site_url() ?>",
            "logo": "<?= base_url() ?>assets/images/logo.png"
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "LocalBusiness",
            "name": "<?= $company3 ?>",
            "url": "<?= site_url() ?>",
            "image": ["<?= base_url() ?>assets/images/logo.png"],
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "  
                <?= $address1 ?> ",
                "addressLocality": "<?= $address2 ?>",
                "postalCode": "<?= $postalCode ?>",
                "addressRegion": "<?= $addressRegion ?>",
                "addressCountry": "India"
            },
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "<?= $ratingValue ?>",
                "ratingCount": "<?= $ratingCount ?>",
                "bestRating": "5",
                "worstRating": "1"
            },
            "review": [{
                "@type": "Review",
                "datePublished": "<?= $datePublished ?>",
                "reviewBody": "<?= $reviewBody ?>",
                "author": {
                    "@type": "Person",
                    "name": "<?= $reviewperson ?>"
                }
            }],
            "paymentAccepted": ["Cash", "Master Card", "Visa Card", "Debit Cards", "Cheques", "Credit Card"],
            "priceRange": "500 - 40000",
            "telephone": "<?= $phone ?>",
            "email": "<?= $mail ?>"
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Product",
            "sku": "<?= $sku ?>",
            "mpn": "<?= $mpn ?>",
            "name": "Bhutan Tour Packages by <?= $company3 ?>",
            "image": "<?= $img ?>",
            "description": "<?= @$description ?>",
            "url": "<?= $url ?>",
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "<?= $ratingValue ?>",
                "ratingCount": "<?= $ratingCount ?>"
            },
            "review": {
                "@type": "Review",
                "reviewRating": {
                    "@type": "Rating",
                    "ratingValue": "<?= $ratingValue ?>",
                    "bestRating": "5"
                },
                "author": {
                    "@type": "Person",
                    "name": "<?= $company3 ?>"
                }
            },
            "offers": {
                "@type": "Offer",
                "price": "4999.00",
                "priceCurrency": "INR",
                "priceValidUntil": "<?= date("Y-m-") ?>30",
                "availability": "https://schema.org/InStock",
                "url": "<?= $url ?>"
            },
            "brand": {
                "@type": "Brand",
                "name": "<?= $company3 ?>",
                "image": "<?= $img ?>"
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Google Fonts async — never blocks render -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@800&family=Playfair+Display:ital,wght@0,700;1,600&family=Plus+Jakarta+Sans:wght@400;600&family=Space+Grotesk:wght@500&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@800&family=Playfair+Display:ital,wght@0,700;1,600&family=Plus+Jakarta+Sans:wght@400;600&family=Space+Grotesk:wght@500&display=swap"></noscript>

    <!-- CSS and Java Script -->
    <?php
    $vendor_css_version = @filemtime(FCPATH . 'assets/css/vendor.css');
    $style_css_version = @filemtime(FCPATH . 'assets/css/style.css');
    ?>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/vendor.css<?= $vendor_css_version ? '?v=' . $vendor_css_version : '' ?>">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css<?= $style_css_version ? '?v=' . $style_css_version : '' ?>">
    <!-- Font Awesome — load async so it never blocks render -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/fontawesome.min.css" media="print" onload="this.media='all'" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/solid.min.css" media="print" onload="this.media='all'" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/brands.min.css" media="print" onload="this.media='all'" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="<?= base_url() ?>assets/js/jquery-3.7.1.min.js"></script>
</head>
