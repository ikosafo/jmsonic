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
                $selectboard = $mysqli->query("select * from boards where status = 'Active' 
                                               and type = 'Main' ORDER BY boardname");
                while ($resboard = $selectboard->fetch_assoc()) { ?>
                    <option value="<?php echo $resboard['boardid'] ?>"><?php echo $resboard['boardname'] ?></option>
                <?php }
                ?>

            </select>
            <span class="form-text text-muted">Please select board</span>
        </div>
        <div class="form-group">
            <label for="selectcolour">Colour to Pay</label>
            <select id="selectcolour" style="width: 100%" disabled>
                <option value="">Select Colour</option>
                <option></option>
            </select>
            <span class="form-text text-muted">Please select name of colour</span>
        </div>
        <div class="form-group">
            <label for="amounttopay">Amount to Pay</label>
            <input type="text" class="form-control" id="amounttopay"
                   placeholder="Enter Amount" onkeypress="return isNumber(event)">
            <span class="form-text text-muted">Please select amount to pay</span>
        </div>
       

    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-primary mr-2" id="savepayment">Submit</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
</form>



<script>
     $("#selectboard").change(function () {
            var getboard = $(this).val();
            if (getboard != "") {
                $.ajax({
                    url: "ajax/forms/getreceivecolour.php",
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

            
    $("#selectboard").select2({placeholder: "Select Board"});
    $("#selectcolour").select2({placeholder: "Select Colour"});

    $("#savepayment").click(function () {
        var selectboard = $("#selectboard").val();
        var selectcolour = $("#selectcolour").val();
        var amounttopay = $("#amounttopay").val();

        var error = '';
        if (selectboard == "") {
            error += 'Please select board \n';
            $("#selectboard").focus();
        }
        if (selectcolour == "") {
            error += 'Please select colour to pay \n';
            $("#selectcolour").focus();
        }
        if (amounttopay == "") {
            error += 'Please enter amount \n';
            $("#amounttopay").focus();
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_exitfee.php",
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
                    selectcolour: selectcolour,
                    amounttopay: amounttopay
                },
                success: function (text) {
                    //alert(text)
                    if (text == 1) {
                        $.ajax({
                            url: "ajax/forms/addexitfee_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#paymentform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },

                        });
                        $.ajax({
                            url: "ajax/tables/exitfee_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#paymenttable_div').html(text);
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
                        $("#errorloc").notify("Board already exist","error");
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