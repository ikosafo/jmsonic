<?php
include('../config.php');

$i_id = $_POST['id_index'];
$q = $mysqli->query("select * from examination_reg where examination_id = '$i_id'");
$res = $q->fetch_assoc();
$applicant_id = $res['applicant_id'];

$getdetails = $mysqli->query("select * from provisional where applicant_id = '$applicant_id'");
$result = $getdetails->fetch_assoc();


?>


<form class="" autocomplete="off">

    <div class="kt-portlet__body">

        <div class="row">
            <div class="col-md-6">
                <?php
                $fullname = $result['first_name'].' '.$result['surname'].' '.$result['other_name'];
                $email_address = $result['email_address'];
                $telephone = $result['telephone'];
                $res_region = $result['res_region'];
                echo '<span class="kt-widget31__info">Full Name: </span>
<span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$fullname.'</span><br/>
<span class="kt-widget31__info">Email Address: </span>
<span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$email_address.'</span><br/>'
                ?>
            </div>
            <div class="col-md-6">
                <?php echo
                    '<span class="kt-widget31__info">Telephone: </span>
<span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$telephone.'</span><br/>
<span class="kt-widget31__info">Region: </span>
<span class="kt-widget31__text" style="font-weight:300;font-size:0.8rem">'.$res_region.'</span><br/>';

                ?>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Index Number</label>
                    <input type="text" id="app_index" class="form-control"
                           value="<?php echo $result['exam_index_number']; ?>"
                           placeholder="Enter Index Number" autocomplete="off">
                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="button" class="btn btn-primary" id="updateindex">Update</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</form>
<!--end::Form-->


<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->

<script>

    $("#updateindex").click(function () {

        var examination_id = '<?php echo $i_id ?>';
        var applicant_id = '<?php echo $applicant_id ?>';
        var app_index = $("#app_index").val();
        //alert(app_index+ ' '+applicant_id);

        var error = '';
        if (app_index == "") {
            error += 'Please enter index number \n';
            $("#app_index").focus();
        }

        if (app_index.length != 8) {
            error += 'Please enter correct format \n';
            $("#app_index").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/index_update.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    examination_id: examination_id,
                    app_index: app_index,
                    applicant_id:applicant_id
                },
                success: function (text) {
                    //alert(text);
                    if (text == 2) {
                        $.notify("You entered the same index number", {position: "top center"}, "error");
                    }
                    else if (text == 3) {
                        $.notify("Index Number already exists", {position: "top center"}, "error");
                    }
                    else {
                        $.notify("Index Number Updated", "success", {position: "top center"});
                        $("#general-table").DataTable().ajax.reload(null, false );
                        $('html, body').animate({
                            scrollTop: $("#examination_table_div").offset().top
                        }, 2000);
                        //location.reload();

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

