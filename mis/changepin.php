<?php
include('../config.php');

$i_id = $_POST['id_index'];
$q = $mysqli->query("select * from provisional where applicant_id = '$i_id'");
$result = $q->fetch_assoc();
$pin = $result['provisional_pin'];

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
                    <label for="exampleInputEmail1">PIN</label>
                    <input type="text" id="app_pin" class="form-control"
                           value="<?php echo $pin ?>"
                           placeholder="Enter Pin" autocomplete="off">
                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="button" class="btn btn-primary" id="updatepin">Update</button>
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

    $("#updatepin").click(function () {
        var applicant_id = '<?php echo $i_id ?>';
        var app_pin = $("#app_pin").val();
        //alert(app_pin+ ' '+applicant_id);

        var error = '';
        if (app_pin == "") {
            error += 'Please enter pin \n';
            $("#app_pin").focus();
        }
        if (app_pin.length != 8) {
            error += 'Please enter correct format \n';
            $("#app_pin").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/pin_update.php",
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
                    app_pin: app_pin
                },
                success: function (text) {
                    //alert(text);
                    if (text == 2) {
                        $.notify("You entered the same pin", {position: "top center"}, "error");
                    }
                    else if (text == 3) {
                        $.notify("Pin already exists", {position: "top center"}, "error");
                    }
                    else {
                        $.notify("Pin Updated", "success", {position: "top center"});
                        $("#general-table").DataTable().ajax.reload(null, false );
                        $('html, body').animate({
                            scrollTop: $("#changepintable_div").offset().top
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

