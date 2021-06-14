<?php
include('../config.php');

$newappid = mysqli_real_escape_string($mysqli,$_POST['id_index']);
$user_id = $_SESSION['user_id'];
$year = $_POST['id_year'];
$applicant_id = str_replace('_', ' ', $newappid);


$app = $mysqli->query("SELECT *
                     FROM renewal r
                     JOIN provisional p ON r.applicant_id = p.applicant_id
                     WHERE r.cpdyear != '' AND r.cpdyear = '$year' AND r.applicant_id = '$applicant_id'");
$result = $app->fetch_assoc();
$professionid = $result['professionid'];
?>



<section class="page-content container-fluid">
    <ul class="nav nav-tabs" id="app_reg_form">
        <li class="nav-item" role="presentation">
            <a href="#tab-1" class="nav-link active show"
               data-toggle="tab" aria-expanded="true">Click to Approve</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#tab-2" class="nav-link" data-toggle="tab"
               aria-expanded="true">Click to view Details</a>
        </li>
    </ul>
    <div class="row">
        <div class="col">
            <div class="tab-content">
                <div class="tab-pane fadeIn active" id="tab-1">

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Approval for <?php echo $result['surname'] . ' ' .$result['first_name'] . ' ' .$result['other_name'] ?>
                                        </h3>
                                    </div>
                                </div>
                                <!--begin::Form-->
                                <form class="">
                                    <div class="kt-portlet__body">

                                        <div class="form-group">
                                            <label>Form Submitted to office</label>
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio">
                                                    <input type="radio" name="form_submitted" value="Yes" <?php if (@$result['cpd_form_submitted'] == "Yes") echo "checked" ?>> Yes
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio">
                                                    <input type="radio" name="form_submitted" value="No" <?php if (@$result['cpd_form_submitted'] == "No") echo "checked" ?>> No
                                                    <span></span>
                                                </label>
                                            </div>
                                            <span class="form-text text-muted">Has the applicant submitted the form to the office?</span>
                                        </div>


                                        <div class="form-group">
                                            <label>Approve Application</label>
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio">
                                                    <input type="radio" name="approve_state" value="Approved" <?php if (@$result['cpd_usercheck_status'] == "Approved") echo "checked" ?>> Approve
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio">
                                                    <input type="radio" name="approve_state" value="Rejected" <?php if (@$result['cpd_usercheck_status'] == "Rejected") echo "checked" ?>> Reject
                                                    <span></span>
                                                </label>
                                            </div>
                                            <span class="form-text text-muted">Approvals can be reverted</span>
                                        </div>

                                        <div class="form-group form-group-last">
                                            <label for="exampleTextarea">Remark</label>
                                            <textarea class="form-control" id="remark" rows="3"
                                                      placeholder="Enter Remark or Comment"><?php echo $result['cpd_usercheck_comment'] ?></textarea>
                                        </div>


                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <button type="button" class="btn btn-primary" id="saveapprovalbtn">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Summary Data
                                        </h3>
                                    </div>
                                </div>
                                <!--begin::Form-->
                                <form class="">
                                    <div class="kt-portlet__body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Payment Status</td>
                                                <td>
                                                    <?php if ($result['payment'] == "0") { ?>
                                                        <button class="btn btn-sm btn-danger btn-floating">Not Paid</button>
                                                    <?php } else if ($result['payment'] == "1") { ?>
                                                        <button class="btn btn-sm btn-success btn-floating">Paid</button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Document Received at office</td>
                                                <td>
                                                    <?php echo $result['cpd_form_submitted'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Approved</td>
                                                <td>
                                                    <?php echo $result['cpd_usercheck_status'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Approved Remark</td>
                                                <td>
                                                    <?php echo $result['cpd_usercheck_comment'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Approved By</td>
                                                <td><?php $u_id = $result['cpd_usercheck_user'] ?>
                                                    <?php $q = $mysqli->query("select * from mis_users where user_id = '$u_id'");
                                                    $r = $q->fetch_assoc();
                                                    echo $r['full_name'];
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Final Approval</td>
                                                <td>
                                                    <?php echo $result['cpd_admincheck_status'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Final Approval Remark</td>
                                                <td>
                                                    <?php echo $result['cpd_admincheck_comment'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Final Approved By</td>
                                                <td><?php $u_id = $result['cpd_admincheck_user'] ?>
                                                    <?php $q = $mysqli->query("select * from mis_users where user_id = '$u_id'");
                                                    $r = $q->fetch_assoc();
                                                    echo $r['full_name'];
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PIN Generated</td>
                                                <td><?php echo $u_id = $result['provisional_pin'] ?></td>
                                            </tr>

                                        </table>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>

                    </div>


                </div>

                <div class="tab-pane fadeIn" id="tab-2">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    APPLICANT DETAILS
                                </h3>
                            </div>
                        </div>

                        <div class="kt-portlet__body">
                            <div class="invoice-wrapper" id="print_this">
                                <div class="invoice-header border-bottom">
                                    <div class="row">
                                        <div class="col-md-2" align="center">
                                            <img src="newassets/img/coa.png"
                                                 style="width:60%;border: 0 !important;"/>
                                        </div>
                                        <div class="col-md-8" align="center">
                                            <h2 style="font-weight: bold;">ALLIED HEALTH PROFESSIONS
                                                COUNCIL</h2>
                                            <h6>MINISTRY OF HEALTH</h6>
                                            <hr/>
                                            APPLICATION FORM FOR PIN RENEWAL
                                        </div>
                                        <div class="col-md-2" align="center">
                                            <img src="newassets/img/ahpc_logo.png"
                                                 style="width:70%;border: 0 !important;"/>
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
                                                        <input type="checkbox"/> Certified Photocopy of picture National ID
                                                    </li>
                                                    <li>
                                                        <input type="checkbox"/> Certified evidence of any change of name (if applicable)
                                                    </li>
                                                    <li>
                                                        <input type="checkbox"/> Expired PIN Card
                                                    </li>
                                                    <li>
                                                        <input type="checkbox"/>  One Passport-size photograph (white background)
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
                                                            $fname = $result['surname'] . ' ' . $result['first_name'] . ' ' . $result['other_name'];
                                                            $title = $result['title'];

                                                            if ($title == "Other") {
                                                                $title = $result['othertitle'];
                                                                $title . ' ' . $result["full_name"];
                                                            } else {
                                                                $title . ' ' . $result["full_name"];
                                                            }

                                                            echo $title . ' ' . $fname;


                                                            ?>
                                                        </strong></h4>
                                                    <p></p>

                                                </div>
                                                <hr class="dashed">
                                                <p>
                                                    AHPC PIN: <?php echo $result['provisional_pin']; ?>
                                                </p>

                                                <hr class="dashed">
                                                <p>
                                                    Level: <b><?php echo $result['acad_level']; ?></b>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <small class="text-muted">Gender:</small>
                                                <p><?php echo $result['gender'] ?></p>
                                                <hr>
                                                <small class="text-muted">Telephone:</small>
                                                <p><?php echo $result['telephone'] ?></p>
                                                <hr>
                                                <small class="text-muted">Email Address:</small>
                                                <p><?php echo $result['email_address'] ?></p>
                                                <hr>
                                                <small class="text-muted">Date of Birth:</small>
                                                <p><?php echo date("jS M, Y", strtotime($result['birth_date'])) ?></p>
                                                <hr>
                                                <small class="text-muted">Place of Birth:</small>
                                                <p><?php echo $result['place_of_birth']; ?></p>
                                                <hr>
                                                <small class="text-muted">Nationality:</small>
                                                <p><?php echo $result['nationality'] ?></p>
                                                <hr>
                                            </div>

                                            <div class="col-md-4">

                                                <small class="text-muted">House Number:</small>
                                                <p><?php echo $result['res_housenumber'] ?></p>
                                                <hr>
                                                <small class="text-muted">Street Name:</small>
                                                <p><?php echo $result['res_streetname'] ?></p>
                                                <hr>
                                                <small class="text-muted">Locality:</small>
                                                <p><?php echo $result['res_locality'] ?></p>
                                                <hr>
                                                <small class="text-muted">District:</small>
                                                <p><?php echo $result['contact_address'] ?></p>
                                                <hr>
                                                <small class="text-muted">Region:</small>
                                                <p><?php echo $result['res_region'] ?></p>
                                                <hr>
                                                <small class="text-muted">Marital Status:</small>
                                                <p><?php echo $result['marital_status'] ?></p>
                                                <hr>
                                            </div>
                                        </div>
                                        <hr class="dashed">
                                        <h5>Identification</h5>
                                        <?php
                                        $do_qu = $mysqli->query("select * from applicant_identification_docs where
                                                applicant_id = '$applicant_id' ORDER BY id DESC");
                                        $doc_count = mysqli_num_rows($do_qu);
                                        if ($doc_count == 0) {

                                            echo "";
                                        } else {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="body">
                                                        <div class="table-responsive">
                                                            <table class="table center-aligned-table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Identification Type</th>
                                                                    <th>File(s)</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                while ($fetch_do = $do_qu->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $file_name = $fetch_do['file_name'] ?></td>
                                                                        <td>
                                                                            <div>
                                                                                <?php $file_id = $fetch_do['file_id']; ?>
                                                                                <?php
                                                                                $doc = $mysqli->query("select * from applicant_identification
                                           where file_id = '$file_id'");
                                                                                while ($fetch_doc = $doc->fetch_assoc()) { ?>
                                                                                    <img
                                                                                        src="<?php echo $reg_root . '/' . $fetch_doc['location'] ?>"
                                                                                        style="width: 50%"/>
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
                                            </div>
                                        <?php } ?>

                                        <hr class="dashed">
                                        <h5>CPD EVENTS UNDERTAKEN</h5>
                                        <div class="row">
                                            <div class="col-md-12">

                                                <table class="table">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Title</th>
                                                        <th>Credit Earned</th>
                                                        <th>Certificate</th>
                                                    </tr>
                                                    <?php
                                                    $getd = $mysqli->query("select * from cpd_event where cpdyear = '$year'
                      AND applicant_id = '$applicant_id' ORDER BY cpddate DESC");
                                                    while ($resd = $getd->fetch_assoc()) { ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $resd['cpddate'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $resd['eventtitle'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $resd['cpdcredit'] ?>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <?php $file_id = $resd['cpdid']; ?>

                                                                    <?php
                                                                    $doc = $mysqli->query("select * from cpd_uploads
                                           where cpdid = '$file_id'");
                                                                    while ($fetch_doc = $doc->fetch_assoc()) { ?>
                                                                        <img src="<?php echo $reg_root.'/'. $fetch_doc['image_location'] ?>"
                                                                             style="width: 100%"/>

                                                                    <?php } ?>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="2">TOTAL CREDIT EARNED </td>
                                                        <td>
                                                            <h5>
                                                                <?php
                                                                $gettot = $mysqli->query("SELECT SUM(cpdcredit) AS sumcpd FROM cpd_event
                                                      where cpdyear = '$year' AND applicant_id = '$applicant_id'");
                                                                $restot = $gettot->fetch_assoc();
                                                                echo $sumcpd = $restot['sumcpd'];
                                                                ?>
                                                            </h5>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>
                                        </div>

                                        <h5>
                                            ***ATTACH COPIES OF CPD CERTIFICATES
                                        </h5>

                                        <h6>
                                            A minimum of Ten (10) CPD Hours is required for Renewal
                                        </h6>


                                        <div class="row" style="padding-top: 4%">
                                            <div class="col-md-4"> Signature</div>

                                            <div class="col-md-8">

                                                .........................................................................................................

                                            </div>

                                        </div>


                                        <hr class="dashed">

                                        <!--<div class="row" style="padding-top: 4%">
                                            <div class="col-md-12" style="text-align: justify">
                                                Registration Fee Paying Method (payable to Allied Health Professions Council Account No.
                                                1131130014299 at GCB, Korle Bu Branch, Accra and attach the Pay-in Slip to the Completed
                                                Application Form).
                                            </div>

                                        </div>-->

                                        <!--<hr class="dashed">
                                        <div class="row" style="padding-top: 4%">
                                            <div class="col-md-12" style="text-align: justify">
                                                <b>Schedule of Fees</b><br/>
                                                <div class="row">
                                                    <div class="col-md-4">Masters & Degree Applicants: </div>
                                                    <div class="col-md-8">GH? 150.00</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Diploma Applicants: </div>
                                                    <div class="col-md-8">GH? 100.00</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">Certificate Applicants: </div>
                                                    <div class="col-md-8">GH? 80.00</div>
                                                </div>
                                            </div>

                                        </div>-->

                                        <h6 align="center" style="padding-top: 8%">OFFICE USE ONLY</h6>
                                        <hr/>


                                        <div class="row" style="padding-top: 2%">
                                            <div class="col-md-4">Received By</div>
                                            <div class="col-md-8">
                                                ...................................................................................................................

                                            </div>

                                        </div>
                                        <div class="row" style="padding-top: 2%">
                                            <div class="col-md-4">Date</div>
                                            <div class="col-md-8">
                                                ...................................................................................................................

                                            </div>

                                        </div>

                                        <div class="row" style="padding-top: 2%">
                                            <div class="col-md-4"> Remarks</div>
                                            <div class="col-md-8">
                                                ...................................................................................................................

                                            </div>
                                        </div>

                                        <hr class="dashed">

                                        <div class="row" style="padding-top: 2%">
                                            <div class="col-md-4">Renewal Approved By</div>
                                            <div class="col-md-8">
                                                ...................................................................................................................

                                            </div>

                                        </div>
                                        <div class="row" style="padding-top: 2%">
                                            <div class="col-md-4">PIN Card Issued By</div>
                                            <div class="col-md-8">
                                                ...................................................................................................................

                                            </div>

                                        </div>

                                        <div class="row" style="padding-top: 2%">
                                            <div class="col-md-4"> Date</div>
                                            <div class="col-md-8">
                                                ...................................................................................................................

                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="button" class="btn btn-primary" onclick="printContent('print_this')"><i class="flaticon2-printer"></i> Print Form</button>
                            </div>
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

<script>
    $("#saveapprovalbtn").click(function () {
        var form_submitted = $('input[name=form_submitted]:checked').val();
        var approve_state = $('input[name=approve_state]:checked').val();
        var remark = $("#remark").val();
        var applicant_id = '<?php echo $applicant_id ?>';
        var user_id = '<?php echo $user_id ?>';
        var year = '<?php echo $year ?>';
        //alert(form_submitted+' '+approve_state+' '+remark+' '+applicant_id);

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
                url: "ajax/queries/misapproval_renewal.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    applicant_id: applicant_id,
                    form_submitted: form_submitted,
                    approve_state: approve_state,
                    remark: remark,
                    user_id: user_id,
                    year_search:year
                },
                success: function (text) {
                    //alert(text);
                    if (text == 2) {
                        $.notify("Applicant has not made payment", {position: "top center"}, "error");
                    }
                    else {
                        $.notify("Application Reviewed", "success", {position: "top center"});
                        $.ajax({
                            type: "POST",
                            url: "approvalmis_renewal.php",
                            data: {
                                id_index:applicant_id,
                                id_year:year
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

                        $("#prov-table").DataTable().ajax.reload(null, false );

                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    KTApp.unblockPage();
                },
            });
        }
        else {
            $.notify(error, {position: "top center"});
        }
        return false;
    });

</script>

