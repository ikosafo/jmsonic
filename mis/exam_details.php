<?php

include('../config.php');

if (isset ($_GET['appid'])) {
    $app_id = $_GET['appid'];
}

$applicant_id = unlock($app_id);

$app = $mysqli->query("select * from provisional where applicant_id = '$applicant_id'");
$result = $app->fetch_assoc();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('includes/styles.php'); ?>


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


<div class="content">
    <div class="page-header">
       <!-- <a href="permanent_registration.php">


            <button class="btn btn-warning btn-floating"
                    style="float: right;margin-right: 2%" onclick="window.open('', '_self', ''); window.close();">
                <i class="icon-arrow-left-circle"></i> Close
            </button>

        </a>-->
    </div>
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body" id="print_this">
                        <div class="invoice-wrapper">
                            <div class="invoice-header border-bottom">
                                <div class="row">

                                    <div class="col-md-2" align="center">
                                        <img src="newassets/img/coa.png"
                                             style="border: 0 !important;"/>
                                    </div>
                                    <div class="col-md-8" align="center">
                                        <h2 style="font-weight: bold;">ALLIED HEALTH PROFESSIONS COUNCIL</h2>
                                        <h6>MINISTRY OF HEALTH</h6>
                                        <hr/>
                                        EXAMINATION REGISTRATION APPLICATION FORM

                                    </div>
                                    <div class="col-md-2" align="center">
                                        <img src="newassets/img/ahpc_logo.png"
                                             style="border: 0 !important;"/>
                                    </div>

                                </div>
                                <div class="invoice-summary">
                                    <div class="row">
                                        <div class="col-md-12">
                                            Please attach the following document to your applications. <br/>Failure
                                            to do so
                                            may result in the rejection of your forms


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
                                                <span>
                                                            <h6>(<?php

                                                                $professionid = $result['professionid'];

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
                                                        <table
                                                                class="table center-aligned-table">
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
                                                                                        src="<?php echo $reg_root.'/'. $fetch_doc['location'] ?>"
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

                                    if ($inst_count == 0){

                                        echo "";
                                    }
                                    else {


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
                                                            while($fetch_qu = $in_qu->fetch_assoc())
                                                            {
                                                                ?>

                                                                <tr>

                                                                    <td><?php echo $fetch_qu['institution_name'] ?></td>
                                                                    <td><?php echo $fetch_qu['date_started'] ?></td>
                                                                    <td><?php echo $fetch_qu['date_ended'] ?></td>
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
                                        </div>


                                    <?php  } ?>

                                    <hr/>

                                    <h5>Appointment Letters / NSS Certificates</h5>
                                    <?php
                                    $nssc = $mysqli->query("select * from applicant_natcert where
                                    applicant_id = '$applicant_id' ORDER BY id DESC");

                                    ?>
                                    <div class="row">
                                         <?php
                                            while ($nss = $nssc->fetch_assoc()) { ?>

                                                <div class="col-md-3">
                                                <img
                                                        src="<?php echo $reg_root.'/'. $nss['image_location'] ?>"
                                                        style="width: 100%"/>                                  
                                                </div>

                                            <?php } ?>
                                               
                                        </div>

                                    <hr/>    
                                    <h5>Referees</h5>

                                    <?php



                                    $re = $mysqli->query("select * from applicant_references
                                                where applicant_id = '$applicant_id' ORDER BY id DESC");
                                    $ref_count = mysqli_num_rows($re);

                                    if ($ref_count == 0){

                                        echo "";
                                    }
                                    else {


                                        ?>

                                        <div class="row">
                                            <div class="col-md-12">


                                                <div class="body">
                                                    <div class="table-responsive">
                                                        <table
                                                                class="table center-aligned-table">
                                                            <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Email Address</th>
                                                                <th>Address</th>
                                                                <th>Phone Number</th>
                                                                <th>Approval</th>


                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php
                                                            while ($fetch_re = $re->fetch_assoc()) {
                                                                ?>

                                                                <tr>
                                                                    <td><?php echo $fetch_re['reference_name'] ?></td>
                                                                    <td><?php echo $fetch_re['email_address'] ?></td>
                                                                    <td><?php echo $fetch_re['address'] ?></td>
                                                                    <td><?php echo $fetch_re['phone_number'] ?></td>
                                                                    <td><?php $approval = $fetch_re['approval'];
                                                                               if ($approval == ""){
                                                                                   echo "PENDING";
                                                                               }
                                                                               else {
                                                                                   echo $approval;
                                                                               }
                                                                    ?></td>

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

                                    <h5>Work Experience</h5>

                                    <?php
                                    $in_qu = $mysqli->query("select * from applicant_experience where 
applicant_id = '$applicant_id' ORDER BY id DESC");
                                    $inst_count = mysqli_num_rows($in_qu);

                                    if ($inst_count == 0){

                                        echo "";
                                    }
                                    else {


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
                                                                <th>Job Title</th>
                                                                <th>Year Started</th>
                                                                <th>Year Completed</th>
                                                                <th>Roles and Responsibilities</th>

                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php
                                                            while($fetch_qu = $in_qu->fetch_assoc())
                                                            {
                                                                ?>

                                                                <tr>

                                                                    <td><?php echo $fetch_qu['institution'] ?></td>
                                                                    <td><?php echo $fetch_qu['title'] ?></td>
                                                                    <td><?php echo $fetch_qu['date_started'] ?></td>
                                                                    <td><?php echo $fetch_qu['date_completed'] ?></td>
                                                                    <td><?php echo $fetch_qu['job_roles'] ?></td>

                                                                </tr>

                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>




                                    <?php  } ?>



                                    <hr/>





                                    <div class="row">
                                        <div class="col-md-12">
                                            By signing this reference, you confirm that the information you
                                            have
                                            supplied
                                            in this reference is accurate. If however, it is detected you
                                            have
                                            made any false
                                            claims you may be committing an offence under Act 837 (2013)

                                            <hr/>
                                        </div>

                                    </div>

                                    <div class="row" style="padding-top: 2%">
                                        <div class="col-md-4">Name of Applicant</div>

                                        <div class="col-md-8">

                                            ...................................................................................................................

                                        </div>

                                    </div>

                                    <div class="row" style="padding-top: 2%">
                                        <div class="col-md-4"> Signature of Applicant</div>

                                        <div class="col-md-8">

                                            ...................................................................................................................

                                        </div>

                                    </div>

                                    <div class="row" style="padding-top: 2%">
                                        <div class="col-md-4">Date (DD/MM/YYYY)</div>

                                        <div class="col-md-8">

                                            ...................................................................................................................

                                        </div>

                                    </div>


                                    <h6 align="center" style="padding-top: 8%">OFFICE USE ONLY</h6>
                                    <hr/>


                                    <div class="row">
                                        <table width="100%">
                                            <tr>
                                                <td width="15%">Checklist certified by</td>
                                                <td width="25%">....................................</td>
                                                <td width="10%">Signature</td>
                                                <td width="25%">....................................</td>
                                                <td width="10%">Date</td>
                                                <td width="20%">...................................</td>
                                            </tr>

                                        </table>


                                        <table width="100%">
                                            <tr>
                                                <td width="15%">Approved by</td>
                                                <td width="25%">....................................</td>
                                                <td width="10%">Signature</td>
                                                <td width="25%">....................................</td>
                                                <td width="10%">Date</td>
                                                <td width="20%">....................................</td>
                                            </tr>

                                        </table>

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
    </section>
</div>

<!-- END CONTENT WRAPPER -->
<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->
<?php require('includes/scripts.php') ?>
</body>
</html>
