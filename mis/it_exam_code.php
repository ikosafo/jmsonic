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
                                    Exam Exception
                                    <small>Log In to Permanent with Examination Code</small>
                                </h3>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-7 col-xs-12 col-sm-12">
                                <div id="examexception_div"></div>
                            </div>
                            <div class="col-md-5 col-xs-12 col-sm-12">
                                <div id="examexceptiontable_div"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile3-->
        </div>
    </div>

</div>
<!--End::Dashboard 3-->
<!-- end:: Content -->

<?php require('includes/footer.php') ?>


<script>
    $.ajax({
        url: "ajax/forms/examexception_form.php",
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        success: function (text) {
            $('#examexception_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            KTApp.unblockPage();
        },

    });

    $.ajax({
        url: "ajax/tables/examexception_table.php",
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        success: function (text) {
            $('#examexceptiontable_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            KTApp.unblockPage();
        },
    });

    $(document).on('click', '.getexception_btn', function() {
        var id_index = $(this).attr('i_index');
        //alert(id_index);

        swal({
                title: "Do you want to create an exception for this applicant?",
                text: "You will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, create it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: "POST",
                        url: "ajax/queries/createexamexception",
                        data: {
                            examination_id: id_index
                        },
                        dataType: "html",
                        success:function(text) {
                            location.reload();
                        },
                        complete: function () {
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        }
                    });

                    swal("Created!", "Exception has been created for applicant.", "success");

                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });
    })

</script>


