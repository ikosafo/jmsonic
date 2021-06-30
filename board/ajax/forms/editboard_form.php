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


<form autocomplete="off">
    <div class="card-body">
        <div id="errorloc"></div>
        <div class="form-group">
            <label for="boardname">Board Name  <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="boardname" id="boardname" value="<?php echo $resdetails['boardname'] ?>"
                   placeholder="Enter Board Name">
            <span class="form-text text-muted">Please enter board name</span>
        </div>
        <div class="form-group">
            <label for="boardnumber">Total Number board can take</label>
            <input type="text" class="form-control" id="boardnumber" onkeypress="return isNumber(event)"
                   placeholder="Enter Number" value="<?php echo $resdetails['boardnumber'] ?>">
            <span class="form-text text-muted">Specify maximum number board can take</span>
        </div>


    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-primary mr-2" id="editboard">Edit</button>
        <button type="reset" class="btn btn-secondary" id="cancelbtn">Cancel</button>
    </div>
</form>



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