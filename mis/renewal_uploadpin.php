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
                        <iframe  id='ifrmapprove' width="100%" height="630px" src="https://oldadmin.ahpcgh.org/renewalpin"></iframe>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="pin_table_div"></div>
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
        url: "ajax/tables/pinupload_table.php",
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        success: function (text) {
            $('#pin_table_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            KTApp.unblockPage();
        },

    });

</script>

