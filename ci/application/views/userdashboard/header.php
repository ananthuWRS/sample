<!DOCTYPE html>

        <html lang="en">
        <!--begin::Head-->

        <head>
            <base href="../" />
            <title><?= WEBSITE_NAME ?> | <?php echo !empty($title) ? $title : ''; ?></title>
            <meta charset="utf-8" />
            <meta name="description" content="" />
            <meta name="keywords" content="" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <meta property="og:locale" content="en_US" />
            <meta property="og:type" content="article" />
            <meta property="og:title"
                content="Metronic | Bootstrap HTML, VueJS, React, Angular, Asp.Net Core, Rails, Spring, Blazor, Django, Flask & Laravel Admin Dashboard Theme" />
            <meta property="og:url" content="<?= SITE_URL ?>" />
            <meta property="og:site_name" content="<?= WEBSITE_NAME ?>" />
            <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
            <link rel="shortcut icon" href="<?= base_url() ?>components/media/logos/fav_ico.png" />
            <!--begin::Fonts(mandatory for all pages)-->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
            <!--end::Fonts-->
            <!--begin::Vendor Stylesheets(used for this page only)-->
            <link href="<?= base_url() ?>components/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
                type="text/css" />
            <link href="<?= base_url() ?>components/plugins/custom/vis-timeline/vis-timeline.bundle.css"
                rel="stylesheet" type="text/css" />
            <!--end::Vendor Stylesheets-->
            <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
            <link href="<?= base_url() ?>components/plugins/global/plugins.bundle.css" rel="stylesheet"
                type="text/css" />
            <link href="<?= base_url() ?>components/css/style.bundle.css" rel="stylesheet" type="text/css" />
            <link href="<?= base_url() ?>components/css/ahead-custom.css" rel="stylesheet" type="text/css" />
            
            <!--end::Global Stylesheets Bundle-->
            <?php

    if (!empty($vendorcss)) {
        foreach ($vendorcss as $value) {
            ?>
            <link rel="stylesheet"
                href="<?= base_url() ?>components/plugins/<?= $value ?>?v=<?php echo getversion() ?>">
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

    if (!empty($pagepermissions)) {
        echo $pagepermissions;
    }

    ?>
        </head>
        <!--end::Head-->
        <!--begin::Body-->

        <body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
            data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
            data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
            data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
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