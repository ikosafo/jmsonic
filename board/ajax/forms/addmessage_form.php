<?php include ('../../../config.php');

?>
<!--begin::Form-->

<form autocomplete="off">
    <div class="card-body">
        <div id="errorloc"></div>
        <div class="form-group">
            <label for="anntitle">Announcement Title  <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="anntitle"
                   placeholder="Enter Title">
            <span class="form-text text-muted">Please enter title</span>
        </div>
        <div class="form-group">
            <label for="announcement">Announcement <span class="text-danger">*</span></label>
            <textarea class="form-control" rows="5" id="announcement"
                   placeholder="Enter Announcement"></textarea>
            <span class="form-text text-muted">Enter announcement here</span>
        </div>


    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-primary mr-2" id="saveannouncement">Submit</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
</form>


<script>

    $("#saveannouncement").click(function () {
        //alert('hi');
        var anntitle = $("#anntitle").val();
        var announcement = $("#announcement").val();

        var error = '';
        if (anntitle == "") {
            error += 'Please enter title\n';
            $("#anntitle").focus();
        }
        if (announcement == "") {
            error += 'Please enter announcement\n';
            $("#announcement").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_announcement.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    anntitle: anntitle,
                    announcement: announcement
                },
                success: function (text) {
                        $.ajax({
                            url: "ajax/forms/addmessage_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#messageform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },
                        });
                        $.ajax({
                            url: "ajax/tables/announcement_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#messagetable_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },
                        });
                   
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