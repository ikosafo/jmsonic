<?php require('../config.php');
$user_id = $_SESSION['userid'];

if (!isset($_SESSION['username'])) {
    header("location:login");
}

?>

<!DOCTYPE html>

<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>

    <title>Allied Health Professions Council | MIS</title>
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


                        <!--begin: User bar -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                <span class="kt-header__topbar-welcome">Hi,</span>
                                <span class="kt-header__topbar-username"><?php /*echo $_SESSION['username']; */?></span>
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
