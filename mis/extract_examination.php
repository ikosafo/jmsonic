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
                                    Licensure Examination Registrations
                                    <small>Extract Data</small>
                                </h3>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
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

                            <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
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

                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Profession:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="search_profession">
                                            <option value="Any">Any</option>
                                            <?php
                                            $query = $mysqli->query("select professionname from professions ORDER BY professionname");
                                            while ($result = $query->fetch_assoc()) { ?>
                                                <option <?php if (@$profession == $result['professionname']) echo "Selected" ?>><?php echo $result['professionname'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Exam Center:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select id="search_center" class="form-control bootstrap-select">
                                            <option value="Any">Any</option>
                                            <option value="Accra">Accra</option>
                                            <option value="Kumasi">Kumasi</option>
                                            <option value="Tamale">Tamale</option>
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
                                        <select id="search_approval" class="form-control bootstrap-select">
                                            <option value="Any">Any</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="Pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Search:</label>
                                    </div>
                                    <button type="button" id="search_examination" class="btn btn-primary">
                                        <i class="flaticon2-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="examination_table_div"></div>
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

    var KTSelect2 = {
        init: function () {
            //$("#select_year").select2({placeholder: "Select year"});
            $("#search_profession").select2({placeholder: "Select Profession"});
            $("#search_center").select2({placeholder: "Select Center"});
            $("#search_approval").select2({placeholder: "Select Status"});
        }
    };
    jQuery(document).ready(function () {
        KTSelect2.init()
    });

    $("#search_examination").click(function(){
        //alert('hi');
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var search_profession = $("#search_profession").val();
        var search_center = $("#search_center").val();
        var search_approval = $("#search_approval").val();

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
        if (search_profession == "") {
            error += 'Please select profession \n';
            $("#search_profession").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/tables/examination_extract_table.php",
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
                    search_center: search_center,
                    search_approval: search_approval,
                    search_profession: search_profession
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


</script>

