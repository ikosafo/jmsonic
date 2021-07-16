<?php require('../config.php');
$user_id = $_SESSION['userid'];
$roleid = $_SESSION['roleid'];

if (!isset($_SESSION['username'])) {
    header("location:login");
}
if ($roleid == '2' || $roleid == '1') {
    echo "";
}
else {
    header("location:login");
}



?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <title>JMSonic | Admin and User Portal</title>
    <meta name="description" content="View project page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle1ff3.css?v=7.1.2" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/prismjs/prismjs.bundle1ff3.css?v=7.1.2" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle1ff3.css?v=7.1.2" rel="stylesheet" type="text/css" />
    <link href="assets/css/jquery-confirm.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="icon" href="assets/images/logo3.png" sizes="16x16" type="image/png">

    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #B53FF4;
        }
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #59237B;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" style="background-image: url(assets/images/bg.jpg)" 
class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">

<!--begin::Main-->
<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile">
    <!--begin::Logo-->
    <a href="/board">
        <img alt="Logo" src="assets/images/logo_tr.png" class="logo-default max-h-90px" />
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
            <span></span>
        </button>
        <button class="btn btn-icon btn-hover-transparent-white p-0 ml-3" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
						<!--end::Svg Icon-->
					</span>
        </button>
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" class="header header-fixed">
                <!--begin::Container-->
                <div class="container d-flex align-items-stretch justify-content-between">
                    <!--begin::Left-->
                    <div class="d-flex align-items-stretch mr-3">
                        <!--begin::Header Logo-->
                        <div class="header-logo">
                            <a href="/board">
                                <img alt="Logo" src="assets/images/jmsonic.png" 
                                class="logo-default max-h-60px" style="border-radius:50%" />
                                <img alt="Logo" src="assets/images/logo3.png" class="logo-sticky max-h-60px" />
                            </a>
                        </div>
                        <!--end::Header Logo-->
                        <!--begin::Header Menu Wrapper-->
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                            <!--begin::Header Menu-->
                            <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                                <!--begin::Header Nav-->
                                <ul class="menu-nav">
                                
                                    <li class="menu-item menu-item-rel <?php echo(
                                        $_SERVER['PHP_SELF'] == "/board/index.php"
                                    ? "menu-item-here" : ""); ?>" data-menu-toggle="click" aria-haspopup="true">
                                        <a href="/board" class="menu-link">
                                            <span class="menu-text">Dashboard</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>

                                    <li class="menu-item menu-item-rel <?php echo(
                                        $_SERVER['PHP_SELF'] == "/board/user.php"
                                    ? "menu-item-here" : ""); ?>" data-menu-toggle="click" aria-haspopup="true">
                                        <a href="/board/user" class="menu-link">
                                            <span class="menu-text">User Dashboard</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    
                                    <li class="menu-item menu-item-submenu menu-item-rel  <?php echo(
                                        $_SERVER['PHP_SELF'] == "/board/boardconfig.php" ||
                                        $_SERVER['PHP_SELF'] == "/board/colourconfig.php" ||
                                        $_SERVER['PHP_SELF'] == "/board/paymentconfig.php" ||
                                        $_SERVER['PHP_SELF'] == "/board/exitfee.php"
                                    ? "menu-item-here" : ""); ?>" data-menu-toggle="click" aria-haspopup="true">
                                        <a href="javascript:;" class="menu-link menu-toggle">
                                            <span class="menu-text">Configurations</span>
                                            <span class="menu-desc"></span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                            <ul class="menu-subnav">
                                                <li class="menu-item
                                                <?php echo(
                                                $_SERVER['PHP_SELF'] == "/board/boardconfig.php"
                                                ? "menu-item-active" : ""); ?>" 
                                                aria-haspopup="true">
                                                    <a href="boardconfig" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Board</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item <?php echo(
                                                $_SERVER['PHP_SELF'] == "/board/colourconfig.php"
                                                ? "menu-item-active" : ""); ?>" aria-haspopup="true">
                                                    <a href="colourconfig" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Colour</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item <?php echo(
                                                $_SERVER['PHP_SELF'] == "/board/paymentconfig.php"
                                                ? "menu-item-active" : ""); ?>" aria-haspopup="true">
                                                    <a href="paymentconfig" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Payment</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item <?php echo(
                                                $_SERVER['PHP_SELF'] == "/board/exitfee.php"
                                                ? "menu-item-active" : ""); ?>" aria-haspopup="true">
                                                    <a href="exitfee" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Exit Fee</span>
                                                    </a>
                                                </li>
                                               
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="menu-item menu-item-submenu menu-item-rel  <?php echo(
                                    $_SERVER['PHP_SELF'] == "/board/loginaccounts.php" ||
                                    $_SERVER['PHP_SELF'] == "/board/memberadmins.php" ||
                                    $_SERVER['PHP_SELF'] == "/board/addmembers.php" ||
                                    $_SERVER['PHP_SELF'] == "/board/searchmember.php"
                                        ? "menu-item-here" : ""); ?>" data-menu-toggle="click" aria-haspopup="true">
                                        <a href="javascript:;" class="menu-link menu-toggle">
                                            <span class="menu-text">Members</span>
                                            <span class="menu-desc"></span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                            <ul class="menu-subnav">
                                                <li class="menu-item
                                                <?php echo(
                                                $_SERVER['PHP_SELF'] == "/board/loginaccounts.php"
                                                    ? "menu-item-active" : ""); ?>"
                                                    aria-haspopup="true">
                                                    <a href="loginaccounts" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Login Accounts</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item <?php echo(
                                                $_SERVER['PHP_SELF'] == "/board/memberadmins.php"
                                                    ? "menu-item-active" : ""); ?>" aria-haspopup="true">
                                                    <a href="memberadmins" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Administrators</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item <?php echo(
                                                $_SERVER['PHP_SELF'] == "/board/addmembers.php"
                                                    ? "menu-item-active" : ""); ?>" aria-haspopup="true">
                                                    <a href="addmembers" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Add Members</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item <?php echo(
                                                $_SERVER['PHP_SELF'] == "/board/searchmember.php"
                                                    ? "menu-item-active" : ""); ?>" aria-haspopup="true">
                                                    <a href="searchmember" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Search Member</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </li>

                                    <li class="menu-item menu-item-submenu menu-item-rel  <?php echo(
                                        $_SERVER['PHP_SELF'] == "/board/splitboard.php" ||
                                        $_SERVER['PHP_SELF'] == "/board/searchboard.php" 
                                    ? "menu-item-here" : ""); ?>" data-menu-toggle="click" aria-haspopup="true">
                                        <a href="javascript:;" class="menu-link menu-toggle">
                                            <span class="menu-text">Boards</span>
                                            <span class="menu-desc"></span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                            <ul class="menu-subnav">

                                                <li class="menu-item <?php echo(
                                                    $_SERVER['PHP_SELF'] == "/board/splitboard.php"
                                                    ? "menu-item-active" : ""); ?>" aria-haspopup="true">
                                                        <a href="splitboard" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Split Board</span>
                                                        </a>
                                                </li>

                                                <li class="menu-item <?php echo(
                                                    $_SERVER['PHP_SELF'] == "/board/searchboard.php"
                                                    ? "menu-item-active" : ""); ?>" aria-haspopup="true">
                                                        <a href="searchboard" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Search Board</span>
                                                        </a>
                                                </li>

                                                
                                            </ul>
                                        </div>
                                    </li>



                                    <li class="menu-item menu-item-submenu menu-item-rel  <?php echo(
                                    $_SERVER['PHP_SELF'] == "/board/announcements.php" ||
                                    $_SERVER['PHP_SELF'] == "/board/chat.php"
                                        ? "menu-item-here" : ""); ?>" data-menu-toggle="click" aria-haspopup="true">
                                        <a href="javascript:;" class="menu-link menu-toggle">
                                            <span class="menu-text">Messages</span>
                                            <span class="menu-desc"></span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                            <ul class="menu-subnav">
                                                <li class="menu-item
                                                <?php echo(
                                                $_SERVER['PHP_SELF'] == "/board/announcements.php"
                                                    ? "menu-item-active" : ""); ?>"
                                                    aria-haspopup="true">
                                                    <a href="announcements" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Announcements</span>
                                                    </a>
                                                </li>
                                                <li class="menu-item <?php echo(
                                                $_SERVER['PHP_SELF'] == "/board/chat.php"
                                                    ? "menu-item-active" : ""); ?>" aria-haspopup="true">
                                                    <a href="chat" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Chat</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>


                                </ul>
                                <!--end::Header Nav-->
                            </div>
                            <!--end::Header Menu-->
                        </div>
                        <!--end::Header Menu Wrapper-->
                    </div>
                    <!--end::Left-->
                    <!--begin::Topbar-->
                    <div class="topbar">
                        <!--begin::Search-->
                        <div class="dropdown">
                            <!--begin::Toggle-->
                            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                <div class="btn btn-icon btn-hover-transparent-white btn-lg btn-dropdown mr-1">
											<span class="svg-icon svg-icon-xl">
												<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/General/Search.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg>
												<!--end::Svg Icon-->
											</span>
                                </div>
                            </div>
                            <!--end::Toggle-->
                            <!--begin::Dropdown-->
                            <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                                <div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
                                    <!--begin:Form-->
                                    <form method="get" class="quick-search-form">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
														<span class="input-group-text">
															<span class="svg-icon svg-icon-lg">
																<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/General/Search.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                                                    </g>
                                                                </svg>
																<!--end::Svg Icon-->
															</span>
														</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Search..." />
                                            <div class="input-group-append">
														<span class="input-group-text">
															<i class="quick-search-close ki ki-close icon-sm text-muted"></i>
														</span>
                                            </div>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                    <!--begin::Scroll-->
                                    <div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
                                    <!--end::Scroll-->
                                </div>
                            </div>
                            <!--end::Dropdown-->
                        </div>
                        <!--end::Search-->
                      
                        <!--begin::User-->
                        <div class="dropdown">
                            <!--begin::Toggle-->
                            <div class="topbar-item">
                                <div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_user_toggle">
                                    <span class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                                    <span class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">
                                    <?php echo $_SESSION['username']; ?></span>
											<span class="symbol symbol-35">
												<span style="text-transform:uppercase" class="symbol-label text-white font-size-h5 font-weight-bold bg-white-o-30">
                                                <?php echo substr($_SESSION['username'], 0, 1)?>
                                                </span>
											</span>
                                </div>
                            </div>
                            <!--end::Toggle-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Topbar-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Header-->