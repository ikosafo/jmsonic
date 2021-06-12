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


<form class="" autocomplete="off">
    <div class="kt-portlet__body">
        <div id="errorloc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="colourname">Select Board</label>
                <input type="text" class="form-control" id="colourname"
                       placeholder="Enter Colour Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="colourname">Colour Name</label>
                <input type="text" class="form-control" id="colourname"
                       placeholder="Enter Colour Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="colourname">Select Colour</label>
                <input type="color" class="form-control" id="colourname"
                       placeholder="Select Colour">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="colournumber">Total Number colour can take</label>
                <input type="text" class="form-control" id="colournumber" onkeypress="return isNumber(event)"
                       placeholder="Enter Number">
            </div>
        </div>

    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="savecolour">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->



<script>

    $("#savecolour").click(function () {
        var colourname = $("#colourname").val();
        var colournumber = $("#colournumber").val();

        var error = '';
        if (colourname == "") {
            error += 'Please enter colour name\n';
            $("#colourname").focus();
        }
        if (colournumber == "") {
            error += 'Please enter colour number\n';
            $("#colournumber").focus();
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
                    colourname: colourname,
                    colournumber: colournumber
                },
                success: function (text) {
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
                    else {
                        $("#errorloc").notify("Colour name already exists","error");
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