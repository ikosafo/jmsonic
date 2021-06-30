<?php include ('../../../config.php');
$random = rand(1,10000).date("Y");
?>
<!--begin::Form-->

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
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
            <label for="colourname">Name of Colour</label>
            <input type="text" class="form-control" id="colourname"
                   placeholder="Enter Colour Name">
            <span class="form-text text-muted">Please enter name of colour</span>
        </div>
        <div class="form-group">
            <label for="selectcolour">Select Colour</label>
            <input type="color" class="form-control" id="selectcolour"
                   placeholder="Select Colour">
            <span class="form-text text-muted">Please select colour code</span>
        </div>
        <div class="form-group">
            <label for="colournumber">Total Number colour can take</label>
            <input type="text" class="form-control" id="colournumber" onkeypress="return isNumber(event)"
                   placeholder="Enter Number">
            <span class="form-text text-muted">Specify maximum number assigned to colour</span>
        </div>
        <div class="form-group">
            <label for="colourpriority">Select Colour Priority</label>
            <select id="colourpriority" style="width: 100%">
                <option value="">Select Board</option>
                <option value="Highest">Highest</option>
                <option value="High">High</option>
                <option value="Low">Low</option>
                <option value="Lowest">Lowest</option>
            </select>
            <span class="form-text text-muted">Please select colour order on board</span>
        </div>


    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-primary mr-2" id="savecolour">Submit</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
</form>

<script>
    $("#selectboard").select2({placeholder: "Select Board"});
    $("#colourpriority").select2({placeholder: "Select Priority"});
    $("#savecolour").click(function () {
        var selectboard = $("#selectboard").val();
        var colourname = $("#colourname").val();
        var selectcolour = $("#selectcolour").val();
        var colournumber = $("#colournumber").val();
        var colourpriority = $("#colourpriority").val();
        //alert(selectcolour);

        var error = '';
        if (selectboard == "") {
            error += 'Please select board \n';
            $("#selectboard").focus();
        }
        if (colourname == "") {
            error += 'Please enter colour name \n';
            $("#colourname").focus();
        }
        if (selectcolour == "") {
            error += 'Please select colour \n';
            $("#selectcolour").focus();
        }
        if (colournumber == "") {
            error += 'Please enter colour number \n';
            $("#colournumber").focus();
        }
        if (colournumber != "" && (8 % colournumber) != 0) {
            error += 'Number should be a factor of 8 \n';
            $("#colournumber").focus();
        }
        if (colourpriority == "") {
            error += 'Please select priority \n';
            $("#colourpriority").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_colour.php",
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
                    colourname: colourname,
                    selectcolour: selectcolour,
                    colournumber: colournumber,
                    colourpriority: colourpriority
                },
                success: function (text) {
                    //alert(text)
                    if (text == 1) {
                        $.ajax({
                            url: "ajax/forms/addcolour_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#colourform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },

                        });
                        $.ajax({
                            url: "ajax/tables/colour_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#colourtable_div').html(text);
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