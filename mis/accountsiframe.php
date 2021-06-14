<?php require('../config.php');
$user_id = $_SESSION['user_id'];
?>
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

<!-- begin:: Subheader -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader"></div>
<!-- end:: Subheader -->


<!-- begin:: Content -->
<div class="kt-container  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->

    <div class="row">
        <div class="col-xl-12">
            <!--begin:: Widgets/Applications/User/Profile3-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__body">
                    <div class="kt-portlet__body">

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Select year for Account
                                Details</label>

                            <div class=" col-lg-4 col-md-9 col-sm-12">
                                <select class="form-control kt-select2" id="select_year" name="param">
                                    <option></option>
                                    <optgroup label="Main">
                                        <option value="<?php echo date('Y') ?>"><?php echo date('Y') ?></option>
                                        <option value="All">All</option>
                                    </optgroup>
                                    <optgroup label="Other">

                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                        <option value="2036">2036</option>
                                        <option value="2037">2037</option>
                                        <option value="2038">2038</option>
                                        <option value="2039">2039</option>
                                        <option value="2040">2040</option>

                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="accounts_table_div"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="approval_div"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile3-->
        </div>
    </div>

    <!--End::Dashboard 3-->    </div>



<!-- end:: Page -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#366cf3",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>
<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="newassets/plugins/global/plugins.bundle.js"
        type="text/javascript"></script>
<script src="newassets/js/scripts.bundle.js"
        type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script
    src="newassets/plugins/custom/fullcalendar/fullcalendar.bundle.js"
    type="text/javascript"></script>
<script src="newassets/plugins/custom/gmaps/gmaps.js"
        type="text/javascript"></script>
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="newassets/js/pages/dashboard.js"
        type="text/javascript"></script>

<script src="newassets/js/pages/custom/login/login-general.js" type="text/javascript"></script>
<script src="newassets/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>
<script src="newassets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script src="newassets/js/pages/crud/datatables/extensions/buttons.js" type="text/javascript"></script>
<script src="newassets/js/pages/notify.js" type="text/javascript"></script>
<script src="newassets/js/custom.js" type="text/javascript"></script>
<script src="newassets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="newassets/jquery-confirm/js/jquery-confirm.js" type="text/javascript"></script>


<script>
    var KTSelect2 = {
        init: function () {
            $("#select_year").select2({placeholder: "Select a year"})
        }
    };
    jQuery(document).ready(function () {
        KTSelect2.init()
    });


    $("#select_year").change(function () {
        var year_search = $("#select_year").val();
        $.ajax({
            type: "POST",
            url: "ajax/tables/monaccounts_table.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            data: {
                year_search: year_search
            },
            success: function (text) {
                $('#accounts_table_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                KTApp.unblockPage();
            },

        });
    });



    $(document).on('click', '.accountprint_btn', function() {
        var id_index = $(this).attr('i_index');
        //alert(id_index);

        $('html, body').animate({
            scrollTop: $("#approval_div").offset().top
        }, 2000);

        $.ajax({
            type: "POST",
            url: "monaccounts.php",
            data: {
                id_index:id_index
            },
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            success: function (text) {
                $('#approval_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                KTApp.unblockPage();
            },

        });


    });

</script>

