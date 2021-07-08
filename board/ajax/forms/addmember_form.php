<?php include ('../../../config.php');
$random = rand(1,10000).date("Y");
?>
<!--begin::Form-->

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;
        return true;
    }
</script>

<form autocomplete="off">
    <div class="card-body">
        <div id="errorloc"></div>
        <div class="form-group">
            <label for="selectboard">Select Board</label>
            <select id="selectboard" style="width: 100%">
                <option value="">Select Board</option>
                <?php
                $selectboard = $mysqli->query("select * from boards where status = 'Active' ORDER BY boardname");
                while ($resboard = $selectboard->fetch_assoc()) { ?>
                    <option value="<?php echo $resboard['boardid'] ?>"><?php echo $resboard['boardname'] ?></option>
                <?php }
                ?>

            </select>
            <span class="form-text text-muted">Please select board</span>
        </div>
        <div class="form-group">
            <label for="selectcolour">Select Colour</label>
            <select id="selectcolour" style="width: 100%">
                <option value="">Select Colour</option>
                <option></option>
            </select>
            <span class="form-text text-muted">Please select colour</span>
        </div>
        <div class="form-group">
            <label for="selectmember">Select Member/User</label>
            <select id="selectmember" style="width: 100%" multiple>
                <option value="">Select Member</option>
                <option></option>
            </select>
            <span class="form-text text-muted">Please select member</span>
        </div>
        

    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-primary mr-2" id="savemember">Submit</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
</form>



<script>
        $("#selectboard").change(function () {
            var getboard = $(this).val();
            if (getboard != "") {
                $.ajax({
                    url: "ajax/forms/getcolour.php",
                    data: {getboard: getboard},
                    type: 'POST',
                    beforeSend: function () {
                        $.blockUI({message: '<h3> Please Wait...</h3>'});
                    },
                    success: function (response) {
                        var resp = $.trim(response);
                        $("#selectcolour").html(resp);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                });
            } else {
                $("#selectcolour").html("<option value=''></option>");
            }
        });


        $("#selectboard").change(function () {
            var getboard = $(this).val();
            if (getboard != "") {
                $.ajax({
                    url: "ajax/forms/getaddmember.php",
                    data: {getboard: getboard},
                    type: 'POST',
                    beforeSend: function () {
                        $.blockUI({message: '<h3> Please Wait...</h3>'});
                    },
                    success: function (response) {
                        var resp = $.trim(response);
                        $("#selectmember").html(resp);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                });
            } else {
                $("#selectmember").html("<option value=''></option>");
            }
        });
        
            
    $("#selectboard").select2({placeholder: "Select Board"});
    $("#selectcolour").select2({placeholder: "Select Colour"});
    $("#selectmember").select2({placeholder: "Select Member"});

    $("#savemember").click(function () {
        var selectboard = $("#selectboard").val();
        var selectmember = $("#selectmember").val();
        var selectcolour = $("#selectcolour").val();
        var countmember = $("#selectmember :selected").length;
        //alert(count);

        var error = '';
        if (selectboard == "") {
            error += 'Please select board \n';
            $("#selectboard").focus();
        }
        if (selectboard != "" && selectmember == "") {
            error += 'Please select member \n';
            $("#selectmember").focus();
        }
        if (selectboard != "" && selectcolour == "") {
            error += 'Please select colour \n';
            $("#selectcolour").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_member.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    selectboard: selectboard,
                    selectmember: selectmember,
                    selectcolour: selectcolour,
                    countmember:countmember
                },
                success: function (text) {
                    //alert(text)
                    if (text == 1 || text == 3) {
                        $.ajax({
                            url: "ajax/forms/addmember_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#memberform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },

                        });
                        $.ajax({
                            url: "ajax/tables/member_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#membertable_div').html(text);
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
                        $("#errorloc").notify("Number of users exceeded","error");
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