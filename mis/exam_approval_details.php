<?php
include('../config.php');
$applicant_id = $_POST['applicant_id'];
$year_search = $_POST['year_search'];
@$examination_id = $_POST['examination_id'];
$app_type = $_POST['app_type'];
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];
$registrationtype = 'Examination';

$getdetails = $mysqli->query("select *,p.`applicant_id` from examination_reg e 
JOIN provisional p ON e.applicant_id = p.applicant_id 
WHERE e.examination_id = '$examination_id' AND p.examination_registration = '1'");
$resdetails = $getdetails->fetch_assoc();
$applicant_id = $resdetails['applicant_id'];
$professionid = $resdetails['professionid'];
$exam_index_number = $resdetails['exam_index_number'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('includes/styles.php'); ?>
    <style>
        .notifyjs-bootstrap-base {
            font-weight: lighter !important;
            font-size: small;
        }
    </style>

    <script>
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
<body>
<!-- START APP WRAPPER -->

<button class="btn btn-warning btn-floating" id="close_page"
        style="float: right;margin-right: 2%">
    <i class="icon-arrow-left-circle"></i> Close/Go Back
</button>

<section class="page-content container-fluid">
    <ul class="nav nav-tabs" id="app_reg_form">
        <li class="nav-item" role="presentation">
            <a href="#tab-1" style="color:#000000 !important" class="nav-link active show"
               data-toggle="tab" aria-expanded="true">Click to Approve</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#tab-2" style="color:#000000 !important" class="nav-link" data-toggle="tab"
               aria-expanded="true">Click to view Details</a>
        </li>
    </ul>
    <div class="row">
        <div class="col">
            <div class="tab-content">
                <div class="tab-pane fadeIn active" id="tab-1">
                    <div class="card">
                        <h5 class="card-header">
                            APPROVAL FOR
                            <strong>
                                <?php echo $resdetails['surname'] . ' ' .$resdetails['first_name'] . ' ' .$resdetails['other_name'] ?></strong>
                        </h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="card-body" id="print_this">
                                        <div class="row">
                                            <?php if ($user_type == "Super Admin"){ ?>
                                                <div class="col-md-6">
                                                    <?php  if ($app_type == "MIS Admin") {
                                                        echo "Only MIS Admins are eligible for approval on this page";
                                                    }
                                                    else { ?>
                                                        <div class="form-group" id="form_submit">
                                                            <label for="exampleInputPassword1">Form Submitted to office </label>
                                                            <br/>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="customRadioInline1"
                                                                       name="form_submitted" value="Yes" class="custom-control-input"
                                                                    <?php if (@$resdetails['exam_form_submitted'] == "Yes") echo "checked" ?>>
                                                                <label class="custom-control-label" for="customRadioInline1">Yes</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="customRadioInline2"
                                                                       name="form_submitted" value="No" class="custom-control-input"
                                                                    <?php if (@$resdetails['exam_form_submitted'] == "No") echo "checked" ?>>
                                                                <label class="custom-control-label" for="customRadioInline2">No</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id="form_approved">
                                                            <label for="customRadioInline3">Application Approval </label>
                                                            <br/>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="customRadioInline3"
                                                                       name="approve_state" value="Approved" class="custom-control-input"
                                                                    <?php if (@$resdetails['exam_admincheck_status'] == "Approved") echo "checked" ?>>
                                                                <label class="custom-control-label" for="customRadioInline3">Approved</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="customRadioInline4"
                                                                       name="approve_state" value="Rejected" class="custom-control-input"
                                                                    <?php if (@$resdetails['exam_admincheck_status'] == "Rejected") echo "checked" ?>>
                                                                <label class="custom-control-label" for="customRadioInline4">Rejected</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Remark</label>
                                                            <textarea type="text" class="form-control" id="remark"
                                                                      placeholder="Enter Remark" rows="6"><?php echo $resdetails['exam_admincheck_comment'] ?></textarea>
                                                        </div>
                                                        <div class="card-footer bg-light">
                                                            <button type="button" class="btn btn-primary"
                                                                    id="finalsaveapproval">Submit
                                                            </button>
                                                            <button type="button" class="btn btn-secondary clear-form"
                                                                    style="float: right">Clear
                                                            </button>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>Payment Status</td>
                                                        <td>
                                                            <b> <?php if ($resdetails['payment'] == "0"){?>
                                                                    <button class="btn btn-sm btn-accent btn-floating">Not Paid</button>
                                                                <?php  }
                                                                else if ($resdetails['payment'] == "1") { ?>
                                                                    <button class="btn btn-sm btn-success btn-floating">Paid</button>
                                                                <?php }?>
                                                            </b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Document Received at office</td>
                                                        <td>
                                                            <b><?php echo $resdetails['exam_form_submitted'] ?></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Approved</td>
                                                        <td>
                                                            <b><?php echo $resdetails['exam_usercheck_status'] ?></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Approved Remark</td>
                                                        <td>
                                                            <b><?php echo $resdetails['exam_usercheck_comment'] ?></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Approved By</td>
                                                        <td> <b><?php $u_id =  $resdetails['exam_usercheck_user'] ?>
                                                                <?php $q = $mysqli->query("select * from users where id = '$u_id'");
                                                                $r = $q->fetch_assoc();
                                                                echo $r['full_name'];
                                                                ?></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Final Approval</td>
                                                        <td>
                                                            <b><?php echo $resdetails['exam_admincheck_status'] ?></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Final Approval Remark</td>
                                                        <td>
                                                            <b><?php echo $resdetails['exam_admincheck_comment'] ?></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Final Approved By</td>
                                                        <td> <b><?php $u_id =  $resdetails['exam_admincheck_user'] ?>
                                                                <?php $q = $mysqli->query("select * from mis_users where user_id = '$u_id'");
                                                                $r = $q->fetch_assoc();
                                                                echo $r['full_name'];
                                                                ?></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Index number Generated</td>
                                                        <td> <b><?php echo $ind =  $resdetails['indexnumber'];
                                                        if ($ind == ""){
                                                            echo $exam_index_number;
                                                        }
                                                        ?></b></td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fadeIn" id="tab-2">
                    <div class="card">
                        <h5 class="card-header">APPLICANT DETAILS</h5>
                        <div class="card-body" id="print_this">
                            <div class="invoice-wrapper">
                                <div class="invoice-header border-bottom">
                                    <div class="row">
                                        <div class="col-md-2" align="center">
                                            <img src="img/logo/coa.png"
                                                 style="border: 0 !important;"/>
                                        </div>
                                        <div class="col-md-8" align="center">
                                            <h2 style="font-weight: bold;">ALLIED HEALTH PROFESSIONS
                                                COUNCIL</h2>
                                            <h6>MINISTRY OF HEALTH</h6>
                                            <hr/>
                                            PROVISIONAL REGISTRATION APPLICATION FORM
                                        </div>
                                        <div class="col-md-2" align="center">
                                            <img src="img/logo/ahpc_logo.png"
                                                 style="border: 0 !important;"/>
                                        </div>
                                    </div>
                                    <div class="invoice-summary">
                                        <div class="row">
                                            <div class="col-md-12">
                                                Please attach the following document to your applications. <br/>Failure
                                                to do so
                                                may result in the rejection of your forms
                                                <hr/>
                                                <strong>Checklist </strong> - please check to ensure you have
                                                enclosed the following
                                                items
                                                with your application.<br/>
                                                <ol type="1">
                                                    <li>
                                                        <input type="checkbox"/> A completed application form
                                                    </li>
                                                    <li>
                                                        <input type="checkbox"/> A Nonrefundable Registration
                                                        fee of
                                                        <strong>GHS
                                                            <?php echo getBill($professionid, $registrationtype); ?>
                                                        </strong>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox"/> <b>Certified</b> copies of Two
                                                        Photo Identification
                                                        to confirm identity
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>

                                        <hr class="dashed">
                                        <h5>Personal Profile</h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php
                                                $img = $mysqli->query("select * from applicant_images
                       where applicant_id = '$applicant_id'");
                                                $fetch_img = $img->fetch_assoc()
                                                ?>
                                                <div class="profile-image"><img
                                                            src="<?php echo $reg_root.'/'. $fetch_img['image_location'] ?>"
                                                            alt="" style="width: 80%">
                                                </div>
                                                <hr/>
                                                <div>
                                                    <h4 class="m-b-0"><strong><?php
                                                            $fname = $resdetails['surname'] . ' ' . $resdetails['first_name'] . ' ' . $resdetails['other_name'];
                                                            $title = $resdetails['title'];

                                                            if ($title == "Other") {
                                                                $title = $resdetails['othertitle'];
                                                                $title . ' ' . $resdetails["full_name"];
                                                            } else {
                                                                $title . ' ' . $resdetails["full_name"];
                                                            }

                                                            echo $title . ' ' . $fname;


                                                            ?>
                                                        </strong></h4>
                                                    <p></p>
                                                    <span>
                                                            <h6>(<?php echo $profession = $resdetails['profession'];

                                                                if ($profession == ""){

                                                                    $getp = $mysqli->query("select * from professions WHERE
                                                                       professionid = '$professionid'");
                                                                    $getname = $getp->fetch_assoc();
                                                                    echo $professionname = $getname['professionname'];
                                                                }

                                                                ?>)</h6>
                                                        </span>
                                                </div>

                                                <hr>


                                            </div>
                                            <div class="col-md-4">
                                                <small class="text-muted">PIN/Code:</small>
                                                <p><?php echo $pin = $resdetails['provisional_pin'];
                                                    if ($pin == ""){
                                                        echo $applicant_id;
                                                    }
                                                    ?></p>
                                                <hr>
                                                <small class="text-muted">Gender:</small>
                                                <p><?php echo $resdetails['gender'] ?></p>
                                                <hr>
                                                <small class="text-muted">Telephone:</small>
                                                <p><?php echo $resdetails['telephone'] ?></p>
                                                <hr>
                                                <small class="text-muted">Email Address:</small>
                                                <p><?php echo $resdetails['email_address'] ?></p>
                                                <hr>
                                                <small class="text-muted">Date of Birth:</small>
                                                <p><?php echo date("jS M, Y", strtotime($resdetails['birth_date'])) ?></p>
                                                <hr>
                                                <small class="text-muted">Place of Birth:</small>
                                                <p><?php echo $resdetails['place_of_birth']; ?></p>
                                                <hr>
                                            </div>

                                            <div class="col-md-4">

                                                <small class="text-muted">Nationality:</small>
                                                <p><?php echo $resdetails['nationality'] ?></p>
                                                <hr>
                                                <small class="text-muted">House Number:</small>
                                                <p><?php echo $resdetails['res_housenumber'] ?></p>
                                                <hr>
                                                <small class="text-muted">Street Name:</small>
                                                <p><?php echo $resdetails['res_streetname'] ?></p>
                                                <hr>
                                                <small class="text-muted">Locality:</small>
                                                <p><?php echo $resdetails['res_locality'] ?></p>
                                                <hr>
                                                <small class="text-muted">District:</small>
                                                <p><?php echo $resdetails['contact_address'] ?></p>
                                                <hr>
                                                <small class="text-muted">Region:</small>
                                                <p><?php echo $resdetails['res_region'] ?></p>
                                                <hr>
                                                <small class="text-muted">Marital Status:</small>
                                                <p><?php echo $resdetails['marital_status'] ?></p>
                                                <hr>
                                            </div>
                                        </div>

                                        <hr class="dashed">
                                        <h5>Institution(s) Attended</h5>
                                        <?php
                                        $in_qu = $mysqli->query("select * from applicant_institutions where 
applicant_id = '$applicant_id' ORDER BY institutionid DESC");
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="table-responsive">
                                                    <table class="table center-aligned-table">
                                                        <thead>
                                                        <tr>
                                                            <th>Institution Name</th>
                                                            <th>Period</th>
                                                            <th>Program of Study</th>
                                                            <th>Certificate</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php
                                                        while($fetch_qu = $in_qu->fetch_assoc())
                                                        {
                                                            ?>

                                                            <tr>
                                                                <td><?php echo $fetch_qu['institution_name'] ?></td>
                                                                <td><?php echo $fetch_qu['date_started']." - ".$fetch_qu['date_ended'] ?></td>
                                                                <td><?php echo $fetch_qu['study_program'] ?></td>
                                                                <td>
                                                                    <div>
                                                                        <?php $file_id = $fetch_qu['qualification_id']; ?>

                                                                        <?php
                                                                        $doc = $mysqli->query("select * from applicant_certificates
                                           where qualification_id = '$file_id'");

                                                                        while ($fetch_doc = $doc->fetch_assoc()) { ?>

                                                                            <img
                                                                                    src="<?php echo $reg_root.'/'. $fetch_doc['image_location'] ?>"
                                                                                    style="width: 100%"/>

                                                                        <?php } ?>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>

                                        <hr class="dashed">

                                        <div>

                                            <?php

                                            $in_nc = $mysqli->query("select * from applicant_natcert where 
applicant_id = '$applicant_id' ORDER BY id DESC");
                                            while ($res_nc = $in_nc->fetch_assoc()){
                                                ?>
                                                <img src="<?php echo $reg_root.'/'. $res_nc['image_location'] ?>"
                                                     style="width: 100%"/>
                                            <?php }

                                            ?>
                                        </div>

                                        <div>

                                            <?php

                                            $in_al = $mysqli->query("select * from applicant_appletter where 
applicant_id = '$applicant_id' ORDER BY id DESC");
                                            while ($res_al = $in_al->fetch_assoc()){
                                                ?>
                                                <img src="<?php echo $reg_root.'/'. $res_al['image_location'] ?>"
                                                     style="width: 100%"/>
                                            <?php }

                                            ?>
                                        </div>

                                        <hr class="dashed">

                                        <h5>Examination Details</h5>

                                        <div class="row">
                                            <div class="col-md-6">

                                                <small class="text-muted">Provisional/Permanent Certificate Number <small>(Where Applicable)</small>:</small>
                                                <p><?php echo $resdetails['provisional_pin']; ?></p>
                                                <hr>
                                                <small class="text-muted">Period of Internship <small>(Where Applicable)</small>:</small>
                                                <p><?php echo $resdetails['internship_period'] ?></p>
                                                <hr>
                                                <small class="text-muted">Facility :</small>
                                                <p><?php echo $resdetails['facility'] ?></p>
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted">Previous Council's Licensure Examination:</small>
                                                <p><?php echo $resdetails['previous_exam'] ?></p>
                                                <hr>
                                                <small class="text-muted">If yes, Number of Attempts:</small>
                                                <p><?php echo $resdetails['exam_attempts'] ?></p>
                                                <hr>
                                                <small class="text-muted">Examination Centre:</small>
                                                <p><?php echo $resdetails['exam_center'] ?></p>
                                                <hr>
                                            </div>
                                        </div>

                                        <hr class="dashed">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <b>Endorsement</b><br/>
                                                Head of Training Institution/Facility
                                                <hr/>
                                            </div>
                                        </div>

                                        <div class="row" style="padding-top: 2%">
                                            <div class="col-md-4">Name of Head</div>

                                            <div class="col-md-8">

                                                ...................................................................................................................

                                            </div>

                                        </div>

                                        <div class="row" style="padding-top: 2%">
                                            <div class="col-md-4"> Signature</div>

                                            <div class="col-md-8">

                                                ...................................................................................................................

                                            </div>

                                        </div>

                                        <div class="row" style="padding-top: 2%">
                                            <div class="col-md-4"> Stamp</div>

                                            <div class="col-md-8">

                                                ...................................................................................................................

                                            </div>

                                        </div>

                                        <div class="row" style="padding-top: 1.5%">
                                            <div class="col-md-12">
                                                <b>
                                                    Note: Any application Form which is not appropriately endorsed will be rejected
                                                </b>
                                            </div>

                                        </div>

                                        <div class="row" style="padding-top: 4%">
                                            <div class="col-md-12" style="text-align: justify">
                                                <b>Declaration of Information</b><br/>
                                                <strong>I declare</strong> that I have read, understood and will comply with the AHPC requirements
                                                for registration. <strong>I agree</strong> to pay the appropriate fees for the examination using
                                                the approved method of payment. <strong>I consent</strong> to the AHPC contacting any
                                                person/institution for further information on my application or to confirm
                                                the information that I have provided. I consent to any person approved by the
                                                AHPC to assist with the evaluation of my application by providing the AHPC with
                                                any information held by that person in respect of me that the AHPC may request.

                                            </div>

                                        </div>

                                        <div class="row" style="padding-top: 4%">
                                            <div class="col-md-4"> Signature</div>

                                            <div class="col-md-8">

                                                .........................................................................................................

                                            </div>

                                        </div>

                                        <div class="row" style="padding-top: 4%">
                                            <div class="col-md-12">
                                                Registration Fee Paying Method: <strong>Applicants are required to make Payment of
                                                    non-refundable Examination Fee of
                                                    GHS 275.00</strong> (Two hundred and Seventy-five Ghana Cedis)  By Submitting your Bill to
                                                any Ghana Commercial  Bank (GBC) after your online application process for Payment.
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <button class="btn btn-primary pull-right m-t-20 m-b-20"
                                    onclick="printContent('print_this')"><i class="icon-printer"></i> Print Form
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SIDEBAR QUICK PANNEL WRAPPER -->
<!-- END SIDEBAR QUICK PANNEL WRAPPER -->
<!-- END CONTENT WRAPPER -->
<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->
<?php require('includes/scripts.php') ?>
<script>

    $("#finalsaveapproval").click(function () {
        var form_submitted = $('input[name=form_submitted]:checked').val();
        var approve_state = $('input[name=approve_state]:checked').val();
        var remark = $("#remark").val();
        var applicant_id = '<?php echo $applicant_id ?>';
        var user_id = '<?php echo $user_id ?>';
        var year_search = '<?php echo $year_search ?>';
        var examination_id = '<?php echo $examination_id ?>';
        var app_type = '<?php echo $app_type ?>';
        //alert(examination_id);
        var error = '';
        if (approve_state == undefined) {
            error += 'Please approve or disapprove application \n';
        }
        if (form_submitted == undefined) {
            error += 'Please indicate whether form is submitted to office \n';
        }
        if (remark == "") {
            error += 'Please enter remark \n';
        }
        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/save_approval_examination_final.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="../assets/img/wait.gif" style="border:0 !important"/>'
                    });
                },
                data: {
                    applicant_id: applicant_id,
                    form_submitted: form_submitted,
                    approve_state: approve_state,
                    examination_id: examination_id,
                    remark: remark,
                    user_id:user_id
                },
                success: function (text) {
                    //alert(text);
                    $.notify("Application Reviewed", "success", {position: "top center"});
                    $.ajax({
                        type: "POST",
                        url: "exam_approval_details.php",
                        data: {
                            applicant_id: applicant_id,
                            examination_id: examination_id,
                            year_search:year_search,
                            app_type:app_type
                        },
                        success: function (text) {
                            $('#pending-table').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },
            });
        }
        else {
            $.notify(error, {position: "top center"});
        }
        return false;
    });
    $('#close_page').click(function () {
        var year_search = '<?php echo $year_search ?>';
        var app_type = '<?php echo $app_type ?>';
        if (app_type == 'Super Admin') {
            $.ajax({
                type: "POST",
                url: "ajax/tables/pending_examination_reg_super.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="../assets/img/wait.gif" style="border:0 !important"/>'
                    });
                },
                data: {
                    year_search: year_search
                },
                success: function (text) {
                    $('#examination_table_div').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },
            });
        }

        else if (app_type == 'MIS Admin')  {
            $.ajax({
                type: "POST",
                url: "ajax/tables/pending_examination_reg_mis.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="../assets/img/wait.gif" style="border:0 !important"/>'
                    });
                },
                data: {
                    year_search: year_search
                },
                success: function (text) {
                    $('#examination_table_div').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },

            });
        }
    })


</script>


</body>
</html>
