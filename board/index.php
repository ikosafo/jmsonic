<?php require('includes/header.php') ?>

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
                    <div class="kt-widget kt-widget--user-profile-3">
                        <div class="kt-widget__top">

                            <div class="kt-widget__content">
                                <div class="kt-widget__head">
                                    <a href="#" class="kt-widget__username">
                                        <?php echo $_SESSION['full_name']; ?>
                                        <i class="flaticon2-user"></i>
                                    </a>

                                </div>

                                <div class="kt-widget__subhead">
                                    <a href="#"><i class="flaticon2-user-1"></i><?php echo $_SESSION['username']; ?></a>
                                    <a href="#"><i class="flaticon2-calendar-3"></i><?php echo $_SESSION['user_type']; ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="kt-widget__bottom">

                            <div class="kt-widget__item">
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Permanent</span>
                                                        <span class="kt-widget__value"><span><i class="la la-users"></i> </span>
                                                            <?php
                                                            $getperm = $mysqli->query("select * from `provisional` where permanent_registration = '1'");
                                                            echo mysqli_num_rows($getperm);
                                                            ?>
                                                        </span>
                                </div>
                            </div>

                            <div class="kt-widget__item">
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Provisional</span>
                                                        <span class="kt-widget__value"><span><i class="la la-users"></i> </span>
                                                            <?php
                                                            $getperm = $mysqli->query("select * from `provisional` where provisional_registration = '1'");
                                                            echo mysqli_num_rows($getperm);
                                                            ?>
                                                        </span>
                                </div>
                            </div>

                            <div class="kt-widget__item">
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Temporal</span>
                                                        <span class="kt-widget__value"><span><i class="la la-users"></i> </span>
                                                            <?php
                                                            $getperm = $mysqli->query("select * from `provisional` where temporal_registration = '1'");
                                                            echo mysqli_num_rows($getperm);
                                                            ?>
                                                        </span>
                                </div>
                            </div>

                            <div class="kt-widget__item">
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Examination</span>
                                                        <span class="kt-widget__value"><span><i class="la la-users"></i> </span>
                                                            <?php
                                                            $getperm = $mysqli->query("select * from `provisional` where examination_registration = '1'");
                                                            echo mysqli_num_rows($getperm);
                                                            ?>
                                                        </span>
                                </div>
                            </div>

                            <div class="kt-widget__item">
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Renewal</span>
                                                        <span class="kt-widget__value"><span><i class="la la-users"></i> </span>
                                                            <?php
                                                            $getperm = $mysqli->query("select * from `provisional` where renewal = '1'");
                                                            echo mysqli_num_rows($getperm);
                                                            ?>
                                                        </span>
                                </div>
                            </div>

                            <div class="kt-widget__item">
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Indexing</span>
                                                        <span class="kt-widget__value"><span><i class="la la-users"></i> </span>
                                                            <?php
                                                            $getperm = $mysqli->query("select * from `provisional` where indexing = '1'");
                                                            echo mysqli_num_rows($getperm);
                                                            ?>
                                                        </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile3-->
        </div>
    </div>

    <!--Begin::Row-->
    <div class="row">
        <div class="col-lg-3 col-md-3 col-xl-3 order-lg-1 order-xl-1">
            <!--begin:: Widgets/Trends-->
            <div class="kt-portlet kt-portlet--head--noborder">
                <div class="kt-portlet__head kt-portlet__head--noborder">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            STATISTICS FOR <?php echo  $new_year = date('Y') ?>
                        </h3>
                    </div>

                </div>
                <div class="kt-portlet__body kt-portlet__body--fluid kt-portlet__body--fit">
                    <div class="kt-widget4 kt-widget4--sticky">
                        <div class="kt-widget4__items kt-widget4__items--bottom kt-portlet__space-x kt-margin-b-20">
                            <div class="kt-widget4__item">

                                <div class="kt-widget4__info">
                                    <a href="#" class="kt-widget4__title">
                                        Permanent Registrations
                                    </a>
						<span class="kt-widget4__sub">
						All Registrations <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                        <?php $query_1 = $mysqli->query("select * from provisional where SUBSTRING(permanent_period,1,4) = '$new_year'");
                        echo  mysqli_num_rows($query_1);
                        ?>
                        </span>
					</span>
						</span>
                                                        <span class="kt-widget4__sub">
						Approved <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                        <?php $query_1 = $mysqli->query("select * from provisional where
                        SUBSTRING(permanent_period,1,4) = '$new_year' AND permanent_admincheck_status = 'Approved'");
                        echo  mysqli_num_rows($query_1);
                        ?>
                        </span>
					</span>
						</span>
                                </div>

                            </div>
                            <div class="kt-widget4__item">

                                <div class="kt-widget4__info">
                                    <a href="#" class="kt-widget4__title">
                                        Provisional Registrations
                                    </a>
						<span class="kt-widget4__sub">
						All Registrations <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                             <?php $query_1 = $mysqli->query("select * from provisional where SUBSTRING(provisional_period,1,4) = '$new_year'");
                             echo  mysqli_num_rows($query_1);
                             ?>
                        </span>
					</span>
						</span>
                                                        <span class="kt-widget4__sub">
						Approved <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                            <?php $query_1 = $mysqli->query("select * from provisional where
                        SUBSTRING(provisional_period,1,4) = '$new_year' AND provisional_admincheck_status = 'Approved'");
                            echo  mysqli_num_rows($query_1);
                            ?>
                        </span>
					</span>
						</span>

                                </div>

                            </div>
                            <div class="kt-widget4__item">

                                <div class="kt-widget4__info">
                                    <a href="#" class="kt-widget4__title">
                                        Temporal Registrations
                                    </a>
						<span class="kt-widget4__sub">
						All Registrations <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                            <?php $query_1 = $mysqli->query("select * from provisional where SUBSTRING(temporal_period,1,4) = '$new_year'");
                            echo  mysqli_num_rows($query_1);
                            ?>
                        </span>
					</span>
						</span>
                                                        <span class="kt-widget4__sub">
						Approved <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                            <?php $query_1 = $mysqli->query("select * from provisional where
                        SUBSTRING(temporal_period,1,4) = '$new_year' AND temporal_admincheck_status = 'Approved'");
                            echo  mysqli_num_rows($query_1);
                            ?>
                        </span>
                       </span>
                    </span>
                                </div>

                            </div>

                            <div class="kt-widget4__item">

                                <div class="kt-widget4__info">
                                    <a href="#" class="kt-widget4__title">
                                        Renewal Registrations
                                    </a>
						<span class="kt-widget4__sub">
						All Registrations <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                            <?php $query_1 = $mysqli->query("select * from renewal where cpdyear = '$new_year'");
                            echo  mysqli_num_rows($query_1);
                            ?>
                        </span>
					</span>
						</span>
                                                        <span class="kt-widget4__sub">
						Approved <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                            <?php $query_1 = $mysqli->query("select * from renewal where
                        cpdyear = '$new_year' AND cpd_admincheck_status = 'Approved'");
                            echo  mysqli_num_rows($query_1);
                            ?>
                        </span>
					</span>
						</span>
                                </div>

                            </div>

                            <div class="kt-widget4__item">
                                <div class="kt-widget4__info">
                                    <a href="#" class="kt-widget4__title">
                                        Indexing Registrations
                                    </a>
					<span class="kt-widget4__sub">
						All Registrations
                        <span class="kt-widget4__ext">
						   <span class="kt-widget4__number kt-font-success" style="float: right">0</span>
                        </span>
					</span>

                    <span class="kt-widget4__sub">
						Approved
                        <span class="kt-widget4__ext">
                            <span class="kt-widget4__number kt-font-success" style="float: right">0</span>
                        </span>
					</span>
                                </div>
                            </div>

                            <div class="kt-widget4__item">

                                <div class="kt-widget4__info">
                                    <a href="#" class="kt-widget4__title">
                                        Examination Registrations
                                    </a>
						<span class="kt-widget4__sub">
						All Registrations <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                        <?php $query_1 = $mysqli->query("select * from provisional where SUBSTRING(examination_period,1,4) = '$new_year'");
                        echo  mysqli_num_rows($query_1);
                        ?>
                        </span>
					</span>
						</span>
                                                        <span class="kt-widget4__sub">
						Approved <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                        <?php $query_1 = $mysqli->query("select * from examination_reg where
                        SUBSTRING(period_registered,1,4) = '$new_year' AND exam_admincheck_status = 'Approved'");
                        echo  mysqli_num_rows($query_1);
                        ?>
                        </span>
					</span>
						</span>

                                                         <span class="kt-widget4__sub">
						Main <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                        <?php $query_1 = $mysqli->query("select * from examination_reg where
                        SUBSTRING(period_registered,1,4) = '$new_year' AND exam_type IS NULL");
                        echo  mysqli_num_rows($query_1);
                        ?></span>
					</span>
						</span>

                                                         <span class="kt-widget4__sub">
						Supplementary <span class="kt-widget4__ext">
						<span class="kt-widget4__number kt-font-success" style="float: right">
                        <?php $query_1 = $mysqli->query("select * from examination_reg where
                        SUBSTRING(period_registered,1,4) = '$new_year' AND exam_type = 'Supplementary'");
                        echo  mysqli_num_rows($query_1);
                        ?>
                        </span>
					</span>
						</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Trends-->    </div>

        <div class="col-lg-5 col-xl-5 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
                <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Current Professions
                        </h3>
                    </div>
                </div>

                <!--begin: Search Form -->
                <div class="kt-form kt-fork--label-right">
                    <div class="row align-items-center ml-2 mr-2 mb-4">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-12 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
						<span class="kt-input-icon__icon kt-input-icon__icon--left">
							<span><i class="la la-search"></i></span>
						</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="kt-portlet__body kt-portlet__body--fit">
                    <!--begin: Datatable -->
                    <table class="kt-datatable" id="html_table" width="100%">
                        <thead>
                        <tr>
                            <th title="Field #1" width="50%">Profession Name</th>
                            <th title="Field #3" width="20%">Code</th>
                            <th title="Field #4" width="20%">Number of <br/>Applicants</th>
                            <th title="Field #2" width="10%">No</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $counter = 1;
                        $getdetails = $mysqli->query("select * from professions ORDER BY professionname");
                        while ($resdetails = $getdetails->fetch_assoc()){
                            ?>

                            <tr>

                                <td><?php echo $resdetails['professionname'] ?></td>
                                <td><?php echo $profcode = $resdetails['professionid'] ?></td>
                                <td><?php $getnum = $mysqli->query("select * from provisional where professionid = '$profcode'");
                                    echo mysqli_num_rows($getnum)
                                    ?>
                                </td>
                                <td><?php echo $counter; ?></td>
                            </tr>
                            <?php
                            $counter++;
                        }
                        ?>
                        </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Registrations Dates Updates
                        </h3>
                    </div>
                </div>

                <div class="table-responsive ml-3">
                    <!--begin::Table-->
                    <table class="table">
                        <!--begin::Thead-->
                        <thead>
                        <tr>
                            <td>Registration <br/>Type</td>
                            <td class="kt-align-right">Date <br/>Started</td>
                            <td class="kt-align-right">Date <br/>Completed</td>
                            <td>Status</td>
                        </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody>
                        <?php $getdate = $mysqli->query("select * from date_config");
                        while ($resdate = $getdate->fetch_assoc()){
                            ?>
                            <tr>
                                <td>
                                    <a href="javascript:;" class="kt-widget11__title">
                                        <?php echo $resdate['registration_type'] ?>
                                    </a>
                                </td>
                                <td class="kt-align-right kt-font-brand kt-font-bold"><?php echo $date_started = $resdate['date_started'] ?></td>
                                <td class="kt-align-right kt-font-brand kt-font-bold"><?php echo $date_com = $resdate['date_completed'] ?></td>
                                <td>
                                    <?php
                                    $today = date('Y-m-d');
                                    if ($date_com >= $today && $date_started <= $today) {
                                        echo '<span class="kt-badge kt-badge--success kt-badge--inline">In Progress</span>';
                                    }
                                    else {
                                        echo '<span class="kt-badge kt-badge--danger kt-badge--inline">Expired</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                        <!--end::Tbody-->
                    </table>
                    <!--end::Table-->
                </div>
            </div>
        </div>
    </div>
    <!--End::Row-->
    <!--End::Dashboard 3-->	</div>
<!-- end:: Content -->

<?php require('includes/footer.php') ?>

<script>
    //alert("SITE WILL SHUTDOWN ON WEDNESDAY DUE TO NON-PAYMENT OF FEES");
    "use strict";
    var KTDatatableHtmlTableDemo = {
        init: function () {
            var t;
            t = $(".kt-datatable").KTDatatable({
                data: {saveState: {cookie: !1}},
                search: {input: $("#generalSearch")},
                columns: [
                    {field: "DepositPaid", type: "number"}, {
                        field: "OrderDate", type: "date", format: "YYYY-MM-DD"},
                    {
                        field: "Status", title: "Status", autoHide: !1, template: function (t) {
                        var e = {
                            1: {title: "Pending", class: "kt-badge--brand"},
                            2: {title: "Approved", class: " kt-badge--success"},
                            3: {title: "Rejected", class: " kt-badge--danger"},
                            4: {title: "Success", class: " kt-badge--success"},
                            5: {title: "Info", class: " kt-badge--info"},
                            6: {title: "Danger", class: " kt-badge--danger"},
                            7: {title: "Warning", class: " kt-badge--warning"}
                        };
                        return '<span class="kt-badge ' + e[t.Status].class + ' kt-badge--inline kt-badge--pill">' + e[t.Status].title + "</span>"
                    }
                    },
                    {
                        field: "Type", title: "Type", autoHide: !1, template: function (t) {
                        var e = {
                            1: {title: "Permanent", state: "danger"},
                            2: {title: "Provisional", state: "primary"},
                            3: {title: "Temporal", state: "success"},
                            4: {title: "Examination", state: "info"},
                            5: {title: "Renewal", state: "warning"},
                            6: {title: "Indexing", state: "success"},
                            7: {title: "None", state: "warning"}
                        };
                        return '<span class="kt-badge kt-badge--' + e[t.Type].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + e[t.Type].state + '">' + e[t.Type].title + "</span>"
                    }
                    }]
            }), $("#kt_form_status").on("change", function () {
                t.search($(this).val().toLowerCase(), "Status")
            }), $("#kt_form_type").on("change", function () {
                t.search($(this).val().toLowerCase(), "Type")
            }), $("#kt_form_status,#kt_form_type").selectpicker()
        }
    };
    jQuery(document).ready(function () {
        KTDatatableHtmlTableDemo.init()
    });
</script>

