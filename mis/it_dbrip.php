<?php require('includes/header.php') ?>

<!-- begin:: Subheader -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader"></div>
<!-- end:: Subheader -->


<!-- begin:: Content -->
<div class="kt-container  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->

    <div class="row">
        <div class="col-xl-12">
            <!--begin:: Widgets/Applications/User/Profile3-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__body">
                    <div class="kt-portlet__body">



                        <div class="kt-portlet__head kt-portlet__head--lg mb-4">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                   Summary
                                    <small>Applicants Info</small>
                                </h3>
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="appinfo_table_div"></div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile3-->
        </div>
    </div>

    <!--End::Dashboard 3-->    </div>
<!-- end:: Content -->

<?php require('includes/footer.php') ?>


<script>
    $.ajax({
        url: "ajax/tables/appinfo_table.php",
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        success: function (text) {
            $('#appinfo_table_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            KTApp.unblockPage();
        },
    });


    $(document).off('click', '.deleteapp_btn').on('click', '.deleteapp_btn', function () {
        var i_index = $(this).attr('i_index');
        //alert(i_index);

        $.confirm({
            title: 'Delete Applicant Details!',
            content: 'Are you sure to continue?<br/><small>You will not be able to recover details</small>',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function () {
                        $.alert('Details are safe!');
                    }
                },
                yes: {
                    text: 'Yes, Continue!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/deleteapplicant.php",
                            data: {
                                i_index: i_index
                            },
                            dataType: "html",
                            success: function (text) {
                                //alert(text);
                                if (text == 1) {
                                    $.ajax({
                                        url: "ajax/tables/appinfo_table.php",
                                        beforeSend: function () {
                                            KTApp.blockPage({
                                                overlayColor: "#000000",
                                                type: "v2",
                                                state: "success",
                                                message: "Please wait..."
                                            })
                                        },
                                        success: function (text) {
                                            $('#appinfo_table_div').html(text);
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
                                    alert('Applicant has already made payment');
                                }
                            },
                            complete: function () {
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });

</script>

