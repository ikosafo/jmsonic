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
$exam_result = $q->fetch_assoc();

?>


<section class="page-content container-fluid">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                   Update for <?php echo $resdetails['surname'] . ' ' .$resdetails['first_name'] . ' ' .$resdetails['other_name'] ?>
                </h3>
            </div>
        </div>
        <!--begin::Form-->
        <form name="inst_form" method="post">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Provisional certificate Number <br/>
                                <small><i>(Where applicable) </i></small>
                            </label>
                            <input type="text" class="form-control"
                                   id="prov_cert_number"
                                   value="<?php echo $exam_result['provisional_number']; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label>Previous Council's Licensure Examination <br/>
                                <small><i>(Default)</i></small>
                            </label>
                            <input type="text" class="form-control"
                                   id="previous_exam" disabled
                                   value="<?php echo $exam_result['previous_exam'] ?>">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Number of Attempts <br/>
                                <small><i>(Default) </i></small>
                            </label>
                            <input type="text" id="num_attempts"
                                   class="form-control" disabled
                                   value="<?php echo $exam_result['exam_attempts'] ?>"/>
                        </div>

                        <div class="form-group">
                            <label>Internship Facility <br/>
                                <small><i>(Required) </i></small>
                            </label>
                            <input type="text" class="form-control"
                                   id="facility"
                                   value="<?php echo $exam_result['facility']; ?>">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Period of Internship <br/>
                                <small><i>(Where applicable) </i></small>
                            </label>
                            <input type="text" class="form-control"
                                   id="internship_period"
                                   value="<?php echo $exam_result['internship_period']; ?>">
                        </div>


                        <div class="form-group">
                            <label>Examination Center <br/>
                                <small><i>(Required) </i></small>
                            </label>
                            <select id="exam_center" style="width: 100%">
                                <option value="">Select Examination Center</option>
                                <option <?php if (@$exam_result['exam_center'] == "Accra") echo "selected" ?>>Accra</option>
                                <option <?php if (@$exam_result['exam_center'] == "Kumasi") echo "selected" ?>>Kumasi</option>
                                <option <?php if (@$exam_result['exam_center'] == "Tamale") echo "selected" ?>>Tamale</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="exampleInputEmail1">Date/Period Registered</label>
                        <input type="text" id="date_registered"
                               class="form-control date-picker-input"
                               placeholder="Select Date" value="<?php echo $exam_result['period_registered'] ?>">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Payment</label>
                            <input type="text" class="form-control"
                                   id="payment" disabled
                                   value="<?php $payment = $exam_result['payment'];
                                                 if ($payment == '1') {
                                                     echo "Paid";
                                                 }
                                                   else {
                                                       echo "Not Paid";
                                                   }
                                   ?>">
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-danger"
                                id="editexam"><i class="la la-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-primary"
                                id="deleteexam"><i class="la la-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>

        </form>

        <script>
            function show() {
                document.getElementById('attempt_div').style.display = 'block';
            }

            function show_not() {
                document.getElementById('attempt_div').style.display = 'none';
            }
        </script>

        <!--end::Form-->
    </div>
</section>

<!-- SIDEBAR QUICK PANNEL WRAPPER -->

<!-- END SIDEBAR QUICK PANNEL WRAPPER -->

<!-- END CONTENT WRAPPER -->
<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->

<script>

    $('#date_registered').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom",
        templates: {
            leftArrow: '<i class="icon dripicons-chevron-left"></i>',
            rightArrow: '<i class="icon dripicons-chevron-right"></i>'
        }
    });

    $("#exam_center").select2();

    $("#editexam").click(function () {
        //alert('hi');
        var examination_id = '<?php echo $examination_id ?>';
        var internship_period = $("#internship_period").val();
        var facility = $("#facility").val();
        var exam_center = $("#exam_center").val();
        var date_registered = $("#date_registered").val();

        var error = '';
        if (facility == "") {
            error += 'Please enter facility \n';
            $("#facility").focus();
        }
        if (exam_center == "") {
            error += 'Please select exam center \n';
        }
        if (date_registered == "") {
            error += 'Please select date registered \n';
            $("#date_registered").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/editexam_details.php",
                beforeSend: function () {
                    $.blockUI({message: '<h3> Please Wait...</h3>'});
                },
                data: {
                    internship_period: internship_period,
                    facility: facility,
                    exam_center: exam_center,
                    examination_id:examination_id,
                    date_registered:date_registered
                },
                success: function (text) {
                    $.notify("Details Updated", "success", {position: "top center"});
                    $.ajax({
                        type: "POST",
                        url: "editexam_details.php",
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

                    $("#itexam-table").DataTable().ajax.reload(null, false );

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

