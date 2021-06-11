<?php require('../config.php');
$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['username'])) {
    header("location:login");
}

?>

<!DOCTYPE html>

<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>

    <title>JMSonic | Admin and User Portal</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="newassets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="newassets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="newassets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="newassets/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="newassets/css/pages/login/login-5.css" rel="stylesheet" type="text/css"/>
    <link href="newassets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="newassets/jquery-confirm/css/jquery-confirm.css" rel="stylesheet" type="text/css"/>
    <link href="assets/vendor/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>

    <!--end::Global Theme Styles -->

    <link rel="shortcut icon" href="newassets/img/ahpc_logo.png"/>
    <script src="newassets/js/jquery.min.js"></script>

    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });

        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
            location.reload();
        }
    </script>

</head>


<!-- end::Head -->

<!-- begin::Body -->
<body style="background-image: url(newassets/media/demos/demo4/header.jpg); background-position: center top;
background-size: 100% 350px;"
      class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right
      kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled
      kt-subheader--transparent kt-page--loading">

<!-- begin::Page loader -->
<div class="loader"></div>
<!-- end::Page Loader -->
<!-- begin:: Page -->
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="/">
            <img alt="Logo" src="newassets/img/ahpc_logo.png" style="width: 30%"/>
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                class="flaticon-more-1"></i></button>
    </div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header  kt-header--fixed " data-ktheader-minimize="on">
                <div class="kt-container ">
                    <!-- begin:: Brand -->
                    <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                        <a class="kt-header__brand-logo" href="/">
                            <img alt="Logo" src="newassets/img/ahpc_logo.png" class="kt-header__brand-logo-default"
                                 style="width:60%;background-color: #ffffff"/>
                            <img alt="Logo" src="../newassets/img/ahpc_logo.png" style="width:50%"
                                 class="kt-header__brand-logo-sticky"/>
                        </a>
                    </div>
                    <!-- end:: Brand -->        <!-- begin: Header Menu -->
                    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i
                            class="la la-close"></i></button>
                    <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid"
                         id="kt_header_menu_wrapper">
                        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                            <ul class="kt-menu__nav ">

                                <li class="kt-menu__item kt-menu__item--rel <?php echo(
                                $_SERVER['PHP_SELF'] == "/index.php"
                                    ? "kt-menu__item--here" : ""); ?>">
                                    <a href="/" class="kt-menu__link"><span
                                            class="kt-menu__link-text">Dashboard</span>
                                    </a>
                                </li>

                                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel <?php echo(
                                $_SERVER['PHP_SELF'] == "/adduser.php" ||
                                $_SERVER['PHP_SELF'] == "/useraccounts.php"
                                    ? "kt-menu__item--here" : ""); ?>"
                                    data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <span class="kt-menu__link-text">Applicants
                                            <i class="fa fa-caret-down ml-2"></i> </span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>

                                    <div
                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                        <ul class="kt-menu__subnav">

                                            <li class="kt-menu__item  <?php echo(
                                            $_SERVER['PHP_SELF'] == "/useraccounts.php"
                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                    href="useraccounts"
                                                    class="kt-menu__link "><i
                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                        <span></span></i><span
                                                        class="kt-menu__link-text">User Accounts</span></a>
                                            </li>

                                            <li class="kt-menu__item   <?php echo(
                                            $_SERVER['PHP_SELF'] == "/applicantfiles.php"
                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                    href="#"
                                                    class="kt-menu__link "><i
                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">Applicant Files</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <!-- <li class="kt-menu__item kt-menu__item--rel  <?php /*echo(
                                $_SERVER['PHP_SELF'] == "/test2.php"
                                    ? "kt-menu__item--here" : ""); */?>">
                                    <a href="test2" class="kt-menu__link"><span
                                            class="kt-menu__link-text">Test2</span>
                                    </a>
                                </li>-->

                                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel <?php echo(
                                $_SERVER['PHP_SELF'] == "/mis_duplicatepins.php" ||
                                $_SERVER['PHP_SELF'] == "/mis_wrongyear.php" ||
                                $_SERVER['PHP_SELF'] == "/mis_permanent.php" ||
                                $_SERVER['PHP_SELF'] == "/super_permanent.php" ||
                                $_SERVER['PHP_SELF'] == "/export_permanent.php" ||
                                $_SERVER['PHP_SELF'] == "/export_permanentdr.php" ||
                                $_SERVER['PHP_SELF'] == "/permanent_regeneratepin.php" ||
                                $_SERVER['PHP_SELF'] == "/permanent_specialcases.php" ||
                                $_SERVER['PHP_SELF'] == "/permanent_pinupdates.php" ||
                                $_SERVER['PHP_SELF'] == "/permanent_search.php" ||
                                $_SERVER['PHP_SELF'] == "/permanent_summary.php" ||
                                $_SERVER['PHP_SELF'] == "/permanent_summarydr.php" ||
                                $_SERVER['PHP_SELF'] == "/mis_provisional.php" ||
                                $_SERVER['PHP_SELF'] == "/super_provisional.php" ||
                                $_SERVER['PHP_SELF'] == "/renewal_bills.php" ||
                                $_SERVER['PHP_SELF'] == "/export_provisional.php" ||
                                $_SERVER['PHP_SELF'] == "/export_provisionaldr.php" ||
                                $_SERVER['PHP_SELF'] == "/provisional_regeneratepin.php" ||
                                $_SERVER['PHP_SELF'] == "/provisional_specialcases.php" ||
                                $_SERVER['PHP_SELF'] == "/provisional_search.php" ||
                                $_SERVER['PHP_SELF'] == "/export_provisionalst.php" ||
                                $_SERVER['PHP_SELF'] == "/mis_examination.php" ||
                                $_SERVER['PHP_SELF'] == "/super_examination.php" ||
                                $_SERVER['PHP_SELF'] == "/provisional_summary.php" ||
                                $_SERVER['PHP_SELF'] == "/provisional_summarydr.php" ||
                                $_SERVER['PHP_SELF'] == "/export_examination.php" ||
                                $_SERVER['PHP_SELF'] == "/extract_examination.php" ||
                                $_SERVER['PHP_SELF'] == "/examination_summary.php" ||
                                $_SERVER['PHP_SELF'] == "/examination_specialcases.php" ||
                                $_SERVER['PHP_SELF'] == "/examination_status.php" ||
                                $_SERVER['PHP_SELF'] == "/examination_search.php" ||
                                $_SERVER['PHP_SELF'] == "/stat_examination.php" ||
                                $_SERVER['PHP_SELF'] == "/mis_renewal.php" ||
                                $_SERVER['PHP_SELF'] == "/super_renewal.php" ||
                                $_SERVER['PHP_SELF'] == "/renewal_uploadpin.php" ||
                                $_SERVER['PHP_SELF'] == "/export_renewal.php" ||
                                $_SERVER['PHP_SELF'] == "/cpd_list.php" ||
                                $_SERVER['PHP_SELF'] == "/renewal_specialcases.php" ||
                                $_SERVER['PHP_SELF'] == "/index_regenerate.php" ||
                                $_SERVER['PHP_SELF'] == "/duplicate_examination.php" ||
                                $_SERVER['PHP_SELF'] == "/renewal_search.php" ||
                                $_SERVER['PHP_SELF'] == "/mis_temporal.php" ||
                                $_SERVER['PHP_SELF'] == "/super_temporal.php" ||
                                $_SERVER['PHP_SELF'] == "/export_temporal.php" ||
                                $_SERVER['PHP_SELF'] == "/export_temporaldr.php" ||
                                $_SERVER['PHP_SELF'] == "/temporal_summary.php" ||
                                $_SERVER['PHP_SELF'] == "/temporal_summarydr.php" ||
                                $_SERVER['PHP_SELF'] == "/temporal_specialcases.php" ||
                                $_SERVER['PHP_SELF'] == "/temporal_search.php"
                                    ? "kt-menu__item--here" : ""); ?>"
                                    data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:;"
                                       class="kt-menu__link kt-menu__toggle"><span
                                            class="kt-menu__link-text">Registrations <i
                                                class="fa fa-caret-down ml-2"></i> </span><i
                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                        <ul class="kt-menu__subnav">

                                            <?php
                                            //PERMANENT REGISTRATION
                                            $query = $mysqli->query("select * from permission where user_id = '$user_id'
                                            AND (permission = 'Permanent Registration' OR permission = 'All Permissions')");
                                            $count = mysqli_num_rows($query);
                                            if ($count == '1') {
                                                ?>

                                                <li class="kt-menu__item  kt-menu__item--submenu <?php echo(
                                                $_SERVER['PHP_SELF'] == "/mis_permanent.php" ||
                                                $_SERVER['PHP_SELF'] == "/super_permanent.php" ||
                                                $_SERVER['PHP_SELF'] == "/export_permanent.php" ||
                                                $_SERVER['PHP_SELF'] == "/export_permanentdr.php" ||
                                                $_SERVER['PHP_SELF'] == "/permanent_summary.php" ||
                                                $_SERVER['PHP_SELF'] == "/permanent_summarydr.php" ||
                                                $_SERVER['PHP_SELF'] == "/permanent_regeneratepin.php" ||
                                                $_SERVER['PHP_SELF'] == "/permanent_specialcases.php" ||
                                                $_SERVER['PHP_SELF'] == "/permanent_pinupdates.php" ||
                                                $_SERVER['PHP_SELF'] == "/permanent_search.php"
                                                    ? "kt-menu__item--here" : ""); ?>"
                                                    data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                            class="kt-menu__link-text">Permanent</span><i
                                                            class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                                    <div
                                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                        <ul class="kt-menu__subnav">
                                                            <li class="kt-menu__item <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/mis_permanent.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="mis_permanent"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">MIS Admin</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/super_permanent.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="super_permanent"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Super Admin</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/export_permanent.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="export_permanent"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Export Data</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/export_permanentdr.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="export_permanentdr"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Export Data by Date Range</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/permanent_summary.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="permanent_summary"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Summary Data</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/permanent_summarydr.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="permanent_summarydr"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Summary Data by Date Range</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/permanent_regeneratepin.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="permanent_regeneratepin"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Regenerate PIN</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/permanent_specialcases.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="permanent_specialcases"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Special Cases</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/permanent_search.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="permanent_search"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Search</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>

                                            <?php } ?>
                                            <!-- End of Permanent -->


                                            <?php //PROVISIONAL REGISTRATION
                                            $query = $mysqli->query("select * from permission where user_id = '$user_id'
                                            AND (permission = 'Provisional Registration' OR permission = 'All Permissions')");
                                            $count = mysqli_num_rows($query);
                                            if ($count == '1') {
                                                ?>

                                                <li class="kt-menu__item  kt-menu__item--submenu  <?php echo(
                                                $_SERVER['PHP_SELF'] == "/mis_provisional.php" ||
                                                $_SERVER['PHP_SELF'] == "/super_provisional.php" ||
                                                $_SERVER['PHP_SELF'] == "/export_provisional.php" ||
                                                $_SERVER['PHP_SELF'] == "/export_provisionaldr.php" ||
                                                $_SERVER['PHP_SELF'] == "/export_provisionalst.php" ||
                                                $_SERVER['PHP_SELF'] == "/provisional_summary.php" ||
                                                $_SERVER['PHP_SELF'] == "/provisional_summarydr.php" ||
                                                $_SERVER['PHP_SELF'] == "/provisional_regeneratepin.php" ||
                                                $_SERVER['PHP_SELF'] == "/provisional_specialcases.php" ||
                                                $_SERVER['PHP_SELF'] == "/provisional_search.php"
                                                    ? "kt-menu__item--here" : ""); ?>"
                                                    data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                        href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                                        <span class="kt-menu__link-text">Provisional</span><i
                                                            class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                                    <div
                                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                        <ul class="kt-menu__subnav">
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/mis_provisional.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="mis_provisional"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">MIS Admin</span></a>
                                                            </li>
                                                            <li class="kt-menu__item   <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/super_provisional.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="super_provisional"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Super Admin</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/export_provisional.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="export_provisional"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Export Data</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/export_provisionaldr.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="export_provisionaldr"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Export Data by Date Range</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/export_provisionalst.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="export_provisionalst"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Export Data by Status</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/provisional_regeneratepin.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="provisional_regeneratepin"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Regenerate PIN</span></a></li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/provisional_summary.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="provisional_summary"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Summary Data</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/provisional_summarydr.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="provisional_summarydr"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Summary Data by Date Range</span></a>
                                                            </li>
                                                            <li class="kt-menu__item <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/provisional_specialcases.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="provisional_specialcases"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Special Cases</span></a>
                                                            </li>

                                                            <li class="kt-menu__item   <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/provisional_search.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="provisional_search"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Search</span></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                            <!-- End of Provisional -->


                                            <?php //EXAMINATION REGISTRATION
                                            $query = $mysqli->query("select * from permission where user_id = '$user_id'
                                            AND (permission = 'Examination Registration' OR permission = 'All Permissions')");
                                            $count = mysqli_num_rows($query);
                                            if ($count == '1') {
                                                ?>

                                                <li class="kt-menu__item  kt-menu__item--submenu   <?php echo(
                                                $_SERVER['PHP_SELF'] == "/mis_examination.php" ||
                                                $_SERVER['PHP_SELF'] == "/super_examination.php" ||
                                                $_SERVER['PHP_SELF'] == "/stat_examination.php" ||
                                                $_SERVER['PHP_SELF'] == "/export_examination.php" ||
                                                $_SERVER['PHP_SELF'] == "/extract_examination.php" ||
                                                $_SERVER['PHP_SELF'] == "/examination_summary.php" ||
                                                $_SERVER['PHP_SELF'] == "/examination_specialcases.php" ||
                                                $_SERVER['PHP_SELF'] == "/examination_status.php" ||
                                                $_SERVER['PHP_SELF'] == "/index_regenerate.php" ||
                                                $_SERVER['PHP_SELF'] == "/duplicate_examination.php" ||
                                                $_SERVER['PHP_SELF'] == "/examination_search.php"
                                                    ? "kt-menu__item--here" : ""); ?>"
                                                    data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                        href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                                        <span class="kt-menu__link-text">Examination</span><i
                                                            class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                                    <div
                                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                        <ul class="kt-menu__subnav">
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/mis_examination.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="mis_examination"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Examination Officer</span></a></li>
                                                            <li class="kt-menu__item   <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/super_examination.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="super_examination"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Super Admin</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/stat_examination.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="stat_examination"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Results Report & Stats</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/export_examination.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="export_examination"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                                    <span class="kt-menu__link-text">Export Data</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/duplicate_examination.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="duplicate_examination"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                                    <span class="kt-menu__link-text">Delete Data</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/extract_examination.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="extract_examination"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                                    <span class="kt-menu__link-text">Extract Data</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/examination_summary.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="examination_summary"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Summary Data</span></a></li>
                                                            <li class="kt-menu__item <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/examination_specialcases.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="examination_specialcases"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Special Cases</span></a></li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/examination_status.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="examination_status"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Exam Status</span></a></li>
                                                            <li class="kt-menu__item   <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/examination_search.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="examination_search"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Search</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                            <!-- End of Examination -->


                                            <?php //RENEWAL
                                            $query = $mysqli->query("select * from permission where user_id = '$user_id'
                                            AND (permission = 'Permanent Renewal (CPD)' OR permission = 'All Permissions')");
                                            $count = mysqli_num_rows($query);
                                            if ($count == '1') {
                                                ?>

                                                <li class="kt-menu__item  kt-menu__item--submenu   <?php echo(
                                                $_SERVER['PHP_SELF'] == "/mis_renewal.php" ||
                                                $_SERVER['PHP_SELF'] == "/super_renewal.php" ||
                                                $_SERVER['PHP_SELF'] == "/renewal_bills.php" ||
                                                $_SERVER['PHP_SELF'] == "/renewal_uploadpin.php" ||
                                                $_SERVER['PHP_SELF'] == "/export_renewal.php" ||
                                                $_SERVER['PHP_SELF'] == "/cpd_list.php" ||
                                                $_SERVER['PHP_SELF'] == "/renewal_specialcases.php" ||
                                                $_SERVER['PHP_SELF'] == "/renewal_search.php"
                                                    ? "kt-menu__item--here" : ""); ?>"
                                                    data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                        href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                                        <span class="kt-menu__link-text">Renewal</span><i
                                                            class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                                    <div
                                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                        <ul class="kt-menu__subnav">
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/mis_renewal.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="mis_renewal"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">MIS Admin</span></a></li>
                                                            <li class="kt-menu__item   <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/super_renewal.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="super_renewal"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Super Admin</span></a>
                                                            </li>
                                                            <li class="kt-menu__item   <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/renewal_bills.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="renewal_bills"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Bills</span></a>
                                                            </li>
                                                            <li class="kt-menu__item   <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/renewal_uploadpin.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="renewal_uploadpin"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Upload PINs</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/export_renewal.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="export_renewal"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Export Data</span></a></li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/cpd_list.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="cpd_list"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">CPD List</span></a></li>
                                                            <li class="kt-menu__item <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/renewal_specialcases.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="renewal_specialcases"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Special Cases</span></a></li>
                                                            <li class="kt-menu__item   <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/renewal_search.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="renewal_search"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Search</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </li>
                                            <?php } ?>
                                            <!-- End of Renewal -->



                                            <?php //TEMPORAL REGISTRATION
                                            $query = $mysqli->query("select * from permission where user_id = '$user_id'
                                            AND (permission = 'Temporal Registration' OR permission = 'All Permissions')");
                                            $count = mysqli_num_rows($query);
                                            if ($count == '1') {
                                                ?>

                                                <li class="kt-menu__item  kt-menu__item--submenu  <?php echo(
                                                $_SERVER['PHP_SELF'] == "/mis_temporal.php" ||
                                                $_SERVER['PHP_SELF'] == "/super_temporal.php" ||
                                                $_SERVER['PHP_SELF'] == "/export_temporal.php" ||
                                                $_SERVER['PHP_SELF'] == "/export_temporaldr.php" ||
                                                $_SERVER['PHP_SELF'] == "/temporal_summary.php" ||
                                                $_SERVER['PHP_SELF'] == "/temporal_summarydr.php" ||
                                                $_SERVER['PHP_SELF'] == "/temporal_specialcases.php" ||
                                                $_SERVER['PHP_SELF'] == "/temporal_search.php"
                                                    ? "kt-menu__item--here" : ""); ?>"
                                                    data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                        href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                                        <span class="kt-menu__link-text">Temporal</span><i
                                                            class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                                    <div
                                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                        <ul class="kt-menu__subnav">
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/mis_temporal.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="mis_temporal"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">MIS Admin</span></a>
                                                            </li>
                                                            <li class="kt-menu__item   <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/super_temporal.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="super_temporal"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Super Admin</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/export_temporal.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="export_temporal"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Export Data</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/export_temporaldr.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="export_temporaldr"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Export Data by Date Range</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/temporal_summarydr.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="temporal_summarydr"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Summary Data by Date Range</span></a>
                                                            </li>
                                                            <li class="kt-menu__item <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/temporal_specialcases.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="temporal_specialcases"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Special Cases</span></a>
                                                            </li>

                                                            <li class="kt-menu__item   <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/temporal_search.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="temporal_search"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Search</span></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                            <!-- End of Provisional -->




                                            <li class="kt-menu__item  kt-menu__item--submenu"
                                                data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a
                                                    href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                                    <span class="kt-menu__link-text">Indexing</span><i
                                                        class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>


                                            </li>
                                            <li class="kt-menu__item  kt-menu__item--submenu <?php echo(
                                            $_SERVER['PHP_SELF'] == "/mis_duplicatepins.php" ||
                                            $_SERVER['PHP_SELF'] == "/mis_wrongyear.php" ||
                                            $_SERVER['PHP_SELF'] == "/it_pinchange.php" ||
                                            $_SERVER['PHP_SELF'] == "/it_resendmail.php" ||
                                            $_SERVER['PHP_SELF'] == "/it_resendmail_index.php"
                                                ? "kt-menu__item--here" : ""); ?>"
                                                data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                        class="kt-menu__link-text">PIN Regeneration</span><i
                                                        class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                                <div
                                                    class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                    <ul class="kt-menu__subnav">
                                                        <li class="kt-menu__item <?php echo(
                                                        $_SERVER['PHP_SELF'] == "/mis_duplicatepins.php"
                                                            ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                href="mis_duplicatepins"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Duplicate PINs</span></a>
                                                        </li>
                                                        <li class="kt-menu__item  <?php echo(
                                                        $_SERVER['PHP_SELF'] == "/mis_wrongyear.php"
                                                            ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                href="#"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Wrong Year Suffix</span></a>
                                                        </li>
                                                        <li class="kt-menu__item  <?php echo(
                                                        $_SERVER['PHP_SELF'] == "/it_nonpayment.php"
                                                            ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                href="it_nonpayment"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Non Payment</span></a>
                                                        </li>
                                                        <li class="kt-menu__item  <?php echo(
                                                        $_SERVER['PHP_SELF'] == "/it_pinchange.php"
                                                            ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                href="it_pinchange"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">PIN Update</span></a>
                                                        </li>
                                                        <li class="kt-menu__item  <?php echo(
                                                        $_SERVER['PHP_SELF'] == "/it_resendmail.php"
                                                            ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                href="it_resendmail"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Resend Mail</span></a>
                                                        </li>
                                                        <li class="kt-menu__item  <?php echo(
                                                        $_SERVER['PHP_SELF'] == "/it_resendmailindex.php"
                                                            ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                href="it_resendmail_index"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Resend Index Mail</span></a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </li>


                                            <li class="kt-menu__item  kt-menu__item--submenu <?php echo(
                                            $_SERVER['PHP_SELF'] == "/it_duplicatepins_ren.php" ||
                                            $_SERVER['PHP_SELF'] == "/it_pinchange_ren.php" ||
                                            $_SERVER['PHP_SELF'] == "/it_resendmail_ren.php"
                                                ? "kt-menu__item--here" : ""); ?>"
                                                data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                        class="kt-menu__link-text">PINs Already Regenerated</span><i
                                                        class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                                <div
                                                    class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                    <ul class="kt-menu__subnav">
                                                        <li class="kt-menu__item <?php echo(
                                                        $_SERVER['PHP_SELF'] == "/it_duplicatepins_ren.php"
                                                            ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                href="it_duplicatepins_ren"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Duplicate PINs</span></a>
                                                        </li>
                                                        <li class="kt-menu__item  <?php echo(
                                                        $_SERVER['PHP_SELF'] == "/it_wrongyear_ren.php"
                                                            ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                href="it_wrongyear_ren"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Wrong Year Suffix</span></a>
                                                        </li>
                                                        <li class="kt-menu__item  <?php echo(
                                                        $_SERVER['PHP_SELF'] == "/it_nonpayment_ren.php"
                                                            ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                href="it_nonpayment_ren"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Non Payment</span></a>
                                                        </li>
                                                        <li class="kt-menu__item  <?php echo(
                                                        $_SERVER['PHP_SELF'] == "/it_pinchange_ren.php"
                                                            ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                href="it_pinchange_ren"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">PIN Update</span></a>
                                                        </li>
                                                        <li class="kt-menu__item  <?php echo(
                                                        $_SERVER['PHP_SELF'] == "/it_resendmail_ren.php"
                                                            ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                href="it_resendmail_ren"
                                                                class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Resent Mails</span></a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </li>



                                        </ul>
                                    </div>
                                </li>




                                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel <?php echo(
                                $_SERVER['PHP_SELF'] == "/it_renewal_login.php" ||
                                $_SERVER['PHP_SELF'] == "/it_duplicatepins_ren.php" ||
                                $_SERVER['PHP_SELF'] == "/it_email_error.php" ||
                                $_SERVER['PHP_SELF'] == "/it_exam_number.php" ||
                                $_SERVER['PHP_SELF'] == "/it_profession_change.php" ||
                                $_SERVER['PHP_SELF'] == "/it_indexpin_conflict.php" ||
                                $_SERVER['PHP_SELF'] == "/it_dbrip.php" ||
                                $_SERVER['PHP_SELF'] == "/it_duplicatepins.php" ||
                                $_SERVER['PHP_SELF'] == "/it_pinchange.php" ||
                                $_SERVER['PHP_SELF'] == "/it_delprov.php" ||
                                $_SERVER['PHP_SELF'] == "/it_delacc.php" ||
                                $_SERVER['PHP_SELF'] == "/it_resendmail.php" ||
                                $_SERVER['PHP_SELF'] == "/it_pinchange_ren.php" ||
                                $_SERVER['PHP_SELF'] == "/it_resendmail_ren.php" ||
                                $_SERVER['PHP_SELF'] == "/it_resendmail_index.php" ||
                                $_SERVER['PHP_SELF'] == "/it_duplicate_email.php" ||
                                $_SERVER['PHP_SELF'] == "/it_bulk_sms.php" ||
                                $_SERVER['PHP_SELF'] == "/it_examreg.php" ||
                                $_SERVER['PHP_SELF'] == "/it_exam_code.php" ||
                                $_SERVER['PHP_SELF'] == "/it_personal_profile.php"
                                    ? "kt-menu__item--here" : ""); ?>"
                                    data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:;"
                                       class="kt-menu__link kt-menu__toggle"><span
                                            class="kt-menu__link-text">IT Section <i
                                                class="fa fa-caret-down ml-2"></i> </span><i
                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                        <ul class="kt-menu__subnav">

                                            <?php
                                            //IT SECTION
                                            $query = $mysqli->query("select * from permission where user_id = '$user_id'
                                            AND (permission = 'IT Section' OR permission = 'All Permissions')");
                                            $count = mysqli_num_rows($query);
                                            if ($count == '1') {
                                                ?>



                                                <li class="kt-menu__item  kt-menu__item--submenu <?php echo(
                                                $_SERVER['PHP_SELF'] == "/it_examreg.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_personal_profile.php"
                                                    ? "kt-menu__item--here" : ""); ?>"
                                                    data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                            class="kt-menu__link-text">Applicants Profile</span><i
                                                            class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                                    <div
                                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                        <ul class="kt-menu__subnav">
                                                            <li class="kt-menu__item <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_examreg.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_examreg"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Examination Registration</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_personal_profile.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_personal_profile"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Personal Profile</span></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </li>


                                                <li class="kt-menu__item  kt-menu__item--submenu <?php echo(
                                                $_SERVER['PHP_SELF'] == "/it_renewal_login.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_email_error.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_exam_number.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_indexpin_conflict.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_duplicate_email.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_exam_code.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_profession_change.php"
                                                    ? "kt-menu__item--here" : ""); ?>"
                                                    data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                            class="kt-menu__link-text">Error Rectifications</span><i
                                                            class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                                    <div
                                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                        <ul class="kt-menu__subnav">
                                                            <li class="kt-menu__item <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_renewal_login.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_renewal_login"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Renewal Login Error</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_email_error.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_email_error"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Email Error</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_exam_number.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_exam_number"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Examination Index Number</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_exam_code.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_exam_code"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Examination Code Exceptions</span></a>
                                                            </li>
                                                            <li class="kt-menu__item <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_indexpin_conflict.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_indexpin_conflict"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Index Number-PIN Conflicts</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_profession_change.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_profession_change"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Profession Change</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_duplicate_email.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_duplicate_email"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Duplicate Email</span></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </li>


                                                <li class="kt-menu__item  kt-menu__item--submenu <?php echo(
                                                $_SERVER['PHP_SELF'] == "/it_duplicatepins.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_pinchange.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_resendmail.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_resendmail_index.php"
                                                    ? "kt-menu__item--here" : ""); ?>"
                                                    data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                            class="kt-menu__link-text">PIN Regeneration</span><i
                                                            class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                                    <div
                                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                        <ul class="kt-menu__subnav">
                                                            <li class="kt-menu__item <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_duplicatepins.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_duplicatepins"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Duplicate PINs</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_wrongyear.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_wrongyear"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Wrong Year Suffix</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_nonpayment.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_nonpayment"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Non Payment</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_pinchange.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_pinchange"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">PIN Update</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_resendmail.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_resendmail"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Resend Mail</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_resendmailindex.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_resendmail_index"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Resend Index Mail</span></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </li>



                                                <li class="kt-menu__item  kt-menu__item--submenu <?php echo(
                                                $_SERVER['PHP_SELF'] == "/it_duplicatepins_ren.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_pinchange_ren.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_resendmail_ren.php"
                                                    ? "kt-menu__item--here" : ""); ?>"
                                                    data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                            class="kt-menu__link-text">PINs Regenerated</span><i
                                                            class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                                    <div
                                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                        <ul class="kt-menu__subnav">
                                                            <li class="kt-menu__item <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_duplicatepins_ren.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_duplicatepins_ren"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Duplicate PINs</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_wrongyear_ren.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_wrongyear_ren"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Wrong Year Suffix</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_nonpayment_ren.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_nonpayment_ren"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Non Payment</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_pinchange_ren.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_pinchange_ren"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">PIN Update</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_resendmail_ren.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_resendmail_ren"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Resent Mails</span></a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </li>



                                                <li class="kt-menu__item  kt-menu__item--submenu <?php echo(
                                                $_SERVER['PHP_SELF'] == "/it_delprov.php" ||
                                                $_SERVER['PHP_SELF'] == "/it_delacc.php"
                                                    ? "kt-menu__item--here" : ""); ?>"
                                                    data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a
                                                        href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                            class="kt-menu__link-text">Delete</span><i
                                                            class="kt-menu__hor-arrow la la-angle-right"></i><i
                                                            class="kt-menu__ver-arrow la la-angle-right"></i></a>

                                                    <div
                                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                                        <ul class="kt-menu__subnav">
                                                            <li class="kt-menu__item <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_delacc.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_delacc"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Accounts Login</span></a>
                                                            </li>
                                                            <li class="kt-menu__item  <?php echo(
                                                            $_SERVER['PHP_SELF'] == "/it_delprov.php"
                                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                                    href="it_delprov"
                                                                    class="kt-menu__link "><i
                                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                        class="kt-menu__link-text">Applicant Details</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>



                                                <li class="kt-menu__item  <?php echo(
                                                $_SERVER['PHP_SELF'] == "/it_dbrip.php"
                                                    ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                        href="it_dbrip"
                                                        class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                            class="kt-menu__link-text">Summary Info.</span></a>
                                                </li>

                                                <li class="kt-menu__item  <?php echo(
                                                $_SERVER['PHP_SELF'] == "/it_bulk_sms.php"
                                                    ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                        href="it_bulk_sms"
                                                        class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                            class="kt-menu__link-text">Bulk SMS</span></a>
                                                </li>

                                            <?php } ?>

                                        </ul>
                                    </div>
                                </li>





                                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel <?php echo(
                                $_SERVER['PHP_SELF'] == "/adduser.php" ||
                                $_SERVER['PHP_SELF'] == "/changepassword.php"
                                    ? "kt-menu__item--here" : ""); ?>"
                                    data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <span class="kt-menu__link-text">User Profile
                                            <i class="fa fa-caret-down ml-2"></i> </span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>

                                    <div
                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                        <ul class="kt-menu__subnav">


                                            <?php //ADD USER
                                            $query = $mysqli->query("select * from permission where user_id = '$user_id'
                                            AND (permission = 'Add User' OR permission = 'All Permissions')");
                                            $count = mysqli_num_rows($query);
                                            if ($count == '1') {
                                                ?>

                                                <li class="kt-menu__item  <?php echo(
                                                $_SERVER['PHP_SELF'] == "/adduser.php"
                                                    ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                        href="adduser"
                                                        class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                            <span></span></i><span
                                                            class="kt-menu__link-text">Add User</span></a>
                                                </li>

                                            <?php } ?>



                                            <li class="kt-menu__item   <?php echo(
                                            $_SERVER['PHP_SELF'] == "/changepassword.php"
                                                ? "kt-menu__item--active" : ""); ?>" aria-haspopup="true"><a
                                                    href="changepassword"
                                                    class="kt-menu__link "><i
                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">Change Password</span></a>
                                            </li>
                                            <li class="kt-menu__item" aria-haspopup="true"><a
                                                    href="https://admin.ahpcgh.org/ticket" target="_blank"
                                                    class="kt-menu__link "><i
                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">Change Request</span></a></li>
                                            <li class="kt-menu__item" aria-haspopup="true"><a
                                                    href="login"
                                                    class="kt-menu__link "><i
                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">Logout</span></a></li>


                                        </ul>
                                    </div>
                                </li>



                                <!--
                                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel <?php /*echo(
                                $_SERVER['PHP_SELF'] == "/accounts.php" ||
                                $_SERVER['PHP_SELF'] == "/accounts_stats.php"
                                    ? "kt-menu__item--here" : ""); */?>"
                                    data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                        <span class="kt-menu__link-text">Accounts
                                            <i class="fa fa-caret-down ml-2"></i> </span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                                    </a>

                                    <div
                                        class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                        <ul class="kt-menu__subnav">

                                          <li class="kt-menu__item  <?php /*echo(
                                                $_SERVER['PHP_SELF'] == "/accounts.php"
                                                    ? "kt-menu__item--active" : ""); */?>" aria-haspopup="true"><a
                                                        href="accounts"
                                                        class="kt-menu__link "><i
                                                            class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                                            <span></span></i><span
                                                            class="kt-menu__link-text">Details</span></a>
                                           </li>

                                            <li class="kt-menu__item   <?php /*echo(
                                            $_SERVER['PHP_SELF'] == "/accounts_stats.php"
                                                ? "kt-menu__item--active" : ""); */?>" aria-haspopup="true"><a
                                                    href="accounts_stats"
                                                    class="kt-menu__link "><i
                                                        class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                        class="kt-menu__link-text">Statistics</span></a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>-->





                            </ul>
                        </div>
                    </div>


                    <!-- end: Header Menu -->        <!-- begin:: Header Topbar -->
                    <div class="kt-header__topbar kt-grid__item">

                        <!--begin: Search -->
                        <div class="kt-header__topbar-item">
                            <div class="kt-header__topbar-wrapper mt-2" data-offset="10px,0px">
				<span class="kt-header__topbar-icon">
					<a href="messages">
                        <i class="fa fa-envelope"></i>
                    </a> 				<!--<i class="flaticon2-search-1"></i>-->
				</span>
                            </div>
                        </div>
                        <!--end: Search -->

                        <!--begin: Search -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown"
                             id="kt_quick_search_toggle">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
				<span class="kt-header__topbar-icon">
					<i class="flaticon2-search-1
					"></i>				<!--<i class="flaticon2-search-1"></i>-->
				</span>
                            </div>
                            <div
                                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                                <div class="kt-quick-search kt-quick-search--dropdown kt-quick-search--result-compact"
                                     id="kt_quick_search_dropdown">
                                    <form method="get" class="kt-quick-search__form">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="flaticon2-search-1"></i></span></div>
                                            <input type="text" class="form-control kt-quick-search__input"
                                                   placeholder="Search...">

                                            <div class="input-group-append"><span class="input-group-text"><i
                                                        class="la la-close kt-quick-search__close"></i></span></div>
                                        </div>
                                    </form>
                                    <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="325"
                                         data-mobile-height="200">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Search -->

                        <?php
                        //IT SECTION
                        $query = $mysqli->query("select * from permission where user_id = '$user_id'
                                            AND (permission = 'IT Section' OR permission = 'All Permissions')");
                        $count = mysqli_num_rows($query);
                        if ($count == '1') {
                            ?>

                            <!--begin: Quick actions -->
                            <div class="kt-header__topbar-item dropdown">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
			<span class="kt-header__topbar-icon">
				<i class="flaticon2-gear"></i>
							</span>
                                </div>
                                <div
                                    class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                    <form>

                                        <!--begin: Grid Nav -->
                                        <div class="kt-grid-nav kt-grid-nav--skin-light">
                                            <div class="kt-grid-nav__row">
                                                <a href="dateconfig" class="kt-grid-nav__item">
            <span class="kt-grid-nav__icon">
                <i class="flaticon2-calendar-2"></i>
            </span>
                                                    <span class="kt-grid-nav__title">Date</span>
                                                    <span class="kt-grid-nav__desc">Configuration</span>
                                                </a>
                                                <a href="#" class="kt-grid-nav__item">
           <span class="kt-grid-nav__icon">
                <i class="flaticon2-user-outline-symbol"></i>
            </span>
                                                    <span class="kt-grid-nav__title">PIN</span>
                                                    <span class="kt-grid-nav__desc">Configuration</span>
                                                </a>
                                            </div>
                                        </div>
                                        <!--end: Grid Nav -->
                                    </form>
                                </div>
                            </div>
                            <!--end: Quick actions -->

                        <?php } ?>


                        <!--begin: User bar -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                <span class="kt-header__topbar-welcome">Hi,</span>
                                <span class="kt-header__topbar-username"><?php echo $_SESSION['username']; ?></span>
                            </div>
                            <div
                                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                <!--begin: Navigation -->
                                <div class="kt-notification">
                                    <a href="userprofile"
                                       class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                My Profile
                                            </div>
                                            <div class="kt-notification__item-time">
                                                User Profile and Details
                                            </div>
                                        </div>
                                    </a>


                                    <div class="kt-notification__custom kt-space-between">
                                        <a href="login"
                                           class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>

                                    </div>
                                </div>
                                <!--end: Navigation -->
                            </div>
                        </div>
                        <!--end: User bar -->
                    </div>
                    <!-- end:: Header Topbar -->
                </div>
            </div>
            <!-- end:: Header -->
            <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                     id="kt_content">
