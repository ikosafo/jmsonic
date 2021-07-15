<?php require('includes/header.php');

?>


<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Subheader-->
                <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
                    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center flex-wrap mr-1">
                            <!--begin::Heading-->
                            <div class="d-flex flex-column">
                                <!--begin::Title-->
                                <h2 class="text-white font-weight-bold my-2 mr-5">Search Member</h2>
                                <!--end::Title-->

                            </div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Info-->

                    </div>
                </div>
                <!--end::Subheader-->
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">

                                <!--begin::Card-->
                                <div class="card card-custom gutter-b">
                                    <div class="card-header flex-wrap py-3">
                                        <div class="card-title">
                                            <h3 class="card-label">Member Details
                                                <span class="d-block text-muted pt-2 font-size-sm">View &amp; and Search Applications</span></h3>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-form-label text-right col-lg-3 col-sm-12">Select Status</label>
                                            <div class=" col-lg-4 col-md-9 col-sm-12">
                                                <select class="form-control kt-selectpicker" id="selectstatus" name="param">
                                                    <option value="All">All</option>
                                                    <option value="1">Pending</option>
                                                    <option value="2">Removed</option>
                                                    <option value="3">Suspended</option>
                                                    <option value="4">Active</option>
                                                    <option value="5">Approved</option>
                                                </select>

                                            </div>

                                        </div>
                                        <div id="membertable_div"></div>
                                    </div>
                                </div>
                                <!--end::Card-->


                            </div>
                        </div>
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->

<?php require('includes/footer.php') ?>

<script>

    $("#selectstatus").selectpicker();

    $.ajax({
        type: "POST",
        url: "ajax/tables/memberdetails_table.php",
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        data: {selectstatus: 'All'},
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

    $("#selectstatus").change(function () {
        var selectstatus = $("#selectstatus").val();
        //alert(selectstatus);
        $.ajax({
            type: "POST",
            url: "ajax/tables/memberdetails_table.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            data: {selectstatus: selectstatus},
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
    });

 
</script>
