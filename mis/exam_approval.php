<?php

include('../config.php');


if (isset ($_GET['appid'])) {
    $app_id = $_GET['appid'];
}
$applicant_id = unlock($app_id);

$user_id = $_GET['userid'];


$app = $mysqli->query("select * from provisional where provisional.applicant_id = '$applicant_id' ");
$rest = $app->fetch_assoc();


$ap = $mysqli->query("SELECT * from examination_reg where applicant_id='$applicant_id' and payment= 1  order by examination_id desc limit 1");
$result = $ap->fetch_assoc();

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
</head>
<body>
<!-- START APP WRAPPER -->


<section class="page-content container-fluid">
    <div class="row">
        <div class="col">
                    <?php 
                        if(isset($_GET['done'])):
                    ?>
                    <div class="alert alert-success">
                    <strong>Success!</strong> Approval Successfully Made.
                    </div>
                    <?php 
                    endif;
                    ?>
            <h5 class="card-header">Examination Registrations approval for
                <strong>
                    <?php echo $rest['surname'] . ' ' . $rest['first_name'] . ' ' . $rest['other_name'] ?><strong>

                    </strong>
            </h5>
            <div class="card-body" id="print_this">
                <form action="/ajax/queries/save_approval_exam.php" method='post'>
                <div class="row">
                        <div class="col-md-6">

                                <div class="form-group" id="form_submit">
                                    <label for="exampleInputPassword1">Form Submitted to office </label>
                                    <br/>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" required id="customRadioInline1"
                                               name="form_submitted" value="Yes" class="custom-control-input"
                                            <?php if (@$result['exam_form_submitted'] == "Yes") echo "checked" ?>>
                                        <label class="custom-control-label" for="customRadioInline1">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" required id="customRadioInline2"
                                               name="form_submitted" value="No" class="custom-control-input"
                                            <?php if (@$result['exam_form_submitted'] == "No") echo "checked" ?>>
                                        <label class="custom-control-label" for="customRadioInline2">No</label>
                                    </div>
                                </div>

                                <div class="form-group" id="form_approved">
                                    <label for="customRadioInline3">Application Approval </label>
                                    <br/>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline3"
                                               name="approve_state" required value="Approved" class="custom-control-input"
                                            <?php if (@$result['exam_usercheck_status'] == "Approved") echo "checked" ?>>
                                        <label class="custom-control-label" for="customRadioInline3">Approved</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline4"
                                               name="approve_state" required value="Rejected" class="custom-control-input"
                                            <?php if (@$result['exam_usercheck_status'] == "Rejected") echo "checked" ?>>
                                        <label class="custom-control-label" for="customRadioInline4">Rejected</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword1">Remark</label>
                                    <textarea type="text" class="form-control" required name='remark' id="remark"
                                              placeholder="Enter Remark"
                                              rows="6"><?php echo $result['exam_usercheck_comment'] ?></textarea>
                                </div>
                                <input type="hidden" name="applicantid" value="<?= $applicant_id?>">
                                <input type="hidden" name="userid" value="<?=$user_id?>">
                                <div class="card-footer bg-light">
                                    <button type="submit" class="btn btn-primary"
                                            id="sapprove">Submit
                                    </button>
                                </div>
                        </div>
                     
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td>Payment Status</td>
                                <td>
                                    <b> <?php if ($result['payment'] != "1") { ?>
                                            <button class="btn btn-sm btn-accent btn-floating">Not Paid</button>
                                        <?php } else if ($result['payment'] == "1") { ?>
                                            <button class="btn btn-sm btn-success btn-floating">Paid</button>
                                        <?php } ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Document Received at office</td>
                                <td>
                                    <b><?php echo $result['exam_form_submitted'] ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Approved</td>
                                <td>
                                    <b><?php echo $result['exam_usercheck_status'] ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Approved Remark</td>
                                <td>
                                    <b><?php echo $result['exam_usercheck_comment'] ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Approved By</td>
                                <td><b><?php $u_id = $result['exam_usercheck_user'] ?>
                                        <?php $q = $mysqli->query("select * from users where id = '$u_id'");
                                        $r = $q->fetch_assoc();
                                        echo $r['name'];
                                        ?></b></td>
                            </tr>
                            <tr>
                                <td>Final Approval</td>
                                <td>
                                    <b><?php echo $result['exam_admincheck_status'] ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Final Approval Remark</td>
                                <td>
                                    <b><?php echo $result['exam_admincheck_comment'] ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Final Approved By</td>
                                <td><b><?php $u_id = $result['exam_admincheck_user'] ?>
                                        <?php $q = $mysqli->query("select * from mis_users where user_id = '$u_id'");
                                        $r = $q->fetch_assoc();
                                        echo $r['full_name'];
                                        ?></b></td>
                            </tr>
                            <!-- <tr>
                                <td>Pin Generated</td>
                                <td><b><?php echo $u_id = $result['provisional_pin'] ?></b></td>
                            </tr> -->

                        </table>
                    </div>


                </div>
                </form>
            </div>


        </div>
    </div>


</section>

<!-- SIDEBAR QUICK PANNEL WRAPPER -->

<!-- END SIDEBAR QUICK PANNEL WRAPPER -->

<!-- END CONTENT WRAPPER -->
<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->
<?php require('includes/scripts.php') ?>

</body>
</html>
