<?php include ('../../../config.php');
$userid = $_SESSION['userid'];
$username = getusername($userid);
$random = rand(1,10000).date("Y");
?>
<!--begin::Form-->

<form autocomplete="off">
    <div class="card-body">
        <div id="errorloc"></div>
        <div class="form-group">
            <label for="selectuser">Select User</label>
            <select id="selectuser" style="width: 100%">
                <option value="">Select User</option>
                <?php
                $selectuser = $mysqli->query("SELECT * FROM users WHERE userstatus = '5' 
                                               AND introusername = '$username' ORDER BY fullname");
                while ($resuser = $selectuser->fetch_assoc()) { ?>
                    <option value="<?php echo $resuser['userid'] ?>"><?php echo $resuser['fullname'].' - '.$resuser['username'] ?></option>
                <?php }
                ?>
            </select>
            <span class="form-text text-muted">Please select user to add to board</span>
        </div>

    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-primary mr-2" id="saveadmin">Make Administrator</button>
    </div>
</form>

<script>
    $("#selectuser").select2({placeholder: "Select User"});

    $("#saveadmin").click(function () {
        var selectuser = $("#selectuser").val();

        var error = '';
        if (selectuser == "") {
            error += 'Please select user \n';
            $("#selectuser").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_selectadmin.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    selectuser: selectuser
                },
                success: function (text) {
                    //alert(text)
                    if (text == 1) {
                        $.ajax({
                            url: "ajax/forms/addmemberadmin_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#memberadminform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },

                        });
                        $.ajax({
                        url: "ajax/tables/memberadmin_table.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#memberadmintable_div').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function () {
                            KTApp.unblockPage();
                        },

                    });
                    }
                    else  if (text == 2){
                        $("#errorloc").notify("Colour name already exists","error");
                    }
                    else {
                        $("#errorloc").notify("Number has exceeded required number for board","error");
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
            $("#errorloc").notify(error);
        }
        return false;
    });
</script>