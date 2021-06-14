<?php
include('../config.php');

$examination_id = $_POST['id_index'];
//@$examination_id = $_POST['examination_id'];
//$app_type = $_POST['app_type'];
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];
$registrationtype = 'Examination';

$getdetails = $mysqli->query("select *,p.`applicant_id` from examination_reg e
JOIN provisional p ON e.applicant_id = p.applicant_id
WHERE e.examination_id = '$examination_id'");
$resdetails = $getdetails->fetch_assoc();
$applicant_id = $resdetails['applicant_id'];
$professionid = $resdetails['professionid'];
$exam_index_number = $resdetails['exam_index_number'];

$q = $mysqli->query("select * from examination_reg where examination_id = '$examination_id'");
$result = $q->fetch_assoc();

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


                    <?php
                    $internship_period = $result['internship_period'];
                    $facility = $result['facility'];
                    $previous_exam = $result['previous_exam'];
                    $exam_attempts = $result['exam_attempts'];
                    $exam_center = $result['exam_center'];
                    echo '<span class="kt-widget31__info">Internship Period: </span>
<span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$internship_period.'</span><br/>
<span class="kt-widget31__info">Facility: </span>
<span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$facility.'</span><br/>
<span class="kt-widget31__info">Previous Exam: </span>
<span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$previous_exam.'</span><br/>
<span class="kt-widget31__info">Exam Attempts: </span>
<span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$exam_attempts.'</span><br/>
<span class="kt-widget31__info">Exam Center: </span>
<span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$exam_center.'</span><br/>';

                    ?>
                    <hr/>


                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Approval for <?php echo $resdetails['surname'] . ' ' .$resdetails['first_name'] . ' ' .$resdetails['other_name'] ?>
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
                                                    <input type="radio" name="form_submitted" value="Yes" <?php if (@$resdetails['exam_form_submitted'] == "Yes") echo "checked" ?>> Yes
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio">
                                                    <input type="radio" name="form_submitted" value="No" <?php if (@$resdetails['exam_form_submitted'] == "No") echo "checked" ?>> No
                                                    <span></span>
                                                </label>
                                            </div>
                                            <span class="form-text text-muted">Has the applicant submitted the form to the office?</span>
                                        </div>


                                        <div class="form-group">
                                            <label>Approve Application</label>
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio">
                                                    <input type="radio" name="approve_state" value="Approved" <?php if (@$resdetails['exam_usercheck_status'] == "Approved") echo "checked" ?>> Approve
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio">
                                                    <input type="radio" name="approve_state" value="Rejected" <?php if (@$resdetails['exam_usercheck_status'] == "Rejected") echo "checked" ?>> Reject
                                                    <span></span>
                                                </label>
                                            </div>
                                            <span class="form-text text-muted">Approvals can be reverted</span>
                                        </div>

                                        <div class="form-group form-group-last">
                                            <label for="exampleTextarea">Remark</label>
                                            <textarea class="form-control" id="remark" rows="3"
                                                      placeholder="Enter Remark or Comment"><?php echo $resdetails['exam_usercheck_comment'] ?></textarea>
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
                                                    <?php if ($resdetails['payment'] == "0") { ?>
                                                        <button class="btn btn-sm btn-danger btn-floating">Not Paid</button>
                                                    <?php } else if ($resdetails['payment'] == "1") { ?>
                                                        <button class="btn btn-sm btn-success btn-floating">Paid</button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Document Received at office</td>
                                                <td>
                                                    <?php echo $resdetails['exam_form_submitted'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Approved</td>
                                                <td>
                                                    <?php echo $resdetails['exam_usercheck_status'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Approved Remark</td>
                                                <td>
                                                    <?php echo $resdetails['exam_usercheck_comment'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Approved By</td>
                                                <td><?php $u_id = $resdetails['exam_usercheck_user'] ?>
                                                    <?php $q = $mysqli->query("select * from mis_users where user_id = '$u_id'");
                                                    $r = $q->fetch_assoc();
                                                    echo $r['full_name'];
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Final Approval</td>
                                                <td>
                                                    <?php echo $resdetails['exam_admincheck_status'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Final Approval Remark</td>
                                                <td>
                                                    <?php echo $resdetails['exam_admincheck_comment'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Final Approved By</td>
                                                <td><?php $u_id = $resdetails['exam_admincheck_user'] ?>
                                                    <?php $q = $mysqli->query("select * from mis_users where user_id = '$u_id'");
                                                    $r = $q->fetch_assoc();
                                                    echo $r['full_name'];
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Index Number Generated</td>
                                                <td><?php echo $u_id = $resdetails['exam_index_number'] ?></td>
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
                                <div class="invoice-header">
                                    <div class="row">
                                        <div class="col-md-2" align="center">
                                            <img src="newassets/img/coa.png"
                                                 style="border: 0 !important; width: 60%"/>
                                        </div>
                                        <div class="col-md-8" align="center">
                                            <h2 style="font-weight: bold;">ALLIED HEALTH PROFESSIONS COUNCIL</h2>
                                            <h6>MINISTRY OF HEALTH</h6>
                                            <hr/>
                                           LICENSURE EXAMINATION REGISTRATION APPLICATION FORM
                                        </div>
                                        <div class="col-md-2" align="center">
                                            <img src="newassets/img/ahpc_logo.png"
                                                 style="border: 0 !important; width: 60%""/>
                                        </div>
                                    </div>
                                    <div class="invoice-summary">
                                        <div class="row mt-3">
                                            <div class="col-md-12" style="margin: 0 auto;text-align: center">
                                                Please attach the following document to your applications. Failure
                                                to do so may result in the rejection of your forms
                                            </div>
                                        </div>
                                        <hr/>

                                        <h5>Personal Profile</h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php
                                                $img = $mysqli->query("select * from applicant_images
                       where applicant_id = '$applicant_id'");
                                                $fetch_img = $img->fetch_assoc()
                                                ?>
                                                <div class="profile-image"><img
                                                        src="<?php echo $reg_root . '/' . $fetch_img['image_location'] ?>"
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
                                                            <h6>(<?php
                                                                $professionid = $resdetails['professionid'];
                                                                $getp = $mysqli->query("select * from professions WHERE
                                                                       professionid = '$professionid'");
                                                                $getname = $getp->fetch_assoc();
                                                                echo $professionname = $getname['professionname'];
                                                                if ($professionname == "") {
                                                                    echo $profession;
                                                                }
                                                                ?>)</h6>
                                                        </span>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-4">
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
                                                <small class="text-muted">Nationality:</small>
                                                <p><?php echo $resdetails['nationality'] ?></p>
                                                <hr>
                                            </div>
                                            <div class="col-md-4">
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
                                        <hr/>
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
                                        <hr/>
                                        <h5>Institution(s) Attended</h5>
                                        <?php
                                        $in_qu = $mysqli->query("select * from applicant_institutions where
                                                applicant_id = '$applicant_id' ORDER BY institutionid DESC");
                                        $inst_count = mysqli_num_rows($in_qu);
                                        if ($inst_count == 0) {
                                            echo "";
                                        } else {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="body">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table center-aligned-table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Institution Name</th>
                                                                    <th>Year of Admission</th>
                                                                    <th>Year of Completion</th>
                                                                    <th>Program of Study</th>
                                                                    <th>Certificate</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                while ($fetch_qu = $in_qu->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $fetch_qu['institution_name'] ?></td>
                                                                        <td><?php echo $fetch_qu['date_started'] ?></td>
                                                                        <td><?php echo $fetch_qu['date_ended'] ?></td>
                                                                        <td><?php echo $fetch_qu['study_program'] ?></td>
                                                                        <td>
                                                                            <div>
                                                                                <?php $file_id = $fetch_qu['qualification_id'];
                                                                                $doc = $mysqli->query("select * from applicant_certificates
                                           where qualification_id = '$file_id'");

                                                                                while ($fetch_doc = $doc->fetch_assoc()) { ?>
                                                                                    <img src="<?php echo $reg_root . '/' . $fetch_doc['image_location'] ?>" style="width: 100%"/>
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
        var examination_id = '<?php echo $examination_id ?>';
        var user_id = '<?php echo $user_id ?>';
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
                url: "ajax/queries/misapproval_examination.php",
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
                    examination_id:examination_id
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
                            url: "approvalmis_examination.php",
                            data: {
                                id_index:examination_id
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

