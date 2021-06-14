<?php
include('../config.php');

$account_id = $_POST['id_index'];
$getdetails = $mysqli->query("select * from accounts where accountid = '$account_id'");
$resdetails = $getdetails->fetch_assoc();
$applicant_id = $resdetails['applicantid'];
$professionid = $resdetails['professionid'];
$accounttype = $resdetails['accounttype'];


?>


<section class="page-content container-fluid">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                   PAYMENT DETAILS
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="invoice-wrapper" id="print_this">
                <div class="invoice-header">
                    <div class="row">
                        <div class="col-md-2" align="center">
                            <img src="assets/img/gcb.png"
                                 style="border: 0 !important; width: 60%"/>
                        </div>
                        <div class="col-md-8" align="center">
                            <h2 style="font-weight: bold;">ALLIED HEALTH PROFESSIONS COUNCIL</h2>
                            <h6>MINISTRY OF HEALTH</h6>
                            <hr/>
                            PAYMENT FOR <span style="text-transform: uppercase"><?php echo $accounttype =  $resdetails['accounttype']; ?></span> REGISTRATION
                        </div>
                        <div class="col-md-2" align="center">
                            <img src="newassets/img/ahpc_logo.png"
                                 style="border: 0 !important; width: 60%""/>
                        </div>
                    </div>
                    <div class="invoice-summary">
                        <div class="row mt-3">
                            <div class="col-md-12" style="margin: 0 auto;text-align: center">
                                Payment Receipt
                            </div>
                        </div>
                        <hr/>

                        <div class="kt-invoice-2">
                            <div class="kt-invoice__head">
                                <div class="kt-invoice__container">
                                    <div class="kt-invoice__brand">
                                        <h1 class="kt-invoice__title">
                                            <?php echo $resdetails['fullname']; ?>
                                        </h1>

                                        <div class="kt-invoice__logo">

							<span class="kt-invoice__desc">
								<span><?php echo $resdetails['emailaddress']; ?></span> <br/>
								<span><?php echo $resdetails['telephonenumber']; ?></span> <br/>
								<span><?php
                                    $professionid = $resdetails['professionid'];
                                    $getp = $mysqli->query("select * from professions WHERE
                                                                       professionid = '$professionid'");
                                    $getname = $getp->fetch_assoc();
                                    echo $professionname = $getname['professionname'];
                                    ?>
                                </span>
							</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="kt-invoice__body">
                                <div class="kt-invoice__container">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>BANK</th>
                                                <th>ACCOUNT</th>
                                                <th>AMOUNT PAID</th>
                                                <th>AMOUNT DUE</th>
                                                <th>QUANTITY</th>
                                                <th>TOTAL AMOUNT (GHS)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>GCB</td>
                                                <td><?php echo $accounttype; ?></td>
                                                <td><?php echo $resdetails['amountpaid'] ?></td>
                                                <td><?php echo $resdetails['amountdue'] ?></td>
                                                <td>1</td>
                                                <td class="kt-font-danger kt-font-xl kt-font-boldest">
                                                    <?php echo $resdetails['amountpaid'] ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" onclick="printContent('print_this')">
                    <i class="flaticon2-printer"></i> Print Form
                </button>
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
