<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="<?=base_url()?>" />
    <title><?=WEBSITE_NAME?></title>
    <meta charset="utf-8" />
    <meta name="description" content="<?=WEBSITE_NAME?>" />
    <meta name="keywords" content="<?=WEBSITE_NAME?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- <meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic | Bootstrap HTML, VueJS, React, Angular, Asp.Net Core, Rails, Spring, Blazor, Django, Flask & Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" /> -->
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="components/media/logos/fav_ico.png" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="<?=base_url()?>components/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>components/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <?php

if (!empty($vendorcss)) {
    foreach ($vendorcss as $value) {
        ?>
    <link rel="stylesheet" href="<?= base_url() ?>components/plugins/<?= $value ?>?v=<?php echo getversion() ?>">
    <?php
    }
}

if (!empty($commoncss)) {
    foreach ($commoncss as $value) {
        ?>
    <link rel="stylesheet" href="<?= base_url() ?>components/css/<?= $value ?>?v=<?php echo getversion() ?>">
    <?php
    }
}



    ?>

    <!--begin::Theme mode setup on page load-->
    <script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-theme-mode");
        } else {
            if (localStorage.getItem("data-theme") !== null) {
                themeMode = localStorage.getItem("data-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }
    </script>
    <!--end::Theme mode setup on page load-->
</head>

<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
