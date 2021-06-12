<?php include ('../../../config.php');
$random = rand(1,10000).date("Y");
$boardid = $_POST['theindex'];

$getdetails = $mysqli->query("select * from boards where boardid = '$boardid'");
$resdetails = $getdetails->fetch_assoc();
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
        <h5>Edit Board Details</h5> <hr/>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="boardname">Board Name</label>
                <input type="text" class="form-control" id="boardname" value="<?php echo $resdetails['boardname'] ?>"
                       placeholder="Enter Board Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="boardnumber">Total Number board can take</label>
                <input type="text" class="form-control" id="boardnumber"
                       onkeypress="return isNumber(event)" value="<?php echo $resdetails['boardnumber'] ?>"
                       placeholder="Enter Number">
            </div>
        </div>

    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="editboard">Edit</button>
            <button type="reset" class="btn btn-secondary" id="cancelbtn">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->



<script>
    $("#editboard").click(function () {
        var boardname = $("#boardname").val();
        var boardnumber = $("#boardnumber").val();
        var boardid = '<?php echo $boardid ?>';

        var error = '';
        if (boardname == "") {
            error += 'Please enter board name\n';
            $("#boardname").focus();
        }
        if (boardnumber == "") {
            error += 'Please enter board number\n';
            $("#boardnumber").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/editform_board.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    boardname: boardname,
                    boardnumber: boardnumber,
                    boardid:boardid
                },
                success: function (text) {
                    if (text == 1) {
                        $.ajax({
                            url: "ajax/forms/addboard_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#boardform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },

                        });
                        $.ajax({
                            url: "ajax/tables/board_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#boardtable_div').html(text);
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
                        $("#errorloc").notify("Board name already exists","error");
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

    $("#cancelbtn").click(function() {
        $.ajax({
            url: "ajax/forms/addboard_form.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            success: function (text) {
                $('#boardform_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                KTApp.unblockPage();
            },

        });
    })
</script>