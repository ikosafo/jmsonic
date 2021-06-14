<?php require('includes/header.php');
$usertype = $_SESSION['user_type'];
?>

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
                                    Licensure Examination Registrations
                                    <small>Exam Officer</small>
                                </h3>
                            </div>
                        </div>

                        <?php
                        if ($usertype != "MIS Admin") {
                            echo "<p>You are not eligible to view this page</p>";
                        }

                        else { ?>

                            <div class="form-group row">
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Start Date:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <input type="text" class="form-control" autocomplete="off"
                                                   id="start_date" placeholder="Select Start Date"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>End Date:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <input type="text" class="form-control" autocomplete="off"
                                                   id="end_date" placeholder="Select End Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Examination Type:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control bootstrap-select" id="examination_type">
                                                <option value="All">All</option>
                                                <option value="Main">Main</option>
                                                <option value="Supplementary">Supplementary</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Status:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control bootstrap-select" id="examination_status">
                                                <option value="All">All</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Search Query:</label>
                                        </div>
                                        <button type="button" id="load_btn" class="btn btn-primary">
                                            Click to load Data
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        ?>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="examination_table_div"></div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="approval_div"></div>
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

    $("#start_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom"
    });

    $("#end_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom"
    });

    $("#load_btn").click(function(){
        //var select_year = $("#select_year").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var examination_status = $("#examination_status").val();
        var examination_type = $("#examination_type").val();
        var admintype = 'MIS Admin';

        var error = '';
        if (start_date == "") {
            error += 'Please select start date \n';
            $("#start_date").focus();
        }
        if (end_date == "") {
            error += 'Please select end date \n';
            $("#end_date").focus();
        }
        if (start_date > end_date) {
            error += 'Please select correct date range \n';
            $("#end_date").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/tables/examination_table.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    examination_status:examination_status,
                    examination_type:examination_type,
                    admintype:admintype
                },
                success: function (text) {
                    $('#examination_table_div').html(text);
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
            $.notify(error, {position: "top center"});
        }
        return false;

    });


    $("#examination_status").selectpicker();
    $("#examination_type").selectpicker();


    $(document).on('click', '.examapprove_btn', function() {
        var id_index = $(this).attr('i_index');
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var examination_status = $("#examination_status").val();

        $('html, body').animate({
            scrollTop: $("#approval_div").offset().top
        }, 2000);

        $.ajax({
            type: "POST",
            url: "approvalmis_examination.php",
            data: {
                id_index:id_index,
                start_date: start_date,
                end_date: end_date,
                examination_status:examination_status
            },
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            success: function (text) {
                $('#approval_div').html(text);
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

